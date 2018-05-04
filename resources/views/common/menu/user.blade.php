@if(auth()->user()->isRole('admin'))
<li class="treeview <?php if(in_array(url()->current(),array(route('user.list'),route('user.create'))) ): print 'active'; endif; ?>" onclick="window.location='{{route('user.list')}}'">
    <a href="#">
      <i class="fa fa-users"></i> <span>Users</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
        <li class="<?php if(url()->current() === route('user.list') ): print 'active'; endif; ?>"><a href="{{route('user.list')}}"><i class="fa fa-circle-o"></i>All Users</a></li>       
        <li class="<?php if(url()->current() === route('user.create') ): print 'active'; endif; ?>"><a href="{{route('user.create')}}"><i class="fa fa-circle-o"></i>New User</a></li>
    </ul>
</li>
@else
<li class="<?php if(url()->current() === route('user.list') ): print 'active'; endif; ?>">
    <a href="{{route('user.list')}}">
        <i class="fa fa-list"></i>
        <span>Users</span></a>
</li>
@endif