<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <li class="nav-item">
        <div class="sidebar-brand d-flex align-items-center justify-content-center">
            <img class="img-responsive" src="\images\logo_escuela.png" alt="Escuela de Informatica" height="60" width="172" data-atf="1">
                <!--<div class="sidebar-brand-icon rotate-n-15">
                <div class="sidebar-brand-text mx-3"></div>-->
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{route('home')}}">
                <i class="fas fa-home"></i>
                <span>Inicio</span></a>
            </li>

    @if (Route::has('login'))
        @auth
        <?php if (Auth::user()->type == 'administrador'): ?>

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

                            <a class="collapse-item" href="{{route('lista_usuarios')}}">Gestion de usuarios</a>
                            <!--<a class="collapse-item" href="{{route('lista_recursos')}}">Gestión de recursos</a>-->
                            <!--<a class="collapse-item" href="{{route('lista_perfiles')}}">Gestión de perfiles</a>-->
                            <a class="collapse-item" href="{{route('lista_alumnos')}}">Gestión de alumnos</a>
                            <a class="collapse-item" href="{{route('lista_supervisores')}}">Gestión de supervisores</a>
                            <a class="collapse-item" href="{{route('lista_practicas')}}">Gestión de practicas</a>
                            <a class="collapse-item" href="{{route('lista_evaluaciones_supervisor')}}">Gestión de evaluaciones supervisor</a>
                            <a class="collapse-item" href="{{route('lista_empresas')}}">Gestión de empresas</a>
                            <a class="collapse-item" href="{{route('lista_auto_evaluaciones')}}">Gestión de auto evaluaciones</a>


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
                        @if(Auth::user()->name == 'Jefe de docencia')
                            <a class="collapse-item" href="{{route('evaluacionSolicitud')}}">Solicitudes</a>
                        @endif
                        @if(Auth::user()->name == 'Gestionador')
                            <a class="collapse-item" href="{{ route('listaSolicitudCivil')}}">Solicitudes</a>
                        @endif
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
                        @if(Auth::user()->name == 'Jefe de docencia') 
                            <a class="collapse-item" href="{{route('evaluacionSolicitudEjecucion')}}">
                            Solicitudes</a>
                        @endif
                        @if(Auth::user()->name == 'Gestionador') 
                            <a class="collapse-item" href="{{ route('listaSolicitudEjecucion')}}">Solicitudes</a>
                        @endif
                        <a class="collapse-item" href="#">Inscripciones</a>
                        <a class="collapse-item" href="#">Autoevaluaciones</a>
                        <a class="collapse-item" href="#">Evaluaciones de empresas</a>

                        <h7 class="collapse-header">Asistencia a charlas</h7>
                        <a class="collapse-item" href="#">Explicación introductoria</a>
                        <a class="collapse-item" href="#">Presentaciones de práctica</a>
                    </div>
                </div>
            </li>
        <?php endif ?>
        @endauth
    @endif
    @if (Route::has('login'))
        @auth
            <?php if (Auth::user()->type == 'alumno'): ?>

                <!--Alumnos-->
                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                        Tú Práctica
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{route('descripcionSolicitud')}}">
                        <i class="fas fa-arrow-right"></i><span>Solicitud enviada</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInscripcion" aria-expanded="true" aria-controls="collapseInscripcion"><i class="fas fa-fw fa-folder"></i>
                    <span>Inscripción</span>
                    </a>
                    <div id="collapseInscripcion" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{route('descripcionSolicitudDocumentos')}}">Solicitar documentos</a>
                            <a class="collapse-item" href="{{route('descripcionInscripcion')}}">Inscribir práctica</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEvaluacion" aria-expanded="true" aria-controls="collapseEvaluacion"><i class="fas fa-fw fa-folder"></i>
                    <span>Evaluación</span>
                    </a>
                    <div id="collapseEvaluacion" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{route('descripcionAutoEvaluacion')}}">Realizar autoevaluación</a>
                        </div>
                    </div>
                </li>
            <?php endif ?>

        @endauth

    @endif
    @if (Auth::guest())

        <!--Alumnos-->
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
                Tú Práctica
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('descripcionSolicitud')}}">
                <i class="fas fa-arrow-right"></i><span>Solicita tu práctica aquí</span>
            </a>
        </li>

    @endif
    @if (Route::has('login'))
        @auth
            <?php if (Auth::user()->type == 'supervisor'): ?>
                <!--Supervisor-->
                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Práctica
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{route('descripcionEvaluacionEmpresa')}}">
                        <i class="fas fa-arrow-right"></i><span>Evalúa a tu practicante</span>
                    </a>
                </li>
            <?php endif ?>
        @endauth
    @endif


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->