@extends('layouts.app')
@section('title', 'Daftar STO')
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
              <h3>Daftar Cabang STO</h3>
            </div>
            <div class="col-md-6">
              <div>
                <a href="{{route('admin.model.form', ['model' => 'sto'])}}" class="btn btn-default ftco-animate pull-right" style="padding: 14px 20px; font-size: 15px;"> <i class="fa fa-plus-square"></i> &nbsp &nbsp Tambah STO </a>
              </div>
            </div>
          </div>
            <div class="container">
              <div class="x_content">
                <table id="datatable-responsive" class="table table-striped table-vcenter" cellspacing="0" width="100%" alignright>
                  <thead>
                    <tr>
                      <th>Kode STO</th>
                      <th>Nama STO</th>
                      <th class="text-center" style="width:20%">Tindakan</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($allCabang as $sto)
                    <tr>
                      <td>{{$sto->kode}}</td>
                      <td>{{$sto->nama}}</td>
                      <td>
                        <center>
                          <a class="btn btn-dark ftco-animate btn-sm" href="{{route('admin.model.updateForm', ['model' => 'sto', 'id' => $sto->id])}}">Ubah</a>
                          <a onclick="hapusFunction('{{$sto->nama}}', '{{route('admin.model.delete', ['model' => 'sto', 'id' => $sto->id])}}')" class="btn btn-danger ftco-animate btn-sm">Hapus</a>
                        </center>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <form id="hapus" method="get" style="display:none;" action=""></form>
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
      $('#datatable-responsive').DataTable();
    }

    // swal Hapus
    function hapusFunction(namacabang, actionPath) {
      console.log(actionPath);
      event.preventDefault(); // prevent form submit
      swal({
          title: "Hapus " + namacabang + "?",
          text: "Setelah dihapus, STO " +namacabang+ " tidak akan terintegrasi lagi di I-CX.",
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
            swal("Batal", "STO " +namacabang + " tidak terhapus.");
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
