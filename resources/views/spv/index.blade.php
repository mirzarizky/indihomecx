@extends('layouts.app')
@section('title', 'Dashboard')
@section('style')
    <link href="{{asset('css/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/datatables/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <div class="right_col" role="main">
      <div class="">
        <div class="row top_tiles">
          <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-share" style="color:#F44336;"></i></div>
              <div class="count">XXX</div>
              <h3>Survei Dikirim</h3>
              <p>Jumlah link survei yang sudah dikirimkan ke pelanggan.</p>
            </div>
          </div>
          <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-comments-o" style="color:#F44336;"></i></div>
              <div class="count">{{$total['survey']}}</div>
              <h3>Survei Terisi</h3>
              <p>Survei yang sudah berhasil diisi oleh pelanggan.</p>
            </div>
          </div>
          <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-check-square-o" style="color:#F44336;"></i></div>
              <div class="count">{{$total['order']}}</div>
              <h3>Completed WO</h3>
              <p>Jumlah WO yang selesai minggu ini.</p>
            </div>
          </div>
        </div>
        <!-- /top tiles -->
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="row dashboard_graph">
              <div class="row x_title">
                <div class="col-md-6">
                  <h3><i>Rating</i> Kepuasan Pelanggan</h3>
                  <p>Berdasarkan bintang yang diberikan.</p>
                </div>
              </div>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <div id="chartdiv" style="width: 100%; height: 300px; background-color: #FFFFFF;"></div>
              </div>
              <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
                <div class="x_title">
                  <h2>Faktor Kepuasan</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-6">
                  @foreach($factors as $factor)
                    <p>{{$factor->nama}}</p>
                    <div class="">
                      <div class="progress progress_sm" style="width: 76%;">
                        @if($factor->detail->count() == 0)
                          <div class="progress-bar bg-red" role="progressbar" data-transitiongoal="0"></div>
                        @else
                          <div class="progress-bar bg-red" role="progressbar" data-transitiongoal="{{($factor->detail->count()/$total['detailFactor']) * 100}}"></div>
                        @endif
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
        <br/>

        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Komentar dan Saran dari Pelanggan</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <table id="datatable-responsive" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>ID Order</th>
                      <th>Komentar & Saran</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($allSurvey as $survey)
                    <tr>
                      <td>{{$survey->pesanan_id}}</td>
                      <td>
                          @if(!empty($survey->komentar))
                              {{$survey->komentar}}
                          @else
                              N/A
                          @endif
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
                  {{$allSurvey->links()}}
              </div>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <br/>
      </div>
    </div>
    <br/>
@endsection
@section('script')
    <script src="{{ asset('js/amcharts/amcharts.js') }}"></script>
    <script src="{{ asset('js/amcharts/pie.js') }}"></script>
    <script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script type="text/javascript">
        AmCharts.makeChart("chartdiv", {
              "type": "pie",
              "angle": 29.7,
              "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
              "depth3D": 21,
              "colors": [
                "#0a100D",
                "#615D5D",
                "#B9BAA3",
                "#D6D5C9",
                "#E72222"
              ],
              "gradientRatio": [],
              "maxLabelWidth": 198,
              "titleField": "category",
              "valueField": "column-1",
              "visibleInLegendField": "category",
              "theme": "default",
              "allLabels": [],
              "balloon": {},
              "titles": [],
              "dataProvider": [
                  @foreach($ratings as $rating)
                  {
                      @foreach($rating as $rates)
                        @switch($rates->nilai)
                          @case(1)
                          @case(2)
                          @case(3)
                          @case(4)
                          @case(5)
                            "category": "{{ str_repeat('★', $rates->nilai) }}",
                            "column-1": "{{ $rating->count() }}",
                            @break
                        @endswitch
                        @break
                      @endforeach
                  },
                  @endforeach
              ]
        });

        //Progressbar
        if ($(".progress .progress-bar")[0]) {
          $('.progress .progress-bar').progressbar();
        }

        //Table
        function init_DataTables() {
          $('#datatable-responsive').DataTable();
        }
        $(document).ready(function() {
          init_DataTables()
        });
  </script>
@endsection
