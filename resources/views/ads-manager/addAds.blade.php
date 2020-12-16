@extends('layout')
@section('content')
<!-- Start Body container box----->
<div class="col-12 grid-margin">
   <div class="card">
      <div class="card-body">
         <div id="errors"></div>
         <div id="success_msg"></div>
         <form class="form-sample addproduct" id="add_product" method="post" enctype="multipart/form-data" action="">
            <!-- Start row form box ---->
            <div class="rowForm">
              <h4 class="card-title">General Info</h4>
              <p class="card-description">
                  Add here the word description with all details and necessary information.
              </p>
              <div class="row">
                <div class="col-md-12">

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Title</label>
                    <div class="col-sm-9">
                      <input type="text" name="title" id="title" class="form-control" />
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-9">
                      <textarea name="description" id="content" rows="20" class="form-control" ></textarea>
                    </div>
                  </div>


                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Link</label>
                    <div class="col-sm-9">
                      <input type="text" name="link" id="link" class="form-control" />
                    </div>
                  </div>

                  

                </div>                
              </div>
            </div>
            <!-- End row form box -->

            <!-- image section  row form box start -->
            <div class="rowForm">
              <h4 class="card-title">Image</h4>
              <p class="card-description">Upload your Blog image.</p>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label> Image</label>
                    <input type="file" name="image" class="file-upload-default  sf1">
                    <div class="input-group col-xs-12">
                      <input type="text" class="form-control form-control01 file-upload-info" disabled placeholder="Upload Image">
                      <span class="input-group-append">
                        <button class="file-upload-browse sfup1 btn btn-primary" type="button">Upload</button>
                      </span>
                    </div>
                  </div>                  
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-6">
                  <div class="form-group"> </div>
                </div>
              </div>
            </div>   
            <!-- End image section row-form box--->     
          
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <button type="submit" name="submit" class="btn btn-primary mr-2">Submit</button>
                <!---  <button class="btn btn-light">Cancel</button>--->
                </div>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
    <!-- End Body container box----->
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

<script src="{{asset('public/ela-site/vendors/base/vendor.bundle.base.js')}}"></script>
<script src="{{asset('public/ela-site/vendors/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('public/ela-site/vendors/datatables.net/jquery.dataTables.js')}}"></script>
<script src="{{asset('public/ela-site/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('public/ela-site/js/off-canvas.js')}}"></script>
<script src="{{asset('public/ela-site/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('public/ela-site/js/template.js')}}"></script>
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
            title: {required: true},
            description:{required: true},            
          },
          messages: {
            title: {required: 'Please enter Title.'},
            description: {required: 'Please enter Description.'},          
          },
          submitHandler: function (form) { 
            var formData= new FormData(jQuery('#add_product')[0]);
              formData.append('_token',"{{ csrf_token() }}");
              jQuery.ajax({
                  url: "/bedesk/addAdsAction",
                  type:'POST',
                  data:formData,
                  processData: false,
                  contentType: false,
                    cache: false,
                  beforeSend: function() { 
                    jQuery('button[name="submit"]').html('Saving ....');
                    jQuery('button[name="submit"]').attr('disabled','disabled');
                  },
                  success: function(data) { 
                    var obj = JSON.parse(data);

                      if(obj.status=='true'){

                        if(obj.message){
                          var text = obj.message;                          
                        }                   
                        jQuery("#success_msg").html('<p style="color:green;text-align:center;font-weight:500px;font-size:25px;">'+text + '<p><br>');
                       
                        setTimeout(function(){
                          jQuery('#add_product')[0].reset();
                          jQuery('button[name="submit"]').html('Submit');
                          jQuery('button[name="submit"]').removeAttr('disabled');
                          jQuery("#errors").html('');
                         window.location= "{{url('/admin/ads-manager')}}";
                        }, 3000);
                      }else{
                       // console.log(obj.errors);
                        if(obj.errors){
                          var errors = obj.errors;
                          var i;
                          var text = '';
                          for (i = 0; i <errors.length; i++) {
                             text += errors[i] + "<br>";
                           } 
                        }
                        if(obj.message){
                          var text = obj.message;
                          
                        }                   
                        jQuery("#errors").html('<p style="color:red;text-align:center;font-weight:500px;">'+text + '<p><br>');

                        setTimeout(function(){
                          jQuery('button[name="submit"]').html('Submit');
                          jQuery('button[name="submit"]').removeAttr('disabled');
                          jQuery("#errors").html('');
                        }, 2000);                           

                     
                      }
                     
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
        url: "/bedesk/logoutAction",
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
@endsection('content')

