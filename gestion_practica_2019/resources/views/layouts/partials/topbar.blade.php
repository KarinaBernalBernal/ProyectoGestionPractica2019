<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" id="topBar">


    <!-- Sidebar Toggle (Topbar) -->
    <div class=" d-none d-md-inline" id="topBarToggle" style="display: none; color: #2e59d9">
        <i class="fa fa-bars fa-2x"></i>
    </div>


    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">

            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                        </a>

                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <!--<a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Perfil
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Ajustes
                            </a>
                            <div class="dropdown-divider"></div>-->
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Cerrar Sesión
                            </a>
                        </div>
                    @else

                        <a  class="col-md-auto" href="{{ route('login') }}" >
                            <button class="btn btn-primary btn-user btn-block col-md-auto">Ingresar</button>
                        </a>
                        <!-- Esto esta aca para crear usuario XD-->
                        <!--<a class="btn btn-primary btn-user" href="{{ route('register') }}">Register</a>-->
                    @endauth
                </div>
            @endif

        </li>

    </ul>

</nav>

<script>

    $('#topBarToggle').click(function()
    {
        $('#accordionSidebar').show(90);
        $('#topBarToggle').hide();
        $('#content').attr('style','margin-left: 215px; padding: 0px 10px;');


    });
</script>
<!-- End of Topbar -->