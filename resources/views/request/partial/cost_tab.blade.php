{!! Form::model($request,['autocomplete'=>'off','id'=>'form_request_cost']) !!}
{{ Form::hidden('_method', 'PUT') }}
{{ Form::hidden('id', null) }}
<?php
$can_edit = ['readonly'=>'readonly','disabled'=>'disabled'];
$can_edit_text = 'readonly="readonly" disabled ="disabled"';
if(auth()->user()->isRoleIn(['coster','admin','projectmanager'])){
    $can_edit = [];
    $can_edit_text = [];
}
?>
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="box box-solid box-info">
            <div class="box-header text-center">
                <h4 class="box-title">Costs</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table no-border">
                    <tbody>
                        <tr>
                            <td><b>Analysis Costs:</b></td>
                            <td>Manpower {{ Form::hidden('manpower_cost', $request->manpower_cost) }} ({{ currency($request->manpower_cost,'&pound;','&pound; 0') }}) and capex costs {{ Form::hidden('capex_cost', $request->capex_cost) }} (&#163; {{number_format( $request->capex_cost) }}) </td>
                            <td id="anaCost">{{ currency($request->manpower_cost + $request->capex_cost,'&pound;','&pound; 0') }}</td>
                        </tr>
                        <tr>
                            <td colspan="3"><hr class="nm"/></td>
                        </tr>
                        <tr>
                            <td><b>Additional Costs:</b></td>
                            <td>{{ Form::textarea('costs',$request->costs,$can_edit+['id'=>'Costs','class'=>'form-control resize','Please indicate / estimate any additional costs, including internal and/or external resources.','rows'=>1]) }}</td>

                            <td>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        &#163;
                                    </div>
                                    {{ Form::text('add_cost',null,$can_edit+['id'=>'addCost','class'=>'form-control decimal', 'onkeyup'=>'totCost()']) }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"><hr class="nm"/></td>
                        </tr>
                        <tr>
                            <td><b>Total Cost:</b></td>
                            <td></td>
                    <script type="text/javascript">
                        function totCost() {
                            var anaCost = <?php echo $request->manpower_cost + $request->capex_cost; ?>;
                            var addCost = document.getElementById('addCost').value;
                            addCost = addCost.replace(",", "");
                            if (anaCost == "") {
                                anaCost = 0;
                            }
                            if (addCost == "") {
                                addCost = 0;
                            }
                            var result = parseInt(anaCost) + parseInt(addCost);
                            if (!isNaN(result)) {
                                document.getElementById('totCost').innerHTML = result.toLocaleString('en');
                            }
                        }
                    </script>
                    <td>&#163; <span id="totCost"><script>totCost();</script></span></td>
                    </tr>
                    </tbody>
                </table>    
            </div>
        </div>
    </div>
</div>
<?php if ($request->costed_comment){ ?>
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="box box-solid box-info">
            <div class="box-header text-center">
                <h4 class="box-title">Costing Comment</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group comment"><?php echo ($request->costed_comment) ? trim($request->costed_comment) : "<span class='descrete'>Costing text will be displayed here.</span>"; ?></div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
@include('request.partial.button',['tab'=>'cost'])
{!! Form::close() !!}