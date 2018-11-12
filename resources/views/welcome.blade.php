<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link rel="shortcut icon" href="{{asset('images/logoindi.png')}}">
  <title>Indihome Customer Experience</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Quicksand|Raleway" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/plugins.css')}}">
	<link rel="stylesheet" href="{{asset('css/homepage.css')}}">
	<link rel="stylesheet" href="{{asset('css/responsive.css')}}">
</head>

<body data-spy="scroll" data-target=".navbar-collapse">
  <div class='preloader'>
    <div class='loaded'>&nbsp;</div>
  </div>
  <div class="culmn">
    <header id="main_menu" class="header navbar-fixed-top">
      <div class="main_menu_bg">
        <div class="container">
          <div class="row">
            <div class="nave_menu">
              <nav class="navbar navbar-default">
                <div class="container-fluid">
                  <div class="navbar-header">
                    <img src="{{asset('images/indihome.png')}}" width="30%" style="margin-left:10px">
                  </div>
                </div>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </header>
    <section id="home " class="home ">
      <div class="overlay home-overlay-fluid">
        <div class="container ">
          <div class="row ">
            <div class="col-sm-12">
              <div class="main_home_slider text-center ">
                <div class="single_home_slider ">
                  <div class="main_home wow fadeInUp " data-wow-duration="200ms ">
                    <h2>Why IndiHome?</h2>
                    <h4>IndiHome merupakan layanan digital terdepan menggunakan teknologi fiber optik yang menawarkan layanan Triple Play yang terdiri dari Internet Rumah (Fixed Broadband Internet), Telepon Rumah (Fixed Phone) dan TV Interaktif (UseeTV). IndiHome juga menawarkan layanan Dual Play yang terdiri Internet Fiber (Internet Cepat) dan Telepon Rumah (Fixed Phone) atau Internet Fiber (Internet Cepat) dan TV Interaktif (UseeTV). </h4>
                  </div>
                </div>
                <div class="single_home_slider ">
                  <div class="main_home wow fadeInUp " data-wow-duration="100ms ">
                    <br>
                    <br>
                    <br>
                    <h4>CEPAT. STABIL. ANDAL. CANGGIH.</h4>
                    <div class="whiteseparator"></div>
                    <div class="home_btn">
                      <a href="https://indihome.co.id/" class="btn btn-primary">PELAJARI LEBIH LANJUT</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="single_home_slider ">
                <div class="main_home wow fadeInUp " data-wow-duration="700ms ">
                  <h3>
                      &nbsp;
                    </h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  </section>


	<script src="{{asset('js/jquery-1.11.2.min.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	<script src="{{asset('js/plugins.js')}}"></script>
	<script src="{{asset('js/main.js')}}"></script>


</body>

</html>
