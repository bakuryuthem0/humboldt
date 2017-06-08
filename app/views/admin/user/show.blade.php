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
        <li class="active"><a href="#"><i class="fa fa-users"></i> Ver usuarios</a></li>
      </ol>
    </section>
    <div class="row">
        <div class="col-xs-12 col-md-10 center-block formulario">
            <div class="box box-success">
                <div class="box-header">
                  <i class="fa fa-users"></i>
                  <h3 class="box-title">Ver usuarios</h3>
                </div>
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Email</th>
                          <th>Username</th>
                          <th>Rol</th>
                          <th>Cambiar contraseña</th>
                          <th>Eliminar</th>
                        </tr>
                      </thead>
                      <tbody>
                       @foreach($users as $u)
                       <tr>
                        <td>{{ $u->id }}</td>
                        <td>{{ $u->email }}</td>
                        <td>@if(!empty($u->name)) {{ $u->name.' '.$u->lastname }} @else Sin especificar @endif</td>
                        <td>{{ ucfirst($u->roles->role_desc) }}</td>
                        <td><button class="btn btn-warning btn-xs btn-change-pass" value="{{ $u->id}}" data-toggle="modal" data-target="#changePass">Cambiar</button></td>
                        <td><button class="btn btn-danger btn-xs btn-elim-user" value="{{ $u->id}}" data-toggle="modal" data-target="#elimThing" data-url="{{ URL::to('administracion/eliminar-usuario') }}" data-tosend="user_id">Eliminar</button></td>
                       </tr>
                       @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Id</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Rol</th>
                          <th>Cambiar contraseña</th>
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
<div class="modal fade" id="changePass">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Cambiar contraseña</h4>
      </div>
      <div class="modal-body">
        <div class="alert responseAjax">
          <p></p>
        </div>
        <div class="">
          <label class="">Contraseña</label>
          <br>
          <label class="control-label label-control-success hidden"><i class="fa fa-check"></i> <p class="success-text"></p></label>
          <label class="control-label label-control-danger hidden"><i class="fa fa-times-circle"></i> <p class="danger-text"></p></label>
          <input type="password" name="password" class="form-control validate-input password" placeholder="Contraseña" >
          @if($errors->has('password'))
          @foreach($errors->get('password') as $err)
          <div class="clearfix"></div>
          <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ $err }}
          </div>
          @endforeach
          @endif
        </div>
        <div class="">
          <label class="">Repita la Contraseña</label>
          <br>
          <label class="control-label label-control-success hidden"><i class="fa fa-check"></i> <p class="success-text"></p></label>
          <label class="control-label label-control-danger hidden"><i class="fa fa-times-circle"></i> <p class="danger-text"></p></label>
          <input type="password" name="password_confirmation" class="form-control validate-input password_confirmation" placeholder="Repita la Contraseña" >
          @if($errors->has('password_confirmation'))
          @foreach($errors->get('password_confirmation') as $err)
          <div class="clearfix"></div>
          <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ $err }}
          </div>
          @endforeach
          @endif
        </div>
      </div>
      <div class="modal-footer">
        <img src="{{ asset('images/loader.gif') }}" class="miniLoader">
        <button type="button" class="btn btn-warning send-change-pass" data-url="{{ URL::to('administracion/cambiar-password') }}">Cambiar</button>
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
          "autoWidth": true
        });
      });
    </script>

@stop