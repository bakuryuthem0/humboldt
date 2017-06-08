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
        <li class="active"><a href="#"><i class="fa fa-pencil"></i> Ver publicaciones</a></li>
      </ol>
    </section>
    <div class="row">
      	<div class="col-xs-12 col-md-11 center-block formulario">
          	<div class="box box-success">
                <div class="box-header">
                  <i class="fa fa-pencil"></i>
                  <h3 class="box-title">Ver publicaciones</h3>
                </div>
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Titulo</th>
                          <th>URL</th>
                          <th>Ubicación</th>
                          <th>Fecha de Inicio</th>
                          <th>Fecha de Fin</th>
                          <th>Ver Imagen</th>
                          <th>Modificar</th>
                          <th>Eliminar</th>
                        </tr>
                      </thead>
                      <tbody>
                       @foreach($publicities as $p)
                       <tr>
                       	<td>{{ $p->id }}</td>
                       	<td>@if(!is_null($p->title)) {{ $p->title }} @else Sin especificar @endif</td>
                        <td>@if(!is_null($p->url)) {{ $p->url }} @else Sin especificar @endif</td>
                        <td>{{ $p->location->description }}</td>
                        <td>{{ date('d-m-Y',strtotime($p->start_date)) }}</td>
                        <td>{{ date('d-m-Y',strtotime($p->end_date)) }}</td>
                        <td>
                          <a class="btn btn-info btn-xs show-publicity-image fancybox" href="{{ asset('images/publicity/'.$p->image) }}" data-fancybox="{{ ucfirst($p->title) }}">
                            Ver
                          </a>
                        </td>
                       	<td><a href="{{ URL::to('administracion/publicidad/modificar/'.$p->id) }}" target="_blank" class="btn btn-warning btn-xs">Modificar</a></td>
                       	<td><button class="btn btn-danger btn-xs btn-elim-publication" value="{{ $p->id}}" data-toggle="modal" data-target="#elimThing" data-url="{{ URL::to('administracion/ver-publicidad/eliminar') }}" data-tosend="id">Eliminar</button></td>
                       </tr>
                       @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Id</th>
                          <th>Titulo</th>
                          <th>URL</th>
                          <th>Ubicación</th>
                          <th>Fecha de Inicio</th>
                          <th>Fecha de Fin</th>
                          <th>Ver Imagen</th>
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
    {{ HTML::style('templates/admin/plugins/datatables/dataTables.bootstrap.css') }}
    {{ HTML::script('templates/admin/plugins/datatables/jquery.dataTables.min.js') }}
    {{ HTML::script('templates/admin/plugins/datatables/dataTables.bootstrap.min.js') }}

    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/fancybox-3.0/dist/jquery.fancybox.min.css') }}">
    <script type="text/javascript" src="{{ asset('plugins/fancybox-3.0/dist/jquery.fancybox.min.js') }}"></script>
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