@extends('layouts.app')

@section('style')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
@endsection

@section('content')
    <div class="col-lg-9">
        <div class="panel panel-default">
            <div class="panel-heading">Ubah Berkas</div>

            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                    <form class="form-horizontal" method="POST" action="{{route('admin.model.update', ['model' => 'berkas', 'id' => $berkas->id])}}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                            <label for="nama" class="col-md-4 control-label">Nama Berkas</label>

                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control" name="nama" value="{{ $berkas->nama }}" required>

                                @if ($errors->has('nama'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('daterange') ? ' has-error' : '' }}">
                            <label for="daterange" class="col-md-4 control-label">Range Tanggal</label>

                            <div class="col-md-6">
                                <input type="text" id="daterange" name="daterange" class="form-control daterange">

                                @if ($errors->has('daterange'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('daterange') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <script type="text/javascript">
        $('input[name="daterange"]').daterangepicker({
            locale: {
                format: 'YYYY/MM/DD'
            },
            startDate: '{{$berkas->tanggalMulaiPesanan}}',
            endDate: '{{$berkas->tanggalAkhirPesanan}}'
        });
    </script>
@endsection
