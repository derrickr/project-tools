@extends('layouts.login')
@section('title', 'Operating Procedure')
@section('content')
@include('layouts.partials.message')
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Work Request System - Operating Procedure</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <!-- 1. New WorkRequest -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">1. New WorkRequest</h3>
                    </div>
                    <div class="box-body">
                        <p class="text-muted well well-sm no-shadow">Clicking upon New Request provides the blank Description template. All fields are mandatory.<br>
                            <br>When complete one of the following Action buttons must be selected:</p>
                        <table class="table table-bordered docs-table">
                            <thead>
                                <tr>
                                    <th>Action button</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>Submit</b> creates the record for the new work request and notification is sent to the Assessor.</td>
                                    <td>No modal screen.<br>Record is created in the database.</td>
                                    <td><b>New</b></td>
                                </tr>
                                <tr>
                                    <td><b>Fast Track</b> provides a facility to capture information for small / inject work. Useful for past/future effort analysis.</td>
                                    <td>No modal screen.<br>Record is created in the database.</td>
                                    <td><b>Fast Track</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- 2. Status: New -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title ">2. Status: New</h3>
                    </div>
                    <div class="box-body">
                        <p class="text-muted well well-sm no-shadow">Once submitted, the Requester can review the Description and has the option to select one of the following Action buttons (for requests they have submitted):</p>
                        <table class="table table-bordered docs-table">
                            <thead>
                                <tr>
                                    <th>Action button</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>Update</b> adds a new record (for audit trail), resets its status to new and sends a notification is sent to the Assessor.</td>
                                    <td>No modal screen.<br>Record is updated in the database.</td>
                                    <td><b>New</b></td>
                                </tr>
                                <tr>
                                    <td><b>Cancel</b> notifies the Requester and provides the Cancelled tab.</td>
                                    <td>Opens Cancel modal screen to allow additional comments.<br>Comments will be stored in the cancelledComment database field.<br>Accessible via the Cancelled tab.<br>The Cancelled tab will only be shown if the cancelledComment database field is NOT NULL.</td>
                                    <td><b>Cancelled</b></td>
                                </tr>
                            </tbody>
                        </table>
                        <br/>
                        <p class="text-muted well well-sm no-shadow">Otherwise, the Assessor reviews the Description and selects one of the following action buttons:</p>
                        <table class="table table-bordered docs-table">
                            <thead>
                                <tr>
                                    <th>Action button</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>Accept</b> notifies the Analyser.</td>
                                    <td>Opens Accept modal screen to allow additional comments.<br>Comments will be shown in the Accepted tab.</td>
                                    <td><b>Accepted</b></td>
                                </tr>
                                <tr>
                                    <td><b>MoreInfo</b> notifies the Requester.</td>
                                    <td>Opens MoreInfo modal screen to allow additional comments.<br>Comments will be stored in the moreInfoComment database field.<br>The MoreInfo modal screen will be accessible via a MoreInfoRequested? button under the Description, which will display the MoreInfo modal screen.<br>The MoreInfoRequested? button will only be shown if the moreInfoComment database field is NOT NULL.</td>
                                    <td><b>MoreInfo</b></td>
                                </tr>
                                <tr>
                                    <td><b>Reject</b> notifies the Requester and provides the Rejected tab.</td>
                                    <td>Opens Reject modal screen to allow additional comments.<br>Comments will be stored in the rejectComment database field.<br>Accessible via the Rejected tab.<br>The Rejected tab will only be shown if the rejectComment database field is NOT NULL.</td>
                                    <td><b>Rejected</b></td>
                                </tr>
                                <tr>
                                    <td><b>Cancel</b> notifies the Requester and provides the Cancelled tab.</td>
                                    <td>Opens Cancel modal screen to allow additional comments.<br>Comments will be stored in the cancelledComment database field.<br>Accessible via the Cancelled tab.<br>The Cancelled tab will only be shown if the cancelledComment database field is NOT NULL.</td>
                                    <td><b>Cancelled</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- 3. Status: Accepted -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">3. Status: Accepted</h3>
                    </div>
                    <div class="box-body">
                        <p class="text-muted well well-sm no-shadow">The Analyser reviews the Description, completes the Technical Analysis section (if possible) and clicks on one of the following Action buttons:</p>
                        <table class="table table-bordered docs-table">
                            <thead>
                                <tr>
                                    <th>Action button</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>Analysed</b> notifies the Scheduler.</td>
                                    <td>No modal screen.<br>Record is updated in the database.</td>
                                    <td><b>Analysed</b></td>
                                </tr>
                                <tr>
                                    <td><b>MoreInfo</b> notifies the Requester.</td>
                                    <td>Opens MoreInfo modal screen to allow additional comments.<br>Comments will be appended to the moreInfoComment database field.<br>The MoreInfo modal screen will be accessible via a MoreInfoRequested? button under the Description.<br>The MoreInfoRequested? button will only be shown if the moreInfoComment database field is NOT NULL.</td>
                                    <td><b>MoreInfo</b></td>
                                </tr>
                                <tr>
                                    <td><b>Reject</b> notifies the Requester and provides the Rejected tab.</td>
                                    <td>Opens Reject modal screen to allow additional comments.<br>Comments will be appended to the rejectComment database field.<br>Accessible via the Rejected tab.<br>The Rejected tab will only be shown if the rejectComment database field is NOT NULL.</td>
                                    <td><b>Rejected</b></td>
                                </tr>
                                <tr>
                                    <td><b>Cancel</b> notifies the Requester and provides the Cancelled tab.</td>
                                    <td>Opens Cancel modal screen to allow additional comments.<br>Comments will be appended to the cancelledComment database field.<br>Accessible via the Cancelled tab.<br>The Cancelled tab will only be shown if the cancelledComment database field is NOT NULL.</td>
                                    <td><b>Cancelled</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- 4. Status: Analysed -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">4. Status: Analysed</h3>
                    </div>
                    <div class="box-body">
                        <p class="text-muted well well-sm no-shadow">The Coster completes the Costs section (if required) and clicks on one of the following Action buttons:</p>
                        <table class="table table-bordered docs-table">
                            <thead>
                                <tr>
                                    <th>Action button</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>Costed</b> notifies the Scheduler.</td>
                                    <td>No modal screen.<br>Record is updated in the database.</td>
                                    <td><b>Costed</b></td>
                                </tr>
                                <tr>
                                    <td><b>MoreInfo</b> notifies the Requester.</td>
                                    <td>Opens MoreInfo modal screen to allow additional comments.<br>Comments will be appended to the moreInfoComment database field.<br>The MoreInfo modal screen will be accessible via a MoreInfoRequested? button under the Description.<br>The MoreInfoRequested? button will only be shown if the moreInfoComment database field is NOT NULL.</td>
                                    <td><b>MoreInfo</b></td>
                                </tr>
                                <tr>
                                    <td><b>Reject</b> notifies the Requester and provides the Rejected tab.</td>
                                    <td>Opens Reject modal screen to allow additional comments.<br>Comments will be appended to the rejectComment database field.<br>Accessible via the Rejected tab.<br>The Rejected tab will only be shown if the rejectComment database field is NOT NULL.</td>
                                    <td><b>Rejected</b></td>
                                </tr>
                                <tr>
                                    <td><b>Cancel</b> notifies the Requester and provides the Cancelled tab.</td>
                                    <td>Opens Cancel modal screen to allow additional comments.<br>Comments will be appended to the cancelledComment database field.<br>Accessible via the Cancelled tab.<br>The Cancelled tab will only be shown if the cancelledComment database field is NOT NULL.</td>
                                    <td><b>Cancelled</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- 5. Status: Costed -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">5. Status: Costed</h3>
                    </div>
                    <div class="box-body">
                        <p class="text-muted well well-sm no-shadow">The Scheduler completes the Timescales section and clicks on one of the following Action buttons:</p>
                        <table class="table table-bordered docs-table">
                            <thead>
                                <tr>
                                    <th>Action button</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>Scheduled</b> notifies the Approver.</td>
                                    <td>No modal screen.<br>Record is updated in the database.</td>
                                    <td><b>Scheduled</b></td>
                                </tr>
                                <tr>
                                    <td><b>MoreInfo</b> notifies the Requester.</td>
                                    <td>Opens MoreInfo modal screen to allow additional comments.<br>Comments will be appended to the moreInfoComment database field.<br>The MoreInfo modal screen will be accessible via a MoreInfoRequested? button under the Description.<br>The MoreInfoRequested? button will only be shown if the moreInfoComment database field is NOT NULL.</td>
                                    <td><b>MoreInfo</b></td>
                                </tr>
                                <tr>
                                    <td><b>Reject</b> notifies the Requester and provides the Rejected tab.</td>
                                    <td>Opens Reject modal screen to allow additional comments.<br>Comments will be appended to the rejectComment database field.<br>Accessible via the Rejected tab.<br>The Rejected tab will only be shown if the rejectComment database field is NOT NULL.</td>
                                    <td><b>Rejected</b></td>
                                </tr>
                                <tr>
                                    <td><b>Cancel</b> notifies the Requester and provides the Cancelled tab.</td>
                                    <td>Opens Cancel modal screen to allow additional comments.<br>Comments will be appended to the cancelledComment database field.<br>Accessible via the Cancelled tab.<br>The Cancelled tab will only be shown if the cancelledComment database field is NOT NULL.</td>
                                    <td><b>Cancelled</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- 6. Status: Scheduled -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">6. Status: Scheduled</h3>
                    </div>
                    <div class="box-body">
                        <p class="text-muted well well-sm no-shadow">The Approver reviews all sections and clicks on one of the following Action buttons:</p>
                        <table class="table table-bordered docs-table">
                            <thead>
                                <tr>
                                    <th>Action button</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>Approved</b> notifies the Scheduler and the Implementer.</td>
                                    <td>Opens Approved modal screen to allow additional comments.<br>Comments will be shown in the Accepted tab.</td>
                                    <td><b>Approved</b></td>
                                </tr>
                                <tr>
                                    <td><b>MoreInfo</b> notifies the Requester.</td>
                                    <td>Opens MoreInfo modal screen to allow additional comments.<br>Comments will be appended to the moreInfoComment database field.<br>The MoreInfo modal screen will be accessible via a MoreInfoRequested? button under the Description.<br>The MoreInfoRequested? button will only be shown if the moreInfoComment database field is NOT NULL.</td>
                                    <td><b>MoreInfo</b></td>
                                </tr>
                                <tr>
                                    <td><b>Reject</b> notifies the Requester and provides the Rejected tab.</td>
                                    <td>Opens Reject modal screen to allow additional comments.<br>Comments will be appended to the rejectComment database field.<br>Accessible via the Rejected tab.<br>The Rejected tab will only be shown if the rejectComment database field is NOT NULL.</td>
                                    <td><b>Rejected</b></td>
                                </tr>
                                <tr>
                                    <td><b>Cancel</b> notifies the Requester and provides the Cancelled tab.</td>
                                    <td>Opens Cancel modal screen to allow additional comments.<br>Comments will be appended to the cancelledComment database field.<br>Accessible via the Cancelled tab.<br>The Cancelled tab will only be shown if the cancelledComment database field is NOT NULL.</td>
                                    <td><b>Cancelled</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- 7. Status: Approved -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">7. Status: Approved</h3>
                    </div>
                    <div class="box-body">
                        <p class="text-muted well well-sm no-shadow">The Implementer carries out the work and selects one of the following Action buttons in the Implemented section:</p>
                        <table class="table table-bordered docs-table">
                            <thead>
                                <tr>
                                    <th>Action button</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>Implemented</b> notifies the Tester.</td>
                                    <td>Opens Implemented modal screen to allow additional comments.<br>Comments will be shown in the Implemented tab.</td>
                                    <td><b>Implemented</b></td>
                                </tr>
                                <tr>
                                    <td><b>MoreTime</b> notifies the stakeholders that the request needs to be re-assessed.</td>
                                    <td>Opens MoreTime modal screen to allow additional comments.<br>Comments will be stored in the moreTimeComment database field.<br>The MoreTime modal screen will be accessible via a MoreTimeRequested? button under the Description.<br>The MoreTimeRequested? button will only be shown if the moreTimeComment database field is NOT NULL.</td>
                                    <td><b>MoreTime</b></td>
                                </tr>
                                <tr>
                                    <td><b>Rework</b> notifies the stakeholders that the request needs to be re-assessed and provides the Rework tab.</td>
                                    <td>Opens Rework modal screen to allow additional comments.<br>Comments will be stored in the reworkComment database field.<br>Accessible via the Rework tab.<br>The Rework tab will only be shown if the reworkComment database field is NOT NULL.</td>
                                    <td><b>Rework</b></td>
                                </tr>
                                <tr>
                                    <td><b>Backout</b> notifies the stakeholders that the implementation will be backed out (as per the provisional agreement in the Analysis) and provides the backout tab.</td>
                                    <td>Opens Backout modal screen to allow additional comments.<br>Comments will be stored in the backoutComment database field.<br>Accessible via the Backout tab.<br>The Backout tab will only be shown if the backoutComment database field is NOT NULL.</td>
                                    <td><b>Backout</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- 8. Status: Implemented -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">8. Status: Implemented</h3>
                    </div>
                    <div class="box-body">
                        <p class="text-muted well well-sm no-shadow">The Tester tests the implementation and selects one of the following Action buttons in the Test Results section:</p>
                        <table class="table table-bordered docs-table">
                            <thead>
                                <tr>
                                    <th>Action button</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>Pass</b> notifies the stakeholders and sets the status to Completed.</td>
                                    <td>No modal screen.<br>Record is updated in the database.</td>
                                    <td><b>Completed</b></td>
                                </tr>
                                <tr>
                                    <td><b>Failed</b> notifies the stakeholders.</td>
                                    <td>Opens Failed modal screen to allow additional comments.<br>Comments will be stored in the failedComment database field.<br>Accessible in the Test Results screen section under the Test Results.<br>Will only be shown if the failedComment database field is NOT NULL.</td>
                                    <td><b>Failed</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- 9. Status: Failed Testing -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">9. Status: Failed Testing</h3>
                    </div>
                    <div class="box-body">
                        <p class="text-muted well well-sm no-shadow">If the request is in a Failed state, the Implementer has the option to click on one of the following Action buttons in the Test Results section:</p>
                        <table class="table table-bordered docs-table">
                            <thead>
                                <tr>
                                    <th>Action button</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>Implemented</b>, if enough time is available within the Planned Finish date.<br>
                                        <span style="font-style:italic; font-size:12px;">This Action button will only be available if adequate time is available!</span></td>
                                    <td>Opens Implemented modal screen to allow additional comments.<br>Comments will be shown in the Implemented tab.</td>
                                    <td><b>Implemented</b></td>
                                </tr>
                                <tr>
                                    <td><b>MoreTime</b> notifies the stakeholders that the request needs to be re-assessed.</td>
                                    <td>Opens MoreTime modal screen to allow additional comments.<br>Comments will be appended to the the moreTimeComment database field.<br>The MoreTime modal screen will be accessible via a MoreTimeRequested? button under the Description.<br>The MoreTimeRequested? button will only be shown if the moreTimeComment database field is NOT NULL.</td>
                                    <td><b>MoreTime</b></td>
                                </tr>
                                <tr>
                                    <td><b>Rework</b> notifies the stakeholders that the request needs to be re-assessed and provides the Rework tab.</td>
                                    <td>Opens Rework modal screen to allow additional comments.<br>Comments will be appended to the reworkComment database field.<br>Accessible via the Rework tab.<br>The Rework tab will only be shown if the reworkComment database field is NOT NULL.</td>
                                    <td><b>Rework</b></td>
                                </tr>
                                <tr>
                                    <td><b>Backout</b> notifies the stakeholders that the implementation will be backed out (as per the provisional agreement in the Analysis) and provides the backout tab.</td>
                                    <td>Opens Backout modal screen to allow additional comments.<br>Comments will be appended to the backoutComment database field.<br>Accessible via the Backout tab.<br>The Backout tab will only be shown if the backoutComment database field is NOT NULL.</td>
                                    <td><b>Backout</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- 10. Status: Cancelled / Rejected / Backed Out -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">10. Status: Cancelled / Rejected / Backed Out</h3>
                    </div>
                    <div class="box-body">
                        <p class="text-muted well well-sm no-shadow">If the request is in a Cancelled, Rejected or Backed Out state it can be Reopened by the Assessor, Analyser, Scheduler or Approver, by selecting the Reopen Action button on the relevant Cancelled, Rejected or Backed Out tab:</p>
                        <table class="table table-bordered docs-table">
                            <thead>
                                <tr>
                                    <th>Action button</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>Reopen</b> notifies the stakeholders that the request needs to be re-assessed and provides the Reopened tab.</td>
                                    <td>Opens Reopened modal screen to allow additional comments.<br>Comments will be shown in the Reopened tab.</td>
                                    <td><b>Reopened</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- 11. Actions -> Status -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">11. Actions &amp; their corresponding status</h3>
                    </div>
                    <div class="box-body">
                        <p class="text-muted well well-sm no-shadow">This table shows the ongoing status when a specific action is carried out:</p>
                        <table class="table table-bordered docs-table">
                    <tbody>
                        <tr>
                            <th>Action</th><th>Status</th>
                        </tr>
                        <tr>
                            <td>accept</td><td>accepted</td>
                        </tr>
                        <tr>
                            <td>analysed</td><td>analysed</td>
                        </tr>
                        <tr>
                            <td>approved</td><td>approved</td>
                        </tr>
                        <tr>
                            <td>backout</td><td>backout</td>
                        </tr>
                        <tr>
                            <td>cancel</td><td>cancelled</td>
                        </tr>
                        <tr>
                            <td>costed</td><td>costed</td>
                        </tr>
                        <tr>
                            <td>failed</td><td>failed testing</td>
                        </tr>
                        <tr>
                            <td>fast track</td><td>fast tracked</td>
                        </tr>
                        <tr>
                            <td>implemented</td><td>implemented</td>
                        </tr>
                        <tr>
                            <td>moreinfo</td><td>moreinfo</td>
                        </tr>
                        <tr>
                            <td>moretime</td><td>moretime</td>
                        </tr>
                        <tr>
                            <td>pass</td><td>completed</td>
                        </tr>
                        <tr>
                            <td>reject</td><td>rejected</td>
                        </tr>
                        <tr>
                            <td>reopen</td><td>reopened</td>
                        </tr>
                        <tr>
                            <td>rework</td><td>rework</td>
                        </tr>
                        <tr>
                            <td>scheduled</td><td>scheduled</td>
                        </tr>
                        <tr>
                            <td>submit</td><td>new</td>
                        </tr>
                        <tr>
                            <td>update</td><td>new</td>
                        </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('script')
<script>

</script>
@endpush