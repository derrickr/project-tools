@extends('layouts.anonymous')
@section('title', 'Password Reset')
@section('body_class','register-page')
@section('content')
<div class="row pt35">
    <div class="col-md-offset-4 col-md-4">
        @include('layouts.partials.message')
    </div>
</div>
<div class="register-box">
    <div class="register-box-body">
        <div class="register-logo">
            <a href="{{url('/')}}">
                <img src="{{ asset('images/logo/logo.svg') }}" />
                <b>Project</b>Tool
            </a>
        </div>
        <p class="login-box-msg">Reset Password</p>
        {{ Form::open(['route' => 'password.email','method' => 'post'])}}
        <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
            {{ Form::email('email',old('email'),['class'=> "form-control",'placeholder' => 'Email Address']) }}
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-12">
                    {{Form::submit('Send Password Reset Link',['class' => 'btn btn-primary btn-block btn-flat'])}}
                </div>
                <!-- /.col -->
            </div>
        {!! Form::close() !!}
        <br>
        {{ Html::link(url('/login'),"Back to login") }}
`   </div>
    <!-- /.form-box -->
</div>
@endsection
