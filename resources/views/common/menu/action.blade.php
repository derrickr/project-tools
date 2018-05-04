@if(auth()->user()->isRoleIn(['admin','projectmanager']))
<li class="treeview <?php if(in_array(url()->current(),array(route('action.list'),route('action.create'))) ): print 'active'; endif; ?>" onclick="window.location='{{route('action.list')}}'">
    <a href="#">
        <i class="fa fa-users"></i><span>Actions</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
        <li class="<?php if(url()->current() === route('action.list') ): print 'active'; endif; ?>"><a href="{{route('action.list')}}"><i class="fa fa-circle-o"></i>All Actions</a></li>
        <li class="<?php if(url()->current() === route('action.create') ): print 'active'; endif; ?>"><a href="{{route('action.create')}}"><i class="fa fa-circle-o"></i>New Action</a></li>
    </ul>
</li>
@else
<li class="<?php if(url()->current() === route('action.list') ): print 'active'; endif; ?>">
    <a href="{{route('action.list')}}">
        <i class="fa fa-list"></i>
        <span>Actions</span></a>
</li>
@endif