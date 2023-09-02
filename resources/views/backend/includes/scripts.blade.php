<script src="{{asset('backend/assets/plugins/jquery/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('backend/assets/js/toastr.min.js')}}"></script>
<script src="{{asset('backend/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('backend/assets/plugins/perfectscroll/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('backend/assets/plugins/pace/pace.min.js')}}"></script>
<script src="{{asset('backend/assets/plugins/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('backend/assets/js/main.min.js')}}"></script>
<script src="{{asset('backend/assets/js/custom.js')}}"></script>
<script src="{{asset('backend/assets/plugins/datatables/datatables.min.js')}}"></script>
<script src="{{asset('backend/assets/plugins/summernote/summernote-lite.min.js')}}"></script>
<script src="{{asset('backend/assets/js/pages/datatables.js')}}"></script>
<script src="{{asset('backend/assets/js/pages/dashboard.js')}}"></script>

<script>
    @if(Session::has('message'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.success("{{ session('message') }}");
    @endif
  
    @if(Session::has('error'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.error("{{ session('error') }}");
    @endif
  
    @if(Session::has('info'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.info("{{ session('info') }}");
    @endif
  
    @if(Session::has('warning'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.warning("{{ session('warning') }}");
    @endif
  </script>