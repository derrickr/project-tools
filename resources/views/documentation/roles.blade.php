@extends('layouts.login')
@section('title', 'Roles')
@section('content')
@include('layouts.partials.message')
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Role Descriptions</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <p>In order to ensure the swift flow of the process, it is recommended that each role has the agreed level of authority to make decisions according to their role.</p>
                
                    <!-- 1. Assessor -->
                    <div class="box">
                        <div class="box-header docs-title">
                            <h3 class="box-title">1. Assessor</h3>
                        </div>
                        <div class="box-body">
                            <ul>
                                <li>Business role.</li>
                                <li>Key business decision maker.</li>
                                <li>Expected to have the authority to make quick business decisions.</li>
                                <li>Accepts the WRF for onward analysis.</li>
                                <li>Commits, next stage, technical resources.</li>
                                <br>
                                <li>Could be combined with the Approver role.</li>
                            </ul>
                        </div>
                    </div>
                
                <!-- 2. Analyser -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">2. Analyser</h3>
                    </div>
                    <div class="box-body">
                        <ul>
                            <li>Technical role.</li>
                            <li>Reviews the request and defines the solution to meet the business requirement.</li>
                            <li>Extemely specialist role, with substantial technical understanding of the company's solutions.</li>
                            <li>Expected to have very senior technical capabilities.</li>
                            <br>
                            <li>This MUST NOT be carried out by anyone other than those responsible for technical analysis.</li>
                            <li style="list-style-position: inside; text-indent:2em;">i.e. non technical / business personnel</li>
                        </ul>
                    </div>
                </div>
                
                <!-- 3. Coster -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">3. Coster</h3>
                    </div>
                    <div class="box-body">
                        <ul>
                            <li>Business role.</li>
                            <li>Reviews the request and works with the Analyser to define any further costs.</li>
                            <br>
                            <li>Could be combined with the Scheduler role.</li>
                        </ul>
                    </div>
                </div>   
                
                <!-- 4. Scheduler -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">4. Scheduler</h3>
                    </div>
                    <div class="box-body">
                        <ul>
                            <li>Business role.</li>
                            <li>Reviews the request and works with the Analyser &amp; Coster to define the timescales.</li>
                            <li>Highly specialist role, taking account of all other projects and especially their committed resources.</li>
                            <li>Expected to have advanced scheduling capabilities.</li>
                            <br>
                            <li>Could be combined with the Coster role.</li>
                        </ul>
                    </div>
                </div>
                
                <!-- 5. Approver -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">5. Approver</h3>
                    </div>
                    <div class="box-body">
                        <ul>
                            <li>Business role.</li>
                            <li>Approves the completed WorkRequest to determine if it should be approved, in line with the business strategy.</li>
                            <li>Commits technical resources to deliver the request.</li>
                            <br>
                            <li>Could be combined with the Assessor role.</li>
                        </ul>
                    </div>
                </div>
                
                <!-- 6. Implementer -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">6. Implementer</h3>
                    </div>
                    <div class="box-body">
                        <ul>
                            <li>Technical role.</li>
                            <li>Specialist role with technical knowledge to implement the requirement.</li>
                            <br>
                            <li>This MUST NOT be carried out by anyone other than those responsible for technical implementation.</li>
                        </ul>
                    </div>
                </div>
                
                <!-- 7. Tester -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">7. Tester</h3>
                    </div>
                    <div class="box-body">
                        <ul>
                            <li>Business role.</li>
                            <li>Responsible for ensuring the implemented solution meets/passes the previously defined Acceptance criteria.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            
        </div>
    </div>
</div>

@endsection
@push('script')
<script>

</script>
@endpush