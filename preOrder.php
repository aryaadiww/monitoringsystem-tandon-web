<?php
include '../koneksi.php';

$notification = ""; // Variabel untuk menyimpan notifikasi
$redirect = false; // Variabel untuk mengatur redirect

// Memeriksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $message = $_POST['message'];

    // Mendapatkan tanggal saat ini
    $date = date('Y-m-d'); // Format tanggal: YYYY-MM-DD

    // Menyiapkan dan mengeksekusi query
    $sql = "INSERT INTO pre_order (tanggal, nama, email, no_telepon, alamat, pesan) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $date, $name, $email, $phone, $address, $message);

    if ($stmt->execute()) {
        $notification = "<div class='alert alert-success' role='alert'>Data berhasil disimpan! Terima kasih atas preorder Anda.</div>";
        $redirect = true; // Set redirect ke true jika berhasil
    } else {
        $notification = "<div class='alert alert-danger' role='alert'>Error: " . $stmt->error . ". Gagal menyimpan data.</div>";
    }

    // Menutup koneksi
    $stmt->close();
}

// Menutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Preorder</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style2.css">
    <link rel="shortcut icon" href="../members/assets/images/logo.png" type="image/x-icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script>
        // Fungsi untuk redirect setelah beberapa detik
        function redirect() {
            setTimeout(function() {
                window.location.href = 'index.php'; 
            }, 2000); 
        }

        // Memanggil fungsi redirect jika ada notifikasi sukses
        <?php if ($redirect): ?>
            redirect();
        <?php endif; ?>
    </script>
</head>
<body>
    <nav class="navbar">
        <div class="container-navbar">
            <div class="logo">
                <a href="index.php"><img src="logo.png" alt="Logo"></a>
            </div>
            <ul class="nav-links">
                <a href="index.php#beranda"><li>Beranda</li></a>
                <a href="index.php#tentang"><li>Tentang</li></a>
                <a href="index.php#testimoni"><li>Testimoni</li></a>
                <a href="index.php#kontak"><li>Kontak</li></a>
            </ul>
            <div class="nav-buttons">
                <button class="login-btn" onclick="window.location.href='../members/login.php'">Login</button>
                <button class="pre-order-btn" onclick="window.location.href='preOrder.php'">Pre-Order</button>
            </div>
        </div>
    </nav>
    <div class="hero-section">
        <div class="preorder-container">
            <?php if ($notification): ?>
                <div class="notification">
                    <?php echo $notification; ?>
                </div>
            <?php endif; ?>
            <form action="" method="POST">
                <h2>Pre-Order</h2>
                <input type="text" id="name" name="name" placeholder="Nama" required>
                <input type="email" id="email" name="email" placeholder="Email" required>
                <input type="tel" id="phone" name="phone" placeholder="No Telepon" required>
                <textarea id="address" name="address" placeholder="Alamat" required></textarea>
                <textarea id="message" name="message" placeholder="Pesan"></textarea>
                <button type="submit" class="btn btn-primary">Kirim Preorder</button>
            </form>
        </div>
    </div>
    <script>
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({ alpha: true });
        renderer.setSize(window.innerWidth, window.innerHeight);
        document.querySelector('.hero-section').appendChild(renderer.domElement);

        // Fungsi untuk membuat tetes air
        function createFallingDrop() {
            const textureLoader = new THREE.TextureLoader();
            const dropTexture = textureLoader.load('tetesair.png'); // Path gambar tetes air
            const geometry = new THREE.PlaneGeometry(0.1, 0.2); // Bentuk tetes air
            const material = new THREE.MeshBasicMaterial({ map: dropTexture, transparent: true });
            const drop = new THREE.Mesh(geometry, material);

            // Menentukan posisi awal tetes air
            drop.position.x = (Math.random() - 0.5) * 10;
            drop.position.y = Math.random() * 10 + 5; // Mulai dari lebih tinggi
            drop.position.z = (Math.random() - 0.5) * 10;

            scene.add(drop);

            // Animasi tetes air jatuh
            function animateDrop() {
                drop.position.y -= 0.1; // Gerakan ke bawah (percepat sedikit)
                if (drop.position.y < -5) {
                    drop.position.y = 10; // Reset posisi ke atas
                }
                requestAnimationFrame(animateDrop);
            }
            animateDrop();
        }

        // Membuat beberapa tetes air
        for (let i = 0; i < 200; i++) { // Meningkatkan jumlah tetes air
            createFallingDrop();
        }

        // Mengatur posisi kamera agar sesuai dengan .hero-section
        camera.position.z = 5; // Jarak dari layar
        camera.position.y = 0; // Posisikan kamera lebih tinggi agar objek 3D muncul dari atas

        // Fungsi animasi
        function animate() {
            requestAnimationFrame(animate);
            renderer.render(scene, camera);
        }

        animate();
    </script>
</body>
</html>
