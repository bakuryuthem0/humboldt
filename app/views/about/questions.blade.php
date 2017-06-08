@extends('layouts.default')

@section('content')
<!--//-->
<div class="banner-top">
	<div class="wrapper full-height">
		<div class="valign-wrapper"><h3 class="center-block">Preguntas Frecuentes</h3></div>
		<!---->
		<div class="clearfix"> </div>
	</div>
</div>
<!--//header-->
<div class="about">	
	<div class="about-middle">
		<div class="wrapper">	
			<div class="row">
				<div class="col-md-12 about-mid">
					<ul class="collapsible popout" data-collapsible="accordion">
						@foreach($questions as $q)
					    <li>
					      <div class="collapsible-header"><i class="fa fa-question-circle"></i> {{ $q->title }}</div>
					      <div class="collapsible-body"><span>{{ $q->description }}</span></div>
					    </li>
					    @endforeach
					  </ul>
				</div>
			</div>	
		</div>
	</div>
</div>
<!--footer-->
@stop

@section('postscript')
<script type="text/javascript">
	
  $(document).ready(function(){
    $('.collapsible').collapsible();
  });
</script>
@stop