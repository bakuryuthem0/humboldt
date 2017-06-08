@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li class=""><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><a href="#"><i class="fa fa-image"></i> Nuevo Slide</a></li>
    </ol>
  </section>
  <div class="row">
    <div class="col-xs-12 col-md-8 col-md-offset-2 formulario">
        <div class="box box-success">
          <div class="box-header">
            <i class="fa fa-image"></i>
            <h3 class="box-title">Nuevo Slide</h3>
          </div>
          <div class="box-body chat" id="chat-box">
            @if(Session::has('success'))
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              {{ Session::get('success') }}
            </div>
            @endif
            <form class="new-user-form" method="POST" action="{{ URL::to('administracion/slider/'.$slide->id.'/enviar') }}" enctype="multipart/form-data"> 
              <div class="formulario">
               <label class="">Titulo (opcional) <i class="fa fa-info-circle text-info" data-container="body" data-toggle="popover" data-placement="right" data-html="true" data-trigger="hover" data-content='Para mejorar el posicionamineto de la pagina web, ingrese un titulo el cual los motores de busqueda como google reconoceran como "Inversora Inversora Humboldt, venta, alquiler y remodelaciones de bienes raices."'></i></label>
               <input type="text" name="title" class="form-control title" placeholder="Titulo" value="{{ $slide->title }}">
               @if($errors->has('title'))
                  @foreach($errors->get('title') as $err)
                  <div class="clearfix"></div>
                  <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ $err }}
                  </div>
                  @endforeach
                @endif
              </div>
              <div class="formulario">
                <label>Mostrar Titulo <i class="fa fa-info-circle text-info" data-container="body" data-toggle="popover" data-placement="right" data-html="true" data-trigger="hover" data-content='Al marcar este campo el titulo colocado anteriormente se mostrara sobre el slide. En caso no desear mostrar el titulo deje este campo sin marcar.'></i></label>
                <br>
                <input type="checkbox" name="show_title" value="1" @if($slide->show_title == 1) checked="checked" @endif>
              </div>
              <div class="formulario">
               <label class="">URL (opcional)</label>
               <input type="url" name="url" class="form-control" placeholder="http://midominio.com" @if($slide->url != "#!") value="{{ $slide->url }}" @endif>
               @if($errors->has('url'))
                  @foreach($errors->get('url') as $err)
                  <div class="clearfix"></div>
                  <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ $err }}
                  </div>
                  @endforeach
                @endif
              </div>
              <div class="formulario">
               <label class="">Imagen (*)</label>
               <input type="file" name="image" class="slide">
               <output class="outpost">
                <img src="{{ asset('images/slides/'.$slide->image) }}" class="center-block publication-image">
               </output>
               @if($errors->has('image'))
                  @foreach($errors->get('image') as $err)
                  <div class="clearfix"></div>
                  <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ $err }}
                  </div>
                  @endforeach
                @endif
              </div>
              <input type="hidden" name="status" class="status" value="1">
              {{ Form::token() }}
            </form>
          </div><!-- /.chat -->
          <div class="box-footer">
            <button class="btn btn-success btn-send-form">Enviar</button>
          </div>
        </div><!-- /.box (chat box) -->

    </div>
  </div>

</div><!-- /.content-wrapper -->
      
@stop

@section('postscript')
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $(function () {
      $('[data-toggle="popover"]').popover()
    }) 
  });
 </script>
@stop