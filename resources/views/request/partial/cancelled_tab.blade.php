{!! Form::model($request,['autocomplete'=>'off','id'=>'form_request_cancelled']) !!}
{{ Form::hidden('_method', 'PUT') }}
{{ Form::hidden('id', null) }}
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="box box-solid box-info">
            <div class="box-header text-center">
                <h4 class="box-title">Cancelled</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group comment"><?php echo ($request->cancelled_comment) ? trim($request->cancelled_comment) : "<span class='descrete'>Cancelled text will be displayed here.</span>"; ?></div>
            </div>
        </div>
    </div>
</div>
@include('request.partial.button',['tab'=>'cancelled'])
{!! Form::close() !!}