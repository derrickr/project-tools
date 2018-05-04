<li class="treeview <?php if(in_array(url()->current(),array(route('request.list'),route('request.create'))) ): print 'active'; endif; ?>" onclick="window.location='{{route('request.list')}}'">
    <a href="#">
      <i class="fa fa-file-o"></i> <span>Requests</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
        <li class="<?php if(url()->current() === route('request.list') ): print 'active'; endif; ?>"><a href="{{route('request.list')}}"><i class="fa fa-circle-o"></i>All Requests</a></li>
        <li class="<?php if(url()->current() === route('request.create') ): print 'active'; endif; ?>"><a href="{{route('request.create')}}"><i class="fa fa-circle-o"></i>New Request</a></li>
    </ul>
</li>