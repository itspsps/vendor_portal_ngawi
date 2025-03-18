@extends('dashboard.admin_log.layout.auth')
@section('title')
SURYA PANGAN SEMESTA
@endsection
@section('content')
@include('sweetalert::alert')
<style type="text/css">
    @media only screen and (min-width: 600px) {
        #sign {
            margin-top: 10%;
            border-radius: 20px;
        }

        #input_username {
            border-radius: 30px;
        }
    }
</style>
<section class="sign-in">
    <div class="container">
        <div class="row">
            <div id="sign" class="col-xs-12 col-md-8 offset-md-2 card shadow-lg" style="background-color:#9F187C">
                <div class="row p-2">
                    <div class="col-xs-12 col-md-6">
                        <div class="signin-image text-center" style="position: absolute; top: 50%; transform: translateY(-50%);">
                            <h4 style="position: absolute; bottom: 12%; left: 40%; transform: translateY(-50%); color: #ffffff;">NGAWI</h4>
                            <figure><img src="{{ asset('logo-login-sps.png') }}" width="100%" alt="sign up image"></figure>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <h2 class="form-title" style="color:white;"><br><b>SIGN IN</b></h2>
                        <form class="register-form" id="login-form" action="{{route('ap.check')}}" method="post">
                            @if (Session::get('fail'))
                            <div class="alert alert-danger">
                                {{ Session::get('fail') }}
                            </div>
                            @endif
                            @csrf
                            <label for="" style="color:white;"> Username/Email</label>
                            <div id="input_username" class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="flaticon2-user"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Username/Email" aria-label="Username/Email" aria-describedby="basic-addon1" name="username" required autocomplete="username" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="" style="color:white;"> Password</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1" name="password" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term" style="color:white;"> Remember me</label>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" style="background-color:#ffffff;border-color:#ffffff;color: black" value="Log in">
                                    Sign in </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
@endsection