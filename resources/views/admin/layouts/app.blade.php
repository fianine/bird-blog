<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Birds Blog - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

  @stack('styles')  
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('secret.dashboard') }}">
        <div class="sidebar-brand-text mx-3">Birds <sup>Blog</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item {{ URL::current() == route('secret.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('secret.dashboard') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Content
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item {{ URL::current() == route('secret.articles') || URL::current() == route('secret.addArticle') ? 'active' : '' }}">
        <a class="nav-link collapsed {{ URL::current() == route('secret.articles') ? 'active' : '' }}" href="#" data-toggle="collapse" data-target="#collapseArticle" aria-expanded="true" aria-controls="collapseArticle">
          <i class="fas fa-fw fa-pen"></i>
          <span>Articles</span>
        </a>
        <div id="collapseArticle" class="collapse {{ URL::current() == route('secret.articles') || URL::current() == route('secret.addArticle') ? 'show' : '' }}" aria-labelledby="headingArticle" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ URL::current() == route('secret.addArticle') ? 'active' : '' }}" href="{{ route('secret.addArticle') }}">Add New Article</a>
            <a class="collapse-item {{ URL::current() == route('secret.articles') ? 'active' : '' }}" href="{{ route('secret.articles') }}">Articles</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Settings</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="#">Change Email</a>
            <a class="collapse-item" href="#">Change Password</a>
          </div>
        </div>
      </li> --}}

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      
      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth()->user()->name }}</span>
                <img class="img-profile rounded-circle" src="data:image/jpeg;base64,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">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}" >
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- End of Topbar -->

        @yield('content')

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Birds Blog @php echo date('Y'); @endphp</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>

  @yield('script')

</body>
</html>
