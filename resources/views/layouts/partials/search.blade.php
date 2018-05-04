<!-- Advanced Search -->
@if(isset($search_filters) && $search_filters)
<?php
$i_class = 'fa-plus';
$div_class = 'collapsed-box';
$chunk = 6;
$chunk_class = 'col-md-2';
$query = request()->query();
if (isset($query['f'])) {
    $i_class = 'fa-minus';
    $div_class = '';
}


?>
<div class="row">
    {!! Form::open(['method' => 'GET','autocomplete'=>'off','id'=>'form-advanced-search','onsubmit'=>'filterEmpty()']) !!}
    <div class="col-md-12">
        <div class="box box-solid {{$div_class}}">
            <div class="box-header with-border">
                <h3 class="box-title">Filter</h3>
                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa {{$i_class}}"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
                
                    
                    @php($filters_search_all = array_chunk($search_filters,$chunk,true ))
                    @foreach($filters_search_all as $filters_search_chuck)
                    <div class="row">
                    @foreach($filters_search_chuck as $filter_key => $filter_attr)
                    <?php 
                    $not_hide = isset($filter_attr['hidden']) && $filter_attr['hidden']==true?false:true;
                    $class = isset($filter_attr['class'])?$filter_attr['class']:'';
                    $type = isset($filter_attr['type'])?$filter_attr['type']:'';
                    $attr = isset($filter_attr['attr'])?$filter_attr['attr']:[];
                    $i_class = isset($query['f'][$filter_key])?'text-red':'';
                    ?>
                    @if($not_hide)
                    <div class="{{$chunk_class}}">
                        <div class="form-group mb0">
                            <label class="text-sm">{{ $filter_attr["label"] }}</label>
                            <div class="input-group">
                                @if($type == 'text'||$type == 'date'||$type == 'daterange')
                                {{ Form::text('f['.$filter_key.']',null,$attr+['class'=>'form-control input-sm '.$class,'placeholder'=>$filter_attr["label"],'kp-action'=>'reset-to']) }}
                                @elseif($type == 'select')
                                {{ Form::select('f['.$filter_key.']',$filter_attr['options'],null,$attr+['class'=>'form-control input-sm '.$class,'placeholder'=>$filter_attr["label"],'kp-action'=>'reset-to']) }}
                                @endif
                                <div class="input-group-addon" kp-action="reset" style="cursor: pointer;">
                                    <i class="fa fa-close"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    </div>
                    @endforeach             
            </div>
            <div class="box-footer">
                <input type="submit" class="btn btn-primary btn-sm" name="submit_search" form="form-advanced-search" value="Search">
                <a class="btn btn-default btn-sm" href="{{url(request()->getPathInfo())}}" name="reset" form="search">Reset</a>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>
@endif
@push('script')
<script type="text/javascript">
    $(document).ready(function(){
       AdvancedSearch.init();
    });
</script>
@endpush