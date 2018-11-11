@extends('layouts.app')
@section('title', 'Faktor Kepuasan dalam Survei')
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
              <h3>Faktor Kepuasan dalam Survei</i></h3>
            </div>
            <div class="col-md-6">
              <div>
                <a href="{{route('admin.model.form', ['model' => 'kriteria'])}}" class="btn btn-default ftco-animate pull-right fa fa-plus-square" style="padding: 14px 20px; font-size: 15px;"> &nbsp &nbsp Tambah Faktor Kepuasan </a>
              </div>
            </div>
          </div>
            <div class="container">
              <div class="x_content">
                <table class="table table-striped table-vcenter" cellspacing="0" align="center">
                  <thead>
                    <tr>
                      <th>Faktor Kepuasan</th>
                      <th class="text-center" style="width:20%">Tindakan</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($allKriteria as $kriteria)
                    <tr>
                      <td>{{$kriteria->nama}}</td>
                        <td>
                          <center>
                          <a class="btn btn-dark ftco-animate btn-sm" href="{{route('admin.model.updateForm', ['model' => 'kriteria', 'id' => $kriteria->id])}}">Ubah</a>
                          <a onclick="hapusFunction('{{$kriteria->nama}}','{{route('admin.model.delete', ['model' => 'kriteria', 'id' => $kriteria->id])}}')" class="btn btn-danger ftco-animate btn-sm">Hapus</a>
                        </center>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <form id="hapus" method="get" style="display:none;" action="{{route('admin.model.delete', ['model' => 'kriteria', 'id' => $kriteria->id])}}"></form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br/>
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

    // swal Hapus

    function hapusFunction(username, actionPath) {
      console.log(actionPath);
      event.preventDefault(); // prevent form submit
      swal({
          title: "Hapus " + username + " sebagai faktor kepuasan dalam survei?",
          text: "",
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
            swal("Batal", username + " tetap menjadi salah satu faktor kepuasan dalam survei.",);
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
