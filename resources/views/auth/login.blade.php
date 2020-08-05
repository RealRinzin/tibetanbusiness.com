@extends('layouts.app')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                                <a href="login/github" class="btn btn-primary">
                                    <i class="fab fa-github"></i> Login with Github
                                </a>
                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto m-5 card">
            <div class="row">
                <div class="col-4" style="background-image: url('/img/food6.jpg');
                    background-repeat: no-repeat;
                    background-position: center;
                    background-size: cover;
                    opacity: 0.6;"></div>
                <div class="col-8">
                    <!-- Header -->
                    <div class="py-3 text-center">
                        <h6 class="text-secondary">Login with Tibetanbusiness.com</h6>
                        <div class="dropdown-divider"></div>
                    </div>
                    <!-- form -->
                    <div class="p-2">
                        <!-- <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="input-group mb-4">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="input-group mb-4">
                                <input type="password" class="form-control" placeholder="Password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="icheck-primary">
                                        <input type="checkbox" id="remember">
                                        <label for="remember" class="text-muted small">
                                            Remember Me
                                        </label>
                                        <a class="btn btn-link text-right text-muted text-xs font-weight-bold" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    </div>
                                </div>
                                <div class="col-12 py-2">
                                    <button type="submit" class="btn btn-success btn-flat btn-block">Sign In</button>
                                </div>
                            </div>
                        </form> -->

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="input-group mb-4">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="input-group mb-4">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="icheck-primary">
                                        <input type="checkbox" id="remember">
                                        <label for="remember" class="text-muted small">
                                            Remember Me
                                        </label>
                                        <a class="btn btn-link text-right text-muted text-xs font-weight-bold" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    </div>
                                </div>
                                <div class="col-12 py-2">
                                    <button type="submit" class="btn btn-success btn-flat btn-block">Sign In</button>
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                    <a href="login/github" class="btn btn-primary">
                                        <i class="fab fa-github"></i> Login with Github
                                    </a>
                                    @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    @endif
                                </div>
                            </div> -->
                        </form>
                    </div>
                    <div class="dropdown-divider"></div>
                    <!-- Social Login -->
                    <div class="py-2">
                        <h4 class="text-muted text-center small font-weight-bold py-2">OR LOGIN USING</h4>
                        <div class="row">
                            <div class="col-6 py-2">
                                <a href="{{url('login/facebook')}}" class="btn btn-block  btn-primary">
                                    <i class="fab fa-facebook mr-2"></i>Facebook
                                </a>
                            </div>
                            <div class="col-6 py-2">
                                <a href="{{ url('login/google') }}" class="btn btn-block btn-danger">
                                    <i class="fab fa-google-plus mr-2"></i>Google
                                </a>
                            </div>
                            <div class="col-6 py-2">
                                <a href="{{url('login/github')}}" class="btn btn-block btn-secondary">
                                    <i class="fab fa-github mr-2"></i> Github
                                </a>
                            </div>
                            <div class="col-6 py-2">
                                <a href="{{url('login/github')}}" class="btn btn-block" style="background-color:#329deb;color:white">
                                    <i class="fab fa-twitter mr-2"></i> Twitter
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Create new password -->
                    <div class="py-2">
                        <p class="text-muted font-weight-bold text-center">Don't have an account? <a class="btn btn-danger btn-sm" href="{{ route('register') }}">Signup</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection