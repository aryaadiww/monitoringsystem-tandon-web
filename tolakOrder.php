<?php
include "../koneksi.php";

$id = $_GET["id"];


$query = mysqli_query($conn, "DELETE FROM pre_order where id=$id");

// <script >alert, window.location.href</script>

// header("Location:  index.php");
// 
if ($query) {
    echo "<script text='text/javascript'>
alert('Data berhasil dihapus'); window.location.href='preOrderAdmin.php'
</script>";
    // header("location: index.php");
}
