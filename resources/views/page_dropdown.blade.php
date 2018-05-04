<?php
$page_limit = PAGE_LIMIT;
$query = request()->query();
if (isset($query['page_limit'])) {
    $page_limit = $query['page_limit'];
    unset($query['page_limit']);
}
if (isset($query['page'])) {
    unset($query['page']);
}

?>
<form method="GET">
    <div class="form-inline">
        {!! Form::select('page_limit', getPageLimits(),$page_limit,['class'=>'form-control input-sm'] )!!}
        
    </div>    
</form>
@push('script')
<script>
    jQuery(document).ready(function(){
        jQuery('select[name="page_limit"]').change(function(e){
            jQuery(this).closest('form').submit();
        });
    });
</script>
@endpush