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
            <li class="active"><a href="#"><i class="fa fa-pencil"></i> Modificar Publicación</a></li>
          </ol>
        </section>
        <div class="row">
          <div class="col-xs-12 col-md-10 col-md-offset-1 formulario">
              <div class="box box-success">
                <div class="box-header">
                  <i class="fa fa-pencil"></i>
                  <h3 class="box-title">Modificar Publicación</h3>
                </div>
                <div class="box-body chat" id="chat-box">
                  @if(Session::has('success'))
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('success') }}
                  </div>
                  @endif
                  <form class="new-user-form row" method="POST" action="{{ URL::to('administracion/publicaciones/modificar/'.$publication->id.'/enviar') }}" enctype="multipart/form-data"> 
                     <div class="col-xs-12">
                        <h3>Datos básicos.</h3>
                     </div>
                     <div class="formulario col-xs-12 col-md-6">
                         <label class="item-label">Código de la propiedad. (*)</label>
                         <input type="text" class="form-control" name="publication_cod" placeholder="Código de la propiedad" value="{{ $publication->publication_cod }}" required>
                         @if($errors->has('publication_cod'))
                            @foreach($errors->get('publication_cod') as $err)
                            <div class="clearfix"></div>
                            <div class="alert alert-danger">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              {{ $err }}
                            </div>
                            @endforeach
                          @endif
                     </div>
                     <div class="formulario col-xs-12 col-md-6">
                        <label class="item-label">Ciudad. (*)</label>
                        <select class="form-control" name="city">
                          <option value="">Seleccione una opción</option>
                          @foreach($cities as $c)
                             <option value="{{ $c->id }}" @if(!is_null($publication->city) && $publication->city_id == $c->id) selected @endif>{{ $c->title }}</option>
                          @endforeach
                        </select>
                       @if($errors->has('city'))
                          @foreach($errors->get('city') as $err)
                          <div class="clearfix"></div>
                          <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ $err }}
                          </div>
                       @endforeach
                     @endif
                     </div>
                     <div class="formulario col-xs-12 col-md-6">
                         <label class="item-label">Título. (*)</label>
                         <input type="text" class="form-control" name="title" placeholder="Título" value="{{ $publication->title }}" required>
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
                     <div class="formulario col-xs-12 col-md-6">
                        <label class="item-label">Precio (*)</label>
                        <input type="text" class="form-control" name="price" placeholder="Precio" value="{{ $publication->price }}" required>
                        @if($errors->has('price'))
                          @foreach($errors->get('price') as $err)
                          <div class="clearfix"></div>
                          <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ $err }}
                          </div>
                          @endforeach
                        @endif
                     </div>
                     <div class="formulario col-xs-12 col-md-6">
                        <label class="item-label">Categoría. (*)</label>
                        <select class="form-control" name="category">
                          <option value="">Seleccione una opción</option>
                          @foreach($cat as $c)
                             <option value="{{ $c->id }}" @if($publication->category_id == $c->id) selected @endif>{{ $c->description }}</option>
                          @endforeach
                        </select>
                       @if($errors->has('category'))
                          @foreach($errors->get('category') as $err)
                          <div class="clearfix"></div>
                          <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ $err }}
                          </div>
                       @endforeach
                     @endif
                     </div>
                     <div class="formulario col-xs-12 col-md-6">
                       <label class="item-label">Operación. (*)</label>
                       <select class="form-control" name="operation">
                          <option value="">Seleccione una opción</option>
                          @foreach($operations as $o)
                             <option value="{{ $o->id }}" @if($publication->operation_id == $o->id) selected @endif>{{ $o->description }}</option>
                          @endforeach
                       </select>
                       @if($errors->has('operation'))
                          @foreach($errors->get('operation') as $err)
                            <div class="clearfix"></div>
                            <div class="alert alert-danger">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              {{ $err }}
                            </div>
                         @endforeach
                       @endif
                     </div>
                     <div class="col-xs-12">
                        <h3>Detalles de la publicación.</h3>
                     </div>
                     <div class="formulario col-xs-12 col-md-6">
                      <label>Cantidad de Habitaciones. (*)</label>
                      <input type="text" class="form-control" name="rooms" placeholder="Cantidad de Habitaciones" value="@if(!is_null($publication->misc)){{ $publication->misc->rooms }} @endif">
                     </div>
                     <div class="formulario col-xs-12 col-md-6">
                      <label>Cantidad de baños. (*)</label>
                      <input type="text" class="form-control" name="bathrooms" placeholder="Cantidad de baños" value="@if(!is_null($publication->misc)){{ $publication->misc->bathrooms }} @endif">
                     </div>
                     <div class="formulario col-xs-12 col-md-6">
                      <label>Cantidad de estacionamientos. (*)</label>
                      <input type="text" class="form-control" name="parking_slots" placeholder="Cantidad de estacionamientos" value="@if(!is_null($publication->misc)){{ $publication->misc->parking_slots }} @endif">
                     </div>
                     <div class="formulario col-xs-12 col-md-6">
                      <label>Area de la infraestructura (m<sup>2</sup>). (*)</label>
                      <input type="text" class="form-control" name="size" placeholder="Area de la infraestructura" value="@if(!is_null($publication->misc)){{ $publication->misc->size }} @endif">
                     </div>
                     <div class="formulario col-xs-12">
                      <label>Google Map. (*) <i class="fa fa-info-circle text-info" data-container="body" data-toggle="popover" data-placement="right" data-html="true" data-trigger="hover" data-content="En este campo puede agregar la ubicación de su tienda mediante google maps. <br><br>Solo vaya a google maps <i class='fa fa-arrow-right'></i> busque su ubicación <i class='fa fa-arrow-right'></i> seleccione compartir <i class='fa fa-arrow-right'></i> insertar mapa y por ultimo copie el texto del iframe"></i></label>
                      <div class="input-group">
                        <input type="text" class="form-control map-input" name="map" placeholder="Mapa" value='@if(!is_null($publication->misc)){{  $publication->misc->map }} @endif'> 
                        <span class="input-group-btn">
                           <button class="btn btn-default preview" type="button">
                              <i class="fa fa-search" data-toggle="tooltip" data-placement="top" data-title="Vista previa"></i>
                           </button>
                        </span>
                      </div>
                     </div>

                      <div class="map"></div>                    
                     <div class="col-xs-12">
                        <h3>Descripción / Imagenes.</h3>
                     </div>
                     <div class="col-xs-12 formulario">
                        <label>Descripción. (*)</label>
                        <textarea class="form-control validate-input" id="editor1" name="description" rows="10" cols="80">
                           {{ $publication->description }}
                        </textarea>
                        @if($errors->has('description'))
                           @foreach($errors->get('description') as $err)
                           <div class="clearfix"></div>
                           <div class="alert alert-danger">
                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                             {{ $err }}
                           </div>
                           @endforeach
                        @endif
                     </div>
                     @foreach($publication->images as $i)
                        <div class="col-xs-12 to-clone active formulario">
                          <div>
                            <button type="button" class="close btn-elim-image" value="{{ $i->id }}" data-toggle="modal" data-target="#elimThing" data-url="{{ URL::to('administracion/publicaciones/modificar/eliminar-imagen') }}" data-tosend="id">&times;</button>
                          </div>
                          <br>
                          <div class="input-group">
                            <input type="file" name="img[{{ $i->id }}]" class="file_es publication-image">
                             <output class="outpost">
                              <a href="{{ asset('images/publications/'.$publication->id.'/'.$i->image) }}" class="fancybox" data-fancybox="{{ ucfirst($publication->title) }}" data-caption="{{ strip_tags($publication->description) }}" data-type="image">
                                <img src="{{ asset('images/publications/'.$publication->id.'/'.$i->image) }}" class="img-responsive center-block publication-image">
                              </a>
                            </output>
                          </div>
                       </div>
                      @endforeach
                     <div class="col-xs-12 formulario">
                        <div class="">
                           <input type="file" name="img[]" class="publication-image">
                             <output class="outpost">
                             </output>
                           @if($errors->has('img'))
                              @foreach($errors->get('img') as $err)
                              <div class="clearfix"></div>
                              <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ $err }}
                              </div>
                              @endforeach
                           @endif
                        </div>
                     </div>
                     <div class="col-xs-12 new-image to-clone formulario">
                        <button type="button" class="close dimiss-cloned">&times;</button>
                        <br>
                        <div>
                          <input type="file" name="" class="file publication-image">
                             <output class="outpost">
                             </output>
                        </div>
                     </div>
                     <div class="col-xs-12 formulario">
                        <button type="button" class="btn btn-primary btn-clone" data-target="new-image" data-input="file" data-name="img[]">
                          Agregar Imagen
                        </button>                     
                     </div>
                     {{ Form::token() }}
                  </form>
                </div><!-- /.chat -->
                <div class="box-footer">
                  <div class="col-xs-12">
                     <button class="btn btn-success btn-send-form">Enviar</button>
                  </div>
                </div>
              </div><!-- /.box (chat box) -->

          </div>
        </div>

      </div><!-- /.content-wrapper -->
{{ View::make('partials.modalElim') }}
{{ Form::token() }}
@stop
@section('postscript')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/fancybox-3.0/dist/jquery.fancybox.min.css') }}">
<script type="text/javascript" src="{{ asset('plugins/fancybox-3.0/dist/jquery.fancybox.min.js') }}"></script>

{{ View::make('partials.editor') }}
 <script type="text/javascript">
  jQuery(document).ready(function($) {
    $(function () {
      $('[data-toggle="popover"]').popover();
      $('[data-fancybox]').fancybox({
        image : {
          protect: true
        }
      });
    }) 
  });
 </script>
@stop