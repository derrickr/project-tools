@if($resource->id)
{!! Form::model($resource,['url' => route('resource.update',$resource->id),'autocomplete'=>'off']) !!}
{{ Form::hidden('_method', 'PUT') }}
@else
{!! Form::model($resource,['url' => route('resource.store'),'autocomplete'=>'off']) !!}
@endif
{{ Form::hidden('id', null) }}

<div class="form-group">
    {{ Form::label('resource', 'Resource',['class'=>'required']) }}
    {{ Form::text('resource',null,['id'=>'resource','class'=>'form-control','placeholder'=>'Resource']) }}
</div>
<div class="form-group">
    {{ Form::label('abbrv', 'Abbreviation', ['class' => 'required'] ) }}
    {{ Form::text('abbrv',null,['id'=>'abbrv','class'=>'form-control','placeholder'=>'Short abbreviation']) }}
</div>
<div class="form-group">
    {{ Form::label('price', 'Daily Cost',['class'=>'required']) }}
    {{ Form::text('price',null,['id'=>'price','class'=>'form-control decimal','placeholder'=>'Daily Cost']) }}
</div>
<div class="text-center mb5">
    <a href="{{route('resource.list')}}" class='btn btn-default'>Cancel</a>
    {{ Form::submit('Save',array('class'=>'btn btn-primary')) }}
</div>

{!! Form::close() !!}
