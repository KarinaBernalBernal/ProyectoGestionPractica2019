@extends('layouts.mainlayout')

@section('content')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="h3 mb-0 text-gray-800">Evaluación del Supervisor</h3>
    </div>
        
    <div class="card text">
        <div class="card-body"> 

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <a href="{{ URL::previous() }}"><button class="btn btn-secondary">Atrás</button></a>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection