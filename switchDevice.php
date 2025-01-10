<?php
session_start();
include '../koneksi.php';

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

try {
    // Verifikasi kepemilikan device
    $stmt = $conn->prepare("SELECT * FROM alat WHERE kode_alat = ? AND username_member = ?");
    $stmt->bind_param("ss", $kode_alat, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Ambil nilai dari device yang baru
        $deviceData = $result->fetch_assoc();
        
        // Update session dengan device baru
        $_SESSION['kode_alat'] = $kode_alat;
        $_SESSION['nilai_keruh'] = $deviceData['nilai_keruh']; // Simpan nilai kekeruhan
        $_SESSION['nilai_tinggi'] = $deviceData['nilai_tinggi']; // Simpan nilai ketinggian
        
        echo json_encode([
            'status' => 'success',
            'message' => 'Berhasil beralih ke device baru'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Device tidak ditemukan atau bukan milik Anda'
        ]);
    }

} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Terjadi kesalahan: ' . $e->getMessage()
    ]);
}

$conn->close();
?>