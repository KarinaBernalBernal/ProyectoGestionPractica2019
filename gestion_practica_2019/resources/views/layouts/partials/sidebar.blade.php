<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
        <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
        <div class="sidebar-brand-text mx-3">INF PUCV </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('home')}}">
        <i class="fas fa-home"></i>
        <span>Inicio</span></a>
    </li>

    <!--Administrador-->
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Gestión Practicas Profesionales
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGestionCuentas" aria-expanded="true" aria-controls="collapseGestionCuentas"><i class="fas fa-users"></i>
            <span>Gestionar cuentas</span>
            </a>
            <div id="collapseGestionCuentas" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="#">Gestion de usuarios</a>
                    <a class="collapse-item" href="#">Gestión de perfiles</a>                
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseIngCivilInf" aria-expanded="true" aria-controls="collapseIngCivilInf"><i class="fas fa-users"></i>
            <span>Ing. Civil Informatica:</span>
            </a>
            <div id="collapseIngCivilInf" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Gestión general</h6>
                    <a class="collapse-item" href="#">Alumnos en práctica</a>
                    <a class="collapse-item" href="#">Supervisores</a>

                    <h6 class="collapse-header">Etapas</h6>
                    <a class="collapse-item" href="#">Solicitudes</a>
                    <a class="collapse-item" href="#">Inscripciones</a>
                    <a class="collapse-item" href="#">Autoevaluaciones</a>
                    <a class="collapse-item" href="#">Evaluaciones de empresas</a>

                    <h7 class="collapse-header">Asistencia a charlas</h7>
                    <a class="collapse-item" href="#">Explicación introductoria</a>
                    <a class="collapse-item" href="#">Presentaciones de práctica</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseIngEjecInf" aria-expanded="true" aria-controls="collapseIngEjecInf"><i class="fas fa-users"></i>
            <span>Ing. Ejec. Informatica</span>
            </a>
            <div id="collapseIngEjecInf" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Gestión general</h6>
                    <a class="collapse-item" href="#">Alumnos en práctica</a>
                    <a class="collapse-item" href="#">Supervisores</a>

                    <h6 class="collapse-header">Etapas</h6>
                    <a class="collapse-item" href="#">Solicitudes</a>
                    <a class="collapse-item" href="#">Inscripciones</a>
                    <a class="collapse-item" href="#">Autoevaluaciones</a>
                    <a class="collapse-item" href="#">Evaluaciones de empresas</a>

                    <h7 class="collapse-header">Asistencia a charlas</h7>
                    <a class="collapse-item" href="#">Explicación introductoria</a>
                    <a class="collapse-item" href="#">Presentaciones de práctica</a>
                </div>
            </div>
        </li>

    <!-- -- -->

    <!--Alumnos-->
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
                Tú Práctica
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('home')}}">
                <i class="fas fa-arrow-right"></i><span>Solicita tu práctica aquí</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInscripcion" aria-expanded="true" aria-controls="collapseInscripcion"><i class="fas fa-fw fa-folder"></i>
            <span>Inscripción</span>
            </a>
            <div id="collapseInscripcion" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="register.html">Solicitar documentos</a>
                    <a class="collapse-item" href="404.html">Inscribir práctica</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEvaluacion" aria-expanded="true" aria-controls="collapseEvaluacion"><i class="fas fa-fw fa-folder"></i>
            <span>Evaluación</span>
            </a>
            <div id="collapseEvaluacion" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="blank.html">Realizar autoevaluación</a>
                </div>
            </div>
        </li>
    <!-- -- -->

    <!--Supervisor-->
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Práctica
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="fas fa-arrow-right"></i><span>Evalúa a tu practicante</span>
            </a>
        </li>
    <!-- -- -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    
</ul>
<!-- End of Sidebar -->