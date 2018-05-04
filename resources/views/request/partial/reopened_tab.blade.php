<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="box box-solid box-info">
            <div class="box-header text-center">
                <h4 class="box-title">Reopened</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group comment"><?php echo ($request->reopened_comment) ? trim($request->reopened_comment) : "<span class='descrete'>Reopened text will be displayed here.</span>"; ?></div>
            </div>
        </div>
    </div>
</div>
@include('request.partial.button',['tab'=>'reopened'])