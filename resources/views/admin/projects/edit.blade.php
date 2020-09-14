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
              {{ Breadcrumbs::render('projects.edit', $project) }}
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
    {{Form::open(['route'	=> ['projects.update', $project->id], 'files'	=>	true, 'method' => 'put'])}}
    <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h4 class="box-title">Изменяем проект</h4>
          @include('admin.errors')
        </div>
        <div class="box-body">
          <div class="col-md-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Название</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                     value="{{ $project->title }}" name="title">
            </div>

            <div class="form-group">
              <div>
                <img src="{{ $project->getImage() }}" alt="" class="img-responsive" width="200">
              </div>

              <!-- Load images -->
              <div class="form-group js-photos-container">
                <div class="js-photos">
                  <div>
                    <label for="photos[0]">{{ __('Главная фотография проекта') }}</label>
                  </div>
                  <div class="img-preview">
                    @if ($project->photos->count() > 0)
                      <div class="js-cancel-button far fa-times-circle fa-2x" title="Удалить фото"></div>
                      <img src="{{ $project->photos[0]->getPhoto() }}" alt="{{ \App\Photo::noPhoto() }}">
                    @endif
                  </div>
                  <input id="photos[0]" type="file" class="btn btn-dark js-main-photo" name="photos[0]" placeholder="Выберите файл...">
                </div>
                <div class="mt-2">
                  <div>
                    <label for="js-add-image">{{ __('Фотографии проекта') }}</label>
                  </div>
                  @if ($project->photos->count() > 1)
                    @for ($i = 1; $i < $project->photos->count(); $i++)
                      <div class="js-photos">
                        <div class="img-preview">
                          <div class="js-cancel-button far fa-times-circle fa-2x" title="Удалить фото"></div>
                          <img src="{{ $project->photos[$i]->getPhoto() }}" alt="{{ \App\Photo::noPhoto() }}">
                        </div>
                        <input class="btn btn-dark mb-2 mt-2" type="file" name="photos[]" style="display: none;">
                      </div>
                    @endfor
                  @endif
                  <button id="js-add-image" class="btn btn-dark js-add-image">Добавить ещё фото...</button>
                </div>
              </div>
              <!-- /Load images -->
            <div class="form-group">
              <label>Категория</label>
              {{ Form::select('category_id', $categories, $project->getCategoryID(), ['class' => 'form-control select2']) }}
            </div>
            <div class="form-group">
              <label>Теги</label>
              {{ Form::select('tags[]', $tags, $selectedTags, [
                    'class' => 'form-control select2',
                    'multiple'=>'multiple',
                    'data-placeholder' => 'Выберите теги'
                    ]) }}
            </div>
            <!-- Date -->
            <div class="form-group">
              <label>Дата:</label>

              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="datepicker" value="{{ $project->date }}"
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
                        class="form-control">{{ $project->description }}</textarea>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button class="btn btn-warning pull-right">{{ __('Изменить') }}</button>
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

          //Add preview block
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
          }

          //Remove preview block
          if ($target.classList.contains('js-cancel-button')) {
              if ($target.parentNode.parentNode.getElementsByClassName('js-main-photo')[0]) {
                  const $imgMainPhoto = $target.parentNode.getElementsByTagName('img')[0];
                  const $btnMainPhoto = $target.parentNode.getElementsByClassName('js-cancel-button')[0];
                  $target.parentNode.removeChild($imgMainPhoto);
                  $target.parentNode.removeChild($btnMainPhoto);
                  document.getElementById('photos[0]').value = '';
              } else {
                  $target.parentNode.parentNode.remove();
              }
          }
      });
      function addImagePreview($target)
      {
          const $imgPreview = $target.parentNode.querySelector('.img-preview');
          const image = document.createElement('img');
          //image.style.cssText = 'width: 200px; padding: 5px;';
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
@stop