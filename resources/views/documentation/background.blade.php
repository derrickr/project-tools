@extends('layouts.login')
@section('title', 'Background &amp; Code Description')
@section('content')
@include('layouts.partials.message')
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Background &amp; Ongoing Usage</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <!-- 1. Background -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">1. Background</h3>
                    </div>
                    <div class="box-body">
                        <p>Working as an IT &amp; Electronics Project Manager for 30 years, I've witnessed a pressing need for a method to allow management to manage the work of their people. This may well sound utterly simplistic and even incredulous, but I have observed this issue in nearly every company I've worked for.<br>
                            <br>I've found Project Managers are on the front line between the doers (the techies) and the directors (the managers). The PMs create their plans and attempt to manage their implementation, only to find that things don’t always go to plan. In fact, it is my experience that things hardly ever go to plan.<br>
                            <br>Having been doing this for a while, I've come to appreciate the factors that affect delivery as follows:
                        </p>
                        <ol>
                            <li>Under-estimation of effort from delivery team.</li>
                            <li>Over-estimation of delivery by management.</li>
                        </ol>
                        <p>It really is that simple.<br>
                            <br>Both think it’ll take / be done within 2 weeks, yet 4 weeks later… you get the picture. Meaning the PM is stuck in the middle trying to appease both sides.<br>
                            <br>To help alleviate this issue, I created what I originally called the WRF (Work Request Form and associated process) whilst working for Reuters in 2005. They too suffered from unorganised demands from management and under estimation of delivery from techies.<br>
                            <br>Unfortunately my coding skills at the time were relatively limited and I had to resort to a paper based form and Excel to manage the system, but it worked. A standard process was developed, based on best practice, and a review board evaluated the work requests. Each techie new what they were doing in the short to medium term and the board (consisting of the management layer) were free to focus on the strategy and long term goals of the business. Everybody knew what we could do with the available resources and it provided justification for further resources according to the urgency/priority of new work requests.<br>
                            <br>Fast forward a few more years and I still find there's a pressing need to manage new work requests within organisations. Not having the time (to develop an electronic version), I once again implemented the paper based approach and got a handle on things. Moving on to 2015 and I got to grips with JIRA and managed to wrangle that into shape to deliver an online system, doing the exact same job. However, I find JIRA a bit of a pain and constricted to certain methodologies.<br>
                            <br>In March 2017, I therfore decided to finally develop the system myself.<br>
                            <br>My first incarnation was simply called "work-request" and focused on that one aspect of managing work requests. This was created purely as a proof of concept to see if I could do it and thankfully managed to develop a working system by June 2017.<br>
                            <br>I then thought about other project management tools that would be useful (i.e. wish I had them to hand within my last few contracts) and started on a straight forward Action Log. This was relatively easy compared to the work-request system and I managed to finish in just a couple of weeks towards the end of June 2017.<br>
                            <br>I then thought if I’m going to actually try and use these tools in the real world then I’d better make sure they’re up to scratch. However, I thought my code was perhaps a little messy / amateurish and could really do with a review / QA. I therefore posted a project on People-Per-Hour and enlisted a London based freelancer (with colleagues in India) to convert the system to use the Laravel framework (something which I’d shied away from for years because of the steep learning curve).<br>
                        </p>
                    </div>
                </div> 
                <!-- 2. The database -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">2. The database</h3>
                    </div>
                    <div class="box-body">
                        <p>I think it’s fair to say that the database schema grew organically, into what it is today.<br>
                            <br>The initial tables consisted of: requests, users, resources and were solely used for the work request system. The actions table was then added, specifically for the Actions Log (which also calls upon the users table).<br>
                            <br>Considering the history of this project, one can see that I simply took the fields from the original paper forms and Excel spreadsheet as the basis for the requests table. Yes, it is a bit of a beast, but has all the relevant fields for a request form within that one table, which is displayed within each separate work request as a tabbed form.<br>
                            <br>A very important aspect here is that a single work request can have more than one database entry - this is due to auditing. Whenever the user/originator makes a change to their work request its status goes back to 'New' AND creates a new database entry for that specific work request.<br>
                            <br>The method I used for this may be a little unconventional but it works and I didn't know how else to do it at the time. So basically, there are 3 fields related to the work request number in the 'requests' table:
                        </p>
                        <ol>
                            <li>id<br>
                            Standard database auto-incrementing 'id' field.</li>
                            <br>
                            <li>req_no<br>
                            Calculated field that determines the current highest work request number (i.e. the 'reqNo') and adds 1 to it for a 'New' (not updated) work request.</li>
                            <br>
                            <li>latest<br>
                            Calculated field that determines the highest 'id' for a 'req_no' and updates ALL 'latest' fields with that 'id' for ALL <b>updated</b> workRequests (that have had changes made to them and are accordingly put back into the 'New' status). *Note the subtle difference between this and the above.</li>
                        </ol>
                    </div>
                </div> 
                <!-- 3. The code -->
                <div class="box">
                    <div class="box-header docs-title">
                        <h3 class="box-title">3. Ongoing Development</h3>
                    </div>
                    <div class="box-body">
                        <p>By Open Sourcing this project, I hope to get feedback and ideas as to how it can be improved. For example, I believe the code and database structure are not as efficient as they could be and would benefit by some refactoring.<br>
                        <br>I'd also like to start adding further tools to the suite, so that it can be built up to support a complete methodology. Indeed, the longer term goal is to build in all the tools necessary for the major methodologies with the objective of allowing focus on delivering the work, rather than having to remember every last little detail of the methodology. Whilst it is agreed that a professional person should have the experience and qualifications, it is hoped that this set of project tools will ultimately act in a supporting role, helping those delivering by providing alerts and simple straight forward web based tools to provide transparency along with the usual standard project deliverables e.g. CRAID logs, weekly reports, etc.<br>
                        <br>It must also be stressed that this is not considered "the be all and end all" of project delivery but is here to provide support and to work in parallel with the usual Project Managament Office capabilities. This is especially true of the highly skilled planning/scheduling work, which must be carried out in conjunction with an organisation's Roadmaps and Strategies! This is actually fundamental to the sucessfull adoption of project-tools in using the right resources at the right time.<br>
                        </p>
                        <div class="box-body text-center">
                            <img src="{{asset('/images/pmo.png')}}" alt="Work Request Process">
                        </div>
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