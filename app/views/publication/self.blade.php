@extends('layouts.default')

@section('content')
<!--//-->
<div class="banner-top">
	<div class="wrapper full-height">
		<div class="valign-wrapper"><h3 class="center-block">{{  $publication->title}}</h3></div>
		<!---->
		<div class="clearfix"> </div>
	</div>
</div>
<!--//header-->
<!---->
<div class="wrapper margin-bottom">

	<div class="buy-single-single">
		
		<div class="col-md-9 single-box">
			
			<div class=" buying-top">
				<div class="flexslider self-slider">
					<ul class="slides">
						@foreach($publication->images as $i)
						<li data-thumb="{{ asset('images/publications/'.$i->publication_id.'/'.$i->image)}}">
							<a href="{{ asset('images/publications/'.$i->publication_id.'/'.$i->image) }}" class="fancybox" data-fancybox="{{ ucfirst($publication->title) }}" data-caption="{{ strip_tags($publication->description) }}" data-type="image"><img src="{{ asset('images/publications/'.$i->publication_id.'/'.$i->image)}}" /></a>
						</li>
						@endforeach
					</ul>
				</div>
				
			</div>
			<div class="buy-sin-single">
				<div class="col-sm-5 middle-side immediate">
					<h4>Operación: {{ $publication->operation->description }}</h4>
					<div class="col-xs-12">
						<p class="text-left">Tipo de Propiedad:</p>
						<p class="pull-right">{{ $publication->category->description }}</p>
					</div>
					<div class="col-xs-12">
						<p class="text-left">Habitaciones:</p>
						<p class="pull-right">{{ $publication->misc->rooms }}</p>
					</div>
					<div class="col-xs-12">
						<p class="text-left">Baños:</p>
						<p class="pull-right">{{ $publication->misc->bathrooms }}</p>
					</div>
					<div class="col-xs-12">
						<p class="text-left">Puesto de Estacionamiento:</p>
						<p class="pull-right">{{ $publication->misc->parking_slots }}</p>
					</div>
					<div class="col-xs-12">
						<p class="text-left">Tamaño de la Propiedad</p>
						<p class="pull-right">{{ $publication->misc->size }}M<sup>2</sup></p>
					</div>
					<div class="col-xs-12">
						<p class="text-left">Precio</p>
						<p class="pull-right">{{ $publication->price }}BsF</p>
					</div>
					<div class="col-xs-12 right-side item-description">
						<a href="#contactModal" class="hvr-sweep-to-right more waves waves-effect waves-light modal-trigger" >Contactar</a>
					</div>
				</div>
				<div class="col-sm-7 buy-sin">
					<h4>Descripción</h4>
					<div>{{ $publication->description }}</div>
				</div>
				<div class="clearfix"> </div>
			</div>
			@if(!is_null($publication->misc->map))
			<div class="map-buy-single">
				<h4>Ubicación de la propiedad.</h4>
				<div class="map-buy-single1">
					{{ $publication->misc->map }}
					
				</div>
			</div>
			@endif
		</div>
		
		
		
		<div class="col-md-3 to-pushpin">
			{{ $sideBar }}

			<div class="single-box-right right-immediate">
				<h4>Propiedades más populares</h4>
				@foreach($populars as $p)
				<div class="single-box-img ">
					{{ View::make('partials.popularBox')->with('pop',$p) }}
					<div class="clearfix"> </div>
				</div>
				@endforeach
			</div>
			
		</div>
		<div class="clearfix"> </div>
	</div>
