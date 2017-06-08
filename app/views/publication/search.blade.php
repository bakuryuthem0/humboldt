@extends('layouts.default')

@section('content')
<!--//-->
<div class="banner-top">
	<div class="wrapper full-height">
		<div class="valign-wrapper"><h3 class="center-block">Búsqueda</h3></div>
		<!---->
		<div class="clearfix"> </div>
	</div>
</div>
<!--//header-->

<!---->
<div class="wrapper">
	
	<div class="buy-single">
		<div class="col-xs-12">
			<div class="col-xs-12 col-md-6"><h3>Propiedades encontradas</h3></div>
			<div class="col-xs-12 col-md-6">
				<form method="GET" action="{{ URL::to(Request::url()) }}" class="sort-filter">
				</form>
				Ordenar Por: 
				<div class="inline-block">
					<p>
						<input type="radio" class="with-gap sort-radio filter-input" name="sort_by" value="date" id="date" @if(!isset($sort_by) || $sort_by == "date") checked="checked" @endif>
						<label for="date">Fecha de publicación</label>
					</p>
				</div>
				<div class="inline-block">
					<p>
						<input type="radio" class="with-gap sort-radio filter-input" name="sort_by" value="price_asc" id="price_asc" @if(isset($sort_by) && $sort_by == "price_asc") checked="checked" @endif>
						<label for="price_asc">Menor precio</label>
					</p>
				</div>
				<div class="inline-block">
					<p>
						<input type="radio" class="with-gap sort-radio filter-input" name="sort_by" value="price_desc" id="price_desc" @if(isset($sort_by) && $sort_by == "price_desc") checked="checked" @endif>
						<label for="price_desc">Mayor Precio</label>
					</p>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="col-xs-12 no-padding box-sin formulario">
			<div class="col-xs-12 col-md-9 single-box">
				@foreach($publications as $p)
				<div class="col-xs-12 col-sm-6 col-md-4 formulario">
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
			</div>
			<div class="col-md-3 map-single-bottom">
				{{ $sideBar }}
				<div class="single-box-right">
			     	<h4>Propiedades más populares</h4>
			     	@foreach($populars as $pop)
					<div class="single-box-img">
						{{ View::make('partials.popularBox')->with('pop',$pop) }}
						<div class="clearfix"> </div>
					</div>
					@endforeach
			 	</div>
		  	</div>
		</div>
		<div class="clearfix"> </div>
		<div class="nav-page">
	        @if(count($publications) > 0)
	        <nav role="navigation">
	            <?php  $presenter = new Illuminate\Pagination\BootstrapPresenter($publications); ?>
	            @if ($publications->getLastPage() > 1)
	                <ul class="pagination">
	                <?php
	                    $beforeAndAfter = 3;
	                    $currentPage = $publications->getCurrentPage();
	                    $lastPage = $publications->getLastPage();
	                    $start = $currentPage - $beforeAndAfter;
	                    if($start < 1)
	                    {
	                        $pos = $start - 1;
	                        $start = $currentPage - ($beforeAndAfter + $pos);
	                    }
	                    $end = $currentPage + $beforeAndAfter;
	                    if($end > $lastPage)
	                    {
	                        $pos = $end - $lastPage;
	                        $end = $end - $pos;
	                    }
	                    if ($currentPage <= 1)
	                    {
	                        echo '<li class="disabled"><a href="#!">&laquo; Primera</a></li>';
	                    }
	                    else
	                    {
	                        $url = $publications->getUrl(1);
	                        echo '<li><a class="" href="'.$url.$paginatorFilter.'">&laquo; Primera</a></li>';
	                    }
	                    if (($currentPage-1) < $start) {
	                        echo '<li class="disabled"><a href="#!">&laquo;</a></li>';   
	                    }else
	                    {
	                        echo '<li><a href="'.$publications->getUrl($currentPage-1).$paginatorFilter.'">&laquo;</a></li>';
	                    }
	                    for($i = $start; $i<=$end;$i++)
	                    {
	                        if ($currentPage == $i) {
	                            echo '<li class="active"><a href="#!">'.$i.'</a></li>';
	                        }else
	                        {
	                            echo '<li><a href="'.$publications->getUrl($i).$paginatorFilter.'">'.$i.'</a></li>';
	                        }
	                    }
	                    if (($currentPage+1) > $end) {
	                        echo '<li class="disabled"><a href="#!">&raquo;</a></li>' ;
	                    }else
	                    {
	                        echo '<li><a href="'.$publications->getUrl($currentPage+1).$paginatorFilter.'">&raquo;</a></li>';
	                    }
	                    if ($currentPage >= $lastPage)
	                    {
	                        echo '<li class="disabled"><a href="#!">Última &raquo;</a></li>';
	                    }
	                    else
	                    {
	                        $url = $publications->getUrl($lastPage);
	                        echo '<li><a class="" href="'.$url.$paginatorFilter.'">Última &raquo;</a></li>';
	                    }
	                ?>
	                </ul>
	                @endif
	   			</nav>
        	@endif
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
	</div>
</div>
@stop

@section('postscript')
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
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('.material_select').material_select();
		$('[data-toggle = popover]').popover();
	});
</script>
@stop