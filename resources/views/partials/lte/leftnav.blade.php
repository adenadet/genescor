<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
            <a href="#" class="d-block">{{Auth::user()->first_name.' '.Auth::user()->last_name}}</a>
            </div>
        </div>
        <!--<div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
            </div>
        </div>-->
        <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item"><a href="/app/dashboard" class="nav-link"><i class="nav-icon fas fa-tachometer-alt"></i><p> Dashboard</p></a></li>
            <li class="nav-item"><a href="/app/profile" class="nav-link"><i class="nav-icon fas fa-user"></i><p> Profile</p></a></li>
            <li class="nav-item"><a href="/app/wallet" class="nav-link"><i class="nav-icon fas fa-wallet"></i><p> Wallet</p></a></li>
            <li class="nav-item"><a href="/app/appointments" class="nav-link"><i class="nav-icon fa fa-calendar"></i><p> Appointments</p></a></li>
            <li class="nav-item"><a href="/app/prescriptions" class="nav-link"><i class="nav-icon fa fa-pill"></i><p> Prescriptions</p></a></li>   
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="nav-icon fas fa-user-cog"></i><p>Administrator<i class="right fas fa-angle-left"></i></p></a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item"><a href="/app/admin/dashboard" class="nav-link"><i class="nav-icon fas fa-tachometer-alt"></i><p> Dashboard</p></a></li>
                    <li class="nav-item"><a href="/app/admin/appointments" class="nav-link"><i class="nav-icon fas fa-calendar"></i><p> Appointments</p></a></li>
                    <li class="nav-item"><a href="/app/admin/prescriptions" class="nav-link"><i class="nav-icon fas fa-pills"></i><p> Prescriptions</p></a></li>
                    
                    <li class="nav-item"><a href="/app/admin/users" class="nav-link"><i class="nav-icon fas fa-users"></i><p> Users</p></a></li>
                    <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Starter Pages
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Active Page</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Inactive Page</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p> Simple Link <span class="right badge badge-danger">New</span></p>
                </a>
            </li>
            </ul>
        </nav>
    </div>
</aside>