<?php
include '../koneksi.php';
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['loggedinMember']) || $_SESSION['loggedinMember'] !== true) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Unauthorized access'
    ]);
    exit;
}

$kode_alat = filter_input(INPUT_POST, 'kode_alat', FILTER_SANITIZE_STRING);
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);

if (empty($kode_alat) || empty($username)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Parameter tidak lengkap'
    ]);
    exit;
}

try {
    // Cek apakah kode alat valid
    $stmt = $conn->prepare("SELECT * FROM alat WHERE kode_alat = ?");
    $stmt->bind_param("s", $kode_alat);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Kode alat tidak valid'
        ]);
        exit;
    }

    $alat = $result->fetch_assoc();
    
    // Cek apakah alat sudah terdaftar ke user lain
    if ($alat['username_member'] && $alat['username_member'] !== $username) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Alat sudah terdaftar ke pengguna lain'
        ]);
        exit;
    }

    // Update username_member di alat
    $update = $conn->prepare("UPDATE alat SET username_member = ? WHERE kode_alat = ?");
    $update->bind_param("ss", $username, $kode_alat);
    
    if ($update->execute()) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Device berhasil ditambahkan'
        ]);
    } else {
        throw new Exception("Gagal mengupdate data");
    }

} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Terjadi kesalahan: ' . $e->getMessage()
    ]);
}

$conn->close();
?>