@if(auth()->user()->isRole('admin'))
<li class="treeview <?php if(in_array(url()->current(),array(route('resource.list'),route('resource.create'))) ): print 'active'; endif; ?>" onclick="window.location='{{route('resource.list')}}'">
    <a href="#">
      <i class="fa fa-list"></i> <span>Resources</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
        <li class="<?php if(url()->current() === route('resource.list') ): print 'active'; endif; ?>"><a href="{{route('resource.list')}}"><i class="fa fa-circle-o"></i>All Resource</a></li>        
        <li class="<?php if(url()->current() === route('resource.create') ): print 'active'; endif; ?>"><a href="{{route('resource.create')}}"><i class="fa fa-circle-o"></i>New Resource</a></li>
        
    </ul>
</li>
@else
<li class="<?php if(url()->current() === route('resource.list') ): print 'active'; endif; ?>">
    <a href="{{route('resource.list')}}">
        <i class="fa fa-list"></i>
        <span>Resources</span></a>
</li>
@endif