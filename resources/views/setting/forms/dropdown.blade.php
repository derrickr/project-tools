<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">{{$dropdown->display_name}}</h3>
    </div>
    <div class="box-body">
        @include('layouts.partials.message')
        {!!Form::open(['route'=>['setting.update',$dropdown->dropdown],'class'=>'form-horizontal'])!!}
        @php($i=0)
        @php($pricing = false)
        @php($pl = 9)
        @php($pricing = $dropdown->hasCosting())
        @php($pricing_more = $dropdown->hasMultipleCosting())
        @foreach($dropdown as $option)
        @if($dropdown->type == "single")
        <div class="form-group">
            <div class="col-md-4">
                {{ Form::text('option['.$i.']',$option , ['id'=>'dropdown_label_'.$i,'class'=>'form-control']) }}
            </div>
        </div>
        @else
        @php($option = collect($option))
        <div class="form-group">
            {{ Form::label('option['.$i.'][label]', 'Label',['class'=>'control-label col-md-1'])}}
            <div class="col-md-2">
                {{ Form::text('option['.$i.'][label]',$option->get('label') , ['id'=>'dropdown_label_'.$i,'class'=>'form-control']) }}
            </div>
            @if($pricing)
            @php($pl = 12)
            {{ Form::label('option['.$i.'][cost]', 'Cost',['class'=>'control-label col-md-1'])}}
            <div class="col-md-2">
                <div class="input-group">
                <div class="input-group-addon">£</div>
                {{ Form::text('option['.$i.'][cost]',$option->get('cost') , ['id'=>'dropdown_cost_'.$i,'class'=>'form-control decimal']) }}
                </div>
            </div>
            @endif
            @if($pricing_more)
            @php($pl = 12)
            {{ Form::label('option['.$i.'][cost]', 'Cost With/Without',['class'=>'control-label col-md-2'])}}
            <div class="col-md-1 pa0">
                <div class="input-group">
                <div class="input-group-addon">£</div>
                {{ Form::text('option['.$i.'][cost_with]',$option->get('cost_with') , ['id'=>'dropdown_cost_with_'.$i,'class'=>'form-control decimal']) }}
                </div>
            </div>
            <div class="col-md-1 pa0">
                <div class="input-group">
                <div class="input-group-addon">/</div>
                {{ Form::text('option['.$i.'][cost_without]',$option->get('cost_without') , ['id'=>'dropdown_cost_without_'.$i,'class'=>'form-control decimal']) }}
                </div>
            </div>
            <div class="col-md-1 pa0">
                <div class="input-group">
                <div class="input-group-addon">X</div>
                {{ Form::text('option['.$i.'][cost_multiplier]',$option->get('cost_multiplier') , ['id'=>'dropdown_cost_multiplier_'.$i,'class'=>'form-control decimal']) }}
                </div>
            </div>
            @endif
            {{ Form::label('option['.$i.'][value]', 'Value',['class'=>'control-label col-md-1'])}}
            <div class="col-md-1">
                {{ Form::text('option['.$i.'][value]', $option->get('value'), ['id'=>'dropdown_value_'.$i,'class'=>'form-control','readonly'=>'readonly']) }}
            </div>
            {{ Form::label('option['.$i.'][deleted]', 'Deleted',['class'=>'control-label col-md-1'])}}
            <div class="col-md-1">
                {{Form::hidden('option['.$i.'][deleted]', '0')}}
                {{Form::checkbox('option['.$i.'][deleted]', '1', $option->get('deleted'), ['id'=>'dropdown_deleted_'.$i,'class'=>'form-control'])}}
            </div>
        </div>
        @endif
        @php($i++)
        @endforeach
        <noscript kp-template="dropdown_details">
        @if($dropdown->type == "single")
        <div class="form-group">
            <div class="col-md-4">
                {{ Form::text('option[#key#]',null , ['id'=>'dropdown_label_#key#','class'=>'form-control']) }}
            </div>
        </div>
        @else
        <div class="form-group">
            {{ Form::label('option[#key#][label]', 'Label',['class'=>'control-label col-md-1'])}}
            <div class="col-md-2">
                {{ Form::text('option[#key#][label]',null , ['id'=>'dropdown_label_#key#','class'=>'form-control']) }}
            </div>
            @if($pricing)
            @php($pl = 12)
            {{ Form::label('option[#key#][cost]', 'Cost',['class'=>'control-label col-md-1'])}}
            <div class="col-md-2">
                <div class="input-group">
                    <div class="input-group-addon">£</div>
                    {{ Form::text('option[#key#][cost]',null , ['id'=>'dropdown_cost_#key#','class'=>'form-control decimal']) }}
                </div>
            </div>
            @endif
            @if($pricing_more)
            @php($pl = 12)
            {{ Form::label('option[#key#][cost]', 'Cost With/Without',['class'=>'control-label col-md-2'])}}
            <div class="col-md-1 pa0">
                <div class="input-group">
                    <div class="input-group-addon">£</div>
                    {{ Form::text('option[#key#][cost_with]',null , ['id'=>'dropdown_cost_with_#key#','class'=>'form-control decimal']) }}
                </div>
            </div>
            <div class="col-md-1 pa0">
                <div class="input-group">
                    <div class="input-group-addon">/</div>
                    {{ Form::text('option[#key#][cost_without]',$option->get('cost') , ['id'=>'dropdown_cost_without_#key#','class'=>'form-control decimal']) }}
                </div>
            </div>
            <div class="col-md-1 pa0">
                <div class="input-group">
                    <div class="input-group-addon">X</div>
                    {{ Form::text('option[#key#][cost_multiplier]',$option->get('cost') , ['id'=>'dropdown_cost_multiplier_#key#','class'=>'form-control decimal']) }}
                </div>
            </div>
            @endif
            <div class="col-md-1"><a kp-action="remove"><span class="fa fa-close"></span></a></div>
        </div>
        @endif
        </noscript>
        <div kp-template-destination="dropdown_details"></div>
        <div class="row form-group">
            <div class="col-md-{{$pl}}">
                <div class="col-md-10 ">
                    {{Form::hidden('dropdown',$dropdown->dropdown )}}
                    
                    {{Form::hidden('last', $i,['id'=>'last_index'])}}
                    <div class="pull-left">
                    @if (!$dropdown->isFixed())
                    {{ Form::button('Add New',array('class'=>'btn btn-primary','kp-action'=>'dropdown_details', 'kp-refernce'=>$i)) }}
                    @endif
                    
                        {{ Form::button('Update',array('class'=>'btn btn-primary','kp-action'=>'save')) }}
                    </div>
                    
                </div>
            </div>
        </div>
        {!!Form::close()!!}
    </div>
</div>
<script>
    var pricing = '<?php echo $pricing;?>';
</script>