@extends('layouts.app')

@section('content')
    <div class="col-lg-9">
        <div class="panel panel-default">
            <div class="panel-heading">List User</div>

            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div>
                    <a href="{{route('admin.model.form', ['model' => 'pesanan'])}}" class="btn btn-sm btn-primary">Tambah Order</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal</th>
                            <th>Nama Pelanggan</th>
                            <th>Kode Status</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->tanggal}}</td>
                                <td>{{$order->namaPelanggan}}</td>
                                <td>{{$order->status_kode}}</td>
                                <td>
                                    <a href="{{route('admin.model.updateForm', ['model' => 'user', 'id' => $order->id])}}" class="btn btn-xs btn-info">Sunting</a>
                                    <a href="{{route('admin.model.delete', ['model' => 'user', 'id' => $order->id])}}" class="btn btn-xs btn-danger">Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{$orders->links()}}
            </div>
        </div>
    </div>
@endsection
