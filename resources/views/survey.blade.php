<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Survey Pelanggan Indihome</title>

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,700" rel="stylesheet">
	<link href="{{asset('css/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{asset('css/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
	<link href="{{ asset('css/survey.css') }}" rel="stylesheet">
</head>

<body>

	<nav class="navbar navbar-expand-lg navbar-dark probootstrap_navbar bg-faded" id="probootstrap-navbar">
		<div class="container">
			<img src="{{ asset('images/indihome.png')}}" style="width:15%">
		</div>
	</nav>
	<!-- END nav -->

	<section class="probootstrap_section" id="section-feature-testimonial">
		<div class="container">
			<div class="row justify-content-center mb-5">
				<div class="col-md-12 text-center mb-5 probootstrap-animate">
					<h2 class="display-5 probootstrap-section-heading text-center">Customer Satisfaction Survey</h2>
					<p class="border-bottom text-center">Please help us improve our service by completing this survey.</p>
					<div style="text-align:left">
						<form action="{{ route('survei.post') }}" method="post">
							{{csrf_field()}}
                            <input type="hidden" name="order_id" value="{{$order_id}}">
                            <p class="lead">1. Please rate our service.</p>
                            <div class="row">
                                <div class="col-lg-12 text-center md-4">
                                    <div class="star-rating">
                                        <span class="fa fa-star-o" data-rating="1"></span>
                                        <span class="fa fa-star-o" data-rating="2"></span>
                                        <span class="fa fa-star-o" data-rating="3"></span>
                                        <span class="fa fa-star-o" data-rating="4"></span>
                                        <span class="fa fa-star-o" data-rating="5"></span>
                                        <input type="hidden" name="rating" class="rating-value" value="0" required>
                                    </div>
                                </div>
                            </div>
                            <p class="lead">2. Please select your satisfaction factors.</p>
                                @foreach($allFactor as $factor)
                                    <div class="checkbox checkbox-danger">
                                        <input id="checkbox{{$factor->id}}" value="{{$factor->id}}" type="checkbox" name="factors[]" {{ (is_array(old('factors')) && in_array($factor->id, old('factors'))) ? ' checked' : '' }}>
                                        <label for="checkbox{{$factor->id}}">{{$factor->nama}}</label>
                                    </div>
                                @endforeach
                            <p class="lead" >3. Please give us a feedback. (Optional)</p>
                            <textarea title="feedback" name="feedback" class="form-control" rows="3">{{old('feedback')}}</textarea>
                            <input type="submit" class="button" value="Submit">
					</form>
				</div>
				</div>
			</div>
		</div>
	</section>
	<!-- END section -->

    <script src="{{ asset('js/jquery3.min.js') }}"></script>
    <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
    <script>
        $(document).ready(function() {
			var contentWayPoint = function() {
				if ($('.probootstrap-animate').length > 0 ) {
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
				}
			};
			contentWayPoint();

		  var ThumbnailOpacity = function() {
		  	var t = $('.probootstrap-thumbnail');
		  	t.hover(function(){
		  		var $this = $(this);
		  		t.addClass('sleep');
		  		$this.removeClass('sleep');
		  	}, function(){
		  		var $this = $(this);
		  		t.removeClass('sleep');
		  	});
		  }
		  ThumbnailOpacity();

		});

		var $star_rating = $('.star-rating .fa');

		var SetRatingStar = function() {
		  return $star_rating.each(function() {
		    if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
		      return $(this).removeClass('fa-star-o').addClass('fa-star');
		    } else {
		      return $(this).removeClass('fa-star').addClass('fa-star-o');
		    }
		  });
		};

		$star_rating.on('click', function() {
		  $star_rating.siblings('input.rating-value').val($(this).data('rating'));
		  return SetRatingStar();
		});

		SetRatingStar();
    </script>
	</body>
</html>