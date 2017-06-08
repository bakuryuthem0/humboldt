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
        <li class="active"><a href="#"><i class="fa fa-image"></i> Ver Slide</a></li>
      </ol>
    </section>
    <div class="row">
      	<div class="col-xs-12 col-md-11 center-block formulario">
          	<div class="box box-success">
                <div class="box-header">
                  <i class="fa fa-image"></i>
                  <h3 class="box-title">Ver Slide</h3>
                </div>
                <div class="box-body">
                  @if(Session::has('success'))
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('success') }}
                  </div>
                  @endif
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Titulo</th>
                          <th>URL</th>
                          <th>Mostrar titulo</th>
                          <th>Imagen</th>
                          <th>Modificar</th>
                          <th>Eliminar</th>
                        </tr>
                      </thead>
                      <tbody>
                       @foreach($slides as $s)
                       <tr>
                       	<td>{{ $s->id }}</td>
                       	<td>{{ $s->title }}</td>
                        <td>@if($s->url != "#!"){{ $s->url }}@else Sin especificar @endif</td>
                        <td>@if($s->show_title == 1) Si @else No @endif</td>
                        <td>
                          <a href="{{ asset('images/slides/'.$s->image) }}" class="fancybox" data-fancybox="{{ ucfirst($s->title) }}" data-type="image">
                            <img src="{{ asset('images/slides/'.$s->image) }}" class="thumb-image">
                          </a>
                        </td>
                       	<td><a href="{{ URL::to('administracion/slides/modificar/'.$s->id) }}" target="_blank" class="btn btn-warning btn-xs">Modificar</a></td>
                       	<td><button class="btn btn-danger btn-xs btn-elim-slide" value="{{ $s->id}}" data-toggle="modal" data-target="#elimThing" data-url="{{ URL::to('administracion/ver-slides/eliminar') }}" data-tosend="id">Eliminar</button></td>
                       </tr>
                       @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Id</th>
                          <th>Titulo</th>
                          <th>URL</th>
                          <th>Mostrar titulo</th>
                          <th>Imagen</th>
                          <th>Modificar</th>
                          <th>Eliminar</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div><!-- /.box-body -->
      		</div>
    	</div>

  	</div><!-- /.content-wrapper -->
</div>  
{{ View::make('partials.modalElim') }}
{{ Form::token() }}
@stop

@section('postscript')
  <link rel="stylesheet" type="text/css" href="{{ asset('plugins/fancybox-3.0/dist/jquery.fancybox.min.css') }}">
  <script type="text/javascript" src="{{ asset('plugins/fancybox-3.0/dist/jquery.fancybox.min.js') }}"></script>
    {{ HTML::style('templates/admin/plugins/datatables/dataTables.bootstrap.css') }}
    {{ HTML::script('templates/admin/plugins/datatables/jquery.dataTables.min.js') }}
    {{ HTML::script('templates/admin/plugins/datatables/dataTables.bootstrap.min.js') }}

    <script>
      $(function () {
        $('[data-fancybox]').fancybox({
          image : {
            protect: true
          }
        });
        $('#example1').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>

@stop