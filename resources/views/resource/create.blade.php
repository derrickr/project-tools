@extends('layouts.login')
@section('title', 'New Resource')
@section('content')
<div class="row">
    <div class="col-md-offset-4 col-md-4">
        @include('layouts.partials.message')
        <div class="box box-primary box-solid">
            <div class="box-header with-border text-center">
                @if($resource->id)
                <h3 class="box-title">Edit Resource#{{$resource->id}}</h3>
                @else
                <h3 class="box-title">Add Resource</h3>
                @endif
            </div>
            <div class="box-body">
                @include('resource.partial.create')
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
      
    });
</script>
@endpush