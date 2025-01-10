<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: loginMember.php'); // Arahkan ke halaman login jika belum login
    exit;
}

// Ambil semua alat yang dimiliki oleh pengguna
$username = $_SESSION['username'];
$sql = "SELECT * FROM alat WHERE username_member = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pilih Alat</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Pilih Alat Anda</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Alat</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php $no = 1; ?>
                    <?php while ($alat = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $alat['kode_alat']; ?></td>
                            <td><?php echo $alat['username_member'] ? 'Aktif' : 'Tidak Aktif'; ?></td>
                            <td>
                                <form method="post" action="switchDevice.php">
                                    <input type="hidden" name="kode_alat" value="<?php echo $alat['kode_alat']; ?>">
                                    <button type="submit" class="btn btn-primary">Pilih</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Tidak ada alat yang terdaftar.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
