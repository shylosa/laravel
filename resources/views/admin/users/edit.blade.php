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
          <h3 class="box-title">{{ __('Изменяем пользователя') }}</h3>
          @include('admin.errors')
        </div>
        <div class="box-body">
          <div class="col-md-6">
            <div class="form-group">
              <label for="name">{{ __('Имя') }}</label>
              <input type="text" class="form-control" id="name" name="name" placeholder=""
                     value="{{ $user->name }}">
            </div>
            <div class="form-group">
              <label for="email">{{ __('Email') }}</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="" value="{{ $user->email }}">
            </div>
            <div class="form-group">
              <label for="password">{{ __('Пароль') }}</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="">
            </div>
            <div class="form-group js-photos-container">
              <div class="js-photos">
                <div>
                  <label for="photos[0]">{{ __('Аватар') }}</label>
                </div>
                <div class="img-preview">
                  @if ($user->avatar)
                    <div class="js-cancel-button far fa-times-circle fa-2x" title="Удалить фото"></div>
                    <img src="{{ $user->getAvatar() }}" alt="{{ \App\Models\Photo::noPhoto() }}">
                    <input class="old-photos" type="hidden" name="old_photos[0]" value="{{ $user->id }}">
                  @endif
                </div>
                <input id="photos[0]" type="file" class="btn btn-dark js-main-photo" name="avatar"
                       placeholder="Выберите файл...">
                <p class="help-block">jpeg, jpg, png, bmp</p>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button class="btn btn-warning pull-right">{{ __('Изменить') }}</button>
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