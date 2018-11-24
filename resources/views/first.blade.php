@extends('layouts.app')
@section('title', 'Ubah Password')
@section('content')
<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h3>Ubah Password</h3>
            <h5>Selamat Datang di Indihome Customer Experience. Untuk memulai, ganti <i>default password</i> anda.</h5>
            <div class="clearfix"></div>
          </div>
          <center class="panel-body">
                  @if (session('status'))
                      <div class="alert alert-success">
                          {{ session('status') }}
                      </div>
                  @endif
          </center>
          <center>
            <div class="x_content">
              <div class="container">
                <div class="row">
                  <form class="form-horizontal" data-parsley-validate role="form" method="POST" action="{{ route('user.updatePassword') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                      <label for="password" class="col-md-3 col-sm-3 col-xs-12 control-label">Password Baru:</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="password" type="password" class="form-control" name="password" autofocus="autofocus" required data-parsley-error-message="Password baru harus diisi.">
                          @if ($errors->has('password'))
                              <span class="help-block">
                              <strong>{{ $errors->first('password') }}</strong>
                              </span>
                          @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="password-confirm" class="col-md-3 col-sm-3 col-xs-12 control-label">Konfirmasi Password Baru:</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required data-parsley-equalto="#password" data-parsley-error-message="Password tidak sama.">
                      </div>
                    </div>
                      <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12 control-label"></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <button type="submit" class="btn btn-danger ftco-animate">Simpan Perubahan
                          <span></span>
                          <button type="reset" onclick="history.back()" class="btn btn-default ftco-animate"> Batal
                        </div>
                      </div>
                  </form>
                  </div>
                </div>
              </div>
              </hr>
              <div class="clearfix"></div>
              <br/>
            </center>
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
