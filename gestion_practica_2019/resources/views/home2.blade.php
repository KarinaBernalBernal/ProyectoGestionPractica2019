@extends('layouts.mainlayout')

@section('content')
    <!-- Main Content -->
    <div id="content">
        <!-- Topbar -->
        @include('layouts.partials.topbar')
        
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Reglas</h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
            </div>

            <!-- Content Row -->
            <div class="card text">
                <!-- Card Body -->
                <div class="card-header">
                    Titulo
                </div>
                <div class="card-body">
                    detalles de la practica
                </div>
            </div>

            

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
@endsection
