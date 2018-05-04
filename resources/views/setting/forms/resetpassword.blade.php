{!! Form::open(['url' => route('postresetpassword'), 'method' => 'post']) !!}

<div class="row form-group">
    <div class="col-md-12">
        <div class="col-md-4">   
            {{ Form::label('old_password', 'Old Password') }}
            {{Form::password('old_password',['class'=>"form-control", 'placeholder'=> 'Old Password'])}}
        </div>
    </div>    
</div>    

<div class="row form-group">
    <div class="col-md-12">
        <div class="col-md-4">
            {{ Form::label('new_password', 'New Password') }}
            {{Form::password('new_password',['class'=>"form-control", 'placeholder'=> 'New Password'])}}
        </div>
    </div>    
</div>    

<div class="row form-group">
    <div class="col-md-12">
        <div class="col-md-4">        
            {{ Form::label('confirm_password', 'Confirm Password') }}
            {{Form::password('confirm_password',['class'=>"form-control", 'placeholder'=> 'Confirm Password'])}}
        </div>
    </div>    
</div>

<div class="row form-group">
    <div class="col-md-12">
        <div class="col-md-12">
            {{ Form::submit('Save',array('class'=>'btn btn-success')) }}
            {{ Form::button('Cancel',array('class'=>'btn btn-danger')) }}
        </div>
    </div>
</div>
    
{!! Form::close() !!}
