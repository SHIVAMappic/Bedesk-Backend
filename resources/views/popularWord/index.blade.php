@extends('layout')
@section('content')
 <!-- Start Body container box----->
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-12 stretch-card">
          <div class="card">
            <div class="card-body">
              <p class="card-title">Popular Words</p>
                <div class="table-responsive">
                  <table id="recent-purchases-listing" class="table">
                  <thead>
                    <tr>
                      <th>Sr No.</th>
                      <th>Word</th>                     
                      <th>Add Date</th>
                      <th>Category</th>                                             
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($allWords)
                    <?php  $i = 1; ?>
                      @foreach($allWords as $words)
                        <tr  id="{{$words->id}}">
                          <td><?php echo $i;?></td>
                          <td>{{$words->word_name}}</td>                         
                          <td>{{$words->add_date}}</td>
                          <td>{{$words->category_name}}</td>                                                        
                          <td>
                            <a href="{{url('admin/popular-word/viewWord',$words->id)}}" class="btn btn-info  "> <i class="fa fa-eye" aria-hidden="true"></i></a>
                            <!---<a href="{{url('admin/blogs/editBlog',$words->id)}}" class="btn btn-success "><i class="fa fa-edit"></i></a>--->
                            <button type="button"  onclick="deleteRecord(this)"
                                data-url="{{url('admin/blogs/editBlog')}}" data-token="{{ csrf_token() }}" data-id="{{$words->id}}" class="btn btn-danger "><i class="fa fa-trash"></i>
                            </button>
                          </td>
                        </tr>
                        <?php  $i++;?>
                      @endforeach
                    @endif  
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
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
<!-- container-scroller--->

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
  function deleteRecord($this){          
    var record_id = $($this).attr('data-id');
    var url = $($this).attr('data-url');
    var token = $($this).attr('data-token');
    if(confirm('Are You sure want to delete this record!')){
      jQuery.ajax({
        url: "/bedesk/deletePopularWordAction",
        type:'POST',
        data:{'record_id':record_id,'_token':token},
        success: function(data) { 
          obj = JSON.parse(data);
          alert(obj.message);
          jQuery('#'+record_id).hide();
        }
      });
    }else {
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
          var obj = JSON.parse(data);
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