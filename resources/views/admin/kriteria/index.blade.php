@extends('layouts.app')

@section('content')
    <div class="col-lg-9">
        <div class="panel panel-default">
            <div class="panel-heading">List Kriteria</div>

            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div>
                    <a href="{{route('admin.model.form', ['model' => 'kriteria'])}}" class="btn btn-sm btn-primary">Tambah Kriteria</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nama Kriteria</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($allKriteria as $kriteria)
                            <tr>
                                <td>{{$kriteria->nama}}</td>
                                <td><a href="{{route('admin.model.updateForm', ['model' => 'kriteria', 'id' => $kriteria->id])}}" class="btn btn-xs btn-info">Sunting</a>
                                <a href="{{route('admin.model.delete', ['model' => 'kriteria', 'id' => $kriteria->id])}}" class="btn btn-xs btn-danger">Hapus</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
