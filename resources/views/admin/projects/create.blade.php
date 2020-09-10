@extends('admin.layout')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Проекты</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              {{ Breadcrumbs::render('projects.create') }}
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
    {{Form::open([
        'route' => 'projects.store',
        'files' => true
    ])}}
    <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h4 class="box-title">Добавляем проект</h4>
          @include('admin.errors')
        </div>
        <div class="box-body">
          <div class="col-md-6">
            <div class="form-group">
              @foreach(app(\Astrotomic\Translatable\Locales::class)->all() as $locale)
                <label for="{{ $locale }}_title">Название-{{ $locale }}</label>
                <input type="text" class="form-control" id="{{ $locale }}_title" placeholder=""
                       name="{{ $locale }}_title">
              @endforeach
            </div>

            <div class="form-group">
              <div>
                <label for="photos">{{ __('Фотографии проекта') }}</label>
              </div>
              <div id="imgPreview"></div>
              <input id="photos" required type="file" class="btn btn-dark" name="image[]" placeholder="Выберите файлы..." multiple>
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
              <label>{{ __('Дата') }}</label>
              <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                <div class="input-group-append" data-target="#datetimepicker4"
                     data-toggle="datetimepicker"></div>
                <input type="date" class="form-control select2" name="date"
                       value="{{ App\Project::getCurrentDate() }}"/>
              </div>
            </div>
            <!-- /.input group -->
          </div>

          <!-- checkbox -->
          <div class="form-group">
            <label>
              <input type="checkbox" class="minimal" name="is_popular" value="1">
            </label>
            <label>{{ __('Рекомендовать') }}</label>
          </div>

          <!-- checkbox -->
          <div class="form-group">
            <label>
              <input type="checkbox" class="minimal" name="status" value="1">
            </label>
            <label>{{ __('Черновик') }}</label>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            @foreach(app(\Astrotomic\Translatable\Locales::class)->all() as $locale)
              <label for="{{ $locale }}_description">Описание-{{ $locale }}</label>
              <textarea class="form-control" id="{{ $locale }}_description"
                        name="{{ $locale }}_description" cols="30" rows="8"></textarea>
            @endforeach
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
  <script type="text/javascript">
      const $photos = document.querySelector('#photos');
      $photos.addEventListener('change', function (event) {
        const $imgPreview = document.querySelector('#imgPreview');
        const $total_file = document.getElementById("photos").files.length;
        const image = [];
        for (var i = 0; i < $total_file; i++) {
            image[i] = document.createElement('img');
            image[i].style.cssText = 'width: 200px; padding: 5px;';
            image[i].setAttribute('src', URL.createObjectURL(event.target.files[i]));
            $imgPreview.appendChild(image[i]);
        }
      });
  </script>
@endsection