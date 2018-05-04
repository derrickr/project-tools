@extends('layouts.login')
@section('title', 'Action')
@section('content')
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        @include('layouts.partials.message')
        <div class="box box-primary box-solid">
            <div class="box-header with-border text-center">
                @if($action->id)
                <h3 class="box-title">Edit Action#{{$action->id}}</h3>
                @else
                <h3 class="box-title">Add Action</h3>
                @endif
            </div>
            <div class="box-body">
                @include('action.forms.create')
            </div>
        </div>
        <!-- nav-tabs-custom -->
    </div>
    <!-- /.col -->
</div>
@endsection
@if($action->id)
@push('script')
<script>
    $(document).ready(function () {
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            endDate: '+0d',
            autoclose: true
        });
    });
</script>
@endpush
@endif