<?php
session_start();
include '../koneksi.php'; // Pastikan Anda memiliki file koneksi.php untuk menghubungkan ke database

// Proses pembaruan akun
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_SESSION['username'];
    $newUsername = $_POST['newUsername'] ?? null; // Tambahkan input untuk username baru
    $newEmail = $_POST['email'] ?? null; // Tambahkan input untuk email baru
    $newAlamat = $_POST['alamat'] ?? null; // Tambahkan input untuk alamat baru
    $newPassword = $_POST['password'] ?? null; // Ambil password baru

    // Update username jika ada
    if (!empty($newUsername)) {
        $query = "UPDATE members SET username = '$newUsername' WHERE username = '$username'";
        mysqli_query($conn, $query);
        $_SESSION['username'] = $newUsername; // Perbarui session username
        $updateMessages[] = "Username berhasil diperbarui.";
    }

    // Update email jika ada
    if (!empty($newEmail)) {
        $query = "UPDATE members SET email = '$newEmail' WHERE username = '$username'";
        mysqli_query($conn, $query);
        $_SESSION['email'] = $newEmail; // Perbarui session email
        $updateMessages[] = "Email berhasil diperbarui.";
    }

    // Update alamat jika ada
    if (!empty($newAlamat)) {
        $query = "UPDATE members SET alamat = '$newAlamat' WHERE username = '$username'";
        mysqli_query($conn, $query);
        $_SESSION['alamat'] = $newAlamat; // Perbarui session alamat
        $updateMessages[] = "Alamat berhasil diperbarui.";
    }

    // Update password jika ada
    if (!empty($newPassword)) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $query = "UPDATE members SET password = '$hashedPassword' WHERE username = '$username'";
        if (mysqli_query($conn, $query)) {
            $updateMessages[] = "Password berhasil diperbarui.";
        } else {
            $updateMessages[] = "Error: " . mysqli_error($conn);
        }
    }

    // Set notifikasi jika ada pembaruan
    if (!empty($updateMessages)) {
        $_SESSION['update_success'] = "Data berhasil diubah.";
    }

    header("Location: pengaturanAkun.php");
    exit();
}
?>