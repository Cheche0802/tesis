<ul class="sidebar-menu">
  <li class="header">Navegación</li>
  <!-- Optionally, you can add icons to the links -->
  <li class="{{ request()->routeIs('dashboard') ? 'hover' : '' }}">
    <a href="{{ route('dashboard') }}">
      <i class="fa fa-dashboard"></i> <span>Inicio</span>
    </a>
  </li>

  <li class="treeview {{ request()->routeIs('admin.posts.index') ? 'hover' : '' }}">
    <a href="#"><i class="fa fa-bars"></i> <span>Publicaciones</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li class="{{ request()->routeIs('admin.posts.index') }}">
        <a href="{{ route('posts.index') }}"><i class="fa fa-eye"></i> Ver todos los posts</a>
      </li>
      @can('create', new App\Models\Post)
        <li>
          @if (request()->routeIs('admin.posts.*'))
            <a href="{{ route('posts.index', '#create') }}"><i class="fa fa-pencil"></i> Crear un post</a>
          @else
            <a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i> Crear un post</a>
          @endif
        </li>
      @endcan
    </ul>
  </li>

  @can('view', new App\Models\User)
    <li class="treeview {{ request()->routeIs(['admin.users.index', 'admin.users.create']) ? 'hover' : '' }}">
      <a href="#"><i class="fa fa-users"></i> <span>Usuarios</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="{{ request()->routeIs('admin.users.index') ? 'hover' : '' }}">
          <a href="{{ route('admin.users.index') }}"><i class="fa fa-eye"></i> Ver todos los usuarios</a>
        </li>
        <li class="{{ request()->routeIs('admin.users.create') ? 'hover' : '' }}">
          <a href="{{ route('admin.users.create') }}"><i class="fa fa-pencil"></i> Crear un usuario</a>
        </li>
      </ul>
    </li>
  @else
  <li class="{{ request()->routeIs(['admin.users.show', 'admin.users.edit']) ? 'hover' : '' }}">
    <a href="{{ route('admin.users.show', auth()->user()) }}">
      <i class="fa fa-user"></i> <span>Perfil</span>
    </a>
  </li>
  @endcan

  @can('view', new \Spatie\Permission\Models\Role)
  <li class="{{ request()->routeIs(['admin.roles.index', 'admin.roles.edit']) ? 'hover' : '' }}">
    <a href="{{ route('admin.roles.index') }}">
      <i class="fa fa-pencil"></i> <span>Roles</span>
    </a>
  </li>
  @endcan

  @can('view', new \Spatie\Permission\Models\Permission)
  <li class="{{ request()->routeIs(['admin.permissions.index', 'admin.permissions.edit']) ? 'hover' : '' }}">
    <a href="{{ route('admin.permissions.index') }}">
      <i class="fa fa-pencil"></i> <span>Permissions</span>
    </a>
  </li>
  @endcan
</ul>
