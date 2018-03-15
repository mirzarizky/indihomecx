@extends('layouts.app')

@section('content')
    <div class="col-lg-9">
        <div class="panel panel-default">
            <div class="panel-heading">User Profile</div>

            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <center>
                    <img class="img-responsive img-circle" src="@if(!is_null($user->avatar_id)) {{asset('storage/'.''.$user->avatar->path)}} @else {{ asset('images/user.png') }} @endif" alt="Avatar" width="20%"><br/>
                    <h2>{{$user->name}}</h2>
                    <h5>
                        <b>
                            {{$user->nik}}
                        </b>
                    </h5>
                    <h5>{{$user->email}}</h5>
                    <h5>{{$user->noHp}}</h5>
                    <br/>
                    <p>
                        <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-default">Edit Profile</a>
                        <a href="{{ route('profile.password') }}" class="btn btn-sm btn-warning">Ubah Password</a>
                    </p>
                </center>
            </div>
        </div>
    </div>
@endsection
