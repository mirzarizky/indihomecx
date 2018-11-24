@extends('layouts.app')
@section('title', 'Dashboard')
@section('')
	<link rel="stylesheet" href="{{asset('css/responsive.css')}}">
@endsection
@section('content')
<div class="right_col" role="main">
  <div class="">
    <div class="row top_tiles">
      <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-users" style="color:#F44336;"></i></div>
          <div class="count">{{ $count['users'] }}</div>
          <h3>Users</h3>
          <p style="font-size:10pt">Jumlah <i>user</i> yang telah terdaftar.</p>

        </div>
      </div>
      <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-share" style="color:#F44336;"></i></div>
          <div class="count">XXX</div>
          <h3>Survei Dikirim</h3>
          <p style="font-size:10pt">Permintaan survei yang sudah dikirimkan.</p>
        </div>
      </div>
      <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-comments-o" style="color:#F44336;"></i></div>
          <div class="count">{{ $count['survei'] }}</div>
          <h3>Survei Terisi</h3>
          <p style="font-size:10pt">Survei yang sudah berhasil diisi oleh pelanggan.</p>
        </div>
      </div>
    </div>
    <div class="row top_tiles">
      <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-check-square-o" style="color:#F44336;"></i></div>
          <div class="count">{{ $count['orders'] }}</div>
          <h3><i>Work Order</i></h3>
          <p style="font-size:10pt">Jumlah <i>work order</i> yang keluar minggu ini</p>
        </div>
      </div>
      <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-university" style="color:#F44336;"></i></div>
          <div class="count">{{ $count['cabang'] }}</div>
          <h3>STO</h3>
          <p style="font-size:10pt">STO yang terintergrasi dengan I-CX saat ini</p>
        </div>
      </div>
      <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-file-excel-o" style="color:#F44336;"></i></div>
          <div class="count">{{ $count['berkas'] }}</div>
          <h3>Berkas</h3>
          <p style="font-size:10pt">Jumlah berkas yang sudah diupload ke database.</p>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
</div>
<!-- /page content -->
</div>
<br />
@endsection
