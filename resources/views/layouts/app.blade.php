<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>

  <!-- Bootstrap -->
  <link href="{{asset('css/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- NProgress -->
  <link href="{{asset('css/nprogress/nprogress.css')}}" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="{{asset('css/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <!-- Styles -->
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
  @yield('style')
</head>

<body class="nav-md">
  <div class="container body">
    @if(Auth::check())
    <div class="main_container">
      <div class="col-md-3 left_col menu_fixed">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="{{route('admin.index')}}" class="site_title border-bottom"> <img src="{{asset('images/logoindi.png')}}" style="margin-bottom:6%;"> <span>{{ config('app.name') }}</span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="@if(!is_null(Auth::user()->avatar_id)) {{asset('storage/'.''.Auth::user()->avatar->path)}} @else {{ asset('images/user.png') }} @endif" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Welcome,</span>
              <h2>{{ Auth::user()->name }}</h2>
            </div>
          </div>
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
              <ul class="nav side-menu">
                <li>
                    @if(Auth::user()->role->name == 'admin')
                        <a href="{{route('admin.index')}}"><i class="fa fa-home"></i> Dashboard</a>
                    @elseif(Auth::user()->role->name == 'supervisor')
                        <a href="{{route('spv.index')}}"><i class="fa fa-home"></i> Dashboard</a>
                    @endif
                </li>
                @if(Auth::user()->role->name == 'admin')
                <li><a href="{{route('admin.model.index', ['model' => 'user'])}}"><i class="fa fa-users"></i> Users</a>
                </li>
                <li><a href="{{route('admin.model.index', ['model' => 'order'])}}"><i class="fa fa-check-square-o"></i> Order</a>
                </li>
                <li><a href="{{route('admin.model.index', ['model' => 'berkas'])}}"><i class="fa fa-file-excel-o"></i> Berkas</a>
                </li>
                <li><a href="{{route('admin.model.index', ['model' => 'sto'])}}"><i class="fa fa-university"></i> Cabang</a>
                </li>
                <li><a><i class="fa fa-pencil-square-o"></i> Survei <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="survei_adm.html">Lihat Form Survei</a></li>
                    <li><a href="{{route('admin.model.index', ['model' => 'kriteria'])}}">Edit Faktor Kepuasan Survei</a></li>
                  </ul>
                </li>
                @else
                <li><a href="survei_spv.html"><i class="fa fa-pencil-square-o"></i> Lihat Form Survei</a>
                </li>
                @endif
              </ul>
            </div>
          </div>
        </div>
      </div>
      @endif
      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <nav>
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars" style="color:#23272b;"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
              <li class="">

                <a href="javascript:" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                  <img src="@if(!is_null(Auth::user()->avatar_id)) {{asset('storage/'.''.Auth::user()->avatar->path)}} @else {{ asset('images/user.png') }} @endif" alt="">
                  {{ Auth::user()->name }}
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li><a href="{{route('profile.index')}}"> Profile</a></li>
                  <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                </ul>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->

      @yield('content')
      <div class="clearfix"></div>
    </div>
  </div>
  <!-- footer content -->
  <footer>
    <div class="pull-right">
      Indihome Customer Experience
    </div>
    <div class="clearfix"></div>
  </footer>
  <!-- /footer content -->


  <!-- Scripts -->
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/nprogress/nprogress.js') }}"></script>
  <script src="{{ asset('js/custom.js')}}"></script>
  @yield('script')
</body>
</html>
