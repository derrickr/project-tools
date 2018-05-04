@extends('layouts.login')
@section('title')
@if($request->id)
Request
@else
New Request
@endif
@endsection
@section('content')
@include('layouts.partials.message')
<div class="row">
    <div class="col-md-12">
        
        <div class="box box-primary box-solid">
            <div class="box-header with-border text-center">
                @if($request->id)
                <h3 class="box-title">Work Request #{{$request->req_no}} | Status: {!! mylabel('request',$request->status)!!}</h3>
                <?php
                    if($request->id ){
                        $req_no = '<a href="'. route('request.create',['id' => $minRecord]) .'" class="btn btn-success btn-sm ad-click-event" title="Original Request">Original</a>';
                        $history = '<a href="'. route('request.history',['id' => $request->req_no]) .'" class="btn btn-success btn-sm ad-click-event" title="History">History</a>';
                        $latest = '<a href="'. route('request.create',['id' => $request->latest]) .'" class="btn btn-success btn-sm ad-click-event" title=Latest update>Latest</a>';
                        
                        switch($requestCount) {
                            case 1:
                                $req_no = "";
                                $history = "";
                                $latest = "";
                                break;
                            case 2:
                                if ($request->id < $request->latest){
                                    $req_no = "";
                                } else {
                                    $latest = "";
                                }
                                break;
                            default:
                                if($request->id == $minRecord){
                                    $req_no = "";
                                }
                                elseif($request->id == $request->latest) {
                                    $latest = "";
                                }
                        }
                        echo '<div class="row row-middle"><div class="col-md-4 text-center">' . $req_no . '</div>' .
                            '<div class="col-md-4 text-center">' . $history . '</div>' .
                            '<div class="col-md-4 text-center">' . $latest . '</div></div>';
                
                    }
                ?>
                @else
                <h3 class="box-title">Add Request</h3>
                @endif
            </div>
            <div class="box-body">

                <div class="nav-tabs-custom" id="tab-requests">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#description_tab" data-toggle="tab" aria-expanded="true">Description</a></li>
                        
                        @if($request->status =='Cancelled' || $request->cancelled_comment != NULL)
                        <li><a href="#cancelled_tab" data-toggle="tab" aria-expanded="true" ><b class="text-red">Cancelled</b></a></li>
                        @endif
                        
                        @if($request->status =='Accepted' || $request->accepted_comment != NULL)
                        <li><a href="#accepted_tab" data-toggle="tab" aria-expanded="true">Assessed</a></li>
                        @endif
                        
                        @if($request->status == "Accepted" || $request->accepted_date)
                        <li><a href="#analysis_tab" data-toggle="tab" aria-expanded="true">Analysis</a></li>
                        @endif
                        
                        @if($request->status =="Accepted" || $request->accepted_date != NULL)
                        <li><a href="#cost_tab" data-toggle="tab" aria-expanded="true">Costs</a></li>
                        @endif
                        
                        @if($request->analysed_date || $request->costed_date)
                        <li><a href="#timescales_tab" data-toggle="tab" aria-expanded="true">Timescale</a></li>
                        @endif
                        
                        @if($request->status =='Rejected' || $request->rejected_comment != NULL)
                        <li><a href="#rejected_tab" data-toggle="tab" aria-expanded="true">Rejected</a></li>
                        @endif
                        
                        @if($request->status =='Approved' || $request->scheduled_date != NULL)
                        <li><a href="#approved_tab" data-toggle="tab" aria-expanded="true">Approval</a></li>
                        @endif
                        
                        @if($request->status =='Implemented' || $request->approved_date != NULL)
                        <li><a href="#implemented_tab" data-toggle="tab" aria-expanded="true">Implemented</a></li>
                        @endif
                        
                        @if($request->status =='Completed' || $request->status =='Failed' || $request->implemented_date != NULL)
                        <li><a href="#testresults_tab" data-toggle="tab" aria-expanded="true">Test Results</a></li>
                        @endif
                        
                        @if($request->status =='Backing Out' || $request->backout_comment != NULL)
                        <li><a href="#backout_tab" data-toggle="tab" aria-expanded="true">Backout</a></li>
                        @endif
                        
                        @if($request->status =='Reworking' || $request->rework_comment != NULL)
                        <li><a href="#rework_tab" data-toggle="tab" aria-expanded="true">Rework</a></li>
                        @endif
                        
                        @if($request->status =='Reopened' || $request->reopened_comment != NULL)
                        <li><a href="#reopened_tab" data-toggle="tab" aria-expanded="true">Reopened</a></li>
                        @endif
                        
                        @if(!$request->id)
                        <li class="pull-right"><button type="button" class="btn btn-success btn-sm" kp-toggle="fasttrack"><i class="fa fa-fw fa-rocket"></i> Fast Track</button></li>
                        @endif
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="description_tab">
                            @include('request.partial.description_tab')
                        </div>
                        
                        <!-- Cancelled -->
                        @if($request->status =='Cancelled' || $request->cancelled_comment != NULL)
                        <div class="tab-pane" id="cancelled_tab">
                            @include('request.partial.cancelled_tab')
                        </div>
                        @endif
                        
                        <!-- Accepted -->
                        @if($request->status =='Accepted' || $request->accepted_comment != NULL)
                        <div class="tab-pane" id="accepted_tab">
                            @include('request.partial.accepted_tab')
                        </div>
                        @endif

                        <!-- Analysis -->
                        @if($request->status =="Accepted" || $request->accepted_date)
                        <div class="tab-pane" id="analysis_tab">
                            @include('request.partial.analysis_tab')
                        </div>
                        @endif
                        
                        <!-- Cost -->
                        @if($request->status =="Accepted" || $request->accepted_date  != NULL)
                        <div class="tab-pane" id="cost_tab">
                            @include('request.partial.cost_tab')
                        </div>
                        @endif
                        
                        <!-- Timescales -->
                        @if($request->analysed_date || $request->costed_date)
                        <div class="tab-pane" id="timescales_tab">
                            @include('request.partial.timescales_tab')
                        </div>
                        @endif
                        
                        <!-- Rejected -->
                        @if($request->status =='Rejected' || $request->rejected_comment != NULL)
                        <div class="tab-pane" id="rejected_tab">
                            @include('request.partial.rejected_tab')
                        </div>
                        @endif
                        
                        <!-- Approved -->
                        @if($request->status =='Approved' || $request->scheduled_date != NULL)
                        <div class="tab-pane" id="approved_tab">
                            @include('request.partial.approved_tab')
                        </div>
                        @endif
                        
                        <!-- Implemented -->
                        @if($request->status =='Implemented' || $request->approved_date != NULL)
                        <div class="tab-pane" id="implemented_tab">
                            @include('request.partial.implemented_tab')
                        </div>
                        @endif
                        
                        <!-- Testresults -->
                        @if($request->status =='Accepted' || $request->implemented_date != NULL)
                        <div class="tab-pane" id="testresults_tab">
                            @include('request.partial.testresults_tab')
                        </div>
                        @endif
                        
                        <!-- Backing Out -->
                        @if($request->status =='Backing Out' || $request->backout_comment != NULL)
                        <div class="tab-pane" id="backout_tab">
                            @include('request.partial.backout_tab')
                        </div>
                        @endif
                        
                        <!-- Reworking -->
                        @if($request->status =='Reworking' || $request->rework_comment != NULL)
                        <div class="tab-pane" id="rework_tab">
                            @include('request.partial.rework_tab')
                        </div>
                        @endif
                        
                        <!-- Reopened -->
                        @if($request->status =='Reopened' || $request->reopened_comment != NULL)
                        <div class="tab-pane" id="reopened_tab">
                            @include('request.partial.reopened_tab')
                        </div>
                        @endif
                        
                    </div>
                    <!-- /.tab-content -->
                </div>


            </div>
        </div>
        <!-- nav-tabs-custom -->
    </div>
    <!-- /.col -->
</div>
@endsection
@php(app()->phptojs->put('js_data', [
'id'=>$request->id
]))
@push('script')
<script>
    $(document).ready(function () {
        Requests.init_edit(window.js_data);
    });
</script>
@endpush