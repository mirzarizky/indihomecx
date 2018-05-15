<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Login</title>

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
          <form class="form-horizontal" method="POST" action="{{ route('login.post') }}">
            {{ csrf_field() }}

            <h1>Silakan Login</h1>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <input id="email" name="email" type="text" class="form-control" placeholder="NIK / E-mail" value="{{ old('email') }}" required>
              @if ($errors->has('email'))
                <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <input id="password" type="password" name="password" class="form-control" placeholder="Password" required />
              @if ($errors->has('password'))
                  <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
                  </span>
              @endif
            </div>
            <div class="form-group">
              <div class="col">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="remember" checked{{ old('remember') ? 'checked' : '' }}> Ingat saya
                  </label>
                </div>
              </div>
            </div>
            <div>
              <button type="submit" class="btn btn-danger ftco-animate">Log In</button>
              <a class="reset_pass" href="{{ route('password.request') }}">Lupa password anda?</a>
            </div>
          </form>
          <div class="clearfix"></div>

          <div class="separator">

            <div class="clearfix"></div>
            <br />
            <div>
              <center>
                <img class="logo" src="images/indihome.png" style="width:60%; padding-bottom:20px;" />
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
