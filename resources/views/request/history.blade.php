@extends('layouts.login')
@section('title', 'Resources')
@section('content')
@include('layouts.partials.message')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header text-center">
                <h3 class="box-title">Work Request # {{ $requestid }} history</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if(!empty($requests) && count($requests)>0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped dataTable ">
                        <thead>
                            <tr role="row">
                                <th class="headings">{!! column_sort_link('requests.title', 'text', 'Description'); !!}</th>
                                <th class="headings">{!! column_sort_link('requests.requester', 'text', 'Requester'); !!}</th>
                                <th class="headings">{!! column_sort_link('requests.submitted_date', 'integer', 'Submitted'); !!}</th>
                                <th class="headings">{!! column_sort_link('requests.status', 'text', 'Status'); !!}</th>
                                <th class="headings">{!! column_sort_link('requests.tot_cost', 'integer', 'Cost'); !!}</th>
                                <th class="headings">{!! column_sort_link('requests.planned_start', 'integer', 'Start'); !!}</th>
                                <th class="headings">{!! column_sort_link('requests.planned_finish', 'integer', 'Finish'); !!}</th>
                            </tr>
                        </thead>
                        <tbody>  
                            @php ($cnt = 1)
                            @foreach($requests as $row)
                            <tr kp-trclickable="{{route('request.create',['id'=>$row->id])}}">
                                <td>{!! str_limit($row->title, 45, '...') !!}</td>
                                <td>{!! $row->first_name.' '.$row->last_name !!}</td>
                                <td>{!! mydate_format($row->submitted_date) !!}</td>
                                <td class="text-center">{!! mylabel('request',$row->status) !!}</td>
                                <td>{!! currency($row->tot_cost) !!}</td>
                                <td>{!! mydate_format($row->planned_start) !!}</td>
                                <td>{!! mydate_format($row->planned_finish) !!}</td>
                            </tr>
                            @php ($cnt++)
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="alert alert-danger">
                    No records found
                </div>
                @endif
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