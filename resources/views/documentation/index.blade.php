@extends('layouts.login')
@section('title', 'Process')
@section('content')
@include('layouts.partials.message')
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Work Request Process</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body text-center">
                <img src="{{asset('/images/workRequestProcess.png')}}" alt="Work Request Process">
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