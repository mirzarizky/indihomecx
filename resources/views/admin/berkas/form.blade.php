@extends('layouts.app')

@section('style')
    {{--<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/latest/css/bootstrap.css" />--}}
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    {{--<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/3/daterangepicker.css" />--}}
@endsection

@section('content')
    <div class="col-lg-9">
        <div class="panel panel-default">
            <div class="panel-heading">Tambah Berkas</div>

            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                    <form class="form-horizontal" method="POST" action="{{ route('admin.model.create', ['model' => 'berkas']) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

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

                        <div class="form-group {{ !$errors->has('berkas') ?: 'has-error' }}">
                            <label for="berkas" class="col-md-4 control-label">Berkas</label>

                            <div class="col-md-6">
                                <input id="berkas" type="file" class="" name="berkas">

                                @if ($errors->has('berkas'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('berkas') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Tambah
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
        });
    </script>
@endsection
