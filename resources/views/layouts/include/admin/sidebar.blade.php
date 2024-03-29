<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="index.html">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#category" aria-expanded="false" aria-controls="category">
        <i class="mdi mdi-circle-outline menu-icon"></i>
        <span class="menu-title">Category</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="category">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/category/create') }}">Add Category</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/category') }}">All Category</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#product" aria-expanded="false" aria-controls="product">
        <i class="mdi mdi-circle-outline menu-icon"></i>
        <span class="menu-title">Product</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="product">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/products/create') }}">Add Product</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/products') }}">All Product</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('admin/brands') }}">
        <i class="mdi mdi-circle-outline menu-icon"></i>
        <span class="menu-title">Brands</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('admin/colors') }}">
        <i class="mdi mdi-circle-outline menu-icon"></i>
        <span class="menu-title">Colors</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('admin/sliders') }}">
        <i class="mdi mdi-circle-outline menu-icon"></i>
        <span class="menu-title">Sliders</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('admin/orders') }}">
        <i class="mdi mdi-circle-outline menu-icon"></i>
        <span class="menu-title">Orders</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('admin/settings') }}">
        <i class="mdi mdi-circle-outline menu-icon"></i>
        <span class="menu-title">Admin settings</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <i class="mdi mdi-account menu-icon"></i>
        <span class="menu-title">Users</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ url('admin/users/') }}"> View All Users </a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ url('admin/users/create') }}"> Create User </a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="documentation/documentation.html">
        <i class="mdi mdi-file-document-box-outline menu-icon"></i>
        <span class="menu-title">Documentation</span>
      </a>
    </li>
  </ul>
</nav>