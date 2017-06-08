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
      <li class="active"><a href="#"><i class="fa fa-image"></i> Administrar Publicidad</a></li>
    </ol>
  </section>
  <div class="row">
    <div class="col-xs-12 col-md-8 col-md-offset-2 formulario">
        <div class="box box-success">
          <div class="box-header">
            <i class="fa fa-image"></i>
            <h3 class="box-title">Administrar Publicidad</h3>
          </div>
          <div class="box-body chat" id="chat-box">
            @if(Session::has('success'))
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              {{ Session::get('success') }}
            </div>
            @endif
            <form class="new-user-form" method="POST" action="{{ URL::to('administracion/publicidad/nueva/enviar') }}" enctype="multipart/form-data"> 
              <div class="col-xs-12 formulario">
               <label class="">Titulo (opcional) <i class="fa fa-info-circle text-info" data-container="body" data-toggle="popover" data-placement="right" data-html="true" data-trigger="hover" data-content='Para mejorar el posicionamineto de la pagina web, ingrese un titulo el cual los motores de busqueda como google reconoceran como "Publicidad para xxxx empresa"'></i></label>
               <input type="text" name="title" class="form-control title" placeholder="Titulo" value="{{ Input::old('title') }}">
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
              <div class="col-xs-12 col-md-6 formulario">
               <label class="">URL (opcional)</label>
               <input type="url" name="url" class="form-control" placeholder="http://midominio.com" value="{{ Input::old('url') }}">
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
              <div class="col-xs-12 col-md-6 formulario">
               <label class="">Ubicación</label>
               <select class="form-control" name="ubication">
                <option value="1" @if(Input::old('ubication') && Input::old('ubication') == 1) selected @endif>Página Principal</option>
                <option value="2" @if(Input::old('ubication') && Input::old('ubication') == 2) selected @endif>Página de Busqueda</option>
                <option value="3" @if(Input::old('ubication') && Input::old('ubication') == 3) selected @endif>Página de Publicación</option>
               </select>
               @if($errors->has('ubication'))
                  @foreach($errors->get('ubication') as $err)
                  <div class="clearfix"></div>
                  <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ $err }}
                  </div>
                  @endforeach
                @endif
              </div>
              <div class="col-xs-12">
                <h3>Duración de la publicidad.</h3>
              </div>
              <div class="col-xs-12 col-md-6 formulario">
               <label class="">Fecha de Inicio (opcional) <i class="fa fa-info-circle text-info" data-container="body" data-toggle="popover" data-placement="right" data-html="true" data-trigger="hover" data-content='En caso de no llenar este campo, se tomara el dia {{ date('d-m-Y',time()+86400) }} como fecha de inicio'></i></label>
               <input type="text" name="start_date" class="form-control datepicker date-start" placeholder="DD-MM-YYYY" value="{{ Input::old('start_date') }}">
               @if($errors->has('start_date'))
                  @foreach($errors->get('start_date') as $err)
                  <div class="clearfix"></div>
                  <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ $err }}
                  </div>
                  @endforeach
                @endif
              </div>
              <div class="col-xs-12 col-md-6 formulario">
               <label class="">Fecha de Fin (opcional) <i class="fa fa-info-circle text-info" data-container="body" data-toggle="popover" data-placement="right" data-html="true" data-trigger="hover" data-content='En caso de no llenar este campo, se tomara 30 dias despues de la fecha de inicio como fecha de fin'></i></label>
               <input type="text" name="end_date" class="form-control datepicker date-end" placeholder="DD-MM-YYYY" value="{{ Input::old('end_date') }}">
               @if($errors->has('end_date'))
                  @foreach($errors->get('end_date') as $err)
                  <div class="clearfix"></div>
                  <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ $err }}
                  </div>
                  @endforeach
                @endif
              </div>
              <div class="col-xs-12 formulario">
               <label class="">Imagen (*)</label>
               <input type="file" name="image" class="slide">
               <output class="outpost"></output>
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
      $('[data-toggle="popover"]').popover();
      $('.datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
      });
    }) 
  });
 </script>
@stop