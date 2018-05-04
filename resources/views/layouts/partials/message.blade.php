<?php 
if(Session::has('success'))
    $success = Session::get('success');
if(Session::has('error'))
    $error = Session::get('error');

    ?>
@if (!empty($success))
@if(is_array($success))
@foreach($success as $var)
<div class="alert alert-success alert-dismissible">
    {!! $var !!}
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
</div>
@endforeach
@else
<div class="alert alert-success alert-dismissible">
    {!! $success !!}
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
</div>
@endif
@endif

@if (!empty($error))
@if(is_array($error))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <ul>
@foreach($error as $var)
<li>{!! $var !!}</li>
@endforeach
    </ul>
</div>
@else
<div class="alert alert-danger alert-dismissible">
    {!! $error !!}
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
</div>
@endif
@endif
@if ($errors->all())
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <ul>
@foreach($errors->all() as $var)
<li>{!! $var !!}</li>
@endforeach
    </ul>
</div>
@endif
@if ($errors->all())
@php(app()->phptojs->put('form_errors', $errors->messages()))
@endif