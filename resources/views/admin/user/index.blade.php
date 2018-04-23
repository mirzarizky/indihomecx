@extends('layouts.app')
@section('title', 'Daftar User')
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
              <h3>Daftar <i>User</i></h3>
            </div>
            <div class="col-md-6">
              <div>
                <a href="{{route('admin.model.form', ['model' => 'user'])}}" class="btn btn-default ftco-animate pull-right fa fa-plus-square" style="padding: 14px 20px; font-size: 15px;"> &nbsp &nbsp Tambah User </a>
              </div>
            </div>
          </div>
            <div class="container">
              <div class="x_content">
                <table id="datatable-responsive" class="table table-striped table-vcenter" cellspacing="0" width="100%" alignright>
                  <thead>
                    <tr>
                      <th class="text-center" style="width:10%">NIK</th>
                      <th class="text-center">Nama</th>
                      <th class="text-center" style="width:20%">Email</th>
                      <th class="text-center" style="width:15%">Hak Akses</th>
                      <th class="text-center" style="width:20%">Tindakan</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(!empty($users))
                    @foreach($users as $user)
                    <tr>
                      <td>{{$user->nik}}</td>
                      <td>{{$user->name}}</td>
                      <td>{{$user->email}}</td>
                      <td class="text-center">
                        @if ($user->role->name == 'admin')
                        <span class="label label-warning">Administrator</span>
                        @else
                        <span class="label label-primary">Supervisor</span>
                        @endif
                      </td>
                      <td>
                          @if ($user->role->name == 'supervisor')
                            <center>
                              <a href="{{route('admin.model.updateForm', ['model' => 'user', 'id' => $user->id])}}" class="btn btn-dark ftco-animate">Ubah</a>
                              <a onclick="hapusFunction('{{$user->name}}', '{{route('admin.model.delete', ['model' => 'user', 'id' => $user->id])}}')" class="btn btn-danger ftco-animate">Hapus</a>
                            </center>
                          @endif
                      </td>
                    </tr>
                    @endforeach
                  @else
                      <tr>
                          <td colspan="5">Tidak ada User dalam database</td>
                      </tr>
                  @endif
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

    function hapusFunction(username, actionPath) {
      console.log(actionPath);
      event.preventDefault(); // prevent form submit
      swal({
          title: "Hapus " + username + "?",
          text: "Setelah dihapus, " +username+ " tidak akan memiliki akses lagi di I-CX.",
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
            swal("Batal", username + " tidak terhapus.",);
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
