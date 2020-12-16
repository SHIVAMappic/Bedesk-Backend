@extends('layout')
@section('content')
                     <div class="col-12 grid-margin">
                        <div class="card">
                           <div class="card-body">

                                    <div class="row">
                                    <div class="col-md-12 stretch-card">
                                       <div class="card">
                                          <div class="card-body">
                                             <p class="card-title">View Ads
                                              <a href="{{url('/admin/ads-manager')}}" style="float:right;"  class="btn btn-secondary" >Back</a>
                                             </p>
                                             <div class="table-responsive">
                                                <table id="recent-purchases-listing" class="table">
                                                   
                                                   <tr>
                                                      <th>Title</th>
                                                      <td>{{$ads->title}}</td>
                                                   </tr>
                                                   <tr>
                                                      <th>Description</th>
                                                      <td>{{$ads->description}}</td>
                                                   </tr>
                                                   <tr>
                                                      <th>Link</th>
                                                      <td>{{$ads->link}}</td>
                                                   </tr>
                                                   <tr>
                                                      <th>Image</th>
                                                      <td> <img src="{{URL::to('/')}}/public/storage/galeryImages/<?php echo $ads->image;?>" style="height:200px;width:200px;"></td>
                                                   </tr>
                                                  
                                                    <tr>
                                                      <th>Add Date</th>
                                                      <td>{{$ads->add_date}}</td>
                                                   </tr>
                                                    <tr>
                                                      <th>Update Date</th>
                                                      <td>{{$ads->update_date}}</td>
                                                   </tr>
                                                  
                                                </table>
                                             </div></div></div></div></div>
                             
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- partial:partials/_footer.html -->












                <footer class="footer">
                  <div class="d-sm-flex justify-content-center justify-content-sm-between">
                     <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2020 <a href="http://www.elpatiopty.com/" target="_blank">elpatiopty</a>. All rights reserved.</span>
                  </div>
               </footer>
               <!-- partial -->
            </div>
            <!-- main-panel ends -->
         </div>
         <!-- page-body-wrapper ends -->
      </div>
      <!-- container-scroller -->
      <!-- plugins:js -->
     


                <script src="{{asset('public/ela-site/vendors/base/vendor.bundle.base.js')}}"></script>
      <!-- endinject -->
      <!-- Plugin js for this page-->
      <script src="{{asset('public/ela-site/vendors/chart.js/Chart.min.js')}}"></script>
      <script src="{{asset('public/ela-site/vendors/datatables.net/jquery.dataTables.js')}}"></script>
      <script src="{{asset('public/ela-site/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
      <!-- End plugin js for this page-->
      <!-- inject:js -->
      <script src="{{asset('public/ela-site/js/off-canvas.js')}}"></script>
      <script src="{{asset('public/ela-site/js/hoverable-collapse.js')}}"></script>
      <script src="{{asset('public/ela-site/js/template.js')}}"></script>
      <!-- endinject -->
      <!-- Custom js for this page-->
      <script src="{{asset('public/ela-site/js/dashboard.js')}}"></script>
      <script src="{{asset('public/ela-site/js/data-table.js')}}"></script>
      <script src="{{asset('public/ela-site/js/jquery.dataTables.js')}}"></script>
      <script src="{{asset('public/ela-site/js/dataTables.bootstrap4.js')}}"></script>
      <script src="{{asset('public/ela-site/js/jquery.validate.min.js')}}"></script>



     

      <script type="text/javascript">
         jQuery(document).ready(function(){
          jQuery('a#melogout').click(function(){
            jQuery.ajax({
              url: "/ela/logoutAction",
              type: 'POST',
              data:{'_token' : '{{ csrf_token() }}'},
              success: function (data) {
                obj = JSON.parse(data);
                  if(obj.status=='true'){
                    setTimeout(function(){
                    window.location= ("{{asset('login')}}");
                    }, 3000);
                  }
              }
            });
          });
          jQuery('.sfup1').on('click', function() {
            jQuery('.sf1').trigger('click');
          });

          jQuery('.sfup2').on('click', function() {
        jQuery('.sf2').trigger('click');
         
      });

      jQuery('.sfup3').on('click', function() {
        jQuery('.sf3').trigger('click');
         
      });

      jQuery('.sfup4').on('click', function() {
        jQuery('.sf4').trigger('click');
         
      });

          jQuery('.sf1').on('change', function() {
        jQuery(this).parent().find('.form-control00').val($(this).val().replace(/C:\\fakepath\\/i, ''));
      });
      jQuery('.sf2').on('change', function() {
        jQuery(this).parent().find('.form-control01').val($(this).val().replace(/C:\\fakepath\\/i, ''));
      });
      jQuery('.sf3').on('change', function() {
        jQuery(this).parent().find('.form-control02').val($(this).val().replace(/C:\\fakepath\\/i, ''));
      });
      jQuery('.sf4').on('change', function() {
        jQuery(this).parent().find('.form-control03').val($(this).val().replace(/C:\\fakepath\\/i, ''));
      });


          jQuery('.file-upload-browse1').on('click', function() {
            jQuery('.file-upload-default1').trigger('click');
          });
          jQuery('.file-upload-default1').on('change', function() {
            jQuery(this).parent().find('.form-contro11').val($(this).val().replace(/C:\\fakepath\\/i, ''));
          });
         });
         function openCity(evt, cityName) {
           var i, tabcontent, tablinks;
           tabcontent = document.getElementsByClassName("tabcontent");
           for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
           }
           tablinks = document.getElementsByClassName("tablinks");
           for (i = 0; i < tablinks.length; i++) {
          tablinks[i].className = tablinks[i].className.replace(" active", "");
           }
           document.getElementById(cityName).style.display = "block";
           evt.currentTarget.className += " active";
         }
         
         //document.getElementById("defaultOpen").click();
      </script> 


                    


            @endsection