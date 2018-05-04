@extends('layouts.login')
@section('title', 'New Request')
@section('content')
<div class="row">
    <div class="col-md-12">
        @include('layouts.partials.message')
        <div class="box box-primary box-solid">
            <div class="box-header with-border text-center">
                <h3 class="box-title">Add Request</h3>
            </div>
            <div class="box-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#description_tab" data-toggle="tab" aria-expanded="true">Description</a></li>
                        <li class="pull-right"><button type="button" class="btn btn-success btn-sm" kp-toggle="fasttrack"><i class="fa fa-fw fa-rocket"></i> Fast Track</button></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="description_tab">
                            @include('request.partial.description_tab')
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
            </div>
        </div>
        <!-- nav-tabs-custom -->
    </div>
    <!-- /.col -->
</div>
@endsection
@push('script')
<script>
    $(document).ready(function () {
        Requests.init_create();
    });
</script>
@endpush