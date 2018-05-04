<li class="treeview <?php if(in_array(url()->current(),array(route('docs.process'),route('docs.operatingprocedure'),route('docs.roles'),route('docs.notifications'),route('docs.background'))) ): print 'active'; endif; ?>" onclick="window.location='{{route('docs.process')}}'">
    <a href="#">
      <i class="fa fa-check-square-o"></i> <span>Docs</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
        <li class="<?php if(url()->current() === route('docs.process') ): print 'active'; endif; ?>"><a href="{{route('docs.process')}}"><i class="fa fa-circle-o"></i>Process</a></li>
        <li class="<?php if(url()->current() === route('docs.operatingprocedure') ): print 'active'; endif; ?>"><a href="{{route('docs.operatingprocedure')}}"><i class="fa fa-circle-o"></i>Operating Procedure</a></li>
        <li class="<?php if(url()->current() === route('docs.roles') ): print 'active'; endif; ?>"><a href="{{route('docs.roles')}}"><i class="fa fa-circle-o"></i>Roles</a></li>
        <li class="<?php if(url()->current() === route('docs.notifications') ): print 'active'; endif; ?>"><a href="{{route('docs.notifications')}}"><i class="fa fa-circle-o"></i>Notifications</a></li>
        <li class="<?php if(url()->current() === route('docs.background') ): print 'active'; endif; ?>"><a href="{{route('docs.background')}}"><i class="fa fa-circle-o"></i>Background</a></li>
    </ul>
</li>