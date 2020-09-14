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
                <input id="photos[0]" type="file" class="btn btn-dark js-main-photo" name="photos[0]"
                       placeholder="Выберите файл...">
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
              <label>{{ __('Категория') }}</label>
              {{Form::select('category_id', $categories, null, ['class' => 'form-control select2']) }}
            </div>

            <div class="form-group">
              <label>{{ __('Теги') }}</label>
              {{Form::select('tags[]', $tags, null,
                  ['class' => 'form-control select2', 'multiple'=>'multiple','data-placeholder'=>'Выберите теги']) }}
            </div>
            <!-- Date -->
            <div class="form-group">
              <label for="date">{{ __('Дата') }}</label>
              <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                <div class="input-group-append" data-target="#datetimepicker4"
                     data-toggle="datetimepicker"></div>
                <input id="date" type="date" class="form-control select2" name="date"
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
      {{ Form::close() }}
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script type="text/javascript">
      const photos = document.querySelector('.js-photos-container');
      photos.addEventListener('change', function (event) {
          let t = event.target;
          if (t.tagName === 'INPUT') {
              if (isMainPhoto(t)) {
                  removeMainPhoto(t);
              }
              addPhoto(t);
          }
      });

      photos.addEventListener('click', function (event) {
          const t = event.target;
          const jsAddImage = document.getElementById('js-add-image');

          //Add preview block
          if (t.id === 'js-add-image') {
              event.preventDefault();
              //container
              const field = document.createElement('div');
              field.classList.add('js-photos');
              jsAddImage.insertAdjacentElement('beforebegin', field);
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
          }

          //Remove preview block
          if (t.classList.contains('js-cancel-button')) {
              if (isMainPhoto(t)) {
                  removePhoto(t.parentNode);
                  document.getElementById('photos[0]').value = '';
              } else {
                  t.parentNode.parentNode.remove();
              }
          }
      });

      function addPhoto(t) {
          if (isMainPhoto(t)) {
              removePhoto(t);
          }
          let imgPreview = t.parentNode.querySelector('.img-preview');
          let image = document.createElement('img');
          //image.style.cssText = 'width: 200px; padding: 5px;';
          image.setAttribute('src', URL.createObjectURL(t.files[0]));
          imgPreview.appendChild(image);
          //cancel button
          let cancelButton = document.createElement('div');
          //cancelButton.innerHTML = '&#10006;';
          cancelButton.classList.add('js-cancel-button', 'far', 'fa-times-circle', 'fa-2x');
          cancelButton.title = 'Удалить фото';
          image.insertAdjacentElement('beforebegin', cancelButton);
      }

      function isMainPhoto(t) {
          return !!(t.classList.contains('js-main-photo') || t.parentNode.parentNode.getElementsByClassName('js-main-photo').length > 0);
      }

      function removePhoto(t) {
          let photo = t.getElementsByTagName('img')[0];
          let button = t.getElementsByClassName('js-cancel-button')[0];
          if (photo) {
              t.removeChild(photo);
              t.removeChild(button);
          }
      }

      function removeMainPhoto(t) {
          let trg = t.parentNode.getElementsByClassName('img-preview')[0];
          removePhoto(trg);
      }

  </script>
  <style>
      .img-preview > img {
          width: 200px;
          padding: 5px;
      }

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