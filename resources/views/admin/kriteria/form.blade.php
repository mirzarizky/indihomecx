@extends('layouts.app')

@section('content')
    <div class="col-lg-9">
        <div class="panel panel-default">
            <div class="panel-heading">Tambah Cabang</div>

            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                    <form class="form-horizontal" method="POST" action="{{ route('admin.model.create', ['model' => 'kriteria']) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                            <label for="nama" class="col-md-4 control-label">Nama Kriteria</label>

                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control" name="nama" value="{{ old('nama') }}" required>

                                @if ($errors->has('nama'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Tambah
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
@endsection
