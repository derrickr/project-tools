<div class="hide" kp-action-form="request"></div>
@php($user = auth()->user())
@if(!$request->id && $tab == 'description')
<div class="row" >
    <div class="col-md-offset-3 col-md-6">
        <div class="box box-solid box-primary">
            <div class="box-body">
                <div class="box-success text-center">              
                    {{ Form::submit('Submit',['class'=>'btn btn-primary']) }}
                </div>
            </div>
        </div>
    </div>
</div>
@elseif($tab == 'description' && $request->id && $request->status != 'Fast Tracked')
<div class="row" >
    @if($request->requester == $user->email)
    <div class="col-md-offset-3 col-md-6">
        <div class="box box-solid box-primary">
            <div class="box-body">
                <div class="box-success text-center">                
                    {{ Form::button('Update',['class'=>'btn btn-primary','kp-request-action'=>'update']) }}
                    {{ Form::button('Cancel',['class'=>'btn btn-primary','kp-request-action'=>'cancel']) }}
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($user->isRoleIn(['admin','assessor']))
    <div class="col-md-offset-3 col-md-6">
        <div class="box box-solid box-primary">
            <div class="box-body">
                <div class="box-success text-center">
                    {{ Form::button('Accepted',['class'=>'btn btn-primary','kp-request-action'=>'accept']) }}
                    {{ Form::button('More Info',['class'=>'btn btn-primary','kp-request-action'=>'more-info']) }}
                    {{ Form::button('Cancel',['class'=>'btn btn-primary','kp-request-action'=>'cancel']) }}
                    {{ Form::button('Reject',['class'=>'btn btn-primary','kp-request-action'=>'reject']) }}
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@elseif ($tab == 'analysis' && $user->isRoleIn(['admin','analyser','projectmanager']))
<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <div class="box box-solid box-primary">
            <div class="box-body">
                <div class="box-success text-center">
                    {{ Form::button('Analysed',['class'=>'btn btn-primary','kp-request-action'=>'analysed']) }}
                    {{ Form::button('More Info',['class'=>'btn btn-primary','kp-request-action'=>'more-info']) }}
                    {{ Form::button('Cancel',['class'=>'btn btn-primary','kp-request-action'=>'cancel']) }}
                    {{ Form::button('Reject',['class'=>'btn btn-primary','kp-request-action'=>'reject']) }}
                </div>
            </div>
        </div>
    </div>
</div>
@elseif($tab == 'cost' && $user->isRoleIn(['admin','coster','projectmanager']))
<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <div class="box box-solid box-primary">
            <div class="box-body">
                <div class="box-success text-center">
                    {{ Form::button('Costed',['class'=>'btn btn-primary','kp-request-action'=>'costed']) }}
                    {{ Form::button('More Info',['class'=>'btn btn-primary','kp-request-action'=>'more-info']) }}
                    {{ Form::button('Cancel',['class'=>'btn btn-primary','kp-request-action'=>'cancel']) }}
                    {{ Form::button('Reject',['class'=>'btn btn-primary','kp-request-action'=>'reject']) }}
                </div>
            </div>
        </div>
    </div>
</div>
@elseif($tab == 'approved' && $user->isRoleIn(['admin','approver']))
<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <div class="box box-solid box-primary">
            <div class="box-body">
                <div class="box-success text-center">
                    {{ Form::button('Approved',['class'=>'btn btn-primary','kp-request-action'=>'approved']) }}
                    {{ Form::button('More Info',['class'=>'btn btn-primary','kp-request-action'=>'more-info']) }}
                    {{ Form::button('Cancel',['class'=>'btn btn-primary','kp-request-action'=>'cancel']) }}
                    {{ Form::button('Reject',['class'=>'btn btn-primary','kp-request-action'=>'reject']) }}
                </div>
            </div>
        </div>
    </div>
</div>
@elseif($tab == 'backout'  && $user->isRoleIn(['admin','implementer']))
<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <div class="box box-solid box-primary">
            <div class="box-body">
                <div class="box-success text-center">
                    {{ Form::button('Backout',['class'=>'btn btn-primary','kp-request-action'=>'backout']) }}
                    {{ Form::button('More Time',['class'=>'btn btn-primary','kp-request-action'=>'moretime']) }}
                    {{ Form::button('Rework',['class'=>'btn btn-primary','kp-request-action'=>'rework']) }}
                    {{ Form::button('Backed Out',['class'=>'btn btn-primary','kp-request-action'=>'backedout']) }}
                </div>
            </div>
        </div>
    </div>
</div>
@elseif($tab == 'cancelled' && $request->status == 'Cancelled' && $user->isRoleIn(['admin','assessor','analyser','coster','scheduler','approver','projectmanager']))
<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <div class="box box-solid box-primary">
            <div class="box-body">
                <div class="box-success text-center">
                    {{ Form::button('Reopen',['class'=>'btn btn-primary','kp-request-action'=>'reopen']) }}
                </div>
            </div>
        </div>
    </div>
</div>
@elseif($tab == 'implemented' && $user->isRoleIn(['admin','implementer']))
<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <div class="box box-solid box-primary">
            <div class="box-body">
                <div class="box-success text-center">
                    @if(time() > (strtotime($request->planned_finish) + 86399))
			<p>The Planned Finished date has already passed. Please request More Time or Backout.</p>
                    @endif
                    @if(strtotime($request->planned_finish) + 86399 > time())
                    {{ Form::button('Implemented',['class'=>'btn btn-primary','kp-request-action'=>'implemented']) }}
                    {{ Form::button('Rework',['class'=>'btn btn-primary','kp-request-action'=>'rework']) }}					
                    @endif
                    {{ Form::button('More Time',['class'=>'btn btn-primary','kp-request-action'=>'moretime']) }}
                    {{ Form::button('Backout',['class'=>'btn btn-primary','kp-request-action'=>'backout']) }}
                </div>
            </div>
        </div>
    </div>
</div>
@elseif($tab == 'rejected' && $request->status == 'Rejected' && $user->isRoleIn(['admin','assessor','analyser','coster','scheduler','approver','projectmanager']))
<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <div class="box box-solid box-primary">
            <div class="box-body">
                <div class="box-success text-center">
                    {{ Form::button('Reopen',['class'=>'btn btn-primary','kp-request-action'=>'reopen']) }}
                </div>
            </div>
        </div>
    </div>
</div>
@elseif($tab == 'reopened')
@elseif($tab == 'rework' && $user->isRoleIn(['admin','implementer']))
<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <div class="box box-solid box-primary">
            <div class="box-body">
                <div class="box-success text-center">
                    {{ Form::button('Rework',['class'=>'btn btn-primary','kp-request-action'=>'rework']) }}
                    {{ Form::button('More Time',['class'=>'btn btn-primary','kp-request-action'=>'moretime']) }}
                    {{ Form::button('Backout',['class'=>'btn btn-primary','kp-request-action'=>'backout']) }}
                </div>
            </div>
        </div>
    </div>
</div>
@elseif($tab == 'testresults' && $user->isRoleIn(['admin','implementer']))
@if($user->isRoleIn(['admin']))
<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <div class="box box-solid box-primary">
            <div class="box-body">
                <div class="box-success text-center">
                    {{ Form::button('Pass',['class'=>'btn btn-primary','kp-request-direct-action'=>route('request.action',['action'=>'pass','id'=>$request->id])]) }}
                    {{ Form::button('Fail',['class'=>'btn btn-primary','kp-request-direct-action'=>route('request.action',['action'=>'fail','id'=>$request->id])]) }}
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <div class="box box-solid box-primary">
            <div class="box-body">
                <div class="box-success text-center">
                    {{ Form::button('Implemented',['class'=>'btn btn-primary','kp-request-action'=>'implemented']) }}
                    {{ Form::button('Rework',['class'=>'btn btn-primary','kp-request-action'=>'rework']) }}
                    {{ Form::button('More Time',['class'=>'btn btn-primary','kp-request-action'=>'moretime']) }}
                    {{ Form::button('Backout',['class'=>'btn btn-primary','kp-request-action'=>'backout']) }}
                </div>
            </div>
        </div>
    </div>
</div>
@elseif($tab == 'testresults' && $user->isRoleIn(['tester']))
<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <div class="box box-solid box-primary">
            <div class="box-body">
                <div class="box-success text-center">
                    {{ Form::button('Pass',['class'=>'btn btn-primary','kp-request-direct-action'=>route('request.action',['action'=>'pass','id'=>$request->id])]) }}
                    {{ Form::button('Fail',['class'=>'btn btn-primary','kp-request-direct-action'=>route('request.action',['action'=>'fail','id'=>$request->id])]) }}
                </div>
            </div>
        </div>
    </div>
</div>
@elseif($tab == 'timescales' && $user->isRoleIn(['admin','scheduler','projectmanager']))
<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <div class="box box-solid box-primary">
            <div class="box-body">
                <div class="box-success text-center">
                    {{ Form::button('Scheduled',['class'=>'btn btn-primary','kp-request-action'=>'scheduled']) }}
                    {{ Form::button('More Info',['class'=>'btn btn-primary','kp-request-action'=>'more-info']) }}
                    {{ Form::button('Cancel',['class'=>'btn btn-primary','kp-request-action'=>'cancel']) }}
                    {{ Form::button('Reject',['class'=>'btn btn-primary','kp-request-action'=>'reject']) }}
                </div>
            </div>
        </div>
    </div>
</div>
@endif
