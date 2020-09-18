@extends('admin.layout')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Пользователи</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              {{ Breadcrumbs::render('users') }}
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
          <div class="form-group">
            <a href="{{ route('users.create') }}" class="btn btn-success">Добавить</a>
          </div>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID</th>
              <th>Имя</th>
              <th>E-mail</th>
              <th>Аватар</th>
              <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
              <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                  <img src="{{ $user->getAvatar() }}" alt="" class="img-responsive" width="120">
                </td>
                <td><a href="{{ route('users.edit', $user->id) }}" class="fas fa-pencil-alt fa-2x"
                       title="Изменить запись"></a>
                  {{ Form::open(['route'=>['users.destroy', $user->id], 'method'=>'delete']) }}
                  <button onclick="return confirm('Вы уверены?')" type="submit" class="delete">
                    <i class="fas fa-times fa-2x" title="Удалить запись"></i>
                  </button>
                  {{ Form::close() }}
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@stop