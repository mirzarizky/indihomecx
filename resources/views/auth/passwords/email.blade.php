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

    <title>Forgot Password</title>

    <link href="{{asset('css/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">>
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
                <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}

                    <h1> Reset Password </h1>
                    @if (session('status'))
                        <span class="help-block">
                            {{ session('status') }}
                        </span>
                    @endif
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-mail Address" required autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-danger ftco-animate">
                                Atur Ulang Password Saya
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
</body>
</html>
