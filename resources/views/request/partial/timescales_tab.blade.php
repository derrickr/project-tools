{!! Form::model($request,['autocomplete'=>'off','id'=>'form_request_scheduled']) !!}
{{ Form::hidden('_method', 'PUT') }}
{{ Form::hidden('id', null) }}
<?php
$can_edit = ['readonly'=>'readonly','disabled'=>'disabled'];
$can_edit_text = 'readonly="readonly" disabled ="disabled"';
if(auth()->user()->isRoleIn(['scheduler','admin','projectmanager'])){
    $can_edit = [];
    $can_edit_text = [];
}
?>
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="box box-solid box-info">
            <div class="box-header text-center">
                <h4 class="box-title">Timescales</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table no-border">
                    <tbody>
                        <tr>
                            <th colspan="2" class="text-center">Please ensure you allow adequate time for potential Backout / Contingency!</th>
                        </tr>
                        <tr>
                            <td>{{ Form::label('planned_start', 'Planned Start',['class'=>'required'])}}</td>
                            <td>{{ Form::text('planned_start',mydate_format($request->planned_start),$can_edit+['id'=>'planned_start','class'=>'form-control datepicker','placeholder'=>'Be Very Careful.']) }}</td>
                        </tr>
                        <tr>
                            <td>{{ Form::label('planned_finish', 'Planned Finish',['class'=>'required'])}}</td>
                            <td>{{ Form::text('planned_finish',mydate_format($request->planned_finish),$can_edit+['id'=>'planned_finish','class'=>'form-control datepicker','placeholder'=>'Double &amp; triple check!']) }}</td>
                        </tr>
                    </tbody>
                </table>    
            </div>
        </div>
    </div>
</div>
 <?php if ($request->scheduled_comment){ ?>
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="box box-solid box-info">
            <div class="box-header text-center">
                <h4 class="box-title">Scheduler Comment</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group comment"><?php echo ($request->scheduled_comment) ? trim($request->scheduled_comment) : "<span class='descrete'>Scheduled text will be displayed here.</span>"; ?></div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
@include('request.partial.button',['tab'=>'timescales'])
{!! Form::close() !!}