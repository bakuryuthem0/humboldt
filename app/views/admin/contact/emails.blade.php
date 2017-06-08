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
        <li class=""><a href="{{ URL::to('administrador/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="{{ Request::url() }}"><i class="fa fa-list"></i> Ver categorías</a></li>

      </ol>
    </section>
    <div class="row">
      	<div class="col-xs-12 col-md-10 col-md-offset-1 formulario">
          	<div class="box box-success">
                <div class="box-header">
                  <i class="fa fa-list"></i>
                  <h3 class="box-title">Ver categorías</h3>
                </div>
                <div class="box-body">
                  <div class="alert alert-danger hidden cat-full">
                    
                  </div>
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped menu-cat-table">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Nombre</th>
                          <th>Email</th>
                          <th>Codigo de la Propiedad</th>
                          <th>Link</th>
                          <th>Mensaje</th>
                        </tr>
                      </thead>
                      <tbody>
                       @foreach($contact as $c)
                       <tr>
                       	<td>{{ $c->id }}</td>
                       	<td>{{ $c->name }}</td>
                        <td>{{ $c->email }}</td>
                        <td>{{ $c->publication->publication_cod }}</td>
                        <td><a href="{{ URL::to('ver-propiedad/'.$c->publication_id) }}" target="_blank" class="btn btn-primary btn-xs">Ir</a></td>
                        <td>
                          @if(!is_null($c->msg))
                          <a class="btn btn-info btn-xs btn-show-msg" value="{{ $c->msg }}" href="#showMsg" data-toggle="modal"> 
                            Ver
                          </a>
                          @else
                          Sin Mensaje
                          @endif
                        </td>
                       </tr>
                       @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Id</th>
                          <th>Nombre</th>
                          <th>Email</th>
                          <th>Codigo de la Propiedad</th>
                          <th>Link</th>
                          <th>Mensaje</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div><!-- /.box-body -->
      		</div>
    	</div>

  	</div><!-- /.content-wrapper -->
</div>  
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
          "ordering": false,
          "info": true,
          "autoWidth": true
        });
      });
    </script>

@stop