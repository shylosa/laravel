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
              {{ Breadcrumbs::render('projects') }}
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
        <!-- /.box-header -->
        <div class="box-body">
          <div class="form-group">
            <a href="{{route('projects.create')}}" class="btn btn-success">Добавить</a>
          </div>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID</th>
              <th>Название</th>
              <th>Категория</th>
              <th>Теги</th>
              <th>Изображения</th>
              <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($projects as $project)
              <tr>

                <td>{{$project->id}}</td>
                <td>{{$project->title}}</td>
                <td>{{$project->getCategoryTitle()}}</td>
                <td>{{$project->getTagsTitles()}}</td>
                <td>
                  <img src="{{$project->getImage()}}" alt="" width="100">
                </td>
                <td>

                  <a href="{{route('projects.edit', $project->id)}}" class="fas fa-pencil-alt fa-2x"
                     title="Изменить запись"></a>

                  {{Form::open(['route'=>['projects.destroy', $project->id], 'method'=>'delete'])}}
                  <button onclick="return confirm('are you sure?')" type="submit" class="delete">
                    <i class="fas fa-times fa-2x" title="Удалить запись"></i>
                  </button>
                  {{Form::close()}}
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
          {{ $projects->links() }}
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@stop