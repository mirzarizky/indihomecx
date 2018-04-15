@extends('layouts.app')
@section('title', 'Berkas')
@section('style')
<link href="{{asset('css/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('css/datatables/responsive.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('css/daterangepicker/daterangepicker.css')}}" rel="stylesheet">
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
              <h3>Berkas Tersimpan</i></h3>
            </div>
            <div class="col-md-6">
              @if (session('status'))
              <div class="alert alert-info alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success.</strong> {{ session('status') }}
              </div>
              @endif
              <div>
                <a href="{{route('admin.model.form', ['model' => 'berkas'])}}" class="btn btn-default ftco-animate pull-right fa fa-plus-square" style="padding: 14px 20px; font-size: 15px;"> &nbsp &nbsp Tambah Berkas </a>
              </div>
            </div>
          </div>
          <div class="container">
            <div class="x_content">
              <table id="datatable-responsive" class="table table-striped table-bordered" cellspacing="0" width="100%" alignright>
                <thead>
                  <tr>
                    <th>Nama File</th>
                    <th>Tanggal Mulai Order</th>
                    <th>Tanggal Akhir Order</th>
                    <th>Total No. HP</th>
                    <th>Total Email</th>
                    <th>Total Order</th>
                    <th>Status</th>
                    <th>Tindakan</th>
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
                    <td>
                      <a class="btn btn-dark ftco-animate btn-xs" href="{{route('admin.model.updateForm', ['model' => 'berkas', 'id' => $berkas->id])}}">Ubah</a>
                      @if($berkas->isSent)
                        <a onclick="hapusFunction()" class="btn btn-danger ftco-animate btn-xs">Hapus</a>
                        <a onclick="kirimFunction()" class="btn btn-default ftco-animate btn-xs" disabled>Kirim</a>
                      @else
                        <a onclick="hapusFunction()" class="btn btn-danger ftco-animate btn-xs">Hapus</a>
                        <a onclick="kirimFunction()" class="btn btn-default ftco-animate btn-xs">Kirim</a>
                      @endif
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <form id="hapus" method="get" style="display:none;" action="{{route('admin.model.delete', ['model' => 'berkas', 'id' => $berkas->id])}}"></form>
              <form id="kirim" method="get" style="display:none;" action="http://google.com"></form>
            </td>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
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

      TableManageButtons = function() {
        "use strict";
        return {
          init: function() {
            handleDataTableButtons();
          }
        };
      }();

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

      var $datatable = $('#datatable-checkbox');

      $datatable.dataTable({
        'order': [
          [1, 'asc']
        ],
        'columnDefs': [{
          orderable: false,
          targets: [0]
        }]
      });
      $datatable.on('draw.dt', function() {
        $('checkbox input').iCheck({
          checkboxClass: 'icheckbox_flat-green'
        });
      });

      TableManageButtons.init();

    };

    // swal Hapus

    function hapusFunction() {
      event.preventDefault(); // prevent form submit
      swal({
          title: "Hapus Berkas?",
          text: "",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Ya",
          cancelButtonText: "Batal",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm) {
          if (isConfirm) {
            // swal("Terhapus!", "Berkas anda sudah terhapus.", "success");
            document.getElementById("hapus").submit();
          } else {
            swal("Batal", "Berkas anda aman.", "");
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
@endsection
