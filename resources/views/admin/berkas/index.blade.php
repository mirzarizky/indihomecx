@extends('layouts.app')
@section('title', 'Berkas Tersimpan')
@section('style')
<link href="{{asset('css/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('css/datatables/responsive.bootstrap.min.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert/sweetalert.min.css')}}">
@endsection

@section('content')
<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="row x_title">
            <div class="col-md-6">
              <h3>Berkas Tersimpan</h3>
            </div>
            <div class="col-md-6">
              <div>
                <a href="{{route('admin.model.form', ['model' => 'berkas'])}}" class="btn btn-default ftco-animate pull-right" style="padding: 14px 20px; font-size: 15px;"> <i class="fa fa-plus-square"></i> &nbsp &nbsp Tambah Berkas </a>
              </div>
            </div>
          </div>
          <div class="container">
            <div class="x_content">
              <table id="datatable-responsive" class="table table-striped table-vcenter" cellspacing="0" width="100%" alignright>
                <thead>
                  <tr>
                    <th class="text-center">Nama File</th>
                    <th class="text-center">Tanggal Mulai Order</th>
                    <th class="text-center">Tanggal Akhir Order</th>
                    <th class="text-center">Total No. HP</th>
                    <th class="text-center">Total Email</th>
                    <th class="text-center">Total Order</th>
                    <th class="text-center">Status</th>
                    <th class="text-center" style="width:17%">Tindakan</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($allBerkas as $berkas)
                  <tr>
                    <td>{{$berkas->nama}}</td>
                    <td class="text-center">{{$berkas->tanggalMulaiPesanan}}</td>
                    <td class="text-center">{{$berkas->tanggalAkhirPesanan}}</td>
                    <td class="text-center">{{$berkas->totalNoHp}}</td>
                    <td class="text-center">{{$berkas->totalEmail}}</td>
                    <td class="text-center">{{$berkas->totalPesanan}}</td>
                    <td class="text-center">
                      @if($berkas->isSent)
                        <span class="label label-success">Terkirim</span>
                      @else
                        <span class="label label-warning">Belum Terkirim</span>
                      @endif
                          </td>
                    <td>
                      <a class="btn btn-dark ftco-animate btn-xs" href="{{route('admin.model.updateForm', ['model' => 'berkas', 'id' => $berkas->id])}}">Ubah</a>
                        {{--TODO : Berkas Status please--}}
                      @if($berkas->isSent)
                        <a onclick="hapusFunction('{{$berkas->nama}}','{{route('admin.model.delete', ['model' => 'berkas', 'id' => $berkas->id])}}')" class="btn btn-danger ftco-animate btn-xs">Hapus</a>
                        <a onclick="kirimFunction()" class="btn btn-default ftco-animate btn-xs" disabled>Kirim</a>
                      @else
                        <a onclick="hapusFunction('{{$berkas->nama}}','{{route('admin.model.delete', ['model' => 'berkas', 'id' => $berkas->id])}}')" class="btn btn-danger ftco-animate btn-xs">Hapus</a>
                        <a onclick="kirimFunction()" class="btn btn-default ftco-animate btn-xs">Kirim</a>
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <form id="hapus" method="get" style="display:none;" action=""></form>
              <form id="kirim" method="get" style="display:none;" action="http://google.com"></form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br />
@endsection
@section('script')
<script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{asset('js/sweetalert/sweetalert.min.js')}}"></script>
<script type="text/javascript">
    //Table
    function init_DataTables() {

      console.log('run_datatables');

      if (typeof($.fn.DataTable) === 'undefined') {
        return;
      }
      console.log('init_DataTables');

      $('#datatable').dataTable();

      $('#datatable-keytable').DataTable({
        keys: true
      });

      $('#datatable-responsive').DataTable();

      $('#datatable-scroller').DataTable({
        ajax: "js/datatables/json/scroller-demo.json",
        deferRender: true,
        scrollY: 380,
        scrollCollapse: true,
        scroller: true
      });

      $('#datatable-fixed-header').DataTable({
        fixedHeader: true
      });

    };

    // swal Hapus

    function hapusFunction(username, actionPath) {
      console.log(actionPath);
      event.preventDefault(); // prevent form submit
      swal({
          title: "Hapus berkas ini?",
          text: "Setelah dihapus, berkas ini tidak dapat dipulihkan.",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Hapus",
          cancelButtonText: "Batal",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm) {
          if (isConfirm) {
            var hapusForm = document.getElementById("hapus");
            hapusForm.action = actionPath;
            hapusForm.submit();
          } else {
            swal("Batal", username + " tidak terhapus.");
          }
        });
    }

    // swal kirim
    function kirimFunction() {
      event.preventDefault(); // prevent form submit
      swal({
          title: "Kirim?",
          text: "Anda akan mengirimkan pesan ke pelanggan sebagai permintaan survei.",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Ya, Kirim",
          cancelButtonText: "Batal",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm) {
          if (isConfirm) {
            document.getElementById("kirim").submit();
          } else {
            swal("", "Anda membatalkan.", "error");
          }
        });
    }

    $(document).ready(function() {
      init_DataTables()
    });
  </script>

  @if (session('status'))
  <script>
      swal("Berhasil", "{{ session('status') }}", "success");
  </script>
  @endif

@endsection
