@extends('layouts.app')
@section('title', 'Ubah Berkas')
@section('style')
<link href="{{asset('css/daterangepicker/daterangepicker.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h3>Ubah Berkas</h3>
            <div class="clearfix"></div>

              @if (session('status'))
                <div class="alert alert-success">
                  {{ session('status') }}
                </div>
              @endif

            </div>
            <center>
            <div class="x_content">
              <div class="container">
                <div class="row">
                  <form id="form-valid" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{route('admin.model.update', ['model' => 'berkas', 'id' => $berkas->id])}}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                      <label for="nama" class="control-label col-md-3 col-sm-3 col-xs-12">Nama Berkas:</label>

                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="nama" type="text" class="form-control" name="nama" value="{{ $berkas->nama }}" required data-parsley-error-message="Nama harus diisi.">

                            @if ($errors->has('nama'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('nama') }}</strong>
                              </span>
                            @endif
                          </div>
                        </div>

                    <div class="form-group{{ $errors->has('daterange') ? ' has-error' : '' }}">
                      <label for="daterange" class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="input-prepend input-group">
                              <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                              <input type="text" id="daterange" name="daterange" class="form-control daterange">
                            </div>
                            @if ($errors->has('daterange'))
                            <span class="help-block">
                              <strong>{{ $errors->first('daterange') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <center>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <button type="submit" class="btn btn-danger ftco-animate">Simpan Perubahan
                            <span></span>
                            </form>
                          <button type="reset" onclick="history.back()" class="btn btn-default ftco-animate">Batal
                        </div>
                      </div>
                    </center>
                   </form>
                  </div>
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
<script src="{{ asset('js/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('js/parsleyjs/dist/parsley.min.js') }}"></script>
<script type="text/javascript">
  //daterangepicker
  $('input[name="daterange"]').daterangepicker({
    locale: {
      format: 'YYYY/MM/DD'
    },
  });

  //parsleyjs
  function init_parsley() {

      if (typeof(parsley) === 'undefined') {
        return;
      }
      console.log('init_parsley');

      $ /*.listen*/ ('parsley:field:validate', function() {
        validateFront();
      });

      $('#form-valid .btn').on('click', function() {
        $('#form-valid').parsley().validate();
        validateFront();
      });
      var validateFront = function() {
        if (true === $('#form-valid').parsley().isValid()) {
          $('.bs-callout-info').removeClass('hidden');
          $('.bs-callout-warning').addClass('hidden');
        } else {
          $('.bs-callout-info').addClass('hidden');
          $('.bs-callout-warning').removeClass('hidden');
        }
      };

      try {
        hljs.initHighlightingOnLoad();
      } catch (err) {}

    };

    $(document).ready(function() {
      init_parsley();

    });
</script>
@endsection
