@extends('layouts.main_layout')

@section('content')
<div id="content" class="container div-vertical-center">
    <div class="row align-items-center" >
        <div class="col-md-12 mx-auto">
            <div class="card border-primary">
                <div class="card-header font-weight-bold h3 text-secondary mx-auto" style="text-align: center; margin-top:40px"><span class="text-primary h1 font-weight-bold" style="font-weigth:bolder">PMFM SYSTEM</span><br><p style="font-size: 14px">Performance Monitoring and Fault Mangement System</p></div>
                <img class="img-responsive  mx-auto d-block" style="margin-top: -20px" src="../assets/img/crdlogo.png" alt="">
                <div class="card-body">
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row" style="margin-top: 50px">
                            <span for="email" class="col-md-4 col-form-label text-md-right text-primary"><span class="material-icons">
                                alternate_email
                                </span></span>
                            <div class="col-md-6">
                                <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <span for="password" class="col-md-4 col-form-label text-md-right text-primary"><span class="material-icons">
                                vpn_key
                                </span></span>

                            <div class="col-md-6">
                                <input id="password" type="password" placeholder="Password"  class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                
                                <button type="submit" class="btn btn-primary">
                                    <span class="material-icons">
                                        login </span>  {{ __('Login') }}
                                </button>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                               
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">              
                                    <a class="btn btn-link" >
                                        <span class="material-icons">
                                            help
                                            </span> Help
                                    </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
