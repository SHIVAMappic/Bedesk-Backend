@extends('layout')
@section('content')
                     <div class="col-12 grid-margin">
                        <div class="card">
                           <div class="card-body">

                              <div class="rowForm">
                                 <div id="errors">
                                  </div>
                               </div>

                               
                              <form class="form-sample addproduct" id="add_product" method="post" enctype="multipart/form-data" action="">
                                 <div class="rowForm">
                                    <h4 class="card-title">General Info</h4>
                                    <p class="card-description">
                                       Add here the word description with all details and necessary information.
                                    </p>
                                    <div class="row">
                                       <div class="col-md-12">
                                          <div class="form-group row">
                                             <label class="col-sm-3 col-form-label">Category Name</label>
                                             <div class="col-sm-9">
                                                <input type="text" name="category_name" id="category_name"  value="{{$categories->category_name}}" class="form-control" />
                                             </div>
                                          </div>                                         
                                         
                                         
                                       </div>

                                       <input type="hidden"  name="record_id"  value="{{$categories->id}}">
                                      
                                    </div>
                                 </div>

                                
                              

                               













                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <button type="submit" name="submit" class="btn btn-primary mr-2">Submit</button>
                                          <button class="btn btn-light">Cancel</button>
                                       </div>
                                    </div>
                                 </div>
                              </form>
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



       <script>
          jQuery.validator.addMethod("noSpace", function(value, element) { 
          return value.indexOf(" ") < 0 && value != ""; 
        }, "Space are not allowed");


         jQuery("#add_product").each(function(e, a) {
          jQuery(this).validate({
          rules: {
            word_name: {required: true,noSpace: true},
            /*productdesc: {required: true},
            regular_price: {required: true,digits:true},*/
          },
          messages: {
            word_name: {required: 'Please enter word name.'},
            /*productdesc: {required: 'Please enter product description.'},
            regular_price: {required: 'Please enter regular price.',digits:"Please enter numbers Only"},*/
          },
          submitHandler: function (form) { 
            var formData= new FormData(jQuery('#add_product')[0]);
              formData.append('_token',"{{ csrf_token() }}");
              jQuery.ajax({
                  url: "/bedesk/editBlogCategoryAction",
                  type:'POST',
                  data:formData,
                  processData: false,
                  contentType: false,
                    cache: false,
                  beforeSend: function() { 
                    jQuery('input[name="submit"]').attr('value','Registering...');
                    jQuery('input[name="submit"]').attr('disabled','disabled');
                  },
                  success: function(data) { 
                    obj = JSON.parse(data);
                    jQuery('input[name="submit"]').removeAttr('disabled');
                      if(obj.status=='true'){ alert('hi');
                       jQuery("#register")[0].reset();
                       jQuery('.ajaxMsg').show().addClass('ajaxSucc').removeClass('ajaxErr').html(obj.message);
                        setTimeout(function(){
                        jQuery('.ajaxMsg').hide();
                        window.location= ("{{asset('login')}}");
                        }, 3000);
                      }else{

                        console.log(obj.errors);
                        var errors = obj.errors;

                        var text = "";
                           var i;
                           for (i = 0; i <errors.length; i++) {
                             text += errors[i] + "<br>";
                           }                          
                          

                           
                            jQuery("#errors").html(text + '<br>');
                       jQuery('.ajaxMsg').show().addClass('ajaxErr').removeClass('ajaxSucc').html(obj.message);
                      setTimeout(function(){
                        jQuery('.ajaxMsg').hide();
                        }, 3000);
                      }
                      jQuery('input[name="submit"]').attr('value','Register');
                  }   
         
                  });
          }
         });
         });
      </script>



    

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