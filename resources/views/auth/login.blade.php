@extends('layouts.anonymous')
@section('title', 'Login')
@section('body_class','login-page')
@push('stylesheets')
<link href="{{asset('/theme/plugins/iCheck/square/blue.css')}}" rel="stylesheet">
@endpush
@push('scripts')
<script src="{{asset('/theme/plugins/iCheck/icheck.min.js')}}"></script>
@endpush
@section('content')
<div class="login-box">
  <!-- /.login-logo -->
  <div class="login-box-body">
     <div class="login-logo">
        <a href="{{url('/')}}">
            <img src="{{ asset('images/logo/logo.svg') }}" />
            <b>Project</b>Tools
        </a>
    </div>
    <p class="login-box-msg">Sign in to start your session</p>

    {{Form::open(['route' => 'login','method' => 'post'])}}
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
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
                <input type="checkbox" name="remember"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
            {{Form::submit('Sign In',['class' => 'btn btn-primary btn-block btn-flat'])}}
        </div>
        <!-- /.col -->
      </div>
    {!! Form::close() !!}
    <!-- /.social-auth-links -->
    {{ Html::link(url('/password/reset'),"I forgot my password") }}<br>
  </div>
  <!-- /.login-box-body -->
</div>
@endsection
