@extends('layouts.login')
@section('title', 'User List')
@section('content')
@include('layouts.partials.message')
@include('layouts.partials.search')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Users List</h3>
                @if(auth()->user()->isRole('admin'))
                <div class="box-tools pull-right">
                    <a href="{{ route('user.create') }}" class="btn btn-primary" ><i class="fa fa-plus"></i> New User</a>
                </div>
                @endif
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if(!empty($users) && count($users)>0)
                <div class="table-responsive">
                    <table class="table table-bordered dataTable ">
                        <thead>
                            <tr role="row">
                                <th class="headings">{!! column_sort_link('users.first_name', 'text', 'First Name'); !!}</th>
                                <th class="headings">{!! column_sort_link('users.last_name', 'text', 'Last Name'); !!}</th>
                                <th class="headings">{!! column_sort_link('users.email', 'text', 'User Name'); !!}</th>
                                <th class="headings">Role</th>
                                <th class="headings">{!! column_sort_link('users.created_at', 'text', 'Enrolled'); !!}</th>
                                <th class="headings">{!! column_sort_link('users.last_visit', 'text', 'Last Visit'); !!}</th>
                            </tr>
                        </thead>
                        <tbody>  
                            @php ($cnt = 1)
                            @foreach($users as $row)
                                @if($cnt % 2 == 0)
                                    @php ($row_class = 'even')
                                @else
                                    @php ($row_class = 'odd')
                                @endif
                            <tr class="{{ $row_class }}" 
                                @if(auth()->user()->isRole('admin'))
                                kp-trclickable="{{route('user.create',['id'=>$row->id])}}
                                @endif
                                ">
                                <td>{!! $row->first_name !!}</td>
                                <td>{!!  $row->last_name !!}</td>
                                <td>{!! $row->email !!}</td>
                                <td>{!! $row->role !!}</td>
                                <td>{!! mydate_format($row->created_at) !!}</td>
                                <td>{!! $row->last_visit !!}</td>
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
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
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