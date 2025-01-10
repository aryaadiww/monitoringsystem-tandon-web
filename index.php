<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toserba</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="../members/assets/images/logo.png" type="image/x-icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
</head>
<body>
    <nav class="navbar">
        <div class="container-navbar">
            <div class="logo">
                <img src="logo.png" alt="Logo">
            </div>
            <div class="nav-toggle" id="nav-toggle">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            <ul class="nav-links" id="nav-links">
                <a href="#beranda"><li>Beranda</li></a>
                <a href="#tentang"><li>Tentang</li></a>
                <a href="#testimoni"><li>Testimoni</li></a>
                <a href="#kontak"><li>Kontak</li></a>
                <a href="../members/login.php"><li>Login</li></a>
                <a href="preOrder.php"><li>Pre-Order</li></a>
            </ul>
        </div>
    </nav>

    <section class="hero-section" id="beranda">
        <div class="container-beranda">
            <h1>Jaga Kebersihan<br>Pantau Ketinggian</h1>
            <p class="subtitle">Monitoring air anda agar selalu bersih dan sehat</p>
            <div class="search-bar">
                <input type="text" placeholder="Find something...">
                <button class="search-btn">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </div>
    </section>

    <section class="tentang" id="tentang">
        <h2 class="judul-tentang">Tentang</h2>
        <div class="container-tentang-atas">
            <div class="tentang-kiri">
                <img src="alat2.png" alt="">
            </div>
            <div class="demo">
                <div class="container-tentang-video">
                    <video controls>
                        <source src="demo.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
        <div class="container-penjelasan">
            <div class="teks-penjelasan">
                <p>Sistem monitoring kualitas kekeruhan dan ketinggian air adalah solusi berbasis IoT yang memungkinkan pengguna memantau kondisi air secara real-time, memastikan kualitas air tetap bersih, mencegah kekurangan air, serta memberikan notifikasi otomatis dan laporan data untuk analisis lebih lanjut.</p>
            </div>
        </div>
        <div class="container-tentang-bawah">
            <div class="features">
                <div class="feature-card">
                    <i class="fa-solid fa-laptop feature-icon"></i>
                    <div class="feature-info">
                        <h3>Tejangkau</h3>
                        <p>Mudah diakses melalui Website dan Mobile anda</p>
                    </div>
                </div>
                <div class="feature-card">
                    <i class="fa-solid fa-clock feature-icon"></i>
                    <div class="feature-info">
                        <h3>Real-Time</h3>
                        <p>Nilai yang didapat Real-Time beserta grafik</p>
                    </div>
                </div>
                <div class="feature-card">
                    <i class="fa-solid fa-money-bill feature-icon"></i>
                    <div class="feature-info">
                        <h3>Ekonomis</h3>
                        <p>Harga sebanding dengan kualitas yang ditawarkan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonials" id="testimoni">
        <div class="container-testimoni">
            <h2>Apa Kata Mereka</h2>
            <div class="testimonial-slider">
                <div class="testimonial active">
                    <div class="testimonial-image">
                        <img src="pakNaufal.jpeg" alt="Pak Naufal">
                    </div>
                    <div class="testimonial-content">
                        <blockquote>
                            <p>Sistem ini sangat membantu saya dalam memantau tandon air saya, saya tidak perlu memanjat lagi untuk melihatnya</p>
                        </blockquote>
                        <cite>
                            <span>Pak Naufal</span><br>
                            <p>Ujung Berung</p>
                        </cite>
                    </div>
                </div>
                <div class="testimonial">
                    <div class="testimonial-image">
                        <img src="anis.jpeg" alt="Pak Budi">
                    </div>
                    <div class="testimonial-content">
                        <blockquote>
                            <p>Sistem ini adalah wujud inovasi yang menghadirkan jaminan kualitas air dan kenyamanan hidup melalui teknologi yang memberdayakan.</p>
                        </blockquote>
                        <cite>
                            <span>Pak Budi</span><br>
                            <p>Bandung</p>
                        </cite>
                    </div>
                </div>
            </div>
            <div class="indicators">
                <span class="dot active"></span>
                <span class="dot"></span>
            </div>
        </div>
    </section>

    <section class="penjual">

    </section>

    <section class="footer" id="kontak">
        <div class="footer-top">
            <div class="footer-logo">
                <img src="logo.png" alt="Logo">
                <p>Sistem monitoring kualitas kekeruhan dan ketinggian air pada tandon</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="footer-form">
                <h4>Send Us Your Feedback</h4>
                <form>
                    <input type="email" placeholder="Enter your email" required>
                    <textarea placeholder="Your message..." required></textarea>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">
            <p>Term of Conditions | Cookies | Privacy and Security</p>
            <p>© 2024 Toserba. All right reserved.</p>
        </div>
    </section>

    <script>
        let currentIndex = 0;
        const testimonials = document.querySelectorAll('.testimonial');
        const dots = document.querySelectorAll('.dot');
        const totalTestimonials = testimonials.length;

        function showNextTestimonial() {
            testimonials[currentIndex].classList.remove('active');
            dots[currentIndex].classList.remove('active');
            currentIndex = (currentIndex + 1) % totalTestimonials;
            testimonials[currentIndex].classList.add('active');
            dots[currentIndex].classList.add('active');
        }

        setInterval(showNextTestimonial, 2000);

        // Inisialisasi scene, camera, dan renderer
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({ alpha: true });
        renderer.setSize(window.innerWidth, window.innerHeight);

        // Menambahkan renderer ke elemen .hero-section
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
                drop.position.y -= 0.05; // Gerakan ke bawah
                if (drop.position.y < -5) {
                    drop.position.y = 10; // Reset posisi ke atas
                }
                requestAnimationFrame(animateDrop);
            }
            animateDrop();
        }

        // Membuat beberapa tetes air
        for (let i = 0; i < 100; i++) {
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

        const navToggle = document.getElementById('nav-toggle');
        const navLinks = document.getElementById('nav-links');

        navToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });

    </script>
</body>
</html>
