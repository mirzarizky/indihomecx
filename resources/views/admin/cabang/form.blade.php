@extends('layouts.app')
@section('title', 'Tambah STO')
@section('content')
<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h3>Tambah STO</h3>
            <div class="clearfix"></div>
          </div>
          <center>
            <div class="x_content">
              <div class="container">
                <div class="row">
                  <form id="form-valid" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{ route('admin.model.create', ['model' => 'sto']) }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('kode') ? ' has-error' : '' }}">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Kode STO<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12 col-sm-6 col-xs-12">
                        <input id="kode" name="kode" class="form-control" type="text" value="{{ old('kode') }}" required data-parsley-error-message="Kode STO harus diisi.">
                        @if ($errors->has('kode'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('kode') }}</strong>
                              </span>
                        @endif
                      </div>
                      <center>
                    </div>
                    <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama STO<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="nama" name="nama" class="form-control" type="text" value="{{ old('nama') }}" required data-parsley-error-message="Nama STO harus diisi.">
                        @if ($errors->has('nama'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nama') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <button type="submit" class=" submit btn btn-danger ftco-animate">Tambah Cabang</button>
                        <span></span>
                        <a type="button" href="{{route('admin.model.index', ['model' => 'sto'])}}" class="btn btn-default ftco-animate">Batal</a>
                      </div>
                    </div>
                  </form>
                </div>
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
<script src="{{ asset('js/parsleyjs/dist/parsley.min.js') }}"></script>
<script type="text/javascript">
    function init_parsley() {

      if (typeof(parsley) === 'undefined') {
        return;
      }
      console.log('init_parsley');

      $ /*.listen*/ ('parsley:field:validate', function() {
        validateFront();
      });

      $('#form-valid .submit').on('click', function() {
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
