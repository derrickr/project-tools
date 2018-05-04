{!! app()->phptojs->script() !!}
@if(config('app.env')=='local')
<div class="{{config('app.env')}} hide"></div>
<script src="{{asset('theme/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script src="{{asset('theme/plugins/jQueryUI/jquery-ui.min.js')}}"></script>
<script src="{{asset('theme/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('theme/js/underscore-min.js')}}"></script>
<script src="{{asset('theme/plugins/form-validation/formValidation.min.js')}}"></script>
<script src="{{asset('theme/plugins/form-validation/bootstrap.min.js')}}"></script>
<script src="{{asset('theme/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{asset('theme/plugins/mask/jquery.mask.min.js')}}"></script>
<script src="{{asset('theme/js/moment.js')}}"></script>
<script src="{{asset('theme/plugins/iCheck/icheck.js')}}"></script>
<script src="{{asset('theme/plugins/datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('theme/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{asset('theme/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('theme/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('theme/plugins/morris/raphael-min.js')}}"></script>
<script src="{{asset('theme/plugins/morris/morris.js')}}"></script>
<script src="{{asset('theme/plugins/jquery.prefix-input/jquery.prefix-input.js')}}"></script>
<script src="{{asset('theme/js/typeahead.bundle.js')}}"></script>
<script src="{{asset('theme/js/app.min.js')}}"></script>
<script src="{{asset('theme/js/common.js')}}"></script>
<script src="{{asset('theme/js/advanced_filter.js')}}"></script>
<script src="{{asset('theme/js/actions.js')}}"></script>
<script src="{{asset('theme/js/users.js')}}"></script>
<script src="{{asset('theme/js/requests.js')}}"></script>
<script src="{{asset('theme/js/resources.js')}}"></script>
@else
<script src="{{asset('/js/app.min.js')}}"></script>
@endif
@stack('script')