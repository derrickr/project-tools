@extends('layouts.anonymous')
@section('title', 'Password Reset')
@section('body_class','register-page')
@section('content')
<div class="register-box">
    <div class="register-box-body">
        <div class="register-logo">
            <a href="{{url('/')}}">
                <img src="{{ asset('images/logo/logo.svg') }}" />
                <b>Project</b>Tool
            </a>
        </div>
        <p class="login-box-msg">Reset Password</p>
        {{Form::open(['route' => 'password.request', 'method' => 'post'])}}
        {{ csrf_field() }}
        {{Form::hidden('token',$token)}}
        <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
            {{ Form::email('email',old('email'),['class'=>"form-control",'placeholder' => 'Email']) }}
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
            {{Form::password('password',['class'=>"form-control", 'placeholder'=> 'Password'])}}
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            {{Form::password('password_confirmation',['class'=>"form-control", 'placeholder'=> 'Confirm Password'])}}
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
            @endif
        </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-12">
                    {{Form::submit('Reset Password',['class' => 'btn btn-primary btn-block btn-flat'])}}
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.form-box -->
</div>
@endsection
