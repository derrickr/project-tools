@extends('layouts.login')
@section('title', 'Setting')
@section('content')
@include('layouts.partials.message')
<div class="row">
    <div class="col-md-2">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Setting</h3>
            </div>
            <div class="box-body">
                <ul class="list-group list-group-unbordered">
                    @foreach($dropdowns as $drop)
                    @if($drop['display'])
                    <li class="list-group-item">
                        <a href="#" kp-setting="{{$drop['dropdown']}}" kp-setting-url="{{route('setting.dropdown',$drop['dropdown'])}}" title="Click to view options of {{$drop['display_name']}}"><b>{{$drop['display_name']}}</b></a>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
        </div>  
    </div>
    <div id="setting-content" class="col-md-10">

        </div>
</div>

@endsection
@push('script')
<script>
$(document).ready(function(){
  Settings.init();
});
</script>
@endpush