@extends('admin.layout')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Теги</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              {{ Breadcrumbs::render('tags') }}
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="box">
          <!-- /.box-header -->
          <div class="box-body">
            <div class="form-group">
              <a href="{{route('tags.create')}}" class="btn btn-success">Добавить</a>
            </div>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Действия</th>
              </tr>
              </thead>
              <tbody>
              @foreach($tags as $tag)
                <tr>
                  <td>{{$tag->id}}</td>
                  <td>
                    @foreach(app(\Astrotomic\Translatable\Locales::class)->all() as $locale)
                      @if ($tag->hasTranslation($locale))
                        <li class="category">{{ $tag->translate($locale)->title }}</li>
                      @endif
                    @endforeach
                  </td>
                  <td><a href="{{route('tags.edit', $tag->id)}}" class="fas fa-pencil-alt fa-2x"
                         title="Изменить запись"></a>
                    {{Form::open(['route'=>['tags.destroy', $tag->id], 'method'=>'delete'])}}
                    <button onclick="return confirm('are you sure?')" type="submit" class="delete">
                      <i class="fas fa-times fa-2x" title="Удалить запись"></i>
                    </button>
                    {{Form::close()}}
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
            {{ $tags->links() }}
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  </div>
@endsection