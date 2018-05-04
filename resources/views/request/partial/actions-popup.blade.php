<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>
    <h4 class="modal-title">{{ucfirst($action)}}: {{$request->title}}</h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            @include('layouts.partials.message')
            {!! Form::model($request,['route'=>['request.action',$action,$request->id],'autocomplete'=>'off']) !!}
            <div class="col-md-12 form-group">
                {{ Form::hidden('action',$action) }}
                {{ Form::hidden('_method', 'PUT') }}
                {{ Form::hidden('id', null) }}
                {{ Form::hidden('_id', my_encrypt($request->id)) }}
                @php
                    $btntext = 'Save';
                @endphp
                @if($action == 'cancel')
                    {{ Form::textarea('cancelled_comment',$request->cancelled_comment,['id'=>'cancelled_comment','required'=>'required','class'=>'form-control','placeholder'=>'Please state why this request is being cancelled.','rows'=>3]) }}
                    {{ Form::hidden('_form_hidden','form_request_update') }}
                    @php
                        $btntext = 'Cancel';
                    @endphp
                @elseif($action == 'reject')
                    {{ Form::textarea('rejected_comment',$request->rejected_comment,['id'=>'rejected_comment','required'=>'required','class'=>'form-control','placeholder'=>'Please state why this request is being rejected.','rows'=>3]) }}
                    {{ Form::hidden('_form_hidden','form_request_update') }}
                    @php
                        $btntext = 'Reject';
                    @endphp
                @elseif($action == 'more-info')
                    {{ Form::textarea('more_info_comment',$request->more_info_comment,['id'=>'more_info_comment','required'=>'required','class'=>'form-control','placeholder'=>'Please state why you need more information.','rows'=>3]) }}
                    {{ Form::hidden('_form_hidden','form_request_update') }}
                    @php
                        $btntext = 'More Info';
                    @endphp
                @elseif($action == 'accept')
                    {{ Form::textarea('accepted_comment',$request->accepted_comment,['id'=>'accepted_comment','class'=>'form-control','placeholder'=>'Please add any comments here.','rows'=>3]) }}
                    {{ Form::hidden('_form_hidden','form_request_update') }}
                    @php
                        $btntext = 'Accept';
                    @endphp
                @elseif($action == 'update')
                    {{ Form::textarea('updated_comment',$request->updated_comment,['id'=>'updated_comment','required'=>'required','class'=>'form-control','placeholder'=>'Please state why this request is being updated.','rows'=>3]) }}
                    {{ Form::hidden('_form_hidden','form_request_update') }}
                    @php
                        $btntext = 'Update';
                    @endphp
                @elseif($action == 'analysed')
                    {{ Form::textarea('analysed_comment',$request->analysed_comment,['id'=>'analysed_comment','class'=>'form-control','placeholder'=>'Please add any comments here.','rows'=>3]) }}
                    {{ Form::hidden('_form_hidden','form_request_analysed') }}
                    @php
                        $btntext = 'Analysed';
                    @endphp
                @elseif($action == 'costed')
                    {{ Form::textarea('costed_comment',$request->costed_comment,['id'=>'costed_comment','class'=>'form-control','placeholder'=>'Please add any comments here.','rows'=>3]) }}
                    {{ Form::hidden('_form_hidden','form_request_cost') }}
                    @php
                        $btntext = 'Costed';
                    @endphp
                @elseif($action == 'approved')
                    {{ Form::textarea('approved_comment',$request->approved_comment,['id'=>'approved_comment','class'=>'form-control','placeholder'=>'Please add any comments here.','rows'=>3]) }}
                    {{ Form::hidden('_form_hidden','form_request_approved') }}
                    @php
                        $btntext = 'Approved';
                    @endphp
                @elseif($action == 'scheduled')
                    {{ Form::textarea('scheduled_comment',$request->scheduled_comment,['id'=>'scheduled_comment','class'=>'form-control','placeholder'=>'Please add any comments here.','rows'=>3]) }}
                    {{ Form::hidden('_form_hidden','form_request_scheduled') }}
                    @php
                        $btntext = 'Scheduled';
                    @endphp
                @elseif($action == 'backout')
                    {{ Form::textarea('backout_comment',$request->backout_comment,['id'=>'backout_comment','required'=>'required','class'=>'form-control','placeholder'=>'Please state why this request is being backed out.','rows'=>3]) }}
                    {{ Form::hidden('_form_hidden','form_request_moretime') }}
                    @php
                        $btntext = 'Backout';
                    @endphp
                @elseif($action == 'backedout')
                    {{ Form::textarea('backedout_comment',$request->backedout_comment,['id'=>'backedout_comment','class'=>'form-control','placeholder'=>'Please state why this request is being backed out.','rows'=>3]) }}
                    {{ Form::hidden('_form_hidden','form_request_backout') }}
                    @php
                        $btntext = 'Backout';
                    @endphp
                @elseif($action == 'implemented')
                    {{ Form::textarea('implemented_comment',$request->implemented_comment,['id'=>'implemented_comment','class'=>'form-control','placeholder'=>'Please add any comments here.','rows'=>3]) }}
                    {{ Form::hidden('_form_hidden','form_request_moretime') }}
                    @php
                        $btntext = 'Implemented';
                    @endphp
                @elseif($action == 'moretime')
                    {{ Form::textarea('more_time_comment',$request->more_time_comment,['id'=>'more_time_comment','required'=>'required','class'=>'form-control','placeholder'=>'Please state why this request requires More Time.','rows'=>3]) }}
                    {{ Form::hidden('_form_hidden','form_request_moretime') }}
                    @php
                        $btntext = 'More Time';
                    @endphp
                @elseif($action == 'rework')
                    {{ Form::textarea('rework_comment',$request->rework_comment,['id'=>'rework_comment','class'=>'form-control','required'=>'required','placeholder'=>'Please state why this request requires to be Reworked.','rows'=>3]) }}
                    {{ Form::hidden('_form_hidden','form_request_moretime') }}
                    @php
                        $btntext = 'Rework';
                    @endphp
                @elseif($action == 'reopen')
                    {{ Form::textarea('reopened_comment',$request->reopened_comment,['id'=>'reopened_comment','required'=>'required','class'=>'form-control','placeholder'=>'Please state why this request requires to be Reopened.','rows'=>3]) }}
                    {{ Form::hidden('_form_hidden','form_request_rejected') }}
                    @php
                        $btntext = 'Reopen';
                    @endphp
                @endif
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default pull-left cancel" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary pull-left" kp-submit="request-action">{{ $btntext }}</button>
</div>


