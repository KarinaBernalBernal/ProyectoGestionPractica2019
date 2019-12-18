<!DOCTYPE html>
<html lang="en">

    @include('layouts.partials.head')

    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">
            @include('layouts.partials.sidebar')

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column" style="position: absolute; width: 100%; height: 100%">
                <!-- Topbar -->
                @include('layouts.partials.topbar')
            <!-- Main Content -->
                <div id="content" style="margin-left: 215px; padding: 0px 10px;">
                        @yield('content')
                <!-- End of Main Content -->
                </div>
                @include('layouts.partials.footer')
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        @include('layouts.partials.modal-logout')
        @include('layouts.partials.footer-scripts')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        @yield('scripts')
    </body>
</html>
