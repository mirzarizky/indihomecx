@extends('layouts.app')

@section('content')
    <div class="col-lg-9">
        <div class="panel panel-default">
            <div class="panel-heading">List STO</div>

            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div>
                    <a href="{{route('admin.model.form', ['model' => 'sto'])}}" class="btn btn-sm btn-primary">Tambah STO</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Kode STO</th>
                                <th>Nama STO</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($allCabang as $sto)
                            <tr>
                                <td>{{$sto->kode}}</td>
                                <td>{{$sto->nama}}</td>
                                <td><a href="{{route('admin.model.updateForm', ['model' => 'sto', 'id' => $sto->id])}}" class="btn btn-xs btn-info">Sunting</a>
                                <a href="{{route('admin.model.delete', ['model' => 'sto', 'id' => $sto->id])}}" class="btn btn-xs btn-danger">Hapus</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
