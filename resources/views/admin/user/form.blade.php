@extends('layouts.app')
@section('title', 'Tambah Pengguna')
@section('content')
<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h3>Tambah Pengguna</h3>
            <div class="clearfix"></div>
              @if (session('status'))
              <div class="alert alert-info alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success.</strong> {{ session('status') }}
              </div>
              @endif
          </div>
          <center>
            <div class="x_content">
              <div class="container">
                <div class="row">
                  <form id="form-valid" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{ route('admin.model.create', ['model' => 'user']) }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Hak Akses*</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="role" name="role" class="form-control" required data-parsley-error-message="Harus dipilih salah satu.">
                              <option value="">---Role---</option>
                              @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                              @endforeach
                          </select>
                          @if ($errors->has('role'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('role') }}</strong>
                              </span>
                          @endif
                      </div>
                    </div>
                    <div class="form-group{{ $errors->has('nik') ? ' has-error' : '' }}">
                      <label for="nik" class="control-label col-md-3 col-sm-3 col-xs-12">NIK*</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="nik" name="nik" class="form-control" placeholder="NIK Perusahaan terdiri dari 6 angka." data-parsley-pattern="[0-9]{6}" value="{{old('nik')}}" required="required" data-parsley-error-message="NIK harus diisi dengan angka dan terdiri dari 6 karakter.">
                          @if ($errors->has('nik'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('nik') }}</strong>
                              </span>
                          @endif
                      </div>
                    </div>
                    <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                      <label for="nama" class="control-label col-md-3 col-sm-3 col-xs-12">Nama*</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="nama" class="form-control" type="text" name="nama" value="{{ old('nama') }}" required data-parsley-error-message="Nama harus diisi.">
                          @if ($errors->has('nama'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('nama') }}</strong>
                              </span>
                          @endif
                      </div>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      <label for="email" class="control-label col-md-3 col-sm-3 col-xs-12">Email*</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" data-parsley-type="email" required="required" data-parsley-error-message="Email harus diisi dengan email yang valid.">
                          @if ($errors->has('email'))
                              <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                          @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <button type="submit" class="btn btn-danger ftco-animate">Tambah Pengguna</button> </form>
                        <span></span>
                        <button type="reset" onclick="history.back()" class="btn btn-default ftco-animate">Batal
                      </div>
                    </div>
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