</div>
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
@endif
@if(count($related) > 0)
<!---->
<div class="wrapper">
	<div class="future">
		<h3 ><span class="hidden-xs hidden-sm">Propiedades</span> Relacionadas</h3>
		<div class="content-bottom-in">
			@foreach($related as $r)
				<div class="col-xs-12 col-sm-6 col-md-3 formulario">
					<div class="project-grid-top">
						<div class="relative">
							<a href="{{ URL::to('ver-propiedad/'.$r->id) }}" class="mask">
								<img src="{{ asset('images/publications/'.$r->id.'/'.$r->images->first()->image) }}" class="zoom-img" alt="{{ $r->title }}"/>
							</a>
							<div class="misc">
								<div class="col-xs-3">
									<div class="fa-container icon-yellow">
										<i class="fa fa-bed fa-bordered" data-toggle="popover" data-trigger="hover" data-title="Nº Habitaciones" data-content="{{ $r->misc->rooms }}" data-placement="bottom" data-html="true"></i>
									</div>
								</div>
								<div class="col-xs-3">
									<div class="fa-container icon-blue">
										<i class="fa fa-bath fa-bordered" data-toggle="popover" data-trigger="hover" data-title="Nº Baños" data-content="{{ $r->misc->bathrooms }}" data-placement="bottom" data-html="true"></i>
									</div>
								</div>
								<div class="col-xs-3">
									<div class="fa-container icon-black">
										<i class="fa fa-automobile fa-bordered" data-toggle="popover" data-trigger="hover" data-title="Nº Puesto de Estacionamiento" data-content="{{ $r->misc->parking_slots }}" data-placement="bottom" data-html="true"></i>
									</div>
								</div>
								<div class="col-xs-3">
									<div class="fa-container icon-green">
										<i class="fa fa-tree fa-bordered" data-toggle="popover" data-trigger="hover" data-title="m<sup>2</sup>" data-content="{{ $r->misc->size }} m<sup>2</sup>" data-placement="bottom" data-html="true"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md1 item-description">
							<div class="col-md2 title-card">
								<div class="col-md-12">
									<strong>{{ $r->title }}</strong>
								</div>
								<div class="clearfix"> </div>
							</div>
							<p>{{ ucfirst(substr(strip_tags($r->description), 0, 75)) }}</p>
							<p class="cost">Para: {{ $r->operation->description }} - {{ $r->price }}BsF</p>
							<a href="{{ URL::to('ver-propiedad/'.$r->id) }}" class="waves waves-effect waves-light hvr-sweep-to-right more">Ver detalles</a>
							<div class="clearfix"> </div>
						</div>
					</div>
				</div>
			@endforeach
			<div class="clearfix"></div>
		</div>
	</div>

</div>
@endif
<div id="contactModal" class="modal modal-fixed-footer">
	<div class="modal-content">
	  <h4>Contacto</h4>
	  <p class="formulario">Por favor llene el siguiente formulario y nuestros agentes pronto se pondran en contacto con usted</p>
	  <div>
	  	<div class="input-field">
			<input type="text" class="validate-input contact-name" name="name">
			<label>Nombre</label>
		</div>
		<div class="input-field">
			<input type="email" class="validate-input contact-email" name="email">
			<label>Email</label>
		</div>
		<div class="input-field">
			<textarea class="materialize-textarea validate-input contact-msg">Me gustaría obtener información de la propiedad {{ $publication->publication_cod }}</textarea>
			<label>Mensaje</label>
		</div>
	  </div>
	</div>
	<div class="modal-footer item-description">
		<div class="miniLoader">{{ View::make('partials.loading')->with('size','extra-small') }}</div>
		<a href="#!" class="hvr-sweep-to-right more waves waves-effect waves-light btn-send-contact" data-id="{{ $publication->id }}" data-url="{{ URL::to('ver-propiedad/contactar') }}">Enviar</a>
	</div>
</div>
{{ Form::token() }}
@stop

@section('postscript')
<!-- FlexSlider -->
<link rel="stylesheet" href="{{ asset('templates/real_home/web/css/flexslider.css' )}}" type="text/css" media="screen" />
<script defer src="{{ asset('templates/real_home/web/js/jquery.flexslider.js') }}"></script>
<script type="text/javascript" src="{{ asset('templates/real_home/web/js/jquery.flexisel.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/fancybox-3.0/dist/jquery.fancybox.min.css') }}">
<script type="text/javascript" src="{{ asset('plugins/fancybox-3.0/dist/jquery.fancybox.min.js') }}"></script>

<script type="text/javascript">
jQuery(document).ready(function($) {
	$('.flexslider').flexslider({
		animation: "slide",
		controlNav: "thumbnails",
	});

	$('.fancybox').fancybox({
        image : {
          protect: true
        }
  	});
  	$('[data-toggle = popover]').popover();
  	$('.modal').modal({
    	dismissible: true
  	});
		$('.material_select').material_select();
  	
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