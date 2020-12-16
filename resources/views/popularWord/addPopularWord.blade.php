@extends('layout')
@section('content')
<!-- Start Body container box----->
<div class="col-12 grid-margin">
   <div class="card">
      <div class="card-body">
         <div id="errors"></div>
         <form class="form-sample addproduct" id="add_product" method="post" enctype="multipart/form-data" action="">
            <!-- Start row form box ---->
            <div class="rowForm">
              <h4 class="card-title">General Info</h4>
              <p class="card-description">
                 
              </p>
              <div class="row">
                <div class="col-md-12">

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Word</label>
                    <div class="col-sm-9">
                      <input type="text" name="search" id="search" placeholder="Search Word"  class="form-control" />
                      <input type="hidden"  name="word_id"  id="word_id">
                      <div class="allword"  id="allword"></div>
                    </div>
                  </div>              
                
                </div>                
              </div>
            </div>
            <!-- End row form box -->           
          
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <button type="submit" name="submit" class="btn btn-primary mr-2">Submit</button>
                 <!--- <button class="btn btn-light">Cancel</button>---->
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
        search: {required: true}       
      },
      messages: {
        search: {required: 'Please enter word.'}       
      },
      submitHandler: function (form) { 
        var formData= new FormData(jQuery('#add_product')[0]);
          formData.append('_token',"{{ csrf_token() }}");
          jQuery.ajax({
              url: "/bedesk/addPopularWordAction",
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
                obj = JSON.parse(data);

                  if(obj.status=='true'){
                   jQuery("#add_product")[0].reset();
                   jQuery('.ajaxMsg').show().addClass('ajaxSucc').removeClass('ajaxErr').html(obj.message);
                    setTimeout(function(){
                    jQuery('.ajaxMsg').hide();
                    jQuery('button[name="submit"]').html('Submit');
                    jQuery('button[name="submit"]').removeAttr('disabled');
                    //window.location= ("{{asset('login')}}");
                    window.location= "{{url('/admin/popular-word')}}";
                    }, 3000);
                  }else{


                   
                    var errors = obj.errors;

                    var text = "";
                       var i;
                       for (i = 0; i <errors.length; i++) {
                         text += errors[i] + "<br>";
                       }                          

                       
                        jQuery("#errors").html('<p style="color:red;">'+text + '<p><br>');
                           

                   jQuery('.ajaxMsg').show().addClass('ajaxErr').removeClass('ajaxSucc').html(obj.message);
                  setTimeout(function(){
                     jQuery('button[name="submit"]').html('Submit');
                          jQuery('button[name="submit"]').removeAttr('disabled');
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

    $(document).on('keyup', '#search', function(){
              var query = $(this).val();
              $.ajax({
                  url:"/bedesk/getWordBySearchTermAction",
                  method:'POST',
                  data:{query:query,'_token' : '{{ csrf_token() }}'},
                  dataType:'json',
                  success:function(data)
                  {
                   $('#allword').html(data);
                   //$('#total_records').text(data.total_data);
                  }
              })              
            });
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

   function GetWordById($this){
    var word = $($this).attr('data-word');
    var word_id = $($this).attr('data-id');
    $('#search').val(word);
    $('#word_id').val(word_id);

    
    
   }
   
   //document.getElementById("defaultOpen").click();
</script> 
@endsection('content')

