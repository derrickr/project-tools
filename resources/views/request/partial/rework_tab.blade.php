{!! Form::model($request,['autocomplete'=>'off','id'=>'form_request_backout']) !!}
{{ Form::hidden('_method', 'PUT') }}
{{ Form::hidden('id', null) }}
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="box box-solid box-info">
            <div class="box-header text-center">
                <h4 class="box-title">Rework</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group comment"><?php echo ($request->rework_comment) ? trim($request->rework_comment) : "<span class='descrete'>Rework text will be displayed here.</span>"; ?></div>
            </div>
        </div>
    </div>
</div>
@include('request.partial.button',['tab'=>'rework'])
{!! Form::close() !!}