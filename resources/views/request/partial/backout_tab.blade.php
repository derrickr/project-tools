{!! Form::model($request,['autocomplete'=>'off','id'=>'form_request_backout']) !!}
{{ Form::hidden('_method', 'PUT') }}
{{ Form::hidden('id', null) }}
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="box box-solid box-info">
            <div class="box-header text-center">
                <h4 class="box-title">Backout</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group comment"><?php echo ($request->backout_comment) ? trim($request->backout_comment) : "<span class='descrete'>Reason for backout will be displayed here.</span>"; ?></div>
            </div>
        </div>
    </div>
</div>
<?php if($request->backedout_comment){ ?>
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="box box-solid box-info">
            <div class="box-header text-center">
                <h4 class="box-title">Backed Out Comment</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group comment"><?php echo ($request->backedout_comment) ? trim($request->backedout_comment) : "<span class='descrete'>Backedout text will be displayed here.</span>"; ?></div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
@include('request.partial.button',['tab'=>'backout'])
{!! Form::close() !!}