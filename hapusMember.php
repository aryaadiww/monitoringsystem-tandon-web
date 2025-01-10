<?php
session_start(); // Memulai sesi

// Koneksi ke database
include '../koneksi.php';

// Cek apakah username ada di URL
if (isset($_GET['username'])) {
    $username = $_GET['username'];

    // Query untuk menghapus member
    $sql = "DELETE FROM members WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);

    if ($stmt->execute()) {
        // Set pesan sukses
        $_SESSION['message'] = "Member berhasil dihapus!";
        $_SESSION['msg_type'] = "success";
    } else {
        // Set pesan gagal
        $_SESSION['message'] = "Gagal menghapus member: " . $stmt->error;
        $_SESSION['msg_type'] = "danger";
    }

    // Tutup koneksi
    $stmt->close();
    $conn->close();
}

// Redirect kembali ke halaman member
header("Location: memberAdmin.php");
exit;
?>