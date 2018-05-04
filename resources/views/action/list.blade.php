@extends('layouts.login')
@section('title', 'Action List')
@section('content')
@include('layouts.partials.message')
@include('layouts.partials.search')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Actions List</h3>
                
                    <div id="actionkey" onmouseover="document.getElementById('actionkeys').style.display = 'inline-block';" onmouseout="document.getElementById('actionkeys').style.display = 'none';">Hover for Actual<br>Duration Colour Key</div>
                    <div id="actionkeys" style="display:none;">
                        <a href="#" class="btn"><span class="header-label label-success">Completed within Target</span></a>
                        <a href="#" class="btn"><span class="header-label label-warning">In progress</span></a>
                        <a href="#" class="btn"><span class="header-label label-danger">Completed late</span></a>
                        <a href="#" class="btn"><span class="header-label label-info2">Ongoing late</span></a>
                    </div>
                
                @if(auth()->user()->isRoleIn(['admin','projectmanager']))
                <div class="box-tools pull-right">
                    <a href="{{ route('action.create') }}" class="btn btn-primary" ><i class="fa fa-plus"></i> New Action</a>
                </div>
                @endif
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if(!empty($actions) && count($actions)>0)
                <div class="table-responsive">
                    <table class="table table-bordered dataTable ">
                        <thead>
                            <tr role="row">
                                <th class="headings">{!! column_sort_link('actions.id', 'text', 'No.'); !!}</th>
                                <th class="headings">{!! column_sort_link('actions.description', 'text', 'Description'); !!}</th>
                                <th class="headings">{!! column_sort_link('actions.owner', 'text', 'Owner'); !!}</th>
                                <th class="headings">{!! column_sort_link('actions.identified', 'text', 'Identified '); !!}</th>
                                <th class="headings">{!! column_sort_link('actions.target_date', 'text', 'Target'); !!}</th>
                                <th class="headings">{!! column_sort_link('actions.completed', 'text', 'Completed'); !!}</th>
                                <th class="headings">{!! column_sort_link('actions.status', 'text', 'Status'); !!}</th>
                                <th class="headings">{!! column_sort_link('actions.actual_duration', 'text', 'Target Duration'); !!}</th>
                                <th class="headings">{!! column_sort_link('actions.actual_duration', 'text', 'Actual Duration'); !!}</th>
                            </tr>
                        </thead>
                        <tbody>  
                            @php ($cnt = 1)
                            @foreach($actions as $row)
                                @if($cnt % 2 == 0)
                                    @php ($row_class = 'even')
                                @else
                                    @php ($row_class = 'odd')
                                @endif
                            <tr class="{{ $row_class }}" kp-trclickable="{{route('action.create',['id'=>$row->id])}}">
                                <td>{!! $row->id !!}</td>
                                <td>{!! str_limit($row->description, 45, '...') !!}</td>
                                <td>{!! $row->m_owner->display_name() !!}</td>
                                <td>{!! mydate_format($row->identified) !!}</td>
                                <td>{!! mydate_format($row->target_date) !!}</td>
                                <td>{!! mydate_format($row->completed) !!}</td>
                                <td>{!! $row->status !!}</td>
                                <td>{!! $row->target_duration < 1 ? "< 1" : $row->target_duration; !!} {!! $row->days($row->target_duration)  !!}</td>
                                <td class="text-center">{!! $row->get_actual_duration() !!}</td>
                                
                            </tr>
                            @php ($cnt++)
                            @endforeach
                        </tbody>
                    </table>
                    <!-- </div>
                    </div> -->
                </div>
                @else
                <div class="alert alert-danger">
                    No records found
                </div>
                @endif
                <!-- /.box-body -->
                 <div class="row">
                        <div class="col-sm-5"></div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                {{ $actions->links() }}
                            </div>
                        </div>
                    </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $(document).ready(function(){
       
    });
</script>
@endpush