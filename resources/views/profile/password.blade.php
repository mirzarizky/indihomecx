@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Ubah Password</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="form-horizontal" method="POST" action="{{ route('profile.password.update') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('oldPassword') ? ' has-error' : '' }}">
                                <label for="oldPassword" class="col-md-4 control-label">Password Lama</label>

                                <div class="col-md-6">
                                    <input id="oldPassword" type="password" class="form-control" name="oldPassword" required autofocus="autofocus"/>

                                    @if ($errors->has('oldPassword'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('oldPassword') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password Baru</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Konfirmasi Password Baru</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
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
