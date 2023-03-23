<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SILA | {{ $title ?? 'Dashboard' }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('template/backend/sb-admin-2') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="{{ asset('template/backend/sb-admin-2') }}/css/sb-admin-2.min.css" rel="stylesheet">
    
    <link href="select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('jquery/jquery-ui-themes-1.12.1') }}//themes/smoothness/jquery-ui.css" rel="stylesheet">
    @stack('css')
    
   </head>
<script>
    var myModal = document.getElementById('myModal')
</script>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        {{-- @include('layouts.backend.sidebar') --}}
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                {{-- @include('layouts.backend.navbar') --}}
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">{{ $pageTitle ?? '' }}</h1>
                    @yield('content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are You Sure ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')


    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('template/backend/sb-admin-2') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('template/backend/sb-admin-2') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('template/backend/sb-admin-2') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('template/backend/sb-admin-2') }}/js/sb-admin-2.min.js"></script>

    {{-- <!-- Page level plugins -->
    <script src="{{ asset('template/backend/sb-admin-2') }}/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('template/backend/sb-admin-2') }}/js/demo/chart-area-demo.js"></script>
    <script src="{{ asset('template/backend/sb-admin-2') }}/js/demo/chart-pie-demo.js"></script> --}}
    <script type="text/javascript">
        $(document).ready(function(){
            window.addEventListener("keydown", (event) => {
            if (event.defaultPrevented) {
                return; // Should do nothing if the default action has been cancelled
            }
            let handled = false;
            if (event.key === 'Enter') {
                // Handle the event with KeyboardEvent.key
                handled = true;
            } else if (event.keyCode === '13') {
                // Handle the event with KeyboardEvent.keyCode
                handled = true;
            }
            if (handled) {
                // Suppress "double action" if event handled
                event.preventDefault();
            }
            }, true);
        });
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
        });
    </script>
    <script type="module" src="bootstrap/js/bootstrap.js"></script>
    <script type="module" src="jquery/jquery-ui-1.12.1/jquery-ui.js"></script>
    <script src="select2/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="jquery/jquery-2.1.4.min.js"></script>
    <script src="jquery/jquery-1.12.4.js"></script>
    @stack('js')
    
</body>

</html>