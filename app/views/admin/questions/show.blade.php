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
                          <th>Ver Descripción</th>
                          <th>Modificar</th>
                          <th>Eliminar</th>
                        </tr>
                      </thead>
                      <tbody>
                       @foreach($questions as $q)
                       <tr>
                       	<td>{{ $q->id }}</td>
                       	<td>{{ $q->title }}</td>
                        <td>
                          <button class="btn btn-info btn-xs show-question-info" value="{{ $q->description }}" data-toggle="modal" data-target="#showDescription">Ver</button>
                        </td>
                       	<td>
                          <a href="{{ URL::to('administracion/preguntas-frecuentes/modificar/'.$q->id) }}" target="_blank" class="btn btn-warning btn-xs">Modificar</a>
                        </td>
                       	<td>
                          <button class="btn btn-danger btn-xs btn-elim-publication" value="{{ $q->id}}" data-toggle="modal" data-target="#elimThing" data-url="{{ URL::to('administracion/preguntas-frecuentes/eliminar') }}" data-tosend="id">Eliminar</button>
                        </td>
                       </tr>
                       @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Id</th>
                          <th>Titulo</th>
                          <th>Ver Descripción</th>
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
<div class="modal fade" id="showDescription">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Descripción</h4>
      </div>
      <div class="modal-body description text-justify">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
{{ View::make('partials.modalElim') }}
{{ Form::token() }}
@stop

@section('postscript')
    {{ HTML::style('templates/admin/plugins/datatables/dataTables.bootstrap.css') }}
    {{ HTML::script('templates/admin/plugins/datatables/jquery.dataTables.min.js') }}
    {{ HTML::script('templates/admin/plugins/datatables/dataTables.bootstrap.min.js') }}

    <script>
      $(function () {
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