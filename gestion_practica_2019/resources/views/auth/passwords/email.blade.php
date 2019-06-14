@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
    
            <div class="col-xl-10 col-lg-12 col-md-9">
    
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">¿Haz olvidado tu contraseña?</h1>
                                        <p class="mb-4">Lo sabemos, cosas que pasan. Sólo tiene que introducir su email y le enviaremos un enlace para restablecer su contraseña.</p>
                                    </div>

                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    
                                    <form class="user" method="POST" action="{{ route('password.email') }}">
                                        {{ csrf_field() }}
                                        
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <input id="email" type="email" class="form-control form-control-user" name="email" aria-describedby="emailHelp" 
                                                placeholder="Enter Email Address..." value="{{ old('email') }}" required>
                
                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                    
                                            <div class="form-group">
                                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                                        Send Password Reset Link
                                                    </button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
</div>
@endsection
