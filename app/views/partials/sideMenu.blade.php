<div class="filters-menu">
	<div class="text-center">
  	<a href="#!" class="collapsed waves waves-effect waves-dark" data-toggle="collapse" data-target="#fiter-container">
  		<h3 class="text-center">
  			{{ Lang::get('lang.filter') }} <i class="fa fa-plus"></i><i class="fa fa-minus"></i>
  		</h3>
  	</a>
   </div> 
	<div class="filter-container collapse" id="fiter-container">
		@if(isset($self))
			<form method="GET" action="{{ URL::to('ver-propiedad/buscar') }}" class="form-filter">
		@else
			<form method="GET" action="{{ URL::to(Request::url()) }}" class="form-filter">
		@endif
		</form>
		<div class="col-xs-12 input-field">
			<label class="label-filter">Búsqueda</label>
			<input type="text" name="busq" @if(isset($busq)) value="{{ $busq }}" @endif class="filter-input">
		</div>
		<div class="col-xs-12 input-field">
			<label class="label-filter select-label">Ciudad</label>
			<select class="material_select filter-input" name="city" >
				<option value="*">Todas</option>
				@foreach($cities as $c)
					<option value="{{ $c->id }}" @if(isset($city) && $city == $c->id) selected @endif>{{ ucfirst($c->title) }}</option>
				@endforeach
			</select>
		</div>
		<div class="col-xs-12 input-field">
			<label class="label-filter select-label">Tipo de Propiedad</label>
			<select class="material_select filter-input" name="cat" >
				<option value="*">Todas</option>
				@foreach($categories as $c)
					<option value="{{ $c->id }}" @if(isset($cat) && $cat == $c->id) selected @endif>{{ ucfirst($c->description) }}</option>
				@endforeach
			</select>
		</div>
		<div class="col-xs-12 input-field">
			<label class="label-filter select-label">Operación</label>
			<select class="material_select filter-input" name="operation">
				<option value="*">Todas</option>
				@foreach($operations as $o)
					<option value="{{ $o->id }}" @if(isset($operation) && $operation == $o->id) selected @endif>{{ ucfirst($o->description) }}</option>
				@endforeach
			</select>
		</div>
		<div class="col-xs-6 input-field">
			<i class="fa fa-bed prefix postfix"></i>
			<input type="number" name="rooms" placeholder="N°" @if(isset($rooms)) value="{{ $rooms }}" @endif class="filter-input">
		</div>
		<div class="col-xs-6 input-field">
			<i class="fa fa-bathtub prefix postfix"></i>
			<input type="number" name="baths" placeholder="N°" @if(isset($baths)) value="{{ $baths }}" @endif class="filter-input">
		</div>
		<div class="col-xs-6 input-field">
			<i class="fa fa-automobile prefix postfix"></i>
			<input type="number" name="park" placeholder="N°" @if(isset($park)) value="{{ $park }}" @endif class="filter-input">
		</div>
		<div class="col-xs-6 input-field">
			<i class="fa fa-tree prefix postfix"></i>
			<input type="number" name="size" placeholder="N°" @if(isset($size)) value="{{ $size }}" @endif class="filter-input">
		</div>
		<div class="col-xs-6 formulario input-field">
			<label class="label-filter">Mínimo</label>
			<input type="text" class="min filter-input" name="min" min="0" placeholder="Min:" @if(isset($min)) value="{{ $min }}" @endif >
		</div>
		<div class="col-xs-6 formulario input-field">
			<label class="label-filter">Máximo</label>
			<input type="text" class="max filter-input" name="max" min="0" placeholder="Max:" @if(isset($max)) value="{{ $max }}" @endif>
		</div>

		<div class="col-xs-12 formulario">
			<button class="btn btn-default btn-xs btn-flat btn-filtralo waves waves-effect waves-dark" title="Filtrar">Filtrar <strong><i class="fa fa-angle-right"></i></strong></button>
		</div>
		<div class="clearfix"></div>
	</div>
</div>