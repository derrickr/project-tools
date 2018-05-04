@extends('layouts.login')
@section('title', 'Resources')
@section('content')
@include('layouts.partials.message')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Resources</h3>
                @if(auth()->user()->isRole('admin'))
                <div class="box-tools pull-right">
                    <a href="{{ route('resource.create') }}" class="btn btn-primary" ><i class="fa fa-plus"></i> New Resource</a>
                </div>
                @endif
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if(!empty($resources) && count($resources)>0)
                <div class="table-responsive">
                    <table class="table table-bordered table-bordered dataTable ">
                        <thead>
                            <tr role="row">
                                <th class="headings">{!! column_sort_link('resources.id', 'integer', 'No.'); !!}</th>
                                <th class="headings">{!! column_sort_link('resources.resource', 'text', 'Resource'); !!}</th>
                                <th class="headings">{!! column_sort_link('resources.abbrv', 'text', 'Abbrv'); !!}</th>
                                <th class="headings">{!! column_sort_link('resources.price', 'integer', 'Cost'); !!}</th>
                                <th class="headings">{!! column_sort_link('resources.res_date', 'text', 'Added on'); !!}</th>
                                <th class="headings">{!! column_sort_link('resources.submitted_by', 'text', 'Added By'); !!}</th>
                            </tr>
                        </thead>
                        <tbody>  
                            @php ($cnt = 1)
                            @foreach($resources as $row)
                            @if($cnt % 2 == 0)
                                    @php ($row_class = 'even')
                                @else
                                    @php ($row_class = 'odd')
                                @endif
                            <tr class="{{ $row_class }}" 
                                @if(auth()->user()->isRole('admin'))
                                kp-trclickable="{{route('resource.create',['id'=>$row->id])}}"
                                @endif
                                >
                                <td>{!! $row->id !!}</td>
                                <td>{!! $row->resource !!}</td>
                                <td>{!! $row->abbrv !!}</td>
                                <td>{!! currency($row->price) !!}</td>
                                <td>{!! $row->res_date !!}</td>
                                <td>{!! $row->submitted_by  !!}</td>
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
                        <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                            {{ $resources->links() }}
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