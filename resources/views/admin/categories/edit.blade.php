@extends('admin.layout')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Категории</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              {{ Breadcrumbs::render('categories.edit', $category) }}
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h4 class="box-title">Изменяем категорию</h4>
          @include('admin.errors')
        </div>
        <div class="box-body">
          {{ Form::open(['route' => ['categories.update', $category->id], 'method' => 'put']) }}
          <div class="col-md-6">
            <div class="form-group">
              @foreach(\App\Models\AppModel::getLocales() as $locale => $language)
                <label for="{{ $locale }}_title">Название-{{ $locale }}</label>
                <input type="text" class="form-control" id="{{ $locale }}_title" name="{{ $locale }}_title"
                       placeholder="" value="{{ $category->translate($locale)->title }}">
              @endforeach
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button class="btn btn-default">Назад</button>
          <button class="btn btn-warning pull-right">Изменить</button>
        </div>
        <!-- /.box-footer-->
        {{Form::close()}}
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection