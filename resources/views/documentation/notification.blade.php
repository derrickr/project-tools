@extends('layouts.login')
@section('title', 'Notifications')
@section('content')
@include('layouts.partials.message')
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Notifications</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <p>There is a very fine balance between too much information and getting it just right.<br>
                <br>Whilst not wanting to become another spam machine, it is essential that communication of the status of the WorkRequest should be known when it transitions from one state to another. The requester will have a vested interest in what's happening at each stage and will be able to transparently see if there's any bottlenecks caused by someone not acting upon their responsibility in a timely manner. Additionally, by sending notifications at each state transition, it is expected that the requester will not have to keep asking for information and that the ongoing roles will not become frustrated at having to keep repeating themselves.<br>
                    <br>As the WorkRequest traverses through its life cycle it changes status depending upon the actions carried out by those responsible to transition the request from its current state to the next, as depicted in the basic process flowchart:<br>
                    <br>
                    <img src="{{asset('/images/workRequestBasic.png')}}" width="100%" class="rounded">
                    <i style="color:#9df;font-size:0.7em;">* please note this simplified process has been extracted from the <a href="/docs">main process</a> to show a WorkRequest moving along with no problems - the ideal scenario!</i>
                    <br>
                    <br>The system only allows those with specific roles to access their allowed actions for each request, depending on its status.<br><br>To ensure those responsible for the transitions know that they are expected to perform their allotted actions, emailed notifications are sent based upon the transition action as identified in the sections below.
                </p>

                <!-- 1. New -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">1. New</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered docs-table text-center">
                            <tr>
                                <th>Requester</th><th>Assessor</th><th>Analyser</th><th>Coster</th><th>Scheduler</th><th>Approver</th><th>Implementer</th><th>Tester</th>
                            </tr>
                            <tr>
                                <td>✔</td><td>✔</td><td></td><td></td><td></td><td></td><td></td><td></td>
                            </tr>
                        </table>
                        <br>
                        <p>When a New WorkRequest is submitted an email notification is sent to the original Requester for their information and to the Assessor.<br>
                        <br>At this early stage the request is only reviewed by the Assessor.<br>The rationale being that the request is first and foremost reviewed at business level, by the Assessor who determines if the request merits undertaking by the company. This aspect is fundamental to the system and process, since the business should be focussed on the most efficient use of its resources and especially them being used at the most effective and right time.<br>
                        <br>Specifically, technical resources should not be utilised on any work other than that which has been sanctioned by the business as being necessary and in line with the Operational and Strategic direction of the business, as defined by the business i.e. senior management.<br>
                        <br>If this aspect is not understood and fundamentally accepted by senior management, this system will not be appropriate for their business and they will continue to mis-manage their resources, time and work, ultimately resulting in the ongoing failed delivery of the company’s projects and wasted time/money.</p>
                    </div>
                </div>
                
                <!-- 2. Fast Tracked -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">2. Fast Tracked</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered docs-table text-center">
                            <tr>
                                <th>Requester</th><th>Assessor</th><th>Analyser</th><th>Coster</th><th>Scheduler</th><th>Approver</th><th>Implementer</th><th>Tester</th>
                            </tr>
                            <tr>
                                <td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td>
                            </tr>
                        </table>
                        <br>
                        <p>The Fast Track is a special case that should be rarely used, but has been included in an effort to capture relevant information on all those 10 minute jobs that turn out to be N hours.<br>
                        <br>It is expected that the Requester will collaborate with the Implementer, or their manager, to provide as much information as possible.<br>
                        <br>Upon submitting a Fast Track WorkRequest, its status will immediately be set to Fast Tracked and a notification will be sent to each of the roles defined in the table above to ensure they are all aware of the WorkRequest and the reason why it has been Fast Tracked.</p>
                    </div>
                </div>
                
                <!-- 3. Accepted -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">3. Accepted</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered docs-table text-center">
                            <tr>
                                <th>Requester</th><th>Assessor</th><th>Analyser</th><th>Coster</th><th>Scheduler</th><th>Approver</th><th>Implementer</th><th>Tester</th>
                            </tr>
                            <tr>
                                <td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td></td><td></td><td></td>
                            </tr>
                        </table>
                        <br>
                        <p>When the Assessor receives their notification that a new WorkRequest has been submitted, only they have the authority to Accept it as a viable piece of work that should be undertaken by the company.<br>
                        <br>Having reviewed the WorkRequest the Assessor may click on Accept to signify that the request should now be analysed.<br>
                        <br>An Accepted notification is sent to each of the roles identified in the above table to ensure they are aware that they are expected to carry out their specialist work for the request:</p>
                        <ul>
                            <li>Analyser Will Technically Analyse the request and deliver a viable technical solution for the business.</li>
                            <li>Coster Will collaborate with the Analyser to ensure all costs have been defined.</li>
                            <li>Scheduler Will collaborate with all relevant parties and the PMO to ensure that the necessary resources are available to deliver the technical solution.</li>
                        </ul>
                    </div>
                </div>
                
                <!-- 4. More Info -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">4. More Info</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered docs-table text-center">
                            <tr>
                                <th>Requester</th><th>Assessor</th><th>Analyser</th><th>Coster</th><th>Scheduler</th><th>Approver</th><th>Implementer</th><th>Tester</th>
                            </tr>
                            <tr>
                                <td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td></td><td></td>
                            </tr>
                        </table>
                        <br>
                        <p>More Information can be requested whilst the WorkRequest is being reviewed to ensure that all parties are happy that adequate attention and diligence has been considered for the WorkRequest.<br>
                        <br>Accordingly if those with the appropriate capability select More Info, a notification is sent to each of the roles identified in the above table to ensure they are aware of what is being asked.<br>
                        <br>The original Requester is then expected to provide the requested More Information which they can Update their request with, in order for the WorkRequest to continue its review.</p>
                    </div>
                </div>
                
                <!-- 5. Cancelled -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">5. Cancelled</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered docs-table text-center">
                            <tr>
                                <th>Requester</th><th>Assessor</th><th>Analyser</th><th>Coster</th><th>Scheduler</th><th>Approver</th><th>Implementer</th><th>Tester</th>
                            </tr>
                            <tr>
                                <td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td></td><td></td>
                            </tr>
                        </table>
                        <br>
                        <p>If the WorkRequest is Cancelled a notification is sent to each of the roles defined in the table above to ensure they are all aware of the Cancelled request and the reason why it has been Cancelled.<br>
                        <br>A WorkRequest can be Cancelled by any of the following roles:</p>
                        <ul>
                            <li>Requester</li>
                            <li>Assessor</li>
                            <li>Analyser</li>
                            <li>Coster</li>
                            <li>Scheduler</li>
                            <li>Approver</li>
                        </ul>
                    </div>
                </div>
                
                <!-- 6. Rejected -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">6. Rejected</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered docs-table text-center">
                            <tr>
                                <th>Requester</th><th>Assessor</th><th>Analyser</th><th>Coster</th><th>Scheduler</th><th>Approver</th><th>Implementer</th><th>Tester</th>
                            </tr>
                            <tr>
                                <td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td></td><td></td>
                            </tr>
                        </table>
                        <br>
                        <p>If the WorkRequest is Rejected a notification is sent to each of the roles defined in the table above to ensure they are all aware of the Rejected request and the reason why it has been Rejected.<br>
                        <br>A WorkRequest can be Rejected by any of the following roles:</p>
                        <ul>
                            <li>Assessor</li>
                            <li>Analyser</li>
                            <li>Coster</li>
                            <li>Scheduler</li>
                            <li>Approver</li>
                        </ul>
                    </div>
                </div>
                
                <!--7. Analysed -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">7. Analysed</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered docs-table text-center">
                            <tr>
                                <th>Requester</th><th>Assessor</th><th>Analyser</th><th>Coster</th><th>Scheduler</th><th>Approver</th><th>Implementer</th><th>Tester</th>
                            </tr>
                            <tr>
                                <td>✔</td><td></td><td>✔</td><td>✔</td><td>✔</td><td></td><td></td><td></td>
                            </tr>
                        </table>
                        <br>
                        <p>Once the Technical Analysis has been carried out the Analyser is expected to click upon the Analysed button and an Analysed notification is sent to each of the roles defined in the table above to ensure they are all aware that the WorkRequest has been Analysed.</p>
                    </div>
                </div>
                
                <!-- 8. Costed -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">8. Costed</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered docs-table text-center">
                            <tr>
                                <th>Requester</th><th>Assessor</th><th>Analyser</th><th>Coster</th><th>Scheduler</th><th>Approver</th><th>Implementer</th><th>Tester</th>
                            </tr>
                            <tr>
                                <td>✔</td><td></td><td>✔</td><td>✔</td><td>✔</td><td></td><td></td><td></td>
                            </tr>
                        </table>
                        <br>
                        <p>Once the WorkRequest has been reviewed from a financial aspect and all costs have been identified the Coster is expected to click upon the Costed button and a Costed notification is sent to each of the roles defined in the table above to ensure they are all aware that the WorkRequest has been Costed.</p>
                    </div>
                </div>
                
                <!-- 9. Scheduled -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">9. Scheduled</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered docs-table text-center">
                            <tr>
                                <th>Requester</th><th>Assessor</th><th>Analyser</th><th>Coster</th><th>Scheduler</th><th>Approver</th><th>Implementer</th><th>Tester</th>
                            </tr>
                            <tr>
                                <td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td></td><td></td>
                            </tr>
                        </table>
                        <br>
                        <p>When all reviews have been completed, the technical solution defined and all costs identified, the Scheduler collaborates with those responsible for delivering the implementation to determine the timescales.<br>
                        <br>When all parties have agreed upon the timescales, the Scheduler will click on the Scheduled button and a Scheduled notification is sent to each of the roles defined in the table above to ensure they are all aware that the WorkRequest has been Scheduled and is now ready to be assessed for approval.</p>
                    </div>
                </div>
                
                <!-- 10. Approved -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">10. Approved</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered docs-table text-center">
                            <tr>
                                <th>Requester</th><th>Assessor</th><th>Analyser</th><th>Coster</th><th>Scheduler</th><th>Approver</th><th>Implementer</th><th>Tester</th>
                            </tr>
                            <tr>
                                <td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td></td>
                            </tr>
                        </table>
                        <br>
                        <p>Now that a complete business case has been delivered through the system, the Approver is expected to review all completed sections and carry out their cost benefit analysis in order to make a judgement as to whether the WorkRequest should be approved or not.<br>
                        <br>Upon clicking the Approved button, a notification is sent to each of the roles defined in the table above to ensure they are all aware that the WorkRequest has been Approved and has been sanction for implementation within the cost and timescales indicated in the WorkRequest.</p>
                    </div>
                </div>
                
                <!-- 11. Implemented -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">11. Implemented</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered docs-table text-center">
                            <tr>
                                <th>Requester</th><th>Assessor</th><th>Analyser</th><th>Coster</th><th>Scheduler</th><th>Approver</th><th>Implementer</th><th>Tester</th>
                            </tr>
                            <tr>
                                <td>✔</td><td></td><td></td><td></td><td>✔</td><td></td><td>✔</td><td>✔</td>
                            </tr>
                        </table>
                        <p>The Implementer now has the responsibility to carry out the implementation within their agreed timescales, ensuring that they also have all the required resources necessary.<br>Upon clicking the Implemented button, a notification is sent to each of the roles defined in the table above to ensure they are all aware that the WorkRequest has been Implemented and is now ready for testing.</p>
                    </div>
                </div>
                
                <!-- 12. More Time -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">12. More Time</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered docs-table text-center">
                            <tr>
                                <th>Requester</th><th>Assessor</th><th>Analyser</th><th>Coster</th><th>Scheduler</th><th>Approver</th><th>Implementer</th><th>Tester</th>
                            </tr>
                            <tr>
                                <td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td></td><td></td>
                            </tr>
                        </table>
                        <br>
                        <p>If the Implementer is unable to deliver the technical solution in the timescales they had previously given, they may need to request More Time.<br>
                        <br>This is essentially a business decision and as such needs the WorkRequest to be re-reviewed, but having already been reviewed it is expected that quick decisions will be able to be made (especially for lower amounts of time).</p>
                    </div>
                </div>
                
                <!-- 13. Completed -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">13. Completed</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered docs-table text-center">
                            <tr>
                                <th>Requester</th><th>Assessor</th><th>Analyser</th><th>Coster</th><th>Scheduler</th><th>Approver</th><th>Implementer</th><th>Tester</th>
                            </tr>
                            <tr>
                                <td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td>
                            </tr>
                        </table>
                        <br>
                        <p>The Tester carries out the tests according to the Acceptance Criteria as defined in the WorkRequest description, providing any relevant Test Results and if Successful clicks upon Pass. A notification is then sent to each of the roles defined in the table above to ensure they are all aware that the WorkRequest has been Completed.</p>
                    </div>
                </div>
                
                <!-- 14. Failed Testing -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">14. Failed Testing</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered docs-table text-center">
                            <tr>
                                <th>Requester</th><th>Assessor</th><th>Analyser</th><th>Coster</th><th>Scheduler</th><th>Approver</th><th>Implementer</th><th>Tester</th>
                            </tr>
                            <tr>
                                <td>✔</td><td></td><td>✔</td><td></td><td>✔</td><td></td><td>✔</td><td>✔</td>
                            </tr>
                        </table>
                        <br>
                        <p>If, upon testing, the Tester was unable to meet the Acceptance Criteria they are expected to click upon Fail, providing any relevant Test Results or comments that may help the Implementer. A notification is then sent to each of the roles defined in the table above to ensure they are all aware that the test has failed.</p>
                    </div>
                </div>
                
                <!-- 15. Reworking -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">15. Reworking</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered docs-table text-center">
                            <tr>
                                <th>Requester</th><th>Assessor</th><th>Analyser</th><th>Coster</th><th>Scheduler</th><th>Approver</th><th>Implementer</th><th>Tester</th>
                            </tr>
                            <tr>
                                <td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td>
                            </tr>
                        </table>
                        <br>
                        <p>The Implementer may indicate that they are having to rework the solution, due to any number of reasons e.g. dependent resources not available, incompatibilities, better solution, etc.<br>
                        <br>If adequate time exists within the Planned Finish date, no further action is required by any of the other roles.<br>
                        <br>However, if the reworked solution is not implemented within the remaining Planned Finish timescale, the WorkRequest will need to be re-reviewed as this will a similar case as requesting More Time.<br>
                        <br>A notification is sent to each of the roles defined in the table above to ensure they are all aware that the implementation requires Reworking.</p>
                    </div>
                </div>
                
                <!-- 16. Backing Out -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">16. Backing Out</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered docs-table text-center">
                            <tr>
                                <th>Requester</th><th>Assessor</th><th>Analyser</th><th>Coster</th><th>Scheduler</th><th>Approver</th><th>Implementer</th><th>Tester</th>
                            </tr>
                            <tr>
                                <td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td>
                            </tr>
                        </table>
                        <br>
                        <p>If the Implementer has determined that there is a problem with the implementation they may deem it necessary to back out the solution.<br>A notification is sent to each of the roles defined in the table above to ensure they are all aware that any implementation is being backed out.</p>
                    </div>
                </div>
                
                <!-- 17. Backed Out -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">17. Backed Out</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered docs-table text-center">
                            <tr>
                                <th>Requester</th><th>Assessor</th><th>Analyser</th><th>Coster</th><th>Scheduler</th><th>Approver</th><th>Implementer</th><th>Tester</th>
                            </tr>
                            <tr>
                                <td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td>
                            </tr>
                        </table>
                        <br>
                        <p>Further to backing out any implementation necessary, the Implementer is expected to click upon the Backed Out button.<br>A notification is then sent to each of the roles defined in the table above to ensure they are all aware that any implementation has been backed out.</p>
                    </div>
                </div>
                
                <!-- 18. Reopened -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">18. Reopened</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered docs-table text-center">
                            <tr>
                                <th>Requester</th><th>Assessor</th><th>Analyser</th><th>Coster</th><th>Scheduler</th><th>Approver</th><th>Implementer</th><th>Tester</th>
                            </tr>
                            <tr>
                                <td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td><td>✔</td>
                            </tr>
                        </table>
                        <br>
                        <p>Sometimes mistakes are made. If a solution has been half installed, not backed out, failed testing, etc, it may be necessary to go back and attempt to finish the WorkRequest.<br>
                        <br>Rather than create a new WorkRequest it may be easier to simply reopen any Cancelled, Rejected, Failed Testing or Backed Out request.<br>
                        <br>This action will necessitate the WorkRequest being updated and re-reviewed.<br>
                        <br>Assuming the review is successful, the request will once again be subject to the same process, albeit with an expected accelerated timcale.</p>
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