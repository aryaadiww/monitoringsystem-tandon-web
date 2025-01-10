<?php

include "../koneksi.php";

$id = $_GET["id"];

if ($id > 0) {
    // Mulai transaksi
    mysqli_begin_transaction($conn);

    try {
        $insert = mysqli_query($conn, 
            "INSERT INTO transaksi (tanggal, nama, no_telepon, alamat, pesan)
             SELECT tanggal, nama, no_telepon, alamat, pesan
             FROM pre_order WHERE id = $id");

        if (!$insert) {
            throw new Exception("Gagal memindahkan data ke tabel transaksi: " . mysqli_error($conn));
        }

        $delete = mysqli_query($conn, "DELETE FROM pre_order WHERE id = $id");

        if (!$delete) {
            throw new Exception("Gagal menghapus data dari tabel pre_order: " . mysqli_error($conn));
        }

        mysqli_commit($conn);

        echo "<script>alert('Data berhasil dipindahkan ke tabel transaksi dan dihapus dari pre-order');
        window.location.href = 'transaksiAdmin.php';</script>";
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo "Terjadi kesalahan: " . $e->getMessage();
    }
} else {
    echo "ID tidak valid.";
}
?>