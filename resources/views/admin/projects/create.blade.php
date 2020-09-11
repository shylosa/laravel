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
            <!-- Load images -->
            <div class="form-group js-photos-container">
              <div class="js-photos">
                <div>
                  <label for="photos[0]">{{ __('Главная фотография проекта') }}</label>
                </div>
                <div class="img-preview"></div>
                <input id="photos[0]" type="file" class="btn btn-dark" name="photos[0]" placeholder="Выберите файл...">
              </div>
              <div class="mt-2">
                <div>
                  <label for="js-add-image">{{ __('Фотографии проекта') }}</label>
                </div>
                <button id="js-add-image" class="btn btn-dark js-add-image">Добавить ещё фото...</button>
              </div>
            </div>
            <!-- /Load images -->
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
      const $photos = document.querySelector('.js-photos-container');
      $photos.addEventListener('change', function (event) {
        if (event.target.tagName === 'INPUT') {
            addImagePreview(event.target);
        }
      });

      $photos.addEventListener('click', function (event) {
          const $target = event.target;
          const $jsAddImage = document.getElementById('js-add-image');

          if ($target.id === 'js-add-image') {
              event.preventDefault();
              //container
              const field = document.createElement('div');
              field.classList.add('js-photos');
              $jsAddImage.insertAdjacentElement('beforebegin', field);
              //preview
              const preview = document.createElement('div');
              preview.classList.add('img-preview');
              field.appendChild(preview);
              //new input element
              const input = document.createElement('input');
              input.classList.add('btn', 'btn-dark');
              input.type = 'file';
              input.name = 'photos[]';
              input.style.display = 'none';
              input.classList.add('mb-2', 'mt-2');
              field.appendChild(input);

              input.click();
          } else if ($target.classList.contains('js-cancel-button')) {
              $target.parentNode.parentNode.remove();
          }
      });
      function addImagePreview($target)
      {
          const $imgPreview = $target.parentNode.querySelector('.img-preview');
          const image = document.createElement('img');
          image.style.cssText = 'width: 200px; padding: 5px;';
          image.setAttribute('src', URL.createObjectURL(event.target.files[0]));
          $imgPreview.appendChild(image);
          //cancel button
          const cancelButton = document.createElement('div');
          //cancelButton.innerHTML = '&#10006;';
          cancelButton.classList.add('js-cancel-button', 'far', 'fa-times-circle', 'fa-2x');
          cancelButton.title = 'Удалить фото';
          image.insertAdjacentElement('beforebegin', cancelButton);
      }
  </script>
  <style>
    .js-cancel-button {
        position: absolute;
        color: #007bff;
        left: 15px;
        top: 15px;
    }

    .js-cancel-button:hover {
        color: yellow;
        cursor: pointer;
    }
    .img-preview {
        position: relative;
    }
  </style>
@endsection