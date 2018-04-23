@extends('layouts.app')
@section('title', 'User Profile')
@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert/sweetalert.min.css')}}">
@endsection
@section('content')
<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h3>Profile</h3>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="container">
              <div class="row">
                <!-- left column -->

                <center>
                  <img class="img-responsive avatar-view" src="@if(!is_null($user->avatar_id)) {{asset('storage/'.''.$user->avatar->path)}} @else {{ asset('images/user.png') }} @endif" alt="Avatar" width="20%" style="border-radius:50%; border-color:red;"> <br>
                  <h2>{{$user->name}}</h2>
                  <h5>
                      <b>{{$user->nik}}</b>
                      <b>-</b>
                      <b>
                        @if ($user->role->name == 'admin')
                        Administrator
                        @else
                        Supervisor
                        @endif
                      </b>
                  </h5>
                  <h5>{{$user->email}}</h5>
                  <h5>{{$user->noHp}}</h5>
                  <br>
                  <p>
                    <a href="{{ route('profile.edit') }}" class="btn btn-danger ftco-animate">Edit Profile</a>
                    <a href="{{ route('profile.password') }}" class="btn btn-danger ftco-animate">Ubah Password</a>
                  </p>
              </div>
            </div>
            </center>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br/>
@endsection
@section('script')
<script src="{{asset('js/sweetalert/sweetalert.min.js')}}"></script>

  @if (session('status'))
  <script>
      swal("Berhasil", "{{ session('status') }}", "success");
  </script>
  @endif

@endsection
