<?php
session_start(); // Memulai sesi

// Cek jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../koneksi.php'; // Ganti dengan path koneksi database Anda

    // Ambil data dari form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $noHp = $_POST['noHp'];
    $alamat = $_POST['alamat'];
    $tanggalBergabung = date('Y-m-d H:i:s'); // Ambil tanggal dan waktu saat ini

    // Koneksi ke database dan simpan data
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Query untuk menambahkan member
    $sql = "INSERT INTO members (username, password, email, noHp, alamat, bergabung) VALUES ('$username', '$password', '$email', '$noHp', '$alamat', '$tanggalBergabung')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Member berhasil ditambahkan!";
        $_SESSION['msg_type'] = "success"; // Tipe pesan
    } else {
        $_SESSION['message'] = "Error: " . $conn->error;
        $_SESSION['msg_type'] = "danger"; // Tipe pesan
    }

    // Redirect ke halaman memberAdmin.php setelah selesai
    header("Location: memberAdmin.php");
    exit;

    // Tutup koneksi
    $conn->close();
} else {
    // Jika bukan POST, redirect ke halaman memberAdmin.php
    header("Location: memberAdmin.php");
    exit;
}
?>
