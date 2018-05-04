<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="box box-solid box-info">
            <div class="box-header text-center">
                <h4 class="box-title">Accepted</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group comment"><?php echo ($request->accepted_comment) ? trim($request->accepted_comment) : "<span class='descrete'>Accepted text will be displayed here.</span>"; ?></div>
            </div>
        </div>
    </div>
</div>
@include('request.partial.button',['tab'=>'accepted'])