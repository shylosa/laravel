<div class="sidebar">
  <!-- Sidebar user panel (optional) -->
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
      <a href="#" class="d-block">Serhii Shylo</a>
    </div>
  </div>

  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <nav class="mt-2">
      <li class="nav-header">Навигация</li>
      <li class="nav-item">
             <a href="{{route('projects.index')}}" class="nav-link">
                 <i class="nav-icon fas fa-project-diagram"></i>
                 <p>
                     Проекты
                     <span class="badge badge-info right">{{ $count['projects'] }}</span>
                 </p>
             </a>
         </li>
      <li class="nav-item">
             <a href="{{route('categories.index')}}" class="nav-link">
                 <i class="nav-icon fas fas fa-list-ul"></i>
                 <p>
                     Категории
                     <span class="badge badge-info right">{{ $count['categories'] }}</span>
                 </p>
             </a>
         </li>
      <li class="nav-item">
             <a href="{{route('tags.index')}}" class="nav-link">
                 <i class="nav-icon fas fas fa-tags"></i>
                 <p>
                     Теги
                     <span class="badge badge-info right">{{ $count['tags'] }}</span>
                 </p>
             </a>
         </li>
      <li class="nav-item">
             <a href="{{route('users.index')}}" class="nav-link">
                 <i class="nav-icon fas fas fa-users"></i>
                 <p>
                     Пользователи
                     <span class="badge badge-info right">{{ $count['users'] }}</span>
                 </p>
             </a>
         </li>
    </nav>
  </ul>
</div>