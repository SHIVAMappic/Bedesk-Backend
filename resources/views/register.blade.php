<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Register</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('public/ela-site/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/ela-site/vendors/base/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('public/ela-site/css/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('public/ela-site/images/favicon.png')}}" />
</head>

<body>
<?php $logSESSION = Session::get('log_base'); ?>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo" style="text-align: center;">
                <img   src="{{asset('public/ela-site/images/logo-dark.png')}}" alt="logo" style="width: 100px;">
              </div>
              <h4>New here?</h4>
              <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
              <form method="post" id="register" class="pt-3" action="">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="fullname" id="fullname" placeholder="Full name">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="email" id="email" placeholder="Email">
                </div>
				<div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Password">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="phone" id="phone" placeholder="Phone number">
                </div>
                
                <div class="mb-4">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" name="tc" id="tc" class="form-check-input">
                      I agree to all Terms & Conditions
                    </label>
                  </div>
                </div>
                <div class="mt-3" style="text-align: center;">
				  <input type="submit" name="submit" value="SIGN UP" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
				  <span class="ajaxMsg" style="margin-top: 10px;"></span>
                </div>
                <div class="text-center font-weight-light" style="margin-top: 10px;">
                  Already have an account? <a href="{{asset('login')}}" class="text-primary">Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{asset('public/ela-site/vendors/base/vendor.bundle.base.js')}}"></script>
  <script src="{{asset('public/ela-site/js/off-canvas.js')}}"></script>
  <script src="{{asset('public/ela-site/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('public/ela-site/js/template.js')}}"></script>
  <script src="{{asset('public/ela-site/js/jquery.validate.min.js')}}"></script>
  <script>
  jQuery("#register").each(function(e, a) {
	  jQuery.validator.addMethod("alpha_email", function(e, a) {
			return this.optional(a) || e.toLowerCase() == e.toLowerCase().match(/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/)
		}, 'Please choose valid email-address.');
	  jQuery(this).validate({
			rules: {
				fullname: {required: true,minlength:3, maxlength:30},
				email: {required: true,alpha_email: true},
				phone: {required: true,minlength:3,digits:true, maxlength:30},
				password:  {required: true,minlength:6, maxlength:50},
				tc: {required: true},
				
			},
			messages: {
				fullname: {required: 'Please enter name.'},
				email: {required: 'Please enter an e-mail address.'},
				phone: {required: 'Please enter phone.',digits:"Please enter numbers Only"},
				password:  {required: 'Please enter a password.',minlength:'Please enter minimum length of password limit 6 digit.'},
				tc: {required: 'Terms and condition required.'},
			},
			submitHandler: function (form) {
				var formData= new FormData(jQuery('#register')[0]);
					formData.append('_token',"{{ csrf_token() }}");
					jQuery.ajax({
						  url: "/ela/registerAction",
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
<?php if(isset($logSESSION)){  ?>
<script>
window.location= ("{{asset('admin/dashboard')}}");
</script>
<?php } ?>
</body>
</html>