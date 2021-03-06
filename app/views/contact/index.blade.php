@extends('layouts.default')

@section('content')
<!--//-->
<div class="banner-top">
	<div class="wrapper full-height">
		<div class="valign-wrapper"><h3 class="center-block">Contáctenos</h3></div>
		<!---->
		<div class="clearfix"> </div>
	</div>
</div>
<!--//header-->

<!--contact-->
<div class="contact">
	<div class="wrapper">
		<h3>Contacto</h3>
	 <div class="contact-top">
		<div class="col-md-6 contact-top1">
		  <h4 > Información</h4>
          <p class="text-contact">Para mayor información, puede contactar a nuestro equipo a través de los medios ofrecidos.</p>
		  <div class="contact-address">
		  	<div class="col-md-6 contact-address1">
			  	 <h5>Dirección</h5>
			  	 <address class="text-justify">
			  	 	<p><b>Inversora Hulbodt-0311 C.A.</b></p>
					<p>Urb/Sector: Los Palos Grandes</p>
					<p>Dirección: Av. Luis Roche con Francisco de Miranda, Edificio Humboldt, piso 3- ofc.11, Urbanización Altamira- Caracas.</p>

			  	 </address>
		  	</div>
		  	<div class="col-md-6 contact-address1">
			  	 <h5>Dirección de Email</h5>
	             <p>General :<a href="inversorahumboldt@gmail.com"> inversorahumboldt@gmail.com</a></p>
		  	</div>
		  	<div class="clearfix"></div>
		  </div>
		  <div class="contact-address">
		  	<div class="col-md-6 contact-address1">
			  	 <h5 >Teléfono </h5>
	             <p>Local : (0212) 266-94-48</p>
	        </div>
		  	<div class="clearfix"></div>
		  </div>
		</div>
		<div class="col-md-6 contact-right">
	
           <input type="text"  placeholder="Nombre" class="validate-input contact-name" required="">
		   <input type="text" placeholder="Email" class="validate-input contact-email" required="">
		   <input type="text" placeholder="Asunto" class="validate-input contact-subject" required="">
		   <textarea  placeholder="Mensaje" class="validate-input contact-msg" required=""></textarea>
		   <div class="col-xs-12 right-side item-description">
				<div class="miniLoader pull-left" style="margin-top:5px;margin-right:5px;">{{ View::make('partials.loading')->with('size','extra-small') }}</div>
				<a href="#!" class="hvr-sweep-to-right more waves waves-effect waves-light btn-contact pull-left" data-url="{{ URL::to('contactenos/enviar') }}" style="margin-top:0;">enviar</a>
			</div>
           </label>
		</div>
		<div class="clearfix"> </div>
</div>
	</div>
	<div class="map">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3923.0439929001036!2d-66.84625988577672!3d10.497198292511321!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c2a59b1f816730b%3A0x16a8f600c55270fd!2sSeguros+Caracas+de+Liberty+Mutual%2C+C.A.!5e0!3m2!1ses!2sve!4v1495127015429" frameborder="0" style="border:0" allowfullscreen></iframe>
	    </div>
</div>
<!--//contact-->
{{ Form::token() }}
@stop