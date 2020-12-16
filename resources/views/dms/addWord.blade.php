@extends('layout')
@section('content')
<div class="col-12 grid-margin">
   <div class="card">
      <div class="card-body">
         <div id="errors">
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
                        <label class="col-sm-3 col-form-label">Word Name</label>
                        <div class="col-sm-9">
                           <input type="text" name="word_name" id="word_name" class="form-control" />
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Meaning</label>
                        <div class="col-sm-9">
                           <input type="text" name="meaning" id="meaning" class="form-control" />
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Category</label>
                        <div class="col-sm-9">
                           <select name="category"  class="form-control">
                              <option  value="">Select Category</option>
                              @foreach($allCategories as $category)
                              <option value="{{$category->id}}">{{$category->category_name}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Synonyms</label>
                        <div class="col-sm-9">
                           <input type="text" name="synonyms" id="synonyms" class="form-control" />
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Antonyms</label>
                        <div class="col-sm-9">
                           <input type="text" name="antonyms" id="antonyms" class="form-control" />
                        </div>
                     </div>
                  </div>
                  <!--<div class="col-md-12">
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Product Description</label>
                        <div class="col-sm-9">
                           <textarea class="form-control" name="productdesc" id="exampleTextarea1" rows="4"></textarea>
                        </div>
                     </div>
                     </div>-->
               </div>
            </div>
            <!-- image section -->
            <div class="rowForm">
               <h4 class="card-title">Image</h4>
               <p class="card-description">
                  Upload your Word image. 
               </p>
               <div class="row">
                  <div class="col-md-5">
                     <div class="form-group">
                        <label> Image</label>
                        <input type="file" name="word_image" class="file-upload-default  sf1">
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
                     <div class="form-group">
                        <!--<label>Gallery Images</label>
                           <input type="file" name="gallery[]" class="file-upload-default file-upload-default1" multiple>
                           <div class="input-group col-xs-12">
                              <input type="text" class="form-control form-contro11 file-upload-info" disabled placeholder="Upload Images">
                              <span class="input-group-append">
                              <button class="file-upload-browse1 btn btn-primary" type="button">Upload</button>
                              </span>
                           </div>-->
                     </div>
                  </div>
               </div>
            </div>
            <!-- audio section -->
            <div class="rowForm">
               <h4 class="card-title">Audio</h4>
               <p class="card-description">
                  Upload audio. 
               </p>
               <div class="row">
                  <div class="col-md-5">
                     <div class="form-group">
                        <label>Audio</label>
                        <input type="file" name="word_audio" class="file-upload-default sf2">
                        <div class="input-group col-xs-12">
                           <input type="text" class="form-control form-control02 file-upload-info" disabled placeholder="Upload Image">
                           <span class="input-group-append">
                           <button class="file-upload-browse sfup2 btn btn-primary" type="button">Upload</button>
                           </span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-1"></div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <!---  <label>Gallery Images</label>
                           <input type="file" name="gallery[]" class="file-upload-default file-upload-default1" multiple>
                           <div class="input-group col-xs-12">
                              <input type="text" class="form-control form-contro11 file-upload-info" disabled placeholder="Upload Images">
                              <span class="input-group-append">
                              <button class="file-upload-browse1 btn btn-primary" type="button">Upload</button>
                              </span>
                           </div>--->
                     </div>
                  </div>
               </div>
            </div>
            <!-- video section -->
            <div class="rowForm">
               <h4 class="card-title">Video</h4>
               <p class="card-description">
                  Upload video. 
               </p>
               <div class="row">
                  <div class="col-md-5">
                     <div class="form-group">
                        <label>Video</label>
                        <input type="file" name="word_video" class="file-upload-default sf3">
                        <div class="input-group col-xs-12">
                           <input type="text" class="form-control form-control03 file-upload-info" disabled placeholder="Upload Image">
                           <span class="input-group-append">
                           <button class="file-upload-browse sfup3 btn btn-primary" type="button">Upload</button>
                           </span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-1"></div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <!---  <label>Gallery Images</label>
                           <input type="file" name="gallery[]" class="file-upload-default file-upload-default1" multiple>
                           <div class="input-group col-xs-12">
                              <input type="text" class="form-control form-contro11 file-upload-info" disabled placeholder="Upload Images">
                              <span class="input-group-append">
                              <button class="file-upload-browse1 btn btn-primary" type="button">Upload</button>
                              </span>
                           </div>--->
                     </div>
                  </div>
               </div>
            </div>
            <!-- document section -->
            <div class="rowForm">
               <h4 class="card-title">Document</h4>
               <p class="card-description">
                  Upload document. 
               </p>
               <div class="row">
                  <div class="col-md-5">
                     <div class="form-group">
                        <label>Document</label>
                        <input type="file" name="word_document" class="file-upload-default sf4">
                        <div class="input-group col-xs-12">
                           <input type="text" class="form-control form-control04 file-upload-info" disabled placeholder="Upload Image">
                           <span class="input-group-append">
                           <button class="file-upload-browse sfup4 btn btn-primary" type="button">Upload</button>
                           </span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-1"></div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <!---  <label>Gallery Images</label>
                           <input type="file" name="gallery[]" class="file-upload-default file-upload-default1" multiple>
                           <div class="input-group col-xs-12">
                              <input type="text" class="form-control form-contro11 file-upload-info" disabled placeholder="Upload Images">
                              <span class="input-group-append">
                              <button class="file-upload-browse1 btn btn-primary" type="button">Upload</button>
                              </span>
                           </div>--->
                     </div>
                  </div>
               </div>
            </div>
            <!---<div class="rowForm">
               <h4 class="card-title">Additional Data</h4>
               <p class="card-description">
                  Add you product additional data.
               </p>
               <div class="row">
                  <div class="col-md-12">
                     <div class="tab1">
                        <button type="button" class="tablinks" onclick="openCity(event, 'Price')" id="defaultOpen">Price</button>
                        <button type="button" class="tablinks" onclick="openCity(event, 'Inventory')">Inventory</button>
                        <button type="button" class="tablinks" onclick="openCity(event, 'Shipping')">Shipping</button>
                        <button type="button" class="tablinks" onclick="openCity(event, 'Attributes')">Attributes</button>
                        <button type="button" class="tablinks" onclick="openCity(event, 'Advanced')">Advanced</button>
                     </div>
                     <div id="Price" class="tabcontent">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group row">
                                 <label class="col-sm-3 col-form-label">Regular Price ($)</label>
                                 <div class="col-sm-9">
                                    <input type="text" name="regular_price" id="regular_price" class="form-control" />
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group row">
                                 <label class="col-sm-3 col-form-label">Sale Price ($)</label>
                                 <div class="col-sm-9">
                                    <input type="text" name="sale_price" id="sale_price" class="form-control" />
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div id="Inventory" class="tabcontent">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group row">
                                 <label class="col-sm-3 col-form-label">SKU</label>
                                 <div class="col-sm-9">
                                    <input type="text" name="sku" id="sku" class="form-control" />
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group row">
                                 <label class="col-sm-3 col-form-label">Manage Stock?</label>
                                 <div class="col-sm-9">
                                    <div class="form-check">
                                       <label class="form-check-label">
                                       <input type="checkbox" name="managestock" id="managestock" class="form-check-input">
                                       Enable stock management at product level
                                       </label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group row">
                                 <label class="col-sm-3 col-form-label">Stock Status</label>
                                 <div class="col-sm-9">
                                    <select class="form-control" name="stockstatus" id="stockstatus">
                                       <option value="in-stock" selected="">In Stock</option>
                                       <option value="out-of-stock">Out of Stock</option>
                                       <option value="on-backorder">On Backorder</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group row">
                                 <label class="col-sm-3 col-form-label">Sold Individually</label>
                                 <div class="col-sm-9">
                                    <div class="form-check">
                                       <label class="form-check-label">
                                       <input type="checkbox" name="soldind" id="soldind" class="form-check-input">
                                       Enable this to only allow one of this item to be bought in a single order
                                       </label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div id="Shipping" class="tabcontent">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group row">
                                 <label class="col-sm-3 col-form-label">Weight (oz)</label>
                                 <div class="col-sm-9">
                                    <input type="text" name="weight" id="weight" class="form-control" />
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group row">
                                 <label class="col-sm-3 col-form-label">Dimensions (in)</label>
                                 <div class="col-sm-9">
                                    <div class="row">
                                       <div class="col-sm-4">
                                          <input type="text" name="length" id="length" class="form-control" placeholder="Length" />
                                       </div>
                                       <div class="col-sm-4">
                                          <input type="text" name="width" id="width" class="form-control" placeholder="Width" />
                                       </div>
                                       <div class="col-sm-4">
                                          <input type="text" name="height" id="height" class="form-control" placeholder="Height" />
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group row">
                                 <label class="col-sm-3 col-form-label">Shipping Class</label>
                                 <div class="col-sm-9">
                                    <select class="form-control" name="shippingclass" id="shippingclass">
                                       <option value="in-stock" selected="">No Shipping Class</option>
                                       <option value="out-of-stock">International</option>
                                       <option value="on-backorder">National</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div id="Attributes" class="tabcontent">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="ecommerce-attributes-wrapper">
                                 <div class="form-group row justify-content-center ecommerce-attribute-row">
                                    <div class="col-md-4">
                                       <label class="control-label">Name</label>
                                       <input type="text" class="form-control form-control-modern" name="attName" value="Size">
                                       <div class="checkbox mt-3 mb-3 mb-lg-0">
                                          <label class="my-2">
                                          <input type="checkbox" name="attVisible" value="1" checked="">
                                          Visible on the product page
                                          </label>
                                       </div>
                                    </div>
                                    <div class="col-md-8">
                                       <a href="#" class="ecommerce-attribute-remove text-color-danger float-right">Remove</a>
                                       <label class="control-label">Value(s)</label>
                                       <textarea class="form-control form-control-modern" name="attValue" rows="4" placeholder="Enter some text, or some attributes by | separating values"></textarea>
                                    </div>
                                 </div>
                                 <div class="col-md-9">
                                    <a href="#" class="ecommerce-attribute-add-new btn btn-primary btn-px-4 btn-py-2">+ Add New</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div id="Advanced" class="tabcontent">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group row">
                                 <label class="col-sm-3 col-form-label">Purchase Note</label>
                                 <div class="col-sm-9">
                                    <textarea class="form-control" name="notes" id="notes" rows="4"></textarea>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group row">
                                 <label class="col-sm-3 col-form-label">Menu Order</label>
                                 <div class="col-sm-9">
                                    <input type="text" name="menu_order" id="menu_order" class="form-control" />
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               </div>---->
            <div class="row">
               <div class="col-md-12">
                  <div class="form-group">
                     <button type="submit" name="submit" class="btn btn-primary mr-2">Submit</button>
                    <!---- <button class="btn btn-light">Cancel</button>----->
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
     meaning : {required: true},
     category:{required: true},           
   },
   messages: {
     word_name: {required: 'Please enter word name.'},
     meaning: {required: 'Please enter meaning.'},
     category: {required: 'Please select category.'},            
   },
   submitHandler: function (form) { 
     var formData= new FormData(jQuery('#add_product')[0]);
       formData.append('_token',"{{ csrf_token() }}");
       jQuery.ajax({
           url: "/bedesk/addWordAction",
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
               // jQuery('.ajaxMsg').show().addClass('ajaxSucc').removeClass('ajaxErr').html(obj.message);
                 setTimeout(function(){
                    jQuery('button[name="submit"]').html('Submit');
                    jQuery('button[name="submit"]').removeAttr('disabled');
                    window.location= "{{url('/admin/dms')}}";   
                   //jQuery('.ajaxMsg').hide();
                 
                 }, 3000);
               }else{                
                 var errors = obj.errors;   
                 var text = "";
                    var i;
                    for (i = 0; i <errors.length; i++) {
                      text += errors[i] + "<br>";
                    }                
   
                    
                  jQuery("#errors").html('<p style="color:red;">'+text + '<p><br>');
                        
   
                //jQuery('.ajaxMsg').show().addClass('ajaxErr').removeClass('ajaxSucc').html(obj.message);
               setTimeout(function(){
                 jQuery('button[name="submit"]').html('Submit');
                 jQuery('button[name="submit"]').removeAttr('disabled');
   
                 //jQuery('.ajaxMsg').hide();
                 }, 3000);
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