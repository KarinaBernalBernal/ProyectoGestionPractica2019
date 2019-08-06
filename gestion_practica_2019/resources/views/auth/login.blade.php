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
                                        <h1 class="h4 text-gray-900 mb-2">Bienvenido!</h1>
                                    </div>
                                    
                                    <form class="user" method="POST" action="{{ route('login') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                            <input class="form-control form-control-user" id="email"
                                                type="email" aria-describedby="emailHelp"
                                                name="email" placeholder="Correo electrónico"
                                                value="{{ old('email') }}" required autofocus>
                                        </div>

                                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" required placeholder="Contraseña">
                                            
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif    
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Recordar</label>
                                            </div>
                                        </div>    
                                        
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                    Iniciar Sesión
                                            </button>
                                        </div>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="{{ route('password.request') }}">¿Haz olvidado tu contraseña?</a>
                                        </div>

                                        <div class="text-center">
                                            <a class="small" href="{{ route('register')}}">¡Crea una Cuenta!</a>
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