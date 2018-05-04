@extends('layouts.anonymous')
@section('title', '500 Error page')
@section('content')
<div class="error-page">
    <h2 class="headline text-red">500</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-red"></i> Oops! Something went wrong.</h3>
          <p>
            We will work on fixing that right away.
            Meanwhile, you may <a href="{{ route('dashboard')}}">return to dashboard.</a>
          </p>
        </div>
        <!-- /.error-content -->
      </div>

@endsection
@push('script')
<script>

</script>
@endpush