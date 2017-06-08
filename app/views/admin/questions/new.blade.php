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
            <li class="active"><a href="#"><i class="fa fa-question-circle"></i> Nueva Pregunta Frecuente</a></li>
          </ol>
        </section>
        <div class="row">
          <div class="col-xs-12 col-md-10 col-md-offset-1 formulario">
              <div class="box box-success">
                <div class="box-header">
                  <i class="fa fa-question-circle"></i>
                  <h3 class="box-title">Nueva Pregunta Frecuente</h3>
                </div>
                <div class="box-body chat" id="chat-box">
                  @if(Session::has('success'))
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('success') }}
                  </div>
                  @endif
                  <form class="new-user-form row" method="POST" action="{{ URL::to('administracion/pregunta-frecuente/nueva/enviar') }}" enctype="multipart/form-data"> 
                     <div class="formulario col-xs-12">
                         <label class="item-label">Título. (*)</label>
                         <input type="text" class="form-control" name="title" placeholder="Título" value="{{ Input::old('title') }}" required>
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
                     <div class="col-xs-12 formulario">
                        <label>Descripción. (*)</label>
                        <textarea class="form-control validate-input" id="editor1" name="description" rows="10" cols="80">
                           {{Input::old('description') }}
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
        
@stop

@section('postscript')

{{ View::make('partials.editor') }}
@stop