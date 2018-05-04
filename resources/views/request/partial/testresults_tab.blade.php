{!! Form::model($request,['autocomplete'=>'off','id'=>'form_request_testresults']) !!}
{{ Form::hidden('_method', 'PUT') }}
{{ Form::hidden('id', null) }}
<?php
$can_edit = ['readonly'=>'readonly','disabled'=>'disabled'];
$can_edit_text = 'readonly="readonly" disabled ="disabled"';
if(auth()->user()->isRoleIn(['tester','admin'])){
    $can_edit = [];
    $can_edit_text = [];
}
?>
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="box box-solid box-info">
            <div class="box-header text-center">
                <h4 class="box-title">Test Results <span class="text-red">*</span></h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-bordered">
                    <tbody>
                        <tr>
                            <td>{{ Form::textarea('testresults',$request->testresults,$can_edit+['id'=>'testresults','required'=>'required','class'=>'form-control resize sen-first-up','placeholder'=>'Please provide all test results here.*','rows'=>2]) }}</td>
                        </tr>
                    </tbody>
                </table>    
            </div>
        </div>
    </div>
</div>
@include('request.partial.button',['tab'=>'testresults'])
{!! Form::close() !!}