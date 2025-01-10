<?php
include "../koneksi.php";

// Data untuk grafik pie (status transaksi)
$dataPie = [
    "berhasil" => 0,
    "diproses" => 0,
    "preorder" => 0,
];

// Query untuk pie chart
$queryPie = "SELECT 
                (SELECT COUNT(*) FROM riwayat) AS berhasil,
                (SELECT COUNT(*) FROM transaksi) AS diproses,
                (SELECT COUNT(*) FROM pre_order) AS preorder";
$resultPie = $conn->query($queryPie);
if ($resultPie) {
    $dataPie = $resultPie->fetch_assoc();
}

// Data untuk grafik line (bulanan)
$months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
$preorderData = array_fill(0, 12, 0); // Isi awal dengan 0
$riwayatData = array_fill(0, 12, 0);

// Query pre-order per bulan
$queryPreorder = "SELECT MONTH(tanggal) - 1 AS month, COUNT(*) AS total FROM pre_order GROUP BY MONTH(tanggal)";
$resultPreorder = $conn->query($queryPreorder);
while ($row = $resultPreorder->fetch_assoc()) {
    $preorderData[intval($row['month'])] = intval($row['total']);
}

// Query riwayat transaksi per bulan
$queryRiwayat = "SELECT MONTH(tanggal) - 1 AS month, COUNT(*) AS total FROM riwayat GROUP BY MONTH(tanggal)";
$resultRiwayat = $conn->query($queryRiwayat);
while ($row = $resultRiwayat->fetch_assoc()) {
    $riwayatData[intval($row['month'])] = intval($row['total']);
}

// Gabungkan data dan kirim sebagai JSON
echo json_encode([
    "pie" => $dataPie,
    "line" => [
        "months" => $months,
        "preorder" => $preorderData,
        "riwayat" => $riwayatData
    ]
]);
?>
