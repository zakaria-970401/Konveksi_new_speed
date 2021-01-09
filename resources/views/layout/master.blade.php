
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('judul')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.google.com/specimen/Cairo?selection.family=Cairo|Source+Sans+Pro:ital,wght@1,200">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
 
  <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="/assets/plugins/daterangepicker/daterangepicker.css">

  <link rel="stylesheet" href="/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- summernote -->
    <!-- Select2 -->
  <link rel="stylesheet" href="/assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  
  <!-- HIGHCHARTS-->
  <script src="/assets/dist/js/highcharts/highcharts.js"></script>
  <script src="/assets/dist/js/highcharts/exporting.js"></script>
  <script src="/assets/dist/js/highcharts/export-data.js"></script>
  <script src="/assets/dist/js/highcharts/accessibility.js"></script>
  <!-- HIGHCHARTS-->


</head>
<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
  <div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
      </li>
     
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
      </li>
       <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <img src="{{asset('foto_akun/'.Auth::user()->foto)}}" class="img-circle" style="width: 31px">
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">{{Auth::user()->name}}</span>
          <div class="dropdown-divider"></div>
          <a href="/profile/{{Auth::user()->id}}" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="#modal_logout" data-toggle="modal" class="dropdown-item">
            <i class="fas fa-power-off mr-2"></i> Logout
          </a>
      </li>
 
    
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link mt-2">
      <span class="brand-image elevation-3" style="opacity: .5">NS</span>
      <center><span class="brand-text font-weight-light">NEW SPEED | APPS</span></center>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="zoom: 90%">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('foto_akun/'.Auth::user()->foto)}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="/admin" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                DASHBOARD UTAMA
              </p>
            </a>
            <li class="nav-header">ORDERAN MASUK</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p>
                Orderan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/input_orderan" class="nav-link">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>Input Orderan</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/orderan/belum_proses" class="nav-link">
                  <i class="far fa-clock nav-icon"></i>
                  <p> Orderan Belum Di Proses</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/on_proses" class="nav-link">
                  <i class="fas fa-dolly"></i>
                  <p> Orderan Proses Produksi</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/siap_kirim" class="nav-link">
                  <i class="fas fa-truck"></i>
                  <p>Orderan Siap Antar</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/orderan_selesai" class="nav-link">
                  <i class="fas fa-check"></i>
                  <p>Orderan Selesai</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/lihat_orderan" class="nav-link">
                  <i class="fa fa-eye nav-icon"></i>
                  <p>Lihat Semua Orderan</p>
                </a>
              </li>
            </ul>
        </li>
           <li class="nav-header">PENGGAJIAN</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                 <i class="nav-icon fas fa-users"></i>
                <p>
                Gaji Karyawan
                <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/sudah_di_bayar" class="nav-link">
                   <i class="	far fa-smile nav-icon"></i>
                 <p>Sudah Di Bayar</p>
                </a>
            </li>
                <li class="nav-item">
                  <a href="/belum_di_bayar" class="nav-link">
                   <i class="far fa-frown nav-icon"></i>
                 <p>Belum Di Bayar</p>
                </a>
            </li>
                <li class="nav-item">
                  <a href="/all_list" class="nav-link">
                   <i class="fas fa-clock nav-icon"></i>
                 <p>History</p>
                </a>
            </li>
         </ul>
           <li class="nav-header">STOK BARANG</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                 <i class="nav-icon fas fa-clipboard-list"></i>
                <p>
                STOK
                <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/stok" class="nav-link">
                   <i class="fas fa-eye nav-icon"></i>
                 <p>Lihat Stok</p>
                </a>
            </li>
         </ul>
           <li class="nav-header">OMSET</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                 <i class="nav-icon fas fa-chart-line"></i>
                <p>
                GRAFIK
                <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/omset_bulanan" class="nav-link">
                   <i class="	fas fa-bullseye nav-icon"></i>
                 <p>Omset Bulanan</p>
                </a>
            </li>
         </ul>
         <li class="nav-header">MASTER DATA</li>
         <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon 	fas fa-tv"></i>
            <p>
              MASTER DATA
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/master_orderan" class="nav-link">
                <p> ORDERAN</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/penggajian/dashboard" class="nav-link">
                <p> GAJI KARYAWAN</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/master_stok" class="nav-link">
                <p> STOK BARANG</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/master_akun" class="nav-link">
                <p> ACCOUNT</p>
              </a>
            </li>
          </ul>
           <li class="nav-header">AKUN</li>
            <li class="nav-item">
              <a href="/profile/{{Auth::user()->id}}" class="nav-link">
                 <i class="nav-icon fas fa-user-alt"></i>
                <p>
                PROFILE
                </p>
              </a>
                <li class="nav-item">
                  <a href="#modal_logout" data-toggle="modal" class="nav-link">
                   <i class="fas fa-power-off nav-icon"></i>
                 <p>LOGOUT</p>
                </a>
            </li>
         </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


  <div class="modal fade" id="modal_logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Tutup Aplikasi??</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-footer no-print">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <a href="/logout" class="btn btn-danger"><i class="fas fa-power-off"> Ya, Keluar</i></a>
        </div>
      </div>
    </div>
  </div>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content" style="zoom: 85%">
      <div class="container-fluid mt-4">
        @include('sweetalert::alert')
            @yield('konten')
    </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer no-print">
    <strong>Copyright &copy; 2020 Ahmad Zakaria All Right Reserved</strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/assets/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- Bootstrap 4 -->
<script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/assets/plugins/sparklines/sparkline.js"></script>


<script src="/assets/plugins/select2/js/select2.full.min.js"></script>

<!-- daterangepicker -->
<script src="/assets/plugins/moment/moment.min.js"></script>
<script src="/assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/assets/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/assets/dist/js/pages/dashboard.js"></script>
<script src="/assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<script type="text/javascript">
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2() 
    $("#mytable").DataTable();
    $('#sistem_dp').on('change',function()
        {
            if( $(this).val()==="YA")
            {
                $("#total_dp").show()
            }
            else
            {
                $("#total_dp").hide()
            }
        });

        $('.BtnTambah').click(function() {
       var fieldHTML = '<div class="form-group col-md-12 kolom_asli">' + $(".kolom_copy").html() + '</div>';
          $('body').find('.kolom_asli:last').after(fieldHTML);
        $('#BtnHapus').show();
          $("body").on("click", "#BtnHapus", function() {
        $(this).parents(".kolom_asli").remove();
        });
      });
    });

    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})


    </script>
</body>

</html>
