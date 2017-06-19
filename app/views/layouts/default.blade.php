<!DOCTYPE html>
<html>
	<head>
		<title>{{ $title }}</title>
		<link rel="stylesheet" type="text/css" href="{{ asset('plugins/font-awesome/font-awesome/css/font-awesome.min.css') }}">
		<link href="{{ asset('templates/real_home/web/css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" />
		<link rel="stylesheet" type="text/css" href="{{ asset('frameworks/materialize/css/materialize.min.css') }}">
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="{{ asset('templates/real_home/web/js/jquery.min.js') }}"></script>
		<!-- Custom Theme files -->
		<!--menu-->
		<script src="{{ asset('templates/real_home/web/js/scripts.js') }}"></script>
		<link href="{{ asset('templates/real_home/web/css/styles.css') }}" rel="stylesheet">
		<!--//menu-->
		<link rel="stylesheet" type="text/css" href="{{ asset('plugins/animate/animate.css') }}">
		<!--theme-style-->
		<link href="{{ asset('templates/real_home/web/css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
		<!--//theme-style-->
		
		<link rel="stylesheet" type="text/css" href="{{ asset('plugins/navicon/css/style.css') }}">
		<!---pop-up-box---->
					
		<link href="{{ asset('templates/real_home/web/css/popuo-box.css') }}" rel="stylesheet" type="text/css" media="all"/>
		<script src="{{ asset('templates/real_home/web/js/jquery.magnific-popup.js') }}" type="text/javascript"></script>
		<!---//pop-up-box---->
		<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">

		<script src="{{ asset('plugins/wow/wow.min.js')}}"></script>
		<script>
			var wow = new WOW(
		      {
		        animateClass: 'animated',
		        offset:       100,
		      }
		    );
		    wow.init();
		</script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	</head>
	<body class="@if(isset($home)) home @endif">
		<input type="hidden" value="{{ URL::to('/') }}" class="baseUrl">
		<div class="contLoading active">
			<div class="content">
				<div class="cssload-container">
					<div class="cssload-whirlpool"></div>
				</div>
			</div>
		</div>
		<!--header-->
		<div class="navigation">
			<div class="container-fluid">
				<nav class="pull">
					<ul>
						<li><a class="waves waves-effect waves-light" href="{{ URL::to('/') }}">Inicio</a></li>
						<li><a class="waves waves-effect waves-light" href="{{ URL::to('acerca-de-nosotros') }}">Acerca de nosotros</a></li>
						<li><a class="waves waves-effect waves-light" href="{{ URL::to('ver-propiedad/buscar') }}">Ver Propiedades</a></li>
						<li><a class="waves waves-effect waves-light" href="{{ URL::to('contactenos') }}">Contáctenos</a></li>
					</ul>
				</nav>
				<div class="clearfix"></div>
				<div class="text-center menu-logo-container"><img src="{{ asset('images/logo-mobil.png') }}" class="logo"></div>
			</div>
		</div>
		<div class="header @if(isset($home)) home @endif">
			<div class="wrapper">
				<!--logo-->
				<div class="logo">
					<h1>
						<a href="{{ URL::to('/') }}" class="waves waves-effect waves-light">
							<img src="{{ asset('images/logo.png') }}" class="logo visible-md visible-lg">
							<img src="{{ asset('images/logo-mobil.png') }}" class="logo visible-xs visible-sm">
						</a>
					</h1>
				</div>
				<!--//logo-->
				<div class="top-nav">
					<div class="nav-icon">
						<div class="nav-holder">
			                <button type="button" role="button" aria-label="Toggle Navigation" class="waves-effect waves-light lines-button arrow arrow-left">
			                  <span class="lines"></span>
			                </button>
			            </div>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>

<!--//header-->
@yield('content')
<!--footer-->
<div class="footer">
	<div class="wrapper">
		<div class="footer-top-at">
			<div class="col-md-3 amet-sed">
				<h4>Nuestra Empresa</h4>
				<ul class="nav-bottom">
					<li><a href="{{ URL::to('acerca-de-nosotros') }}">Acerca de nosotros</a></li>
					<li><a href="{{ URL::to('ver-propiedad/buscar') }}">Ver Propiedades</a></li>
					<li><a href="{{ URL::to('politicas-de-privacidad') }}">Políticas de Privacidad</a></li>
				</ul>
			</div>
			
			<div class="col-md-3 amet-sed">
				<h4>Atención al cliente</h4>
				<p>Lun-Vie, 8:30 am a 12:00 pm y de 1:00 a 3:30 pm. </p>
				<p>Local (0212) 266-94-48</p>
				<p>Celular (0414) 590-71-78</p>
				<p>General :<a href="inversorahumboldt@gmail.com"> inversorahumboldt@gmail.com</a></p>
				<p>Dirección: Av. Luis Roche con Francisco de Miranda, Edificio Humboldt, piso 3- ofc.11, Urbanización Altamira- Caracas.</p>
				<ul class="nav-bottom">
					<li><a href="{{ URL::to('contactenos') }}">Contáctenos.</a></li>
				</ul>
			</div>
			<div class="col-md-3 amet-sed ">
				<h4>Propiedades más Populares</h4>
				<ul class="nav-bottom">
					@foreach(CommonTask::getPopulars() as $pop)
					<li><a href="{{ URL::to('ver-propiedad/'.$pop->publication->id) }}">{{ $pop->publication->title }}</a></li>
					@endforeach
				</ul>
				<ul class="social">
					<li><a target="_blank" href="https://www.facebook.com/profile.php?id=100017731064775"><i> </i></a></li>
					<li><a target="_blank" href="https://www.instagram.com/inversorahumboldt/?hl=es"><i class="camera"> </i></a></li>
				</ul>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="wrapper">
			<div class="footer-logo valign">
				<a href="{{ URL::to('/') }}" class="waves waves-effect waves-light">
					<img src="{{ asset('images/logo.png') }}" class="logo">
				</a>
			</div>
			<div class="footer-class valign">
				<p>Inversora Humboldt-0311 C.A.  J-40946271-4 | © 2017 Todos los Derechos reservados </p>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>
<!--//footer-->
<div class="overly"></div>
</body>
@yield('postscript')
<script src="{{ asset('templates/real_home/web/js/responsiveslides.min.js') }}"></script>
<script src="{{ asset('templates/real_home/web/js/easyResponsiveTabs.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('frameworks/bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frameworks/materialize/js/materialize.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/functions.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
<script>
	$(document).ready(function() {
		$('.popup-with-zoom-anim').magnificPopup({
			type: 'inline',
			fixedContentPos: false,
			fixedBgPos: true,
			overflowY: 'auto',
			closeBtnInside: true,
			preloader: false,
			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-zoom-in'
		});
		$('#horizontalTab').easyResponsiveTabs({
			type: 'default', //Types: default, vertical, accordion
			width: 'auto', //auto or any width like 600px
			fit: true   // 100% fit in a container
		});
      	$("#slider").responsiveSlides({
			auto: true,
			speed: 500,
			namespace: "callbacks",
			pager: true,
		});
    });
  </script>
</html>