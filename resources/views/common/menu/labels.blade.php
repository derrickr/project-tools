@if(url()->current() === route('action.list') )
<li class="header"><span class="">Labels of Actions</span></li>
<li><a href="#"><span class="header-label label-success">Completed within Target</span></a></li>
<li><a href="#"><span class="header-label label-warning">In progress</span></a></li>
<li><a href="#"><span class="header-label label-danger">Completed late</span></a></li>
<li><a href="#"><span class="header-label label-info2">Ongoing late</span></a></li>
@endif