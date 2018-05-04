<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        
        <div class="pull-left info">
          <p>{{auth()->user()->display_name()}}</p>
          <span id="currentDateTime"></span>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="<?php if (in_array(url()->current(), array(route('dashboard')))): print 'active'; endif; ?>">
            <a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
        </li>
        @include('common.menu.request')
        @include('common.menu.action')
        @include('common.menu.resources')
        @include('common.menu.user')
        <!-- @include('common.menu.settings') -->
        @include('common.menu.docs')
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>