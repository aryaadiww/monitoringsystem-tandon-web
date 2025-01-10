<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Memulai sesi
include '../koneksi.php';

if (!isset($_SESSION['loggedinMember']) || $_SESSION['loggedinMember'] !== true) {
    header('Location: login.php'); // Arahkan ke halaman login jika belum login
    exit;
}

// Ambil semua device yang dimiliki user berdasarkan kode_alat
$username = $_SESSION['usernameMember'];
$query = "SELECT * FROM alat WHERE kode_alat IN (SELECT kode_alat FROM alat WHERE username_member = ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$devices = $stmt->get_result();
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
  <body>
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
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h3 class="mb-4">Device Saya</h3>
                    <?php if($devices->num_rows > 0): ?>
                      <div class="table-responsive">
                        <table class="table table-dark text-white">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Kode Alat</th>
                              <th>Status</th>
                              <th>Nilai Kekeruhan</th>
                              <th>Nilai Ketinggian</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            $no = 1;
                            while($device = $devices->fetch_assoc()): 
                            ?>
                            <tr style="cursor: pointer;" onclick="switchDevice('<?php echo $device['kode_alat']; ?>')">
                              <td><?php echo $no++; ?></td>
                              <td><?php echo $device['kode_alat']; ?></td>
                              <td>
                                <?php if(isset($_SESSION['kode_alat']) && $_SESSION['kode_alat'] == $device['kode_alat']): ?>
                                  <span class="badge badge-success">Aktif</span>
                                <?php else: ?>
                                  <span class="badge badge-secondary text-dark">Tidak Aktif</span>
                                <?php endif; ?>
                              </td>
                              <td><?php echo $device['nilai_keruh']; ?></td>
                              <td><?php echo $device['nilai_tinggi']; ?></td>
                              <td>
                                <button class="btn btn-danger btn-sm" onclick="event.stopPropagation(); hapusDevice('<?php echo $device['kode_alat']; ?>')">
                                  Hapus
                                </button>
                              </td>
                            </tr>
                            <?php endwhile; ?>
                          </tbody>
                        </table>
                      </div>
                    <?php else: ?>
                      <div class="alert alert-info">
                        Anda belum memiliki device. Silakan tambahkan device baru.
                      </div>
                    <?php endif; ?>

                    <div class="mt-4">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahDeviceModal">
                        Tambah Device Baru
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block"></span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © Toserba 2024</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>

    <!-- Modal Tambah Device -->
    <div class="modal fade" id="tambahDeviceModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Device Baru</h5>
            <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="formTambahDevice">
            <div class="modal-body">
              <div class="form-group">
                <label>Kode Alat</label>
                <input type="text" class="form-control" id="kodeAlat" name="kodeAlat" required>
                <small class="form-text text-muted">Masukkan kode alat yang ingin ditambahkan</small>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Tambah Device</button>
            </div>
          </form>
        </div>
      </div>
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
    $(document).ready(function() {
      $('#formTambahDevice').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
          url: 'verifyAndAddDevice.php',
          type: 'POST',
          dataType: 'json',
          data: {
            kode_alat: $('#kodeAlat').val(),
            username: '<?php echo $_SESSION['username']; ?>'
          },
          success: function(response) {
            if(response.status === 'success') {
              alert('Device berhasil ditambahkan!');
              location.reload();
            } else {
              alert(response.message);
            }
          },
          error: function() {
            alert('Terjadi kesalahan. Silakan coba lagi.');
          }
        });
      });
    });

    function hapusDevice(kodeAlat) {
      if(confirm('Apakah Anda yakin ingin menghapus device ini?')) {
        $.ajax({
          url: 'hapusDevice.php',
          type: 'POST',
          dataType: 'json',
          data: {
            kode_alat: kodeAlat,
            username: '<?php echo $_SESSION['username']; ?>'
          },
          success: function(response) {
            if(response.status === 'success') {
              alert('Device berhasil dihapus!');
              location.reload();
            } else {
              alert(response.message);
            }
          },
          error: function() {
            alert('Terjadi kesalahan. Silakan coba lagi.');
          }
        });
      }
    }

    function switchDevice(kodeAlat) {
      if(confirm('Apakah Anda yakin ingin beralih ke device ini?')) {
        $.ajax({
          url: 'switchDevice.php',
          type: 'POST',
          dataType: 'json',
          data: {
            kode_alat: kodeAlat,
            username: '<?php echo $_SESSION['username']; ?>'
          },
          success: function(response) {
            if(response.status === 'success') {
              alert('Berhasil beralih ke device baru!');
              window.location.href = 'dashboardMember.php';
            } else {
              alert(response.message);
            }
          },
          error: function() {
            alert('Terjadi kesalahan. Silakan coba lagi.');
          }
        });
      }
    }
    </script>
  </body>
</html>


