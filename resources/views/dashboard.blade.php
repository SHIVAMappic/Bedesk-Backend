@extends('layout')
@section('content')
          
          <div class="row">
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Cash deposits</p>
                  <p class="mb-4">To start a blog, think of a topic about and first brainstorm party is ways to write details</p>
                  <div id="cash-deposits-chart-legend" class="d-flex justify-content-center pt-3"></div>
                  <canvas id="cash-deposits-chart"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Total sales</p>
                  <h1>$ 28835</h1>
                  <h4>Gross sales over the years</h4>
                  <p class="text-muted">Today, many people rely on computers to do homework, work, and create or store useful information. Therefore, it is important </p>
                  <div id="total-sales-chart-legend"></div>                  
                </div>
                <canvas id="total-sales-chart"></canvas>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Recent Purchases</p>
                  <div class="table-responsive">
                    <table id="recent-purchases-listing" class="table">
                      <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status report</th>
                            <th>Office</th>
                            <th>Price</th>
                            <th>Date</th>
                            <th>Gross amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                            <td>Jeremy Ortega</td>
                            <td>Levelled up</td>
                            <td>Catalinaborough</td>
                            <td>$790</td>
                            <td>06 Jan 2018</td>
                            <td>$2274253</td>
                        </tr>
                        <tr>
                            <td>Alvin Fisher</td>
                            <td>Ui design completed</td>
                            <td>East Mayra</td>
                            <td>$23230</td>
                            <td>18 Jul 2018</td>
                            <td>$83127</td>
                        </tr>
                        <tr>
                            <td>Emily Cunningham</td>
                            <td>support</td>
                            <td>Makennaton</td>
                            <td>$939</td>
                            <td>16 Jul 2018</td>
                            <td>$29177</td>
                        </tr>
                        <tr>
                            <td>Minnie Farmer</td>
                            <td>support</td>
                            <td>Agustinaborough</td>
                            <td>$30</td>
                            <td>30 Apr 2018</td>
                            <td>$44617</td>
                        </tr>
                        <tr>
                            <td>Betty Hunt</td>
                            <td>Ui design not completed</td>
                            <td>Lake Sandrafort</td>
                            <td>$571</td>
                            <td>25 Jun 2018</td>
                            <td>$78952</td>
                        </tr>
                        <tr>
                            <td>Myrtie Lambert</td>
                            <td>Ui design completed</td>
                            <td>Cassinbury</td>
                            <td>$36</td>
                            <td>05 Nov 2018</td>
                            <td>$36422</td>
                        </tr>
                        <tr>
                            <td>Jacob Kennedy</td>
                            <td>New project</td>
                            <td>Cletaborough</td>
                            <td>$314</td>
                            <td>12 Jul 2018</td>
                            <td>$34167</td>
                        </tr>
                        <tr>
                            <td>Ernest Wade</td>
                            <td>Levelled up</td>
                            <td>West Fidelmouth</td>
                            <td>$484</td>
                            <td>08 Sep 2018</td>
                            <td>$50862</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      
  </div>
  <!-- container-scroller -->

  

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
   function deleteRecord($this){
   
      var record_id = $($this).attr('data-id');
      var url = $($this).attr('data-url');
       var token = $($this).attr('data-token');
       if(confirm('Are You sure want to delete this record!')){
       jQuery.ajax({
           url: "/bedesk/deleteCategoryAction",
           type:'POST',
           data:{'record_id':record_id,'_token':token},
            success: function(data) { 
             obj = JSON.parse(data);
             jQuery('#'+record_id).hide();
            
          }
       });
      }else{
         return false;
      }
   }
   
   
   
   
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