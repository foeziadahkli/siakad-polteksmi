<?php
include 'config.php';

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
$user = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];

    // Jika ganti password
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $query = "UPDATE users SET name='$name', username='$username', password='$password' WHERE id=$id";
    } else {
        $query = "UPDATE users SET name='$name', username='$username' WHERE id=$id";
    }

    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5" style="max-width: 500px;">
    <h2>Edit User</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="name" value="<?= htmlspecialchars($user['name']); ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" value="<?= htmlspecialchars($user['username']); ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password (Kosongkan jika tidak diubah)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <button type="submit" name="update" class="btn btn-warning">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</body>
</html>
