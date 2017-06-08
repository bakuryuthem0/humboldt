<div class="row">
	<div class="col-xs-12 text-center">
		<h5><strong>Código de la propiedad</strong></h5>
		<p class="title es">@if(!is_null($publication->publication_cod)){{ $publication->publication_cod }}@else Sin especificar @endif</p>
	</div>
	<div class="col-xs-12 col-md-6 text-center">
		<h5><strong>Cantidad de Habitaciones</strong></h5>
		<p class="title es">{{ $publication->misc->rooms }}</p>
	</div>
	<div class="col-xs-12 col-md-6 text-center">
		<h5><strong>Cantidad de baños</strong></h5>
		<p class="subcat es">{{ $publication->misc->bathrooms }}</p>
	</div>
	<div class="col-xs-12 col-md-6 text-center">
		<h5><strong>Cantidad de Puesto de estacionamiento</strong></h5>
		<p class="cat es">{{ $publication->misc->parking_slots }}</p>
	</div>
	<div class="col-xs-12 col-md-6 text-center">
		<h5><strong>Tamaño de la infraestructura</strong></h5>
		<p class="subcat es">{{ $publication->misc->size }} m<sup>2</sup></p>
	</div>
	<div class="col-xs-12 text-center">
		<h5><strong>Descripción</strong></h5>
		<div class="description es">{{ $publication->description }}</div>
		<h5><strong>Mapa</strong></h5>
		<div class="description es map">{{ $publication->misc->map }}</div>
	</div>
</div>
