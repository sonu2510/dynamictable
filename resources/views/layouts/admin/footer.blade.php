    <footer class="footer text-center">
                ©  ERP <?php echo date("Y"); ?> 
    </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
  @yield('footer_scripts')

  <script type="text/javascript">
      @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;

            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;

            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;

            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
      @endif
  </script>
   
   
 
    
     {!! Html::script('assets/assets/libs/popper.js/dist/umd/popper.min.js') !!}
     {!! Html::script('assets/assets/libs/bootstrap/dist/js/bootstrap.min.js') !!}
    <!-- apps -->
     {!! Html::script('assets/dist/js/app.min.js') !!}
     {!! Html::script('assets/dist/js/app.init.dark.js') !!}
     {!! Html::script('assets/dist/js/app-style-switcher.js') !!}
    <!-- slimscrollbar scrollbar JavaScript -->
    {!! Html::script('assets/assets/extra-libs/sparkline/sparkline.js') !!}
    <!--Wave Effects -->
    {!! Html::script('assets/dist/js/waves.js') !!}   
    <!--Menu sidebar -->
    {!! Html::script('assets/dist/js/sidebarmenu.js') !!} 
    <!--Custom JavaScript -->
    {!! Html::script('assets/dist/js/custom.min.js') !!}   
    <!--This page JavaScript -->
    <!--chartis chart-->
    {!! Html::script('assets/assets/libs/chartist/dist/chartist.min.js') !!}
    {!! Html::script('assets/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') !!}   
    <!--c3 charts -->
    {!! Html::script('assets/assets/extra-libs/c3/d3.min.js') !!}
    {!! Html::script('assets/assets/extra-libs/c3/c3.min.js') !!}    
    <!--chartjs -->
    {!! Html::script('assets/dist/js/pages/dashboards/dashboard1.js') !!}
    
    {!! Html::script('js/helper.js') !!}

<script type="text/javascript">
    
// function MultiLogin(userid){
//             $.ajax({

//                     "url": '/Multilogin',   
//                      type: "GET",
//                     async: false,
//                     data: {userid:userid},
//                     method: 'GET',
//                     success: function (data) {
//                         window.location = '/dashboard';
//                         } 
                  
//                 });
// }


function FirstLevel(firstlevelmenu){
    //alert(firstlevelmenu);
    if(firstlevelmenu != ''){
        //var url = '{{ url('firstlevelmenu') }}';
        var url = '{{ url(":slug") }}';
        url = url.replace(':slug', firstlevelmenu);
        window.location.href=url;
        
    }
}



</script>
   
</body>
</html>




