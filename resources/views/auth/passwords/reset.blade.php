<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('images/logoindi.png')}}">

    <title>Reset Password</title>

    <!-- Bootstrap -->
    <link href="{{asset('css/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('css/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
    <style media="screen">
        h1 {
            color: #9E9E9E;
        }

        .login {
            background-color: #FAFAFA;
        }

        .logo {
            margin-bottom: 30px;
            margin-left: 0px;
            -webkit-transition: 2s;
        }

        .logo:hover {
            -webkit-transform: rotatey(180deg);
        ;
            -webkit-transition-duration: 2s;
        }
    </style>
</head>
<body class="login">
<div>
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ $token }}">

                    <h1>Perbarui Password</h1>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="E-mail Address" required autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                            @endif
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-danger ftco-animate">
                                Simpan Password Baru
                            </button>
                        </div>
                    </div>
                </form>
                <div class="clearfix"></div>

                <div class="separator">
                    <div class="clearfix"></div>
                    <br/>
                    <div>
                        <center>
                            <img class="logo" src="{{asset('images/indihome.png')}}" style="width:60%; padding-bottom:20px;" />
                        </center>
                        <p>Telkom Indonesia</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<!-- NProgress -->
<script src="{{asset('js/nprogress/nprogress.js')}}"></script>
</body>
</html>
