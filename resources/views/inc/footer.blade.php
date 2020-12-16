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
		  jQuery(this).parent().find('.form-control01').val($(this).val().replace(/C:\\fakepath\\/i, ''));
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