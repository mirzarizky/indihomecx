@extends('layouts.app')
@section('title', 'Work Orders')
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
          <div class="x_title">
            <h3>Daftar Detail <i>Work Order</i></h3>
            <div class="clearfix"></div>
          </div>
            <div class="container">
              <div class="x_content">
                <table id="datatable-responsive" class="table table-striped table-vcenter" cellspacing="0" width="100%" alignright>
                  <thead>
                    <tr>
                      <th class="text-center">ID</th>
                      <th class="text-center">Tanggal</th>
                      <th class="text-center">Nama Pelanggan</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Cabang</th>
                      <th class="text-center">Status Survei</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($orders as $order)
                    <tr>
                      <td>{{$order->id}}</td>
                      <td>{{$order->tanggal}}</td>
                      <td>{{$order->namaPelanggan}}</td>
                        {{--TODO : Status Kode : Kan PS semua?--}}
                      <td>{{$order->status_kode}}</td>
                      <td>{{$order->cabang->nama}}</td>
                        {{--TODO : Status Survei Please--}}
                      <td>OK</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              {{$orders->links()}}
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

    $(document).ready(function() {
      init_DataTables()
    });
  </script>

@endsection
