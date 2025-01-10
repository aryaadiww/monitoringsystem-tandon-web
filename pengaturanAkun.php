<?php
session_start();
include '../koneksi.php'; // Pastikan Anda memiliki file koneksi.php untuk menghubungkan ke database

// Pastikan data pengguna sudah disimpan dalam sesi saat login
if (!isset($_SESSION['usernameMember'])) {
    header("Location: login.php"); // Redirect ke halaman login jika belum login
    exit();
}

// Ambil data pengguna dari database
$username = $_SESSION['usernameMember'];
$query = "SELECT * FROM members WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if ($result) {
    $user = mysqli_fetch_assoc($result);
    $_SESSION['email'] = $user['email'];
    $_SESSION['alamat'] = $user['alamat'];
} else {
    // Tangani kesalahan jika query gagal
    echo "Error: " . mysqli_error($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
      tr[style*="cursor: pointer"]:hover {
        background-color: rgba(255, 255, 255, 0.1) !important;
      }
    </style>
  </head>
  <body class="d-flex flex-column" style="min-height: 100vh;">
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top" style="padding: 10px; text-align: center;">
          <a class="sidebar-brand brand-logo" href="dashboardAdmin.php">
            <img src="assets/images/logo.png" alt="logo" class="img-fluid" style="max-width: 40%; height: auto;" />
          </a>
        </div>
        <ul class="nav mt-4">
          <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  <img class="img-xs rounded-circle " src="assets/images/faces/cepi.jpeg" alt="">
                  <span class="count bg-success"></span>
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal"><?php echo $_SESSION['usernameMember']; ?></h5>
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item menu-items mt-3">
            <a class="nav-link <?php echo $current_page == 'dashboardMember.php' ? 'active' : ''; ?>" href="dashboardMember.php">
              <span class="menu-icon">
                <i class="mdi mdi-home"></i>
              </span>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link <?php echo $current_page == 'kekeruhanAir.php' ? 'active' : ''; ?>" href="kekeruhanAir.php">
              <span class="menu-icon">
                <i class="mdi mdi-clipboard-outline"></i>
              </span>
              <span class="menu-title">Kekeruhan Air</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link <?php echo $current_page == 'ketinggianAir.php' ? 'active' : ''; ?>" href="ketinggianAir.php">
              <span class="menu-icon">
                <i class="mdi mdi-cash-register"></i>
              </span>
              <span class="menu-title">Ketinggian Air</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link <?php echo $current_page == 'laporKerusakan.php' ? 'active' : ''; ?>" href="laporKerusakan.php">
              <span class="menu-icon">
                <i class="mdi mdi-history"></i>
              </span>
              <span class="menu-title">Lapor Kerusakan</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link <?php echo $current_page == 'tambahDevice.php' ? 'active' : ''; ?>" href="tambahDevice.php">
              <span class="menu-icon">
                <i class="mdi mdi-monitor-multiple"></i>
              </span>
              <span class="menu-title">Ganti Device</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link <?php echo $current_page == 'pengaturanAkun.php' ? 'active' : ''; ?>" href="pengaturanAkun.php">
              <span class="menu-icon">
                <i class="mdi mdi-account"></i>
              </span>
              <span class="menu-title">Pengaturan Akun</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="dashboardAdmin.php"><img src="assets/images/logo.png" alt="logo" class="img-fluid" style="max-width: 50%; height: auto;" /></a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item dropdown border-left">
                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                  <i class="mdi mdi-email"></i>
                  <span class="count bg-success"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                  <h6 class="p-3 mb-0">Messages</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="assets/images/faces/face4.jpg" alt="image" class="rounded-circle profile-pic">
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Mark send you a message</p>
                      <p class="text-muted mb-0"> 1 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="assets/images/faces/face2.jpg" alt="image" class="rounded-circle profile-pic">
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Cregh send you a message</p>
                      <p class="text-muted mb-0"> 15 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="assets/images/faces/face3.jpg" alt="image" class="rounded-circle profile-pic">
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Profile picture updated</p>
                      <p class="text-muted mb-0"> 18 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">4 new messages</p>
                </div>
              </li>
              <li class="nav-item dropdown border-left">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                  <i class="mdi mdi-bell"></i>
                  <span class="count bg-danger"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                  <h6 class="p-3 mb-0">Notifications</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-calendar text-success"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Event today</p>
                      <p class="text-muted ellipsis mb-0"> Just a reminder that you have an event today </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-settings text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Settings</p>
                      <p class="text-muted ellipsis mb-0"> Update dashboard </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-link-variant text-warning"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Launch Admin</p>
                      <p class="text-muted ellipsis mb-0"> New admin wow! </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">See all notifications</p>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                  <div class="navbar-profile">
                    <img class="img-xs rounded-circle" src="assets/images/faces/cepi.jpeg" alt="">
                    <p class="mb-0 d-none d-sm-block navbar-profile-name"><?php echo $_SESSION['usernameMember']; ?></p>
                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                  <h6 class="p-3 mb-0">Akun</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item" href="pengaturanAkun.php">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-settings text-success"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Pengaturan Akun</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-logout text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Keluar</p>
                    </div>
                  </a>
                </div>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>
        <div class="main-panel">
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Profil Pengguna</h4>
                  <p class="card-description"> Informasi pengguna saat ini </p>

                  <!-- Notifikasi -->
                  <?php if (isset($_SESSION['update_success'])): ?>
                      <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                          <?php echo $_SESSION['update_success']; ?>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <?php unset($_SESSION['update_success']); // Hapus notifikasi setelah ditampilkan ?>
                  <?php endif; ?>

                  <form class="forms-sample" method="post">
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" class="form-control text-dark" id="username" value="<?php echo $_SESSION['usernameMember']; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control text-dark" id="email" value="<?php echo $_SESSION['email']; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="alamat">Alamat</label>
                      <textarea class="form-control text-dark" id="alamat" readonly><?php echo $_SESSION['alamat']; ?></textarea>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Perbarui Akun</h4>
                  <p class="card-description"> Form untuk memperbarui informasi akun </p>
                  <form class="forms-sample" action="editAkun.php" method="post">
                    <div class="form-group">
                      <label for="newUsername">Username</label>
                      <input type="text" class="form-control text-white" id="newUsername" name="newUsername" placeholder="Username Baru">
                    </div>
                    <div class="form-group">
                      <label for="newEmail">Email Baru</label>
                      <input type="email" class="form-control text-white" id="newEmail" name="email" placeholder="Email Baru">
                    </div>
                    <div class="form-group">
                      <label for="newAlamat">Alamat Baru</label>
                      <textarea class="form-control text-white" id="newAlamat" name="alamat" placeholder="Alamat Baru"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="newPassword">Password Baru</label>
                      <input type="password" class="form-control text-white" id="newPassword" name="password" placeholder="Password Baru">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Perbarui</button>
                    <button class="btn btn-dark">Batal</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <footer class="footer" style="position: relative; bottom: 0; width: 100%;">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block"></span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © Toserba 2024</span>
            </div>
            </footer>
          <!-- partial -->
        </div>
      <!-- page-body-wrapper ends -->
    </div>


    <!-- Modal Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Keluar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Apakah Anda yakin ingin keluar?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <a href="logout.php" class="btn btn-danger">Keluar</a>
          </div>
        </div>
      </div>
    </div>

    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
    <script src="main.js"></script>

    <script>
        // Menghilangkan notifikasi setelah 2 detik
        setTimeout(function() {
            var alert = document.getElementById('success-alert');
            if (alert) {
                alert.classList.remove('show');
                alert.classList.add('fade');
                setTimeout(function() {
                    alert.remove();
                }, 500); // Waktu untuk menghapus elemen setelah fade
            }
        }, 2000); // 2000 ms = 2 detik
    </script>

  </body>
</html>