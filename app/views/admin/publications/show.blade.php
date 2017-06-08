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
                          <th>Precio</th>
                          <th>Categoría</th>
                          <th>Operación</th>
                          <th>Ver Detalles</th>
                          <th>Modificar</th>
                          <th>Eliminar</th>
                        </tr>
                      </thead>
                      <tbody>
                       @foreach($publications as $p)
                       <tr>
                       	<td>{{ $p->id }}</td>
                       	<td>{{ $p->title }}</td>
                        <td>{{ $p->price }}</td>
                        <td>{{ $p->category->description }}</td>
                        <td>{{ $p->operation->description }}</td>
                        <td><button class="btn btn-info btn-xs show-pub-info" value="{{ $p->id }}" data-toggle="modal" data-target="#showItemInfo">Ver</button></td>
                       	<td><a href="{{ URL::to('administracion/publicaciones/modificar/'.$p->id) }}" target="_blank" class="btn btn-warning btn-xs">Modificar</a></td>
                       	<td><button class="btn btn-danger btn-xs btn-elim-publication" value="{{ $p->id}}" data-toggle="modal" data-target="#elimThing" data-url="{{ URL::to('administracion/ver-publicaciones/eliminar') }}" data-tosend="id">Eliminar</button></td>
                       </tr>
                       @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Id</th>
                          <th>Titulo</th>
                          <th>Precio</th>
                          <th>Categoría</th>
                          <th>Operación</th>
                          <th>Ver Detalles</th>
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
<div class="modal fade" id="showItemInfo">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Detalles de la publicación</h4>
      </div>
      <div class="modal-body">
        <div class="alert responseAjax">
          <p></p>
        </div>
        <div class="text-center">
          <img src="{{ asset('images/loader.gif') }}" class="miniLoader">
        </div>
        <div class="partial-container">
          
        </div>
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