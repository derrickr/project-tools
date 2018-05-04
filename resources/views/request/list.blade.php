@extends('layouts.login')
@section('title', 'Requests')
@section('content')
@include('layouts.partials.message')
@include('layouts.partials.search')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Requests</h3>
                <div class="box-tools pull-right">
                    <a href="{{ route('request.create') }}" class="btn btn-primary" ><i class="fa fa-plus"></i> New Request</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if(!empty($requests) && count($requests)>0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped dataTable ">
                        <thead>
                            <tr role="row">
                                <th class="headings">{!! column_sort_link('requests.req_no', 'integer', 'Req. No.'); !!}</th>
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
                                <td>{!! $row->req_no !!}</td>
                                <td>{!! str_limit($row->title, 45, '...') !!}</td>
                                <td>{!! $row->req_first_name.' '.$row->req_last_name !!}</td>
                                <td>{!! mydate_format($row->submitted_date) !!}</td>
                                <td class="text-center">{!! mylabel('request',$row->status) !!}</td>
                                <td>{!! currency($row->tot_cost,'&pound;','') !!}</td>
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
                <div class="row">
                    <div class="col-sm-5">
                        @include('page_dropdown')
                    </div>
                    <div class="col-sm-7">
                        <div class="dataTables_paginate paging_simple_numbers">
                            {{ $requests->links() }}
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