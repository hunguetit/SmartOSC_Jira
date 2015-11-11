s      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
            @if (Auth::check())
              <img src="{{ asset(Auth::user()->avatar) }}" class="img-circle" alt="User Image">
              @endif
            </div>
            <div class="pull-left info">
            @if (Auth::check())
              <p>{{ Auth::user()->name }}</p>
              @endif
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="treeview">
              <a href="#">
                <i class="fa fa-cubes"></i> <span>Task Manager</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              	@if (Auth::check())
                <li><a href="{{asset('user/task/'.Auth::user()->id)}}"><i class="fa fa-tasks"></i> Managed Task</a></li>
                @endif
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>User & Setting</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href=""><i class="fa fa-plus-circle "></i> Profile</a></li>
                <li><a href="{{asset('user/user')}}"><i class="fa fa-cogs "></i> Manager User</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="">
                <i class="fa fa-exclamation-triangle"></i>
                <span>Problems</span>
                <span class="label label-primary pull-right">4</span>
              </a>
            </li>
            <li>
              <a href="">
                <i class="fa fa-bug"></i> <span>Bugs</span> <small class="label pull-right bg-green">new</small>
              </a>
            </li>
            <li class="treeview">
              <a href="">
                <i class="fa fa-comments"></i>
                <span>Messages</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href=""><i class="fa fa-commenting"></i> Composer</a></li>
                <li><a href=""><i class="fa fa-inbox"></i> Inbox</a></li>
                <li><a href=""><i class="fa fa-envelope-o"></i> Sent</a></li>
                <li><a href=""><i class="fa fa-file-text-o"></i> Draft</a></li>
                <li><a href=""><i class="fa fa-filter"></i> Junk</a></li>
                <li><a href=""><i class="fa fa-trash-o"></i> Trash</a></li>
              </ul>
            </li>
            
            <li><a href="http://laravel.com/docs/5.1/"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>