@extends('layouts.login')
@section('title', 'Reset Password')
@section('content')
<section class="content">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @include('layouts.partials.message')
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Reset Password</h3>
                    </div>
                    <div class="box-body">
                       @include('setting.forms.resetpassword')
                    </div>
                </div>
                <!-- nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
    </section>     
</section>
@endsection