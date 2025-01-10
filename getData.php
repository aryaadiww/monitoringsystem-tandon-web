<?php
include "../koneksi.php"; // Hubungkan dengan database

function getTotalTransaksi($conn) {
    $query = "SELECT COUNT(*) AS total_transaksi FROM riwayat";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total_transaksi'];
}

function getTotalPreOrder($conn) {
    $query = "SELECT COUNT(*) AS total_pre_order FROM pre_order";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total_pre_order'];
}

function getTotalMembers($conn) {
    $query = "SELECT COUNT(*) AS total_members FROM members";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total_members'];
}

function getTotalProses($conn) {
    $query = "SELECT COUNT(*) AS total_proses FROM transaksi";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total_proses'];
}
?>
