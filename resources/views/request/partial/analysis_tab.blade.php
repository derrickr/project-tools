{!! Form::model($request,['autocomplete'=>'off','id'=>'form_request_analysed']) !!}
{{ Form::hidden('_method', 'PUT') }}
{{ Form::hidden('id', null) }}
<?php
$can_edit = ['readonly'=>'readonly','disabled'=>'disabled'];
$can_edit_text = 'readonly="readonly" disabled ="disabled"';
if(auth()->user()->isRoleIn(['analyser','admin','projectmanager'])){
    $can_edit = [];
    $can_edit_text = [];
}
?>
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="box box-solid box-info">
            <div class="box-header text-center">
                <h4 class="box-title">Technical Analysis</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group">
                    {{ Form::label('req_type', 'Type of Request',['class'=>'required']) }}
                    <div class="col-md-12 text-center">
                        <?php 
                        $pre_check = (!$request->req_type)?['checked'=>'checked']:[];                            
                        ?>
                        <div class="col-md-4">
                            {{ Form::label('req_type', 'New Requirement')}}<br>
                            {{Form::radio('req_type', 'new', null, $can_edit+$pre_check+['id'=>'new','class'=>'form-control'])}}
                        </div>
                        <div class="col-md-4">
                            {{ Form::label('req_type', 'Fix')}}<br>
                            {{Form::radio('req_type', 'bug', null, $can_edit+['id'=>'bug','class'=>'form-control'])}}
                        </div>
                        <div class="col-md-4">
                            {{ Form::label('req_type', 'Enhancement')}}<br>
                            {{Form::radio('req_type', 'enhance', null, $can_edit+['id'=>'enhance','class'=>'form-control'])}}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('soln', 'Technical solution',['class'=>'required']) }}
                    {{ Form::textarea('soln',null,$can_edit+['id'=>'soln','class'=>'form-control','placeholder'=>'Please define the technical solution, with as much detail as possible.','rows'=>2]) }}
                </div>
                @php(
                    $skills = getDbDropDown('resources','resource','abbrv',['order'=>['resource','ASC']])
                )
                @php(
                    $myskills = getSkillsValues($request->skills)
                )
                <?php 

                ?>
                <div class="form-group nm">
                    {{ Form::label('soln', 'Skills Required(Man days)',['class'=>'required']) }}
                </div>
                <div class="form-group col-md-12 np">
                    
                        @foreach($skills as $abbrv=>$skill)
                        <div class="col-md-3 np pr10">
                            
                            <?php 
                                $kk_skill = isset($myskills[$abbrv])?$myskills[$abbrv]:'';
                            ?>
                            {{Form::text('skills['.$abbrv.']', $kk_skill, $can_edit+['class'=>'col-md-2 np text-center numeric'])}}
                            <!--<input type="input" name="skills[{{$abbrv}}]" class="col-md-2 np text-center numeric" id="" value="{{$kk_skill}}"/>-->
                            <label for="{{$abbrv}}" class="col-md-10 pl5">{{$skill}}</label>
                        </div>
                        @endforeach
                </div>
                
                <div class="form-group col-md-12 np">
                    <div class="col-md-10 pl0">
                        {{ Form::label('capex_comment', 'Costs (Capex/P&L)')}}
                        {{ Form::textarea('capex_comment',null,$can_edit+['id'=>'capex_comment','class'=>'form-control resize','placeholder'=>'Please define any capital expenditure items here, outline costs from quotes or online prices.','rows'=>2]) }}
                    </div>
                    <div class="col-md-2 pr0">
                        {{ Form::label('capex_cost', 'Costs')}}
                        {{Form::text('capex_cost', null, $can_edit+['id'=>'bug','class'=>'form-control decimal'])}}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('ext_interfaces', 'Stakeholders')}}
                    {{ Form::textarea('ext_interfaces',null,$can_edit+['id'=>'ext_interfaces','class'=>'form-control resize','placeholder'=>'Please define who else should be involved, provide input or be informed about this work.','rows'=>2]) }}
                </div>
                <div class="form-group">
                    {{ Form::label('approach', 'Approach',['class'=>'required'])}}
                    {{ Form::textarea('approach',null,$can_edit+['id'=>'approach','class'=>'form-control resize','placeholder'=>'Please define the approach to be taken, identifying approximately who needs to do what and when.','rows'=>2]) }}
                </div>
                <div class="form-group">
                    {{ Form::label('backout_method', 'Backout Method',['class'=>'required'])}}
                    {{ Form::textarea('backout_method',null,$can_edit+['id'=>'backout_method','class'=>'form-control resize','placeholder'=>'Please define how this implementation would be backed out, including how long it would take to back it out, if it was necessary. If no timescales are given it will be assumed that the timeframe would be the same as it was to implement.','rows'=>2]) }}
                </div>
            </div>
        </div>
    </div>
</div>
@if ($request->analysed_comment)
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="box box-solid box-info">
            <div class="box-header text-center">
                <h4 class="box-title">Analyser Comment</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group comment"><?php echo trim($request->analysed_comment); ?></div>
            </div>
        </div>
    </div>
</div>
@endif
@include('request.partial.button',['tab'=>'analysis'])
{!! Form::close() !!}