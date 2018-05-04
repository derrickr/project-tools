@php($auth_user = auth()->user())
<header class="main-header">
    <!-- Logo -->
    <a href="{{url('/')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img src="{{ asset('images/logo/logo.svg') }}" /></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img src="{{ asset('images/logo/logo.svg') }}" /><b>Project</b>Tools</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-th-large"></i>
        </button>
        <div class="navbar-custom-menu pull-right">

            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if($auth_user->avatar)
                        <img src="{{asset($auth_user->avatar)}}" class="user-image" alt="{{$auth_user->display_name()}}">
                        @else
                        <img src="{{asset('/theme/img/user2-160x160.jpg')}}" class="user-image" alt="{{$auth_user->display_name()}}">
                        @endif
                        <span class="hidden-xs" title="{{$auth_user->role}}">{{$auth_user->display_name()}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            
                            @if($auth_user->avatar)
                            <img src="{{asset($auth_user->avatar)}}" class="img-circle" alt="{{$auth_user->display_name()}}">
                            @else
                            <img src="{{asset('/theme/img/user2-160x160.jpg')}}" class="img-circle" alt="{{$auth_user->display_name()}}">
                            @endif
                            <div class="user-info">
                                <p>{{$auth_user->display_name()}}</p>
                                <span>{{$auth_user->email}}</span><br/>
                                <span>Role: </span><br>
                                <?php $roles = $auth_user->roles(); ?>
                                @foreach($roles as $kko=>$role)
                                <small>
                                    {{ucfirst($role)}}
                                </small>{{ (count($roles) == $kko+1)?'':'|'}}
                                @endforeach
                                
                            </div>
                        </li>              
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left hide">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{route('logout')}}" class="btn btn-primary btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
            </ul>
        </div>
    </nav>
</header>
