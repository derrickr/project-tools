@if($user->id)
{!! Form::model($user,['url' => route('user.update',$user->id),'autocomplete'=>'off','files' => true]) !!}
{{ Form::hidden('_method', 'PUT') }}
@else
{!! Form::model($user,['url' => route('user.store'),'autocomplete'=>'off','id'=>'form-add-user','files' => true]) !!}
@endif
{{ Form::hidden('id', null) }}
<div class="form-group">
    {{ Form::label('first_name', 'First Name', array('class' => 'required')) }}
    {{ Form::text('first_name',null,['id'=>'first_name','class'=>'form-control','placeholder'=>'First Name']) }}
</div>

<div class="form-group">
    {{ Form::label('last_name', 'Last Name', array('class' => 'required') ) }}
    {{ Form::text('last_name',null,['id'=>'last_name','class'=>'form-control','placeholder'=>'Last Name']) }}
</div>

<div class="form-group">

    {{ Form::label('email', 'Email address', array('class' => 'required')) }}
    <div class="input-group">
        {{ Form::text('email',null,['id'=>'email','data-id'=>$user->id,'class'=>'form-control','placeholder'=>'Email address','autocomplete'=>'false']) }}
        <div id="userResult" class="input-group-addon">
            @if($user->id)
            <i title="Please provide email" class="text-green fa fa-check"></i>
            @else
            <i title="Please provide email" class="text-red fa fa-remove"></i>
            @endif
        </div>
    </div>
</div>

<div class="form-group">
    {{ Form::label('password', 'Password', array('class' => 'required')) }}
    {{ Form::password('password', ['id'=>'password','class'=>'form-control','placeholder'=>'Password', 'autocomplete'=>'new-password']) }}
</div>

<div class="form-group">
    {{ Form::label('role', 'Additional User Roles') }}
    <ul class="two-cols">
        @foreach (getOptionKeyValue('roles') as $key => $value) 
        <li>
            {{ Form::checkbox('role[]', $value, $user->isRole($value))}}
            {{ Form::label('role', $key) }}
        </li>
        @endforeach
    </ul>
</div>
@if($user->id)
<div class="form-group">
    {{ Form::label('created_at', 'Enrolled') }}: {{$user->created_at }}
</div>
<div class="form-group">
    {{ Form::label('last_visit', 'Last Visited') }} : {{ $user->last_visit }}
</div>
@endif
<div class="form-group">
        <div class="btn btn-default btn-file">
        <input type="file" name="avatar">
<!--        <img src="{{asset($user->avatar)}}" height="50px" class="user-image pull-right" alt="{{$user->display_name()}}">-->
        @if($user and $user->avatar)
        <img src="{{asset($user->avatar)}}" height="75px" class="user-image pull-right">
        @else
        <img src="{{asset('/theme/img/user2-160x160.jpg')}}" height="50px"  class="user-image pull-right">
        @endif
    </div>
    <p class="help-block text-sm">Max. 2MB</p>

        

    
    
</div>
<div class="text-center mb5">
    <a href="{{route('user.list')}}" class='btn btn-default'>Cancel</a>
    {{ Form::submit('Save',array('class'=>'btn btn-primary')) }}
</div>

{!! Form::close() !!}
@push('script')
<script>
    $(document).ready(function () {
        Users.init();
    });
</script>
@endpush