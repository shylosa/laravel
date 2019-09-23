@extends('admin.layout')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Добавление проекта
        <small>Управление проектами</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    {{Form::open([
        'route' => 'projects.store',
        'files' => true
    ])}}
    <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Добавляем проект</h3>
          @include('admin.errors')
        </div>
        <div class="box-body">
          <div class="col-md-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Название</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" name="title"
                     value="{{old('title')}}">
            </div>

            <div class="form-group">
              <div>
                <label for="exampleInputFile">Лицевая картинка</label>
              </div>
              <input type="file" id="exampleInputFile" name="main_image">
              <p class="help-block">jpeg, jpg, png, bmp</p>
            </div>

            <div class="form-group">
              <label>Категория</label>
              {{Form::select('category_id',
                  $categories,
                  null,
                  ['class' => 'form-control select2'])
              }}
            </div>

            <div class="form-group">
              <label>Теги</label>
              {{Form::select('tags[]',
                  $tags,
                  null,
                  ['class' => 'form-control select2', 'multiple'=>'multiple','data-placeholder'=>'Выберите теги'])
              }}
            </div>
            <!-- Date -->
          <!--<div class="form-group">
              <label>Дата:</label>
              <div class="input-group date"id="datetimepicker4" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4" id="datepicker" name="date" value="{{old('date')}}">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
            </div>-->
            <div class="form-group">
              <label>Дата</label>
              <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                <div class="input-group-append" data-target="#datetimepicker4"
                     data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
                <input type="text" class="form-control datetimepicker-input pull-right"
                       data-target="#datetimepicker4" name="date" value="{{App\Project::getCurrentDate()}}" />
              </div>
            </div>
            <!-- /.input group -->
          </div>

          <!-- checkbox -->
          <div class="form-group">
            <label>
              <input type="checkbox" class="minimal" name="is_popular">
            </label>
            <label>
              Рекомендовать
            </label>
          </div>

          <!-- checkbox -->
          <div class="form-group">
            <label>
              <input type="checkbox" class="minimal" name="status">
            </label>
            <label>
              Черновик
            </label>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="exampleInputEmail1">Описание</label>
            <textarea name="description" id="" cols="30" rows="8"
                      class="form-control">{{old('description')}}</textarea>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button class="btn btn-default">Назад</button>
        <button class="btn btn-success pull-right">Добавить</button>
      </div>
      <!-- /.box-footer-->

  <!-- /.box -->
  {{Form::close()}}
  </section>
  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection