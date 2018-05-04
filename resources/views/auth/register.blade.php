@extends('layouts.anonymous')
@section('title', 'Register')
@section('body_class','register-page')
@push('stylesheets')
<link href="{{asset('/theme/plugins/iCheck/square/blue.css')}}" rel="stylesheet">
@endpush
@push('scripts')
<script src="{{asset('/theme/plugins/iCheck/icheck.min.js')}}"></script>
@endpush
@section('content')
<div class="register-box">
  <div class="register-box-body">
    <div class="register-logo">
        <a href="{{url('/')}}">
            <img src="{{ asset('images/logo/logo.svg') }}" />
            <b>Project</b>Tool
        </a>
    </div>
    <p class="login-box-msg">Register a new membership</p>

    {{Form::open(['route' => 'register', 'method' => 'post'])}}
      <div class="form-group has-feedback {{ $errors->has('name') ? ' has-error' : '' }}">
        {{Form::text('name',old('name'),['class'=>'form-control', 'placeholder' => 'Full Name'])}}
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif
      </div>
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
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
            {{Form::submit('Register',['class' => 'btn btn-primary btn-block btn-flat'])}}
        </div>
        <!-- /.col -->
      </div>
   {!! Form::close() !!}
   {{ Html::link(url('login'),"I already have a membership", ['class' => 'text-center']) }}
  </div>
  <!-- /.form-box -->
</div>
@endsection
