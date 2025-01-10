<?php
session_start();
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['katasandi'];
    $kode_alat = $_POST['kode_alat']; // Ambil kode alat dari form login

    // Cek kredensial pengguna
    $stmt = $conn->prepare("SELECT * FROM members WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            $_SESSION['loggedinMember'] = true;
            $_SESSION['usernameMember'] = $username;

            // Ambil data alat berdasarkan kode alat
            $stmt = $conn->prepare("SELECT * FROM alat WHERE kode_alat = ? AND username_member = ?");
            $stmt->bind_param("ss", $kode_alat, $username);
            $stmt->execute();
            $alatResult = $stmt->get_result();

            if ($alatResult->num_rows > 0) {
                $alatData = $alatResult->fetch_assoc();
                $_SESSION['kode_alat'] = $alatData['kode_alat'];
                $_SESSION['nilai_keruh'] = $alatData['nilai_keruh'];
                $_SESSION['nilai_tinggi'] = $alatData['nilai_tinggi'];
            } else {
                // Jika tidak ada alat yang terdaftar, bisa mengarahkan ke halaman pemilihan alat
                header('Location: pilihAlat.php');
                exit;
            }

            header('Location: dashboardMember.php');
            exit;
        } else {
            echo "Username atau password salah.";
        }
    } else {
        echo "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toserba</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
</head>
<body>
    <nav class="navbar">
        <div class="container-navbar">
            <div class="logo">
                <img src="assets/images/logo.png" alt="Logo">
            </div>
            <div class="nav-toggle" id="nav-toggle">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            <ul class="nav-links" id="nav-links">
                <a href="../landingPage/index.php#beranda"><li>Beranda</li></a>
                <a href="../landingPage/index.php#tentang"><li>Tentang</li></a>
                <a href="../landingPage/index.php#testimoni"><li>Testimoni</li></a>
                <a href="../landingPage/index.php#kontak"><li>Kontak</li></a>
                <a href="login.php"><li>Login</li></a>
                <a href="../landingPage/preOrder.php"><li>Pre-Order</li></a>
            </ul>
        </div>
    </nav>
    <div class="hero-section">
        <!-- Container untuk form login -->
        <div class="login-container">
            <form method="POST" action="">
                <h2>Login Member</h2>
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="katasandi" placeholder="Kata Sandi" required>
                <input type="text" name="kode_alat" placeholder="Kode Alat" required>
                <button type="submit">Masuk</button>
            </form>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('form').on('submit', function(e) {
            var username = $('input[name="username"]').val();
            var password = $('input[name="katasandi"]').val();
            var kode_alat = $('input[name="kode_alat"]').val();
            
            if (!username || !password || !kode_alat) {
                e.preventDefault();
                alert('Semua field harus diisi!');
                return false;
            }
        });

        $('input[name="kode_alat"]').on('blur', function() {
            var kode = $(this).val();
            if (kode.trim() === '') {
                alert('Alat belum terpasang. Silakan masukkan kode alat.');
                return;
            }
            $.ajax({
                url: 'loginMember.php?api=check_alat',
                type: 'GET',
                data: { kode: kode },
                dataType: 'json',
                success: function(response) {
                    if (!response.verified) {
                        alert('Kode alat yang dimasukkan salah!');
                        $('input[name="kode_alat"]').val('');
                    }
                }
            });
        });
    });
    </script>

    <script>
      const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({ alpha: true });
        renderer.setSize(window.innerWidth, window.innerHeight);

        // Menambahkan renderer ke elemen .hero-section
        document.querySelector('.hero-section').appendChild(renderer.domElement);

        // Fungsi untuk membuat tetes air
        function createFallingDrop() {
            const textureLoader = new THREE.TextureLoader();
            const dropTexture = textureLoader.load('../landingPage/tetesair.png'); // Path gambar tetes air
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
    <script>
        const navToggle = document.getElementById('nav-toggle');
        const navLinks = document.getElementById('nav-links');

        navToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active'); // Toggle class active pada nav-links
        });
    </script>
</body>
</html>