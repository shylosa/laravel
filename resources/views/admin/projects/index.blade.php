@extends('admin.layout')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Проекты
        <small>Управление проектами</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Список проектов</h3>
            </div>
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
                      
                      <a href="{{route('projects.edit', $project->id)}}" class="fa fa-pencil"></a>

                      {{Form::open(['route'=>['projects.destroy', $project->id], 'method'=>'delete'])}}
                          <button onclick="return confirm('are you sure?')" type="submit" class="delete">
                           <i class="fa fa-remove"></i>
                          </button>
                      {{Form::close()}}
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection