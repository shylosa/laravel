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
              {{ Breadcrumbs::render('users.edit', $user) }}
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
    {{ Form::open([
      'route'	=>	['users.update', $user->id],
      'method'	=>	'put',
      'files'	=>	true
    ]) }}
    <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Изменяем пользователя</h3>
          @include('admin.errors')
        </div>
        <div class="box-body">
          <div class="col-md-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Имя</label>
              <input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder=""
                     value="{{ $user->name }}">
            </div>
            <div class="form-group">
              <label for="email">E-mail</label>
              <input type="text" class="form-control" id="email" name="email" placeholder=""
                     value="{{ $user->email }}">
            </div>
            <div class="form-group">
              <label for="password">Пароль</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="">
            </div>
            <div class="form-group">
              <img src="{{ $user->getAvatar() }}" alt="/img/no-image.png" width="200" class="img-responsive">
              <button onclick="return confirm('Вы уверены?')" type="submit" name="update" value="delete-avatar"
                      class="delete align-top" title="Удалить аватар">
                <i class="fa fa-remove fa-3x"></i>
              </button>
            </div>
            <div class="form-group">
              <div>
                <label for="avatar">Аватар</label>
              </div>
              <input id="avatar" type="file" name="avatar">
              <p class="help-block">jpeg, jpg, png, bmp</p>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button class="btn btn-warning pull-right" name="update" value="update-user">Изменить</button>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
      {{ Form::close() }}
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@stop