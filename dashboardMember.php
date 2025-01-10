<?php
include '../koneksi.php';
session_start(); // Memulai sesi

if (!isset($_SESSION['loggedinMember']) || $_SESSION['loggedinMember'] !== true) {
    header('Location: login.php'); // Arahkan ke halaman login jika belum login
    exit;
}

if(isset($_SESSION['kode_alat'])) {
    $kodeAlat = $_SESSION['kode_alat'];
    $sql = mysqli_query($conn, "SELECT * FROM alat WHERE kode_alat = '$kodeAlat'");
    $data_alat = mysqli_fetch_array($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard Members</title>
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
    <link rel="stylesheet" href="grafikTinggi.css">
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
  
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script type="text/javascript">

        $(document).ready( function() {

          setInterval(function() {
               $("#kekeruhan").load("../monitoringair2/bacakekeruhan.php");
              //  $("#status").load("../monitoring2/bacastatus.php");
               $("#ketinggian").load("../monitoringair2/bacaketinggian.php");
              //  $("#status2").load("../monitoring2/bacastatus2.php"); 
          }, 1000 );  

        } );    

     </script>
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
                  <i class="mdi mdi-contact-mail"></i>
                  <span class="count bg-success"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                  <h6 class="p-3 mb-0">Hubungi Kami</h6>
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
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Status Alat</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0"><?php echo isset($data_alat['kode_alat']) ? $data_alat['kode_alat'] : '-'; ?></h2>
                        </div>
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-message-alert <?php echo isset($data_alat) ? 'text-success' : 'text-danger'; ?> ml-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>kekeruhan Air</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 id="kekeruhan" class="mb-0">Tunggu...</h2>
                        </div>
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-water text-primary ml-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Ketinggian Air</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                            <h2 id="ketinggian" class="mb-0">Tunggu...</h2>
                        </div>
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-water-pump text-primary ml-auto"></i>
                      </div>
                    </div>
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
            <a href="logOut.php" class="btn btn-danger">Keluar</a> <!-- Ganti dengan URL logout yang sesuai -->
          </div>
        </div>
      </div>
    </div>
    <!-- container-scroller -->
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
    <script src="main.js"></script>
    <!-- End custom js for this page -->
    
    <script>
    $(document).ready(function () {
        const ctx = document.getElementById('waterClarityChartDashboard').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Nilai Keruh Air', 'Batas Air Bersih'],
                datasets: [{
                    label: 'Kekeruhan Air',
                    data: [0, 500],
                    backgroundColor: ['#795C32', 'rgba(255, 255, 255, 0.6)']
                }]
            },
            options: {
                responsive: true
            }
        });

        function updateChart() {
            $.ajax({
                url: '../monitoringair2/bacakekeruhan.php',
                method: 'GET',
                success: function(response) {
                    const turbidityValue = parseInt(response) || 0;
                    let status = '';
                    let backgroundColor;
                    
                    // Tentukan status dan warna berdasarkan nilai kekeruhan
                    if (turbidityValue <= 200) {
                        status = 'Air Bersih';
                        backgroundColor = ['#795C32', 'rgba(255, 255, 255, 0.6)'];
                    } else if (turbidityValue <= 500) {
                        status = 'Air Agak Keruh';
                        backgroundColor = ['orange', 'rgba(255, 255, 255, 0.6)'];
                    } else {
                        status = 'Air Keruh';
                        backgroundColor = ['cyan', 'rgba(255, 255, 255, 0.6)'];
                    }

                    // Update chart
                    myChart.data.datasets[0].data = [turbidityValue, 500 - turbidityValue];
                    myChart.data.datasets[0].backgroundColor = backgroundColor;
                    myChart.update();
                }
            });
        }

        // Update setiap 1 detik
        setInterval(updateChart, 1000);
    });
    </script>
    
    <script>
    $(document).ready(function() {
        const maxKetinggian = 15.5; // Batas maksimum ketinggian air

        function updateWaterLevel() {
            $.ajax({
                url: '../monitoringair2/bacaketinggian.php',
                method: 'GET',
                success: function(data) {
                    const ketinggianAir = parseFloat(data);
                    const heightPercentage = (ketinggianAir / maxKetinggian) * 100;

                    // Update tampilan grafik
                    $('#water').css('height', heightPercentage + '%');
                    $('#ketinggian').text(ketinggianAir.toFixed(1) + ' cm');

                    // Update status dan warna berdasarkan ketinggian
                    let status = '';
                    let color = '';

                    if (ketinggianAir <= 6) {
                        status = 'Air Rendah';
                        color = 'red';
                    } else if (ketinggianAir <= 10) {
                        status = 'Air Normal';
                        color = 'yellow';
                    } else if (ketinggianAir <= 11) {
                        status = 'Air Penuh';
                        color = 'green';
                    } else {
                        status = 'Air Tinggi';
                        color = 'orange';
                    }

                    $('#water').css('background-color', color);
                    $('#statusKetinggian').html(status);
                    $('#ketinggian').html(data);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }

        // Panggil fungsi sekali saat halaman dimuat
        updateWaterLevel();
        
        // Update setiap 1 detik
        setInterval(updateWaterLevel, 1000);
    });
    </script>
    
  </body>
</html>
