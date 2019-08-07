@extends('layouts.app2')

@section('content')
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">  
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Restablecer contraseña</h1>
                                    </div>

                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    <form class="user" method="POST" action="{{ route('password.request') }}">
                                        {{ csrf_field() }}
            
                                        <input type="hidden" name="token" value="{{ $token }}">
            
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <div class="col-md">
                                                <input id="email" type="email" class="form-control form-control-user" name="email" aria-describedby="emailHelp"
                                                placeholder="Correo electrónico" value="{{ $email or old('email') }}" required autofocus>
            
                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
            
                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <div class="col-md">
                                                <input id="password" type="password" class="form-control form-control-user" name="password" aria-describedby="emailHelp" 
                                                placeholder="Nueva contraseña" required>
            
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
            
                                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">                                            
                                            <div class="col-md">
                                                <input id="password-confirm" type="password" class="form-control form-control-user" name="password_confirmation" aria-describedby="emailHelp" 
                                                placeholder="Confirmar contraseña" required>
            
                                                @if ($errors->has('password_confirmation'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <div class="col-md">
                                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                                    Cambiar contraseña
                                                </button>
                                            </div>
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
