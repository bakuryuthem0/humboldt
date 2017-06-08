@extends('layouts.default')

@section('content')
<!--//-->
<div class=" header-right">
	<div class=" banner">
		<div class="slider">
			<div class="callbacks_container">
				<ul class="rslides" id="slider">
					@foreach($slides as $s)
					<li>
						<div class="slide">
							<img src="{{ asset('images/slides/'.$s->image) }}" class="full-size" alt="{{ $s->title }}">
						</div>
						@if($s->show_title == 1)
						<div class="banner1">
							<div class="caption"> 
								<h3>{{ $s->title }}</h3>
							</div>
						</div>
						@endif
					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
	<!--header-bottom-->
	<div class="banner-bottom-top">
		<div class="wrapper">
			<div class="bottom-header">
				<div class="col-xs-12 visible-xs visible-sm">
					<div class="text-center">
						<i class="btn btn-flat waves waves-effect wave-light fa fa-search fa-2x fa-open-filters"></i>
					</div>
				</div>
				<div class="header-bottom">
					<i class="fa fa-times btn btn-flat close-filter"></i>
					<form action="{{ URL::to('ver-propiedad/buscar') }}" method="GET" class="filter-form">
					</form>

					<div class="col-xs-12 col-sm-6 col-md-4 input-field">
						<i class="fa fa-search prefix postfix"></i>
						<input type="text" name="busq" class="browser-default filter-input" placeholder="Palabras Claves">
					</div>
					<div class="col-xs-12 col-sm-3 col-md-2 input-field">
						<i class="fa fa-building-o prefix postfix"  data-toggle="popover" data-trigger="hover" data-content="Tipo de Propiedad" data-placement="top" data-html="true"></i>
						<select class="form-control browser-default filter-input" name="cat">
							<option value="*">Todas</option>
							@foreach($categories as $c)
								<option value="{{ $c->id }}">{{ ucfirst($c->description) }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-xs-12 col-sm-3 col-md-2 input-field">
						<i class="fa fa-handshake-o prefix postfix" data-toggle="popover" data-trigger="hover" data-content="Tipo de Operación" data-placement="top" data-html="true"></i>
						<select class="form-control browser-default filter-input" name="operation" >
							<option value="*">Todas</option>
							@foreach($operations as $o)
								<option value="{{ $o->id }}">{{ ucfirst($o->description) }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-xs-6 col-sm-3 col-md-1 input-field rooms">
						<i class="fa fa-bed prefix postfix" data-toggle="popover" data-trigger="hover" data-content="Nº Habitaciones" data-placement="top" data-html="true"></i>
						<input type="number" max="99" class="browser-default filter-input" name="rooms" placeholder="N°">
					</div>
					<div class="col-xs-6 col-sm-3 col-md-1 input-field">
						<i class="fa fa-bathtub prefix postfix" data-toggle="popover" data-trigger="hover" data-content="Nº Baños" data-placement="top" data-html="true"></i>
						<input type="number" max="99" class="browser-default filter-input" name="baths" placeholder="N°">	
					</div>
					<div class="col-xs-6 col-sm-3 col-md-1 input-field">
						<i class="fa fa-automobile prefix postfix" data-toggle="popover" data-trigger="hover" data-content="Nº Puestos de Estacionamiento" data-placement="top" data-html="true"></i>
						<input type="number" max="99" class="browser-default filter-input" name="park" placeholder="N°">	
					</div>
					<div class="col-xs-6 col-sm-3 col-md-1 input-field">
						<i class="fa fa-tree prefix postfix" data-toggle="popover" data-trigger="hover" data-content="m<sup>2</sup>" data-placement="top" data-html="true"></i>
						<input type="number" class="browser-default filter-input" name="size" placeholder="N°">	
					</div>
					<div class="col-xs-12 col-md-6 formulario pull-right">
						<div id="range-slider"></div>
					</div>
					<div class="col-xs-12 col-md-6 formulario">
						<button class="btn waves waves-effect waves-light btn-search-filter " type="button">Buscar</button>
						<button class="btn btn-flat waves waves-effect waves-light pull-right visible-xs close-filter white" type="button">Cerrar</button>
						<div class="col-xs-12 col-md-6 pull-right">
							<div class="range-text min">30000</div>
							<div class="range-text">BsF - </div>
							<div class="range-text max">1000000</div>
							<div class="range-text">BsF</div>
							<input type="hidden" name="min" class="min filter-input" value="30000">
							<input type="hidden" name="max" class="max filter-input"value="1000000">
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>
	</div>
	<!--//-->
</div>

<!--//header-bottom-->
<div class="content">
<!--content-->
	@if(count($populars) > 0)
	<div class="content-grid wow slideInUp" data-wow-duration="1.5s">
		<div class="wrapper">
			<h3><span class="hidden-xs hidden-sm">Propiedades</span> Más Populares</h3>
			@foreach($populars as $pop)
			<div class="col-xs-12 col-md-6 col-md-4 box_2 populars formulario">
				<div class="relative">
					<a href="{{ URL::to('ver-propiedad/'.$pop->publication->id) }}" class="mask">
						<img class="img-responsive zoom-img popular-img" src="{{ asset('images/publications/'.$pop->publication->id.'/'.$pop->publication->images->first()->image)}}" alt="{{ $pop->publication->title }}">
						<span class="four">{{ $pop->publication->price }}BsF</span>
					</a>
					<div class="misc">
						<div class="col-xs-3">
							<div class="fa-container icon-yellow">
								<i class="fa fa-bed fa-bordered" data-toggle="popover" data-trigger="hover" data-title="Nº Habitaciones" data-content="{{ $pop->publication->misc->rooms }}" data-placement="bottom" data-html="true"></i>
							</div>
						</div>
						<div class="col-xs-3">
							<div class="fa-container icon-blue">
								<i class="fa fa-bath fa-bordered" data-toggle="popover" data-trigger="hover" data-title="Nº Baños" data-content="{{ $pop->publication->misc->bathrooms }}" data-placement="bottom" data-html="true"></i>
							</div>
						</div>
						<div class="col-xs-3">
							<div class="fa-container icon-black">
								<i class="fa fa-automobile fa-bordered" data-toggle="popover" data-trigger="hover" data-title="Nº Puesto de Estacionamiento" data-content="{{ $pop->publication->misc->parking_slots }}" data-placement="bottom" data-html="true"></i>
							</div>
						</div>
						<div class="col-xs-3">
							<div class="fa-container icon-green">
								<i class="fa fa-tree fa-bordered" data-toggle="popover" data-trigger="hover" data-title="m<sup>2</sup>" data-content="{{ $pop->publication->misc->size }} M<sup>2</sup>" data-placement="bottom" data-html="true"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="most-1 popular-description item-description">
					<h5>{{ $pop->publication->title }}</h5>
					<p>{{ ucfirst(substr(strip_tags($pop->publication->description), 0, 75)) }}</p>
				</div>
			</div>
			@endforeach
			<div class="clearfix"> </div>
		</div>
	</div>
	@endif
	@if(count($publicity) > 0)
	<!--features-->
	<div class="content-middle">
		<ul class="slide-publicity">
			@foreach($publicity as $p)
			<li>
				<a @if(!is_null($p->url)) href="{{ $p->url }}" @else href="#!"@endif>
					<img src="{{ asset('images/publicity/'.$p->image) }}" alt="{{ $p->title }}"/>
				</a>
			</li>
			@endforeach
		</ul>
	</div>
	<!--//features-->
	@endif
	<!--project-->
	<div class="project wow zoomIn" data-wow-duration="2s">
		<div class="wrapper">
			<h3 class="hidden-xs hidden-sm">Últimas Propiedades</h3>
			<h3 class="visible-xs visible-sm">Propiedades Nuevas</h3>
			<div class="project-top">
				@foreach($publications as $p)
				<div class="col-xs-12 col-sm-6 col-md-3 formulario">
					<div class="project-grid-top">
						<div class="relative">
							<a href="{{ URL::to('ver-propiedad/'.$p->id) }}" class="mask">
								<img src="{{ asset('images/publications/'.$p->id.'/'.$p->images->first()->image) }}" class="zoom-img" alt="{{ $p->title }}"/>
							</a>
							<div class="misc">
								<div class="col-xs-3">
									<div class="fa-container icon-yellow">
										<i class="fa fa-bed fa-bordered" data-toggle="popover" data-trigger="hover" data-title="Nº Habitaciones" data-content="{{ $p->misc->rooms }}" data-placement="bottom" data-html="true"></i>
									</div>
								</div>
								<div class="col-xs-3">
									<div class="fa-container icon-blue">
										<i class="fa fa-bath fa-bordered" data-toggle="popover" data-trigger="hover" data-title="Nº Baños" data-content="{{ $p->misc->bathrooms }}" data-placement="bottom" data-html="true"></i>
									</div>
								</div>
								<div class="col-xs-3">
									<div class="fa-container icon-black">
										<i class="fa fa-automobile fa-bordered" data-toggle="popover" data-trigger="hover" data-title="Nº Puesto de Estacionamiento" data-content="{{ $p->misc->parking_slots }}" data-placement="bottom" data-html="true"></i>
									</div>
								</div>
								<div class="col-xs-3">
									<div class="fa-container icon-green">
										<i class="fa fa-tree fa-bordered" data-toggle="popover" data-trigger="hover" data-title="m<sup>2</sup>" data-content="{{ $p->misc->size }} M<sup>2</sup>" data-placement="bottom" data-html="true"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md1 item-description">
							<div class="col-md2 title-card">
								<div class="col-md-12">
									<strong>{{ $p->title }}</strong>
								</div>
								<div class="clearfix"> </div>
							</div>
							<p>{{ ucfirst(substr(strip_tags($p->description), 0, 75)) }}</p>
							<p class="cost">Para: {{ ucfirst($p->operation->description) }} - {{ $p->price }}BsF</p>
							<a href="{{ URL::to('ver-propiedad/'.$p->id) }}" class="waves waves-effect waves-light hvr-sweep-to-right more">Ver detalles</a>
							<div class="clearfix"> </div>
						</div>
					</div>
				</div>
				@endforeach
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!--//project-->
	
	<!--partners-->
	<div class="content-bottom1 allies wow slideInUp" data-wow-duration="1.5s">
		<h3>Nuestros Aliados</h3>
		<div class="wrapper">
			<ul class="text-center">
				<li class="allie-item">
					<a target="_blank" href="http://tolaecoposada.com/">
						<img class="img-responsive" src="http://tolaecoposada.com/wp-content/uploads/2017/04/logo-tola-eco.png" alt="Tola eco Posada | Inversora Humboldt, venta, alquiler y remodelaciones de bienes raices.">
					</a>
				</li>
				<li class="allie-item">
					<a target="_blank" href="http://concrecasa.com.ve/">
						<img class="img-responsive" src="http://www.concrecasa.com.ve/themes/Concrecasa/images/header_logo.png" alt="Concrecasa | Inversora Humboldt, venta, alquiler y remodelaciones de bienes raices.">
					</a>
				</li>
				<li class="allie-item">
					<a href="#!">
						<img class="img-responsive" src="http://www.viajestureven.com/wp-content/uploads/2016/09/000-Grupo-Tureven.png" alt="Grupo Tureven | Inversora Humboldt, venta, alquiler y remodelaciones de bienes raices.">
					</a>
				</li>
				<li class="allie-item">
					<a href="#!">
						<img class="img-responsive" src="{{ asset('images/allies/mount.jpg') }}" alt="Mount Everest Investments | Inversora Humboldt, venta, alquiler y remodelaciones de bienes raices.">
					</a>
				</li>
				<li class="allie-item">
					<a target="_blank" href="http://cheryvenezuela.com">
						<img class="img-responsive" src="{{ asset('images/allies/chery.png') }}" alt="Automoviles Chery | Inversora Humboldt, venta, alquiler y remodelaciones de bienes raices.">
					</a>
				</li>
				<div class="clearfix"> </div>
			</ul>
		</div>
	</div>
	<!--//partners-->
</div>
@stop
@section('postscript')
<!-- In <head> -->
<link href="{{ asset('plugins/noUiSlider/nouislider.min.css') }}" rel="stylesheet">

<!-- In <body> -->
<script src="{{ asset('plugins/noUiSlider/nouislider.min.js') }}"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		var slider = document.getElementById('range-slider');
	  	noUiSlider.create(slider, {
	   		start: [2000000, 8000000],
	   		connect: true,
	   		step: 100000,
	   		range: {
	     		'min': 0,
	     		'max': 9999999
	   		}
	  	});
	  	slider.noUiSlider.on('update', function( values, handle ) {
			var value = values[handle];

			if ( handle == 1) {
				$('.range-text.max').html(value);
				$('input.max').val(value);

			} else {
				$('.range-text.min').html(value);
				$('input.min').val(value);

			}
		});
	  	$('[data-toggle = popover]').popover();
	});
</script>
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/book/css/default.css') }}" />

<link rel="stylesheet" type="text/css" href="{{ asset('plugins/book/css/bookblock.css') }}" />

<script src="{{ asset('plugins/book/js/modernizr.custom.js') }}"></script>
<script src="{{ asset('plugins/book/js/jquerypp.custom.js') }}"></script>

<link rel="stylesheet" type="text/css" href="{{ asset('plugins/owl-carousel/css/owl.carousel.css') }}">
<script src="{{ asset('plugins/owl-carousel/js/owl.carousel.min.js') }}">
</script>
<script type="text/javascript">

jQuery(document).ready(function($) {
	if ($('.slide-publicity > li').length > 1) {
		var loop = true;
	}else
	{
		var loop = false;
	}
	 var data = {
        loop: loop,
        nav:false,
        items : 1,
    }
	$('.slide-publicity').owlCarousel(data); 
	
});
</script>
@stop