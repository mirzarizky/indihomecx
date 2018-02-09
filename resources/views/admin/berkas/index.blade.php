@extends('layouts.app')

@section('content')
    <div class="col-lg-9">
        <div class="panel panel-default">
            <div class="panel-heading">List Berkas</div>

            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div>
                    <a href="{{route('admin.model.form', ['model' => 'berkas'])}}" class="btn btn-sm btn-primary">Tambah Berkas</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>File</th>
                                <th>Tanggal Mulai Order</th>
                                <th>Tanggal Akhir Order</th>
                                <th>Total Nomor Hp</th>
                                <th>Total Email</th>
                                <th>Total Order</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($allBerkas as $berkas)
                            <tr>
                                <td>{{$berkas->nama}}</td>
                                <td>{{$berkas->tanggalMulaiPesanan}}</td>
                                <td>{{$berkas->tanggalAkhirPesanan}}</td>
                                <td>{{$berkas->totalNoHp}}</td>
                                <td>{{$berkas->totalEmail}}</td>
                                <td>{{$berkas->totalPesanan}}</td>
                                <td>
                                    @if($berkas->isSent)
                                        Link sudah terkirim
                                    @else
                                        Link belum dikirm
                                    @endif
                                </td>
                                <td><a href="{{route('admin.model.updateForm', ['model' => 'berkas', 'id' => $berkas->id])}}" class="btn btn-xs btn-info">Sunting</a>
                                    @if($berkas->isSent)
                                        <a href="{{route('admin.model.delete', ['model' => 'berkas', 'id' => $berkas->id])}}" class="btn btn-xs btn-danger">Hapus</a>
                                    @else
                                        <a href="{{route('berkas.download', ['id' => $berkas->id])}}" class="btn btn-xs btn-warning">Download</a>
                                        <a href="" class="btn btn-xs btn-default">Kirim Link</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
