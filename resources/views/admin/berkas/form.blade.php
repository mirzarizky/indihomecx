@extends('layouts.app')
@section('title', 'Tambah Berkas')
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
            <h3>Tambah Berkas</h3>
            <div class="clearfix"></div>
              @if (session('status'))
                <div class="alert alert-success">
                  {{ session('status') }}
                </div>
              @endif
            </div>
            <div class="x_content">
              <div class="container">
                <div class="row">
                  <form class="form-horizontal" method="POST" action="{{ route('admin.model.create', ['model' => 'berkas']) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

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

                    <div class="form-group {{ !$errors->has('berkas') ?: 'has-error' }}">
                      <label for="berkas" class="control-label col-md-3 col-sm-3 col-xs-12">Berkas:</label>
                      <label class="btn btn-default btn-file" style="margin-left:10px"> Pilih Berkas untuk di Upload<br />
                        <input id="berkas" type="file" class="btn btn-default btn-file" name="berkas" accept=".xlsx, .xls"/>
                      </label>
                      <label style="font-size:10px;">*.xlsx</label>
                        @if ($errors->has('berkas'))
                        <span class="help-block">
                            <strong>{{ $errors->first('berkas') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" style="margin-left:10px"></label>
                      <output id="filesInfo"></output>
                    </div>

                  <div class="form-group{{ $errors->has('send') ? ' has-error' : '' }}">
                      <label for="daterange" class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="input-prepend input-group">
                              <input type="checkbox" name="send" checked{{ old('remember') ? 'checked' : '' }}> Kirim Langsung
                          </div>
                          @if ($errors->has('daterange'))
                                <strong>{{ $errors->first('daterange') }}</strong>
                          @endif
                      </div>
                  </div>

                    <center>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <button type="submit" class="btn btn-danger ftco-animate">Tambah Berkas</button>
                          </form>
                          <button type="reset" onclick="history.back()" class="btn btn-default ftco-animate">Batal</button>
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
<script type="text/javascript">
//daterangepicker
$('input[name="daterange"]').daterangepicker({
  locale: {
    format: 'YYYY/MM/DD'
  }
});

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
document.getElementById('berkas').addEventListener('change', fileSelect, false);
</script>
@endsection
