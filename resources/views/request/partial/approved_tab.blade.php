{!! Form::model($request,['autocomplete'=>'off','id'=>'form_request_approved']) !!}
{{ Form::hidden('_method', 'PUT') }}
{{ Form::hidden('id', null) }}
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="box box-solid box-info">
            <div class="box-header text-center">
                <h4 class="box-title">Approved</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group comment"><?php echo ($request->approved_comment) ? trim($request->approved_comment) : "<span class='descrete'>If added, Approval text will be inserted here.</spam>"; ?></div>
            </div>
            
        </div>
    </div>
</div>
@include('request.partial.button',['tab'=>'approved'])
{!! Form::close() !!}