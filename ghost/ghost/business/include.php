   <script src="../assets/js/vendors.min.js"></script>
    
    <script src="../assets/js/app.min.js"></script>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.4.8/jquery.jgrowl.min.js" integrity="sha512-h77yzL/LvCeAE601Z5RzkoG7dJdiv4KsNkZ9Urf1gokYxOqtt2RVKb8sNQEKqllZbced82QB7+qiDAmRwxVWLQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Form validation cdn -->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.js"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.3.1/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <!-- Bootstrap Growl  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js" integrity="sha512-pBoUgBw+mK85IYWlMTSeBQ0Djx3u23anXFNQfBiIm2D8MbVT9lr+IxUccP8AMMQ6LCvgnlhUCK3ZCThaBCr8Ng==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <!-- Google translate launguage cdn -->
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script type="text/javascript" src="../new_js/translate_launguage.js"></script>

    <!-- Current date and time Js  -->
    
    <script src="../assets/vendors/chartjs/Chart.min.js"></script>
    <script src="../assets/js/pages/dashboard-default.js"></script>

    <script type="text/javascript" src="../new_js/time.js"></script>
    <script type="text/javascript" src="../new_js/userList.js"></script>
    
    <script src="../new_js/theme.js"></script>
    <script>
      $(document).ready(function(){
         if($(".pop-notification").children().find(".dropdown-item").length == 0)
         {
            $(".pop-notification").append('<a id="returnReqHeader" class="dropdown-item d-block p-5 border-bottom"><div class="d-flex"><div class="m-l-10"><p class="m-b-0 text-danger">No Notifications</p></div></div></a>');
         }
         else
         {
            $("#notifyDropdown").prepend('<span class="icon-button__badge"></span>');
         }
      })
   </script>

   <!--Start of Tawk.to Script-->
   <script type="text/javascript">
   var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
   (function(){
   var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
   s1.async=true;
   s1.src='https://embed.tawk.to/64061dd831ebfa0fe7f1002f/1gqru96ii';
   s1.charset='UTF-8';
   s1.setAttribute('crossorigin','*');
   s0.parentNode.insertBefore(s1,s0);
   })();
   </script>
   <!--End of Tawk.to Script-->