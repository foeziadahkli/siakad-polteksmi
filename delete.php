<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM users WHERE id=$id";
    
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
    } else {
        echo "Error menghapus data: " . mysqli_error($conn);
    }
}
?>
