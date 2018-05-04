@if($action->id)
<?php $disabled = 'readonly'; ?>
{!! Form::model($action,['url' => route('action.update',$action->id),'autocomplete'=>'off']) !!}
{{ Form::hidden('_method', 'PUT') }}
@else
<?php $disabled = ''; ?>
{!! Form::model($action,['url' => route('action.store'),'autocomplete'=>'off']) !!}
@endif
<?php
$can_edit = ['readonly'=>'readonly','disabled'=>'disabled'];
$can_edit_text = 'readonly="readonly" disabled ="disabled"';
if((auth()->user()->isRoleIn(['admin','projectmanager']) || !$action->id)){
    $can_edit = [];
    $can_edit_text = [];
}

?>
{{ Form::hidden('id', null) }}


@if(!$action->id)
    <div class="form-group">
        {{ Form::label('description', 'Description', array('class' => 'required')) }}
        {{ Form::textarea ('description',null,$can_edit+['id'=>'description','class'=>'form-control resize','placeholder'=>'Description of the agreed action.','size' => '30x3']) }}
    </div>

    <div class="form-group">
        {{ Form::label('owner', 'Owner', array('class' => 'required') ) }}
        {{ Form::select('owner',getDbDropDown('user', 'display_names', 'email', $options=[
                'select'=>"email,CONCAT(first_name,' ',last_name) as display_names"
            ]),null,['id'=>'owner','class'=>'form-control','placeholder'=>'Owner']) }}
    </div>

    <div class="form-group">
        {{ Form::label('target_date', 'Target', array('class' => 'required')) }}
        {{ Form::text('target_date',mydate_format($action->target_date),['id'=>'target_date','class'=>'form-control datepicker','placeholder'=>'Please set a realisitic & achievable timescale.']) }}
    </div>

    <div class="form-group">
        {{ Form::label('comment', 'Comment') }}
        {{ Form::textarea ('comment',null,['id'=>'comment','class'=>'form-control resize','placeholder'=>'Please add any additional comments, if necessary.','size' => '30x3']) }}
    </div> 
@else
    <div class="form-group">
        {{ Form::label('description', 'Description', array('class' => 'required')) }}
        {{ Form::textarea ('description',null,$can_edit+['id'=>'description','class'=>'form-control resize','placeholder'=>'Description of the agreed action.','size' => '30x3']) }}
    </div>
    
    <div class="form-group">
        {{ Form::label('identified', 'Identified') }}
        {{ Form::text ('identified',null,['id'=>'identified','class'=>'form-control', 'readonly']) }}
    </div>

    <div class="form-group">
        {{ Form::label('owner', 'Owner', array('class' => 'required') ) }}
        {{ Form::select('owner',getDbDropDown('user', 'display_names', 'email', $options=[
                'select'=>"email,CONCAT(first_name,' ',last_name) as display_names"
            ]),null,['id'=>'owner','class'=>'form-control','placeholder'=>'Owner', 'disabled']) }}
    </div>

    <div class="form-group">
        {{ Form::label('target_date', 'Target', array('class' => 'required')) }}
        {{ Form::label('target_date',mydate_format($action->target_date),['class'=>'label-edit-form']) }}
    </div>

    <div class="form-group">
        {{ Form::label('completed', 'Completed') }}
        {{ Form::text('completed',mydate_format($action->completed),$can_edit+['id'=>'completed','class'=>'form-control datepicker','placeholder'=>'Please ensure this action has 100% been completed before marking it so.']) }}
    </div>

    <div class="form-group">
        {{ Form::label('status', 'Status') }}
        {{ Form::label('status',$action->status,['class'=>'label-edit-form']) }}
    </div>

    <div class="form-group">
        {{ Form::label('comment', 'Comment') }}
        {{ Form::textarea ('comment',null,$can_edit+['id'=>'comment','class'=>'form-control resize','placeholder'=>'Please add any additional comments, if necessary.','size' => '30x3']) }}
    </div> 

    <div class="form-group">
        {{ Form::label('target_duration', 'Target duration') }}
        {{ Form::label('target_duration',$action->target_duration < 1 ? "< 1" : $action->target_duration . $action->days($action->target_duration),['class'=>'label-edit-form']) }}
    </div>

    <div class="form-group">
        {{ Form::label('actual_duration', 'Actual duration') }}
        {{ Form::label('actual_duration',$action->get_actual_duration(false),['class'=>'label-edit-form']) }}
    </div>
@endif

<div class="text-center mb5">
    <a href="{{route('action.list')}}" class='btn btn-default'>Cancel</a>
    {{ Form::submit('Save',array('class'=>'btn btn-primary')) }}
</div>

{!! Form::close() !!}
