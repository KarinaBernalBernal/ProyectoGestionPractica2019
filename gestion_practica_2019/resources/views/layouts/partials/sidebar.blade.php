<!-- Sidebar -->
<?php   use SGPP\Administrador; ?>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="position: fixed; z-index: 1; width: 100%; height: 100%; overflow-x: hidden;">  <!-- style="position: fixed; z-index: 1;"  -->
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
        <?php
            $gestionador = Administrador::where('id_user', Auth::user()->id_user)->where('nombre', Auth::user()->name)->where('email', Auth::user()->email)->where('cargo', 'Gestionador')->first();
            $jefeDocencia = Administrador::where('id_user', Auth::user()->id_user)->where('nombre', Auth::user()->name)->where('email', Auth::user()->email)->where('cargo', 'Jefe de docencia')->first();
            $profesor = Administrador::where('id_user', Auth::user()->id_user)->where('nombre', Auth::user()->name)->where('email', Auth::user()->email)->where('cargo', 'Profesor')->first();?>

        <?php if (Auth::user()->type == 'administrador'): ?>

        <!--Administrador-->
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Gestión Practicas Profesionales
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            @if(Auth::user()->type == 'administrador' && $jefeDocencia != null || $gestionador !=null)
            <li class="nav-item">

                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGestionCuentas" aria-expanded="true" aria-controls="collapseGestionCuentas"><i class="fas fa-users"></i>
                <span>Mantenedores</span>
                </a>
                <div id="collapseGestionCuentas" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <a class="collapse-item" href="{{route('lista_usuarios')}}">Usuarios</a>
                        <!--<a class="collapse-item" href="{{route('lista_recursos')}}">recursos</a>-->
                        <!--<a class="collapse-item" href="{{route('lista_perfiles')}}">perfiles</a>-->
                        <a class="collapse-item" href="{{route('lista_alumnos')}}">Alumnos</a>
                        <a class="collapse-item" href="{{route('lista_administradores')}}">Administradores</a>
                        <a class="collapse-item" href="{{route('lista_supervisores')}}">Supervisores</a>
                        <a class="collapse-item" href="{{route('lista_practicas')}}">Prácticas</a>
                        <a class="collapse-item" href="{{route('lista_empresas')}}">Empresas</a>
                        <a class="collapse-item" href="{{route('lista_auto_evaluaciones')}}">Autoevaluaciones</a>
                        <a class="collapse-item" href="{{route('lista_evaluaciones_supervisor')}}">Evaluaciones supervisor</a>
                        <h6 class="collapse-header">Formularios</h6>
                        <a class="collapse-item" href="{{route('lista_elementos_dinamicos')}}">Elementos dinámicos</a>
                        <a class="collapse-item" href="{{route('lista_otros')}}">Respuestas "otro"</a>
                    </div>
                </div>
            </li>
            @endif
            @if(Auth::user()->type == 'administrador' && $jefeDocencia != null || $profesor !=null)
            <li class="nav-item">
                <!-- Solo profesores -->
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseResolucionPracticas" aria-expanded="true" aria-controls="collapseResolucionPracticas"><i class="fas fa-archive"></i>
                    <span>Resolución de Prácticas</span>
                </a>
                <div id="collapseResolucionPracticas" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{route('ResolucionPracticaCivil')}}">Ing. Civil Informática</a>
                        <a class="collapse-item" href="{{route('ResolucionPracticaEjecucion')}}">Ing. Ejec. Informática</a>
                    </div>
                </div>
                <!-- -->
            </li>
            @endif
            @if(Auth::user()->type == 'administrador' && $jefeDocencia != null || $profesor !=null)
                <li class="nav-item">
                    <!-- Solo profesores -->
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseVerEstadisticas" aria-expanded="true" aria-controls="collapseVerEstadisticas"><i class="fas fa-chart-bar"></i>
                            <span>Ver estadísticas</span>
                        </a>
                        <div id="collapseVerEstadisticas" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded"> 
                                <a class="collapse-item" href="{{route('estadisticaAlumno')}}">Estadísticas por alumno</a>
                                <a class="collapse-item" href="{{route('estadisticaCriteriosAutoeval')}}">Autoevaluaciones del <br>alumno</a>
                                <a class="collapse-item" href="{{route('estadisticaCriteriosEvalSupervisor')}}"> Evaluaciones del <br>supervisor</a>
                                <a class="collapse-item" href="{{route('estadisticaGeneral')}}">Estadísticas generales</a>
                            </div>
                        </div>
                    <!-- -->
                </li>
            @endif
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                    Documentos
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                @if(Auth::user()->type == 'administrador' && $gestionador != null)
                    <a class="nav-link collapsed" href="{{route('lista_solicitudes_documentos')}}">
                        <i class="fas fa-arrow-right"></i><span>Solicitudes documentos</span>
                    </a>        
                @endif

            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseIngCivilInf" aria-expanded="true" aria-controls="collapseIngCivilInf"><i class="fas fa-users"></i>
                <span>Ing. Civil Informática:</span>
                </a>
                <div id="collapseIngCivilInf" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Gestión general</h6>
                        <a class="collapse-item" href="alumnosPracticaCivil">Alumnos en práctica</a>
                        <a class="collapse-item" href="supervisoresPracticaCivil">Supervisores</a>

                        <h6 class="collapse-header">Etapas</h6>
                        @if(Auth::user()->type == 'administrador' && $jefeDocencia != null)
                            <a class="collapse-item" href="{{route('evaluacionSolicitud')}}">Solicitudes</a>
                        @endif
                        @if(Auth::user()->type == 'administrador' && $gestionador != null)
                            <a class="collapse-item" href="{{ route('listaSolicitudCivil')}}">Solicitudes</a>
                        @endif
                        <a class="collapse-item" href="{{route('listaInscripcionCivil')}}">Inscripciones</a>
                        <a class="collapse-item" href="#">Autoevaluaciones</a>
                        <a class="collapse-item" href="#">Evaluaciones de <br> Empresas</a>

                        @if(Auth::user()->type == 'administrador' && $gestionador != null)
                            <h7 class="collapse-header">Gestión de Charlas</h7>
                            <a class="collapse-item" href="#">Charlas de Presentación</a>
                        @endif

                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseIngEjecInf" aria-expanded="true" aria-controls="collapseIngEjecInf"><i class="fas fa-users"></i>
                <span>Ing. Ejec. Informática</span>
                </a>
                <div id="collapseIngEjecInf" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Gestión general</h6>
                        <a class="collapse-item" href="alumnosPracticaEjecucion">Alumnos en práctica</a>
                        <a class="collapse-item" href="supervisoresPracticaEjecucion">Supervisores</a>

                        <h6 class="collapse-header">Etapas</h6>
                        @if(Auth::user()->type == 'administrador' && $jefeDocencia != null)
                            <a class="collapse-item" href="{{route('evaluacionSolicitudEjecucion')}}">
                            Solicitudes</a>
                        @endif
                        @if(Auth::user()->type == 'administrador' && $gestionador != null)
                            <a class="collapse-item" href="{{ route('listaSolicitudEjecucion')}}">Solicitudes</a>
                        @endif
                        <a class="collapse-item" href="{{route('listaInscripcionEjecucion')}}">Inscripciones</a>
                        <a class="collapse-item" href="#">Autoevaluaciones</a>
                        <a class="collapse-item" href="#">Evaluaciones de <br> Empresas</a>

                        @if(Auth::user()->type == 'administrador' && $gestionador != null)
                            <h7 class="collapse-header">Gestión de Charlas</h7>
                            <a class="collapse-item" href="#">Charlas de Presentación</a>
                        @endif
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
                <!--<li class="nav-item">
                    <a class="nav-link collapsed" href="{{route('descripcionSolicitud')}}">
                        <i class="fas fa-arrow-right"></i><span>Solicitud enviada</span>
                    </a>
                </li>-->

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
        <i class="fas fa-angle-double-left fa-2x" id="hola" style="color: #f2eeed;"></i>
    </div>

</ul>

<!-- End of Sidebar -->

<script>

    $('#hola').click(function()
    {
        $('#accordionSidebar').hide(80);
        $('#topBarToggle').show();
        $('#content').removeAttr('style');

    });


</script>