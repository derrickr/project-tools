@if($request->id)
{!! Form::model($request,['autocomplete'=>'off','id'=>'form_request_update']) !!}
{{ Form::hidden('_method', 'PUT') }}
@else
{!! Form::model($request,['url' => route('request.store'),'autocomplete'=>'off']) !!}
@endif
{{ Form::hidden('id', null) }}
<?php
$can_edit = ['readonly' => 'readonly',];
$can_edit_text = 'readonly="readonly"';
if ((auth()->user()->isRoleIn(['admin']) || $request->requester == auth()->user()->email || !$request->id) and $request->status != "Fast Tracked") {
    $can_edit = [];
    $can_edit_text = [];
}
?>
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="box box-solid box-info">
            <div class="box-header text-center">
                <h4 class="box-title">Description</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group">
                    {{ Form::label('title', 'Title',['class'=>'required']) }}
                    {{ Form::text('title',null,$can_edit+['id'=>'title','class'=>'form-control ','placeholder'=>'Short title']) }}
                </div>
                @if($request->id)
                <div class="form-group">
                    {{ Form::label('submitted_date', 'Submitted') }}
                    <p class="text-muted">{{ $request->submitted_date}}</p>
                </div>
                <div class="form-group">
                    {{ Form::label('requester', 'Requester',['class'=>'']) }}
                    <p class="text-muted">{{ $request->m_requester->display_name() }}</p>
                </div>
                @endif
                <div class="form-group">
                    {{ Form::label('description', 'Description & Requirements', ['class' => 'required'] ) }}
                    {{ Form::textarea('description',null,$can_edit+['id'=>'description','class'=>'form-control  resize','placeholder'=>'Detailed description of your requirements and timescales.','rows'=>2]) }}
                </div>
                <div class="form-group">
                    {{ Form::label('justification', 'Business Justification & Benefits', ['class' => 'required'] ) }}
                    {{ Form::textarea('justification',null,$can_edit+['id'=>'justification','class'=>'form-control  resize','placeholder'=>'Clearly state why this is required for the business. A concise justification and the expected benefits to be derived must be listed here.','rows'=>2]) }}
                </div>
                <div class="form-group">
                    {{ Form::label('deliverables', 'Key Deliverables', ['class' => 'required'] ) }}
                    {{ Form::textarea('deliverables',null,$can_edit+['id'=>'deliverables','class'=>'form-control  resize','placeholder'=>'Please be as verbose as possible in defining exactly what you expect to be delivered. This is an essential part of the process! Bullet as much detail as possible.','rows'=>2]) }}
                </div>
                <div class="form-group">
                    {{ Form::label('criteria', 'Completion & Accpetance Criteria', ['class' => 'required'] ) }}
                    {{ Form::textarea('criteria',null,$can_edit+['id'=>'criteria','class'=>'form-control  resize','placeholder'=>'Detail the exact list of criteria that you will sign off against to say that this project has been delivered.','rows'=>2]) }}
                </div>
                <div class="form-group">
                    {{ Form::label('required_date', 'Required Date',['class'=>'required']) }}
                    {{ Form::text('required_date',mydate_format($request->required_date),$can_edit+['id'=>'required_date','class'=>'form-control datepicker','placeholder'=>'Ensure to allow adequate time.']) }}
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if ($request->updated_comment != NULL) {
    ?>
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="box box-solid box-info">
                <div class="box-header text-center">
                    <h4 class="box-title">Updated Comment</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group comment"><?php echo trim($request->updated_comment); ?></div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if ($request->fasttrack_comment != NULL) {
    ?>
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="box box-solid box-info">
                <div class="box-header text-center">
                    <h4 class="box-title">Fast Track Reason</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group comment"><?php echo trim($request->fasttrack_comment); ?></div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if ($request->more_info_comment != NULL) {
    ?>
<div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="box box-solid box-info">
                <div class="box-header text-center">
                    <h4 class="box-title">More Info Reason</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group comment"><?php echo trim($request->more_info_comment); ?></div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if ($request->more_time_comment) {
    ?>
<div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="box box-solid box-info">
                <div class="box-header text-center">
                    <h4 class="box-title">More Time Reason</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group comment"><?php echo trim($request->more_time_comment); ?></div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
<div class="row hide" kp-toggle-bind="fasttrack">
    <div class="col-md-offset-2 col-md-8">
        <div class="box box-solid box-info">
            <div class="box-header text-center">
                <h4 class="box-title">Fast Track, Urgent & small work <2hrs</h4>
            </div>
            <div class="box-body">
                <div class="form-group">
                    {{ Form::label('fasttrack_comment', 'Fast Track Reason', ['class' => 'required'] ) }}
                    {{ Form::textarea('fasttrack_comment',null,$can_edit+['id'=>'fasttrack_comment','class'=>'form-control ','placeholder'=>'Simple statement explaining why this needs to be fast tracked, what it\'s for & who\'s going to do what & when.','rows'=>2]) }}
                    <p class="text-aqua">Please do not abuse the fast track option.
                        This should only be used in cases of urgency/emergency.</p>
                    {{ Form::hidden('fasttrack', null) }}
                </div>
            </div>
        </div>
    </div>
</div>
@include('request.partial.button',['tab'=>'description'])
{!! Form::close() !!}