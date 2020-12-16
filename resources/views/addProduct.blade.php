<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Add Product</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('public/ela-site/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/ela-site/vendors/base/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{asset('public/ela-site/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('public/ela-site/css/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('public/ela-site/images/favicon.png')}}" />
</head>
<body>
<?php $logSESSION = Session::get('log_base'); ?>
  <div class="container-scroller">
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
          <a class="navbar-brand brand-logo" href="#"><img src="{{asset('public/ela-site/images/el.png')}}" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="#"><img src="{{asset('public/ela-site/images/el.png')}}" alt="logo"/></a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
          </button>
        </div>  
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-4">
          <li class="nav-item nav-search d-none d-lg-block w-100"><h2 style="color:#000;">Add Product</h2></li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
		  <li class="navbar-nav mr-lg-4 w-100">
			<div class="d-flex justify-content-between align-items-end flex-wrap">
			  <button class="btn btn-primary mt-2 mt-xl-0">Add Product</button>
			</div>
		  </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="{{asset('public/ela-site/images/el.png')}}" alt="profile"/>
              <span class="nav-profile-name">Decew </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="mdi mdi-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item" href="javascript:void(0);" id="melogout">
                <i class="mdi mdi-logout text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{asset('/admin/dashboard')}}">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-cart menu-icon"></i>
              <span class="menu-title">Elpatiopty Shop</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{asset('/admin/add-product')}}">Add Product</a></li>
                <li class="nav-item"> <a class="nav-link" href="#">Products List</a></li>
				<li class="nav-item"> <a class="nav-link" href="#">Add Category</a></li>
				<li class="nav-item"> <a class="nav-link" href="#">Categories List</a></li>
				<li class="nav-item"> <a class="nav-link" href="#">Add Coupon</a></li>
				<li class="nav-item"> <a class="nav-link" href="#">Coupons List</a></li>
				<li class="nav-item"> <a class="nav-link" href="#">Orders List</a></li>
				<li class="nav-item"> <a class="nav-link" href="#">Add Customer</a></li>
				<li class="nav-item"> <a class="nav-link" href="#">Customers List</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/forms/basic_elements.html">
              <i class="mdi mdi-view-headline menu-icon"></i>
              <span class="menu-title">Form elements</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/charts/chartjs.html">
              <i class="mdi mdi-chart-pie menu-icon"></i>
              <span class="menu-title">Charts</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/tables/basic-table.html">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Tables</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/icons/mdi.html">
              <i class="mdi mdi-emoticon menu-icon"></i>
              <span class="menu-title">Icons</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/login-2.html"> Login 2 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/register-2.html"> Register 2 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/lock-screen.html"> Lockscreen </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="documentation/documentation.html">
              <i class="mdi mdi-file-document-box-outline menu-icon"></i>
              <span class="menu-title">Documentation</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
           
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  
                  <form class="form-sample addproduct" id="add_product" method="post" enctype="multipart/form-data" action="">
					<div class="rowForm">
					<h4 class="card-title">General Info</h4>
                    <p class="card-description">
                      Add here the product description with all details and necessary information.
                    </p>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Product Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="productname" id="productname" class="form-control" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                       <div class="form-group row">
						  <label class="col-sm-3 col-form-label">Product Description</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" name="productdesc" id="exampleTextarea1" rows="4"></textarea>
                          </div>
						</div>
                      </div>
                    </div>
					</div>
					<div class="rowForm">
					<h4 class="card-title">Product Image</h4>
					<p class="card-description">
                      Upload your Product image. You can add multiple images
                    </p>
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label>Single Image</label>
						  <input type="file" name="single" class="file-upload-default sf1">
                          <div class="input-group col-xs-12">
								<input type="text" class="form-control form-control01 file-upload-info" disabled placeholder="Upload Image">
								<span class="input-group-append">
								  <button class="file-upload-browse sfup1 btn btn-primary" type="button">Upload</button>
								</span>
							  </div>
                        </div>
                      </div><div class="col-md-1"></div>
					  <div class="col-md-6">
                        <div class="form-group">
                          <label>Gallery Images</label>
						  <input type="file" name="gallery[]" class="file-upload-default file-upload-default1" multiple>
                          <div class="input-group col-xs-12">
								<input type="text" class="form-control form-contro11 file-upload-info" disabled placeholder="Upload Images">
								<span class="input-group-append">
								  <button class="file-upload-browse1 btn btn-primary" type="button">Upload</button>
								</span>
							  </div>
                        </div>
						
                      </div>
                    </div>
					</div>
					<div class="rowForm">
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
        <!-- content-wrapper ends -->
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
  jQuery("#add_product").each(function(e, a) {
	  jQuery(this).validate({
			rules: {
				productname: {required: true,minlength:3, maxlength:30},
				productdesc: {required: true},
				regular_price: {required: true,digits:true},
			},
			messages: {
				productname: {required: 'Please enter product name.'},
				productdesc: {required: 'Please enter product description.'},
				regular_price: {required: 'Please enter regular price.',digits:"Please enter numbers Only"},
			},
			submitHandler: function (form) {
				var formData= new FormData(jQuery('#add_product')[0]);
					formData.append('_token',"{{ csrf_token() }}");
					jQuery.ajax({
						  url: "/ela/addProductAction",
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
								  if(obj.status=='true'){
									 jQuery("#register")[0].reset();
									 jQuery('.ajaxMsg').show().addClass('ajaxSucc').removeClass('ajaxErr').html(obj.message);
									  setTimeout(function(){
										jQuery('.ajaxMsg').hide();
										window.location= ("{{asset('login')}}");
									  }, 3000);
								  }else{
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

		
		jQuery('.sf1').on('change', function() {
		  jQuery(this).parent().find('.form-control00').val($(this).val().replace(/C:\\fakepath\\/i, ''));
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

	document.getElementById("defaultOpen").click();
	</script> 
<?php if(!isset($logSESSION)){  ?>
<script>
window.location= ("{{asset('login')}}");
</script>
<?php } ?>
</body>

</html>