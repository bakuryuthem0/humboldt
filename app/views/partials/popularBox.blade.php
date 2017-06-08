<div class="box-img">
	<a href="{{ URL::to('ver-propiedad/'.$pop->publication->id) }}">
		<img class="img-responsive" src="{{ asset('images/publications/'.$pop->publication->id.'/'.$pop->publication->images->first()->image) }}" alt="{{ $pop->publication->title }}">
	</a>
</div>
<div class="box-text">
	<p><a href="{{ URL::to('ver-propiedad/'.$pop->publication->id) }}">{{ $pop->publication->title }}</a></p>
	<a href="{{ URL::to('ver-propiedad/'.$pop->publication->id) }}" class="in-box">Ver Propiedad</a>
</div>