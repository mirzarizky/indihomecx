<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,700" rel="stylesheet">
  	<link rel="stylesheet" href="{{asset('css/bootstrap/css/bootstrap.css')}}">
	<link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <title>Indihome Customer Experience</title>
	<style media="screen">
		body {
			font-family: "Work Sans", Arial, sans-serif;
		}

		h1,
		h2,
		h3,
		h4,
		h5,
		h6 {
			font-weight: 300 !important;
		}

		.probootstrap-cover {
			background-repeat: no-repeat;
			background-position: center center;
			background-size: cover;
			padding: 7em 0;
		}

		.probootstrap-cover>.container>.row {
			padding: 7em 0;
		}

		.probootstrap-animate {
			opacity: 0;
			visibility: hidden;
		}

		p {
			font-size: 14px;
			width: 600px;
		}
	</style>
</head>

<body>

	<section class="probootstrap-cover overflow-hidden relative" style="background-image: url('{{asset('images/bg_1.jpg')}}');" data-stellar-background-ratio="0.7" id="section-home">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-8">
					<h1 class="ftco-heading ftco-animate probootstrap-animate" style="color: #424242">Indihome Customer Experience</h1>
					<h2 class="h5 ftco-subheading mb-4 ftco-animate probootstrap-animate" style="color: #424242">STO Depok</h2>
					<p class="ftco-animate probootstrap-animate" style="color: #000000">
						Indihome adalah salah satu produk layanan dari Telkom Group berupa paket layanan yang terpadu dalam satu paket triple play meliputi layanan komunikasi, data dan entertainment.<br> Indihome Customer Experience adalah sebuah website survei kepuasan
						pelanggan Indihome.
					</p>
				</div>
			</div>
		</div>
	</section>

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery.waypoints.min.js')}}"></script>
    <script>
    $(document).ready(function($) {

        "use strict";

        var contentWayPoint = function() {
            var i = 0;
            if ($('.probootstrap-animate').length > 0) {
                $('.probootstrap-animate').waypoint(function(direction) {

                    if (direction === 'down' && !$(this.element).hasClass('probootstrap-animated')) {

                        i++;

                        $(this.element).addClass('item-animate');
                        setTimeout(function() {

                            $('body .probootstrap-animate.item-animate').each(function(k) {
                                var el = $(this);
                                setTimeout(function() {
                                    var effect = el.data('animate-effect');
                                    if (effect === 'fadeIn') {
                                        el.addClass('fadeIn probootstrap-animated');
                                    } else if (effect === 'fadeInLeft') {
                                        el.addClass('fadeInLeft probootstrap-animated');
                                    } else if (effect === 'fadeInRight') {
                                        el.addClass('fadeInRight probootstrap-animated');
                                    } else {
                                        el.addClass('fadeInUp probootstrap-animated');
                                    }
                                    el.removeClass('item-animate');
                                }, k * 50, 'easeInOutExpo');
                            });

                        }, 50);

                    }

                }, {
                    offset: '95%'
                });
            }
        };
        contentWayPoint();

        var ThumbnailOpacity = function() {
            var t = $('.probootstrap-thumbnail');
            t.hover(function() {
                var $this = $(this);
                t.addClass('sleep');
                $this.removeClass('sleep');
            }, function() {
                var $this = $(this);
                t.removeClass('sleep');
            });
        }
        ThumbnailOpacity();
    });
</script>
</body>

</html>
