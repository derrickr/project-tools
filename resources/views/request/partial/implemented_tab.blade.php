{!! Form::model($request,['autocomplete'=>'off','id'=>'form_request_moretime']) !!}
{{ Form::hidden('_method', 'PUT') }}
{{ Form::hidden('id', null) }}
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="box box-solid box-info">
            <div class="box-header text-center">
                <h4 class="box-title">Implemented</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group comment"><?php echo ($request->implemented_comment) ? trim($request->implemented_comment) : "<span class='descrete'>Implemented text will be displayed here.</span>"; ?></div>
            </div>
        </div>
    </div>
</div>
@include('request.partial.button',['tab'=>'implemented'])
{!! Form::close() !!}