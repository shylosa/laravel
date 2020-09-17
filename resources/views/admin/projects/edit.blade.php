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
              @foreach(\app\AppModel::getLocales() as $locale)
                <label for="{{ $locale }}_title">Название-{{ $locale }}</label>
                <input type="text" class="form-control" id="{{ $locale }}_title" placeholder=""
                       name="{{ $locale }}_title" value="{{ $project->translate($locale)->title }}">
              @endforeach
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
                      <img src="{{ $project->getMainPhoto() }}" alt="{{ \App\Photo::noPhoto() }}">
                      <input class="old-photos" type="hidden" name="old_photos[0]" value="{{ $project->getMainPhotoID() }}">
                    @endif
                  </div>
                  <input id="photos[0]" type="file" class="btn btn-dark js-main-photo" name="photos[0]"
                         placeholder="Выберите файл...">
                </div>
                <div class="mt-2">
                  <div>
                    <label for="js-add-image">{{ __('Фотографии проекта') }}</label>
                  </div>
                  @if ($project->photos->count() > 1)
                    @foreach ($photos as $photo)
                      <div class="js-photos">
                        <div class="img-preview">
                          <div class="js-cancel-button far fa-times-circle fa-2x" title="Удалить фото"></div>
                          <img class="image-{{ $photo->id }}" src="{{ $photo->getPhoto() }}" alt="{{ \App\Photo::noPhoto() }}">
                          <input class="old-photos" type="hidden" name="old_photos[]" value="{{ $photo->id }}">
                        </div>
                        <input class="btn btn-dark mb-2 mt-2" type="file" name="photos[]" style="display: none;">
                      </div>
                    @endforeach
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
                <label for="date">{{ __('Дата') }}</label>
                <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                  <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker"></div>
                  <input id="date" type="date" class="form-control select2" name="date" value="{{ $project->date }}"/>
                </div>
              </div>
              <!-- ./Date -->
              <!-- checkbox -->
              <div class="form-group">
                <label>{{ Form::checkbox('is_popular', '1', $project->is_popular, ['class'=>'minimal']) }}</label>
                <label>Рекомендовать</label>
              </div>
              <div class="form-group">
                <label>{{ Form::checkbox('status', '1', $project->status, ['class'=>'minimal']) }}</label>
                <label>Черновик</label>
              </div>
              <!-- checkbox -->
            </div>
            <div class="col-md-12">
              <div class="form-group">
                @foreach(\app\AppModel::getLocales() as $locale)
                  <label for="{{ $locale }}_description">Описание-{{ $locale }}</label>
                  <textarea class="form-control" id="{{ $locale }}_description" name="{{ $locale }}_description" cols="30" rows="8">
                    {{ $project->translate($locale)->description }}
                  </textarea>
                @endforeach
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button class="btn btn-warning pull-right">{{ __('Изменить') }}</button>
              </div>
              <!-- /.box-footer-->
            </div>
            <!-- /.box -->
          </div>
      {{ Form::close() }}
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script type="text/javascript" src="/js/project-photos.js"></script>
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