<?php
include '../koneksi.php';
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Unauthorized access'
    ]);
    exit;
}

$kode_alat = filter_input(INPUT_POST, 'kode_alat', FILTER_SANITIZE_STRING);
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);

try {
    // Hapus hubungan user dengan alat
    $stmt = $conn->prepare("UPDATE alat SET username_member = NULL WHERE kode_alat = ? AND username_member = ?");
    $stmt->bind_param("ss", $kode_alat, $username);
    
    if ($stmt->execute()) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Device berhasil dihapus'
        ]);
    } else {
        throw new Exception("Gagal menghapus device");
    }

} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Terjadi kesalahan: ' . $e->getMessage()
    ]);
}

$conn->close();
?>