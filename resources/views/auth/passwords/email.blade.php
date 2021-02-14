@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-8 mx-auto m-5 card">
            <div class="row">
                <div class="col-4 text-center" style="background-image: url('/img/food12.jpg');
                    background-repeat: no-repeat;
                    background-position: center;
                    background-size: cover;
                    opacity: 0.8;">
                    <img src="/img/tibetanbusiness.png" alt="" style="top:50%">
                </div>
                <div class="col-8">
                    <!-- Header -->
                    <div class="py-3 text-center">
                        <h6 class="text-secondary">Reset Your Password...</h6>
                        <div class="dropdown-divider"></div>
                    </div>
                    <!-- form -->
                    <div class="p-2">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="input-group mb-4">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-12 py-2">
                                    <button type="submit" class="btn btn-warning">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection