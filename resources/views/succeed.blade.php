<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Survey Pelanggan Indihome</title>

	<link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,700" rel="stylesheet">
	<link href="{{ asset('css/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
	<style media="screen">
	body {
		font-family: "Work Sans", Arial, sans-serif;
	}

	h1, h2, h3, h4, h5, h6 {
		font-weight: 300 !important;
	}

	.border-bottom {
		display: block;
		position: relative;
		padding-bottom: 20px;
		margin-bottom: 20px;
	}

	.border-bottom:after {
		width: 50px;
		height: 2px;
		background: #F44336;
		position: absolute;
		content: "";
		bottom: 0;
		left: 50%;
		-webkit-transform: translateX(-50%);
		-ms-transform: translateX(-50%);
		transform: translateX(-50%);
	}

	.probootstrap_section {
		padding: 7em 0;
		float: left;
		width: 100%;
	}

	.probootstrap-animate {
		opacity: 0;
		visibility: hidden;
	}

	.logo {
	margin-bottom:30px;
	margin-left:0px;
	-webkit-transition:2s;
	}

	.logo:hover {
	-webkit-transform: rotatey(180deg);;
	-webkit-transition-duration: 2s;
	}
	</style>
</head>

<body>
<section class="probootstrap_section" id="section-feature-testimonial">
    <center>
      <img class="logo" src="{{ asset('images/indihome.png')}}" style="width:20%; padding-bottom:20px;" />
    </center>
    <div class="container">
      <div class="row justify-content-center mb-5">
        <div class="col-md-12 text-center mb-5 probootstrap-animate">
          <h2 class="display-5 probootstrap-section-heading text-center">Thank You</h2>
          <p class="border-bottom text-center">Respon anda sudah kami terima.</p>
          <div class="containerIsi" style="text-align:left">
          </div>
        </div>
      </div>
    </div>
</section>

<script src="{{ asset('js/jquery3.min.js') }}"></script>
<script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
<script>
    $(document).ready(function() {
        var contentWayPoint = function() {
                $('.probootstrap-animate').waypoint( function( direction ) {
                    if( direction === 'down' && !$(this.element).hasClass('probootstrap-animated') ) {
                        $(this.element).addClass('item-animate');
                        setTimeout(function(){
                            $('body .probootstrap-animate.item-animate').each(function(k){
                                var el = $(this);
                                setTimeout( function () {
                                    var effect = el.data('animate-effect');
                                    if ( effect === 'fadeIn') {
                                        el.addClass('fadeIn probootstrap-animated');
                                    } else if ( effect === 'fadeInLeft') {
                                        el.addClass('fadeInLeft probootstrap-animated');
                                    } else if ( effect === 'fadeInRight') {
                                        el.addClass('fadeInRight probootstrap-animated');
                                    } else {
                                        el.addClass('fadeInUp probootstrap-animated');
                                    }
                                    el.removeClass('item-animate');
                                },  k * 50, 'easeInOutExpo' );
                            });

                        }, 50);
                    }
                } , { offset: '95%' } );
            };
        contentWayPoint();
    });
</script>
</body>
</html>
