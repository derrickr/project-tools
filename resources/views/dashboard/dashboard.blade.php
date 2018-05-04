@extends('layouts.login')
@section('title', 'Dashboard')
@section('content')
<div class="row">
    <div class="col-md-12">
        @include('layouts.partials.message')
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box" id="ganttHolder">
            <div class="box-header with-border">
              <h3 class="box-title text-center">Scheduled Work Requests</h3>
            </div>
            <div class="box-body" id="gantt"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="box" id="requestsHolder">
            <div class="box-header with-border">
              <h3 class="box-title">Work Request Status</h3>
            </div>
            <div class="box-body" id="requests"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box" id="requestersHolder">
            <div class="box-header with-border">
              <h3 class="box-title">Work Requesters</h3>
            </div>
            <div class="box-body" id="requesters"></div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        

    function drawGantt() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Task ID');
        data.addColumn('string', 'Task Name');
        data.addColumn('string', 'Resource');
        data.addColumn('date', 'Start Date');
        data.addColumn('date', 'End Date');
        data.addColumn('number', 'Duration');
        data.addColumn('number', 'Percent Complete');
        data.addColumn('string', 'Dependencies');
        data.addRows([
<?php
$i = '0';
foreach ($gantt_requests as $request) {
    if (!$request->planned_start || !$request->planned_finish) {
        continue;
    }//only chart those with dates
    $noApostrophes = str_replace("'", '', $request->title);
    echo "['$request->req_no', '" . $noApostrophes . "', '" . ($i = $i + 1) . "', new Date(" . date('Y, n, j', strtotime("-1 month", strtotime($request->planned_start))) . "), new Date(" . date('Y, n, j', strtotime("-1 month", strtotime($request->planned_finish))) . "), null, null, null],";
}
?>
        ]);
<?php
$nRows = $gantt_count[0]->count;
$ganttHeight = ($nRows * 30) + 40;
?>

        var options = {
            height: <?php echo $ganttHeight; ?>,
            width: $('#ganttHolder').width()-50,
            fontName: 'Arial',
            fontSize: 12,
            gantt: {
                trackHeight: 30
            }
        };

        var chart = new google.visualization.Gantt(document.getElementById('gantt'));
        chart.draw(data, options);
        console.log(data);
    }
    function drawRequests() {
        var dataTable = new google.visualization.arrayToDataTable([
            ['Status', 'Quantity'],
<?php
foreach ($request_status as $request) {
    echo "['" . $request->status . "'," . $request->quantity . "],";
}
?>
        ]);
        var view = new google.visualization.DataView(dataTable);
        view.setColumns([0, 1, {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            }
        ]);
        var options = {
            title: 'Current statuses',
            animation: {startup: true, duration: 3000, easing: 'out'},
            legend: 'none',
            hAxis: {slantedText: true, slantedTextAngle: 45},
            width: $('#requestsHolder').width()-40,
            height: 400
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('requests'));
        chart.draw(view, options);
    }

    function drawRequesters() {
        var dataTable = new google.visualization.arrayToDataTable([
            ['Requester', 'Quantity'],
<?php
foreach ($requesters as $requester) {
    echo "['" . $requester->first_name . " " . $requester->last_name . "'," . $requester->quantity . "],";
}
?>
        ]);
        var options = {
            title: 'Who\'s asking for it',
            is3D: true,
            pieSliceText: 'label',
            legend: 'none',
            width: $('#requestersHolder').width()-40,
            height: 400,
            chartArea: {left: 20, top: 20, width: '100%', height: '100%'}
        };
        var chart = new google.visualization.PieChart(document.getElementById('requesters'));
        chart.draw(dataTable, options);
    }

    google.charts.load('current', {'packages': ['gantt', 'corechart']});
    google.charts.setOnLoadCallback(drawGantt);
    google.charts.setOnLoadCallback(drawRequests);
    google.charts.setOnLoadCallback(drawRequesters);
    });
</script>

@endpush