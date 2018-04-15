@extends('layouts.app')

@section('content')
    <div class="col-lg-9">
        <div class="panel panel-default">
            <div class="panel-heading">Dashboard</div>

            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            </div>


                <div class="row center-block">
                    <div class="col-md-4">
                        <div class="panel panel-info">
                            <div class="panel-heading text-center">User</div>
                            <div class="panel-body">
                                <p>Jumlah user yang terdaftar : {{ $count['users'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-info">
                            <div class="panel-heading text-center">Survei</div>
                            <div class="panel-body">
                                <p>Survei terkirim : belum</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-info">
                            <div class="panel-heading text-center">Survei</div>
                            <div class="panel-body">
                                <p>{{ $count['survei'] }} Survei yang sudah berhasil diisi oleh pelanggan.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row center-block">
                    <div class="col-md-4">
                        <div class="panel panel-info">
                            <div class="panel-heading text-center">Work Order</div>
                            <div class="panel-body">
                                <p>Jumlah work order yang keluar minggu ini : {{ $count['orders'] }} </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-info">
                            <div class="panel-heading text-center">STO</div>
                            <div class="panel-body">
                                <p>{{ $count['cabang'] }} STO yang terintergrasi dengan Indihome-CX saat ini.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-info">
                            <div class="panel-heading text-center">Berkas</div>
                            <div class="panel-body">
                                <p>Jumlah berkas yang sudah diupload ke database : {{ $count['berkas'] }} </p>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
