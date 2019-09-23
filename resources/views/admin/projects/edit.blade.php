@extends('admin.layout')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Изменение проекта
        <small>Управление проектами</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    {{Form::open([
      'route'	=>	['projects.update', $project->id],
      'files'	=>	true,
      'method'	=>	'put'
    ])}}
    <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Изменяем проект</h3>
          @include('admin.errors')
        </div>
        <div class="box-body">
          <div class="col-md-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Название</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$project->title}}"
                     name="title">
            </div>

            <div class="form-group">
              <div>
                <label for="exampleInputFile">Лицевая картинка</label>
              </div>
              <div>
                <img src="{{$project->getImage()}}" alt="" class="img-responsive" width="200">
              </div>

              <input type="file" id="exampleInputFile" name="image">

              <p class="help-block">jpeg, jpg, png, bmp</p>
            </div>
            <div class="form-group">
              <label>Категория</label>
              {{Form::select('category_id', 
              	$categories, 
                $project->getCategoryID(), 
              	['class' => 'form-control select2'])
              }}
            </div>
            <div class="form-group">
              <label>Теги</label>
              {{Form::select('tags[]', 
              	$tags, 
              	$selectedTags, 
              	['class' => 'form-control select2', 'multiple'=>'multiple','data-placeholder'=>'Выберите теги'])
              }}
            </div>
            <!-- Date -->
            <div class="form-group">
              <label>Дата:</label>

              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="datepicker" value="{{$project->date}}"
                       name="date">
              </div>
              <!-- /.input group -->
            </div>

            <!-- checkbox -->
            <div class="form-group">
              <label>
                {{Form::checkbox('is_popular', '1', $project->is_popular, ['class'=>'minimal'])}}
              </label>
              <label>
                Рекомендовать
              </label>
            </div>
            <!-- checkbox -->
            <div class="form-group">
              <label>
                {{Form::checkbox('status', '1', $project->status, ['class'=>'minimal'])}}
              </label>
              <label>
                Черновик
              </label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="exampleInputEmail1">Описание</label>
              <textarea name="description" id="" cols="30" rows="10"
                        class="form-control">{{$project->description}}</textarea>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button class="btn btn-warning pull-right">Изменить</button>
          </div>
          <!-- /.box-footer-->
        </div>
        <!-- /.box -->
      </div>
      {{Form::close()}}
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection