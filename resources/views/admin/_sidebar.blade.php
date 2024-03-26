<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ Auth::user()->getAvatar() }}" class="img-circle elevation-2" alt="/uploads/no-image.png">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>

    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header"></li>
        @foreach($sidebar as $sidebarItem)
            <li class="nav-item">
                <a href="{{ route($sidebarItem['url']) }}" class="nav-link">
                    <i class="nav-icon {{ $sidebarItem['icon'] }}"></i>
                    <p>{{ __($sidebarItem['text']) }}<span class="badge badge-info right">{{ $sidebarItem['count'] }}</span></p>
                </a>
            </li>
        @endforeach
    </ul>
</div>