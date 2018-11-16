@extends('layouts.app')
@section('title', 'Ubah Profile')
@section('content')
<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h3>Edit Profile</h3>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="container">
              <div class="row">
                <!-- edit form column -->
                <form id="form-valid" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{route('profile.update')}}" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="text-center">
                  <div class="col-sm-3 col-sm-6 col-xs-12 col-sm-6 col-xs-12 center">
                      <img class="avatar-view" src="@if(!is_null($user->avatar_id)) {{asset('storage/'.''.$user->avatar->path)}} @else {{ asset('images/user.png') }} @endif" alt="Avatar" title="Avatar" style="width:210px";>
                      <br>
                      <br>
                      <label for="photoInput" class="btn btn-default btn-file" style="cursor: pointer;">
                          Ganti Foto Profil <input type="file" name="photo" id="photoInput" style="display: none;" accept=".png,.jpg,.jpeg">
                      </label>
                      @if ($errors->has('photo'))
                      <span class="help-block">
                          <strong>{{ $errors->first('photo') }}</strong>
                      </span>
                      @endif
                      <output id="filesInfo"></output>
                    </div>
                  </div>
                <div class="col-md-9">
                    <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                      <label for="role" class="col-lg-3 col-lg-3 col-xs-12 control-label">Hak Akses:</label>
                        <div class="col-lg-8 col-sm-6 col-xs-12 col-sm-6 col-xs-12">
                          <input id="role" type="text" class="form-control" name="role" value="@if ($user->role->name == 'admin')Administrator @else Supervisor @endif" readonly>
                          @if ($errors->has('role'))
                              <span class="help-block">
                              <strong>{{ $errors->first('role') }}</strong>
                          </span>
                          @endif
                          <output id="filesInfo"></output>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('nik') ? ' has-error' : '' }}">
                      <label for="kode" class="col-lg-3 col-lg-3 col-xs-12 control-label">NIK:</label>
                      <div class="col-lg-8 col-sm-6 col-xs-12 col-sm-6 col-xs-12">
                        <input id="kode" class="form-control" type="text" name="kode" value="{{ $user->nik }}" readonly>
                            @if ($errors->has('nik'))
                              <span class="help-block">
                                <strong>{{ $errors->first('nik') }}</strong>
                              </span>
                            @endif
                      </div>
                    </div>
                    <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                      <label for="nama" class="col-lg-3 col-lg-3 col-xs-12 control-label">Nama:</label>
                      <div class="col-lg-8 col-sm-6 col-xs-12 col-sm-6 col-xs-12">
                        <input id="nama" type="text" placeholder="Nama Lengkap" class="form-control" name="nama" value="{{ $user->name }}" required data-parsley-error-message="Nama harus diisi.">
                            @if ($errors->has('nama'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('nama') }}</strong>
                              </span>
                            @endif
                      </div>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      <label for="email" class="col-lg-3 col-lg-3 col-xs-12 control-label">Email:</label>
                      <div class="col-lg-8 col-sm-6 col-xs-12 col-sm-6 col-xs-12">
                        <input id="email" type="email" placeholder="Alamat Email" class="form-control" name="email" value="{{ $user->email }}" data-parsley-type="email" required data-parsley-error-message="Harus diisi dengan email yang valid.">
                          @if ($errors->has('email'))
                              <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                              </span>
                          @endif
                      </div>
                    </div>
                    <div class="form-group{{ $errors->has('noHp') ? ' has-error' : '' }}">
                      <label for="noHp" class="col-lg-3 col-lg-3 col-xs-12 control-label">No telp:</label>
                      <div class="col-md-8 col-sm-6 col-xs-12 col-sm-6 col-xs-12">
                        <input id="noHp" type="text" class="form-control" placeholder="Nomor Hp" name="noHp" value="{{ $user->noHp }}">
                          @if ($errors->has('noHp'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('noHp') }}</strong>
                              </span>
                          @endif
                      </div>
                    </div>
                    <center>
                    <div class="form-group">
                      <label class="col-md-3 col-md-3 col-xs-12 control-label"></label>
                      <div class="col-md-8 col-sm-6 col-xs-12 col-sm-6 col-xs-12">
                        <button type="submit" class="btn btn-danger ftco-animate">Simpan Perubahan
                        <span></span>
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


    //namafile
    function fileSelect(evt) {
      var files = evt.target.files;
      var result = '';
      var file;
      for (var i = 0; file = files[i]; i++) {
        result += file.name;
      }
      document.getElementById('filesInfo').innerHTML = result;
    }
    document.getElementById('photoInput').addEventListener('change', fileSelect, false);

    $(document).ready(function() {
      init_parsley();

    });
  </script>
  @endsection
