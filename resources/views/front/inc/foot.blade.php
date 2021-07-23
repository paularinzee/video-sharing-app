<!-- SCRIPTS -->

@yield('before_scripts') 
<!-- JQuery --> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
<!-- Bootstrap tooltips --> 
<script src="{{url('js/tether.min.js')}}"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script> 

<!-- MDB core JavaScript --> 
<script src="{{url('js/compiled.min.js?v=4.3.2')}}"></script> 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script> 
<script src="{{url('js/script.js?v=1.1')}}"></script> 
<script>
$(document).ready(function() {

@if(session('success'))
    toastr.success('{!!session("success")!!}')
@endif
@if(session('status'))
    toastr.info('{!!session("status")!!}')
@endif
@if(session('error'))
    toastr.error('{!!session("error")!!}')
@endif

});
</script> 
@yield('after_scripts')