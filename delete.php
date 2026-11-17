<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
include("koneksi.php");

$id = $_GET['id'];
$result = mysqli_query($koneksi, "DELETE FROM produk WHERE id=$id");

header("Location: admin_index.php");
?>
