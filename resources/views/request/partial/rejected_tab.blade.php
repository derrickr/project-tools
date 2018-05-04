{!! Form::model($request,['autocomplete'=>'off','id'=>'form_request_rejected']) !!}
{{ Form::hidden('_method', 'PUT') }}
{{ Form::hidden('id', null) }}
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="box box-solid box-info">
            <div class="box-header text-center">
                <h4 class="box-title">Rejected</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group comment"><?php echo ($request->rejected_comment) ? trim($request->rejected_comment) : "<span class='descrete'>Rejected text will be displayed here.</span>"; ?></div>
            </div>
        </div>
    </div>
</div>
@include('request.partial.button',['tab'=>'rejected'])
{!! Form::close() !!}