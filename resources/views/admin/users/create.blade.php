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
              {{ Breadcrumbs::render('users.create') }}
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
    {{ Form::open(['route'	=>	'users.store', 'files'	=>	true]) }}
    <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h4 class="box-title">Добавляем пользователя</h4>
          @include('admin.errors')
        </div>
        <div class="box-body">
          <div class="col-md-6">
            <div class="form-group">
              <label for="name">Имя</label>
              <input type="text" name="name" class="form-control" id="name" placeholder=""
                     value="{{ old('name') }}">
            </div>
            <div class="form-group">
              <label for="email">E-mail</label>
              <input type="text" name="email" class="form-control" id="email" placeholder=""
                     value="{{ old('email') }}">
            </div>
            <div class="form-group">
              <label for="password">Пароль</label>
              <input type="password" name="password" class="form-control" id="password" placeholder="">
            </div>
            <div class="form-group  js-photos-container">
              <div class="js-photos">
                <div>
                  <label for="photos[0]">{{ __('Аватар') }}</label>
                </div>
                <div class="img-preview"></div>
                <input id="photos[0]" type="file" class="btn btn-dark js-main-photo" name="avatar"
                       placeholder="Выберите файл...">
                <p class="help-block">jpeg, jpg, png, bmp</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button class="btn btn-success pull-right">Добавить</button>
      </div>
      <!-- /.box-footer-->

      <!-- /.box -->
      {{Form::close()}}
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script type="text/javascript" src="/js/project-photos.js"></script>
@stop