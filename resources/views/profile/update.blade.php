@extends('layouts.app')

@section('content')
    <div class="col-lg-9">
        <div class="panel panel-default">
            <div class="panel-heading">Ubah Profil</div>

            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-3">
                        <img class="img-responsive img-circle " src="@if(!is_null($user->avatar_id)) {{asset('storage/'.''.$user->avatar->path)}} @else {{ asset('images/user.png') }} @endif" alt="Avatar" width=""><br/>
                        <label for="photoInput" class="btn btn-default" style="cursor: pointer;">
                            Upload a different photo <input type="file" form="profileForm" name="photo" id="photoInput" style="display: none;">
                        </label><br/>
                        @if ($errors->has('photo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('photo') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-md-9">
                        <form id="profileForm" class="form-horizontal" method="POST" action="{{route('profile.update')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                <label for="role" class="col-md-4 control-label">Role</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Peran" name="role" disabled value="{{$user->role->name}}">


                                    @if ($errors->has('role'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('nik') ? ' has-error' : '' }}">
                                <label for="kode" class="col-md-4 control-label">NIK User</label>

                                <div class="col-md-6">
                                    <input id="kode" type="text" class="form-control" name="kode" value="{{ $user->nik }}" required disabled>

                                    @if ($errors->has('nik'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('nik') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                                <label for="nama" class="col-md-4 control-label">Nama</label>

                                <div class="col-md-6">
                                    <input id="nama" type="text" placeholder="Nama Lengkap" class="form-control" name="nama" value="{{ $user->name }}" required>

                                    @if ($errors->has('nama'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('noHp') ? ' has-error' : '' }}">
                                <label for="noHp" class="col-md-4 control-label">Nomor Hp</label>

                                <div class="col-md-6">
                                    <input id="noHp" type="text" class="form-control" placeholder="Nomor Hp" name="noHp" value="{{ $user->noHp }}">

                                    @if ($errors->has('noHp'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('noHp') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Alamat Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" placeholder="Alamat Email" class="form-control" name="email" value="{{ $user->email }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        Simpan
                                    </button>
                                    <a href="{{route('profile.index')}}" class="btn btn-sm btn-danger">Batal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
