@extends('layouts.app')
@section('title', 'Tambah User')
@section('content')
<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h3>Tambah User</h3>
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
                      <label for="role" class="col-lg-3 control-label">Hak Akses: *</label>
                      <div class="col-lg-6">
                        <div class="ui-select">
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
                    </div>
                    <div class="form-group{{ $errors->has('nik') ? ' has-error' : '' }}">
                      <label for="nik" class="col-lg-3 control-label">NIK: *</label>
                      <div class="col-lg-6">
                        <input id="nik" name="nik" class="form-control" data-parsley-pattern="[0-9]{7}" value="" required="required" data-parsley-error-message="NIK harus diisi dengan angka dan terdiri dari 7 karakter.">
                          @if ($errors->has('nik'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('nik') }}</strong>
                              </span>
                          @endif
                      </div>
                    </div>
                    <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                      <label for="nama" class="col-lg-3 control-label">Nama: *</label>
                      <div class="col-lg-6">
                        <input id="nama" class="form-control" type="text" name="nama" value="{{ old('nama') }}" required>
                          @if ($errors->has('nama'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('nama') }}</strong>
                              </span>
                          @endif
                      </div>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      <label for="email" class="col-lg-3 control-label">Email: *</label>
                      <div class="col-lg-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" data-parsley-type="email" required="required" data-parsley-error-message="Harus diisi dengan email yang valid.">
                          @if ($errors->has('email'))
                              <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                          @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label"></label>
                      <div class="col-md-6">
                        <button type="submit" class="btn btn-danger ftco-animate">Tambah User
                        <span></span>
                        <button type="reset" onclick="history.back()" class="btn btn-default ftco-animate">Batal
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            </hr>
            <div class="clearfix"></div>
            <br>
        </div>
      </div>
    </div>
    <br />
  </div>
</div>
<br />
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
