@extends('layouts.login')
@section('title')
@if($user->id)
Edit User
@else
Add User
@endif
@endsection
@section('content')
<div class="row">
    <div class="col-md-offset-4 col-md-4">
        @include('layouts.partials.message')
        <div class="box box-primary box-solid">
            <div class="box-header with-border text-center">
                @if($user->id)
                <h3 class="box-title">Edit User#{{$user->id}}</h3>
                @else
                <h3 class="box-title">Add User</h3>
                @endif
            </div>
            <div class="box-body">
                @include('user.forms.create')
            </div>
        </div>
        <!-- nav-tabs-custom -->
    </div>
    <!-- /.col -->
</div>
@endsection