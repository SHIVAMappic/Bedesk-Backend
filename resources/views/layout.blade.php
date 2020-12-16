<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>BeDesk</title>
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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      
   </head>
   <body>
      <?php $logSESSION = Session::get('log_base'); ?>
      <div class="container-scroller">
         <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex justify-content-center">
               <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
                  <a class="navbar-brand brand-logo" href="#"><img src="{{asset('public/ela-site/images/logo-dark.png')}}" alt="logo"/></a>
                  <a class="navbar-brand brand-logo-mini" href="#"><img src="{{asset('public/ela-site/images/logo-dark.png')}}" alt="logo"/></a>
                  <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                  <span class="mdi mdi-sort-variant"></span>
                  </button>
               </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
               <ul class="navbar-nav mr-lg-4">
                  <li class="nav-item nav-search d-none d-lg-block w-100">
                     <h2 style="color:#000;">{{$pageTitle}}</h2>
                  </li>
               </ul>
               <ul class="navbar-nav navbar-nav-right">
                 <!-- <li class="navbar-nav mr-lg-4 w-100">
                     <div class="d-flex justify-content-between align-items-end flex-wrap">
                        <button class="btn btn-primary mt-2 mt-xl-0">Add Word</button>
                     </div>
                  </li>-->
                  <li class="nav-item nav-profile dropdown">
                     <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                     <img src="{{asset('public/ela-site/images/logo-dark.png')}}" alt="profile"/>
                     <span class="nav-profile-name">Decew </span>
                     </a>
                     <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item">
                        <i class="mdi mdi-settings text-primary"></i>
                        Settings
                        </a>
                        <a class="dropdown-item" href="{{url('admin/logout')}}" id="melogout">
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
                 <!-- <li class="nav-item">
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
                  </li>--->
                  <li class="nav-item">
                     <a class="nav-link" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic2">
                     <i class="mdi mdi-cart menu-icon"></i>
                     <span class="menu-title">DMS</span>
                     <i class="menu-arrow"></i>
                     </a>
                     <div class="collapse" id="ui-basic2">
                        <ul class="nav flex-column sub-menu">
                           <li class="nav-item"> <a class="nav-link" href="{{url('/admin/dms')}}">All Words</a></li>
                           <li class="nav-item"> <a class="nav-link" href="{{url('/admin/dms/addWord')}}">Add  Word</a></li>
                        </ul>
                     </div>
                  </li>

                     <li class="nav-item">
                     <a class="nav-link" data-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic3">
                    <i class="mdi mdi-view-list menu-icon"></i>
                     <span class="menu-title">Category</span>
                     <i class="menu-arrow"></i>
                     </a>
                     <div class="collapse" id="ui-basic3">
                        <ul class="nav flex-column sub-menu">
                           <li class="nav-item"> <a class="nav-link" href="{{url('/admin/category')}}">All Categories</a></li>
                           <li class="nav-item"> <a class="nav-link" href="{{url('/admin/category/addCategory')}}">Add  Category</a></li>
                        </ul>
                     </div>
                  </li>


                    <li class="nav-item">
                     <a class="nav-link" data-toggle="collapse" href="#ui-basic8" aria-expanded="false" aria-controls="ui-basic3">
                     <i class="mdi mdi-blogger menu-icon"></i>
                     <span class="menu-title">Blogs</span>
                     <i class="menu-arrow"></i>
                     </a>
                     <div class="collapse" id="ui-basic8">
                        <ul class="nav flex-column sub-menu">
                           <li class="nav-item"> <a class="nav-link" href="{{url('/admin/blogs')}}">All Blogs</a></li>
                           <li class="nav-item"> <a class="nav-link" href="{{url('/admin/blogs/addBlog')}}">Add  Blog</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{url('/admin/blog-category')}}">Category</a></li>
                        </ul>
                     </div>
                  </li>

                   <li class="nav-item">
                     <a class="nav-link" data-toggle="collapse" href="#ui-basic2233" aria-expanded="false" aria-controls="ui-basic22">
                     <i class="mdi mdi-cart menu-icon"></i>
                     <span class="menu-title">Word of The Day</span>
                     <i class="menu-arrow"></i>
                     </a>
                     <div class="collapse" id="ui-basic2233">
                        <ul class="nav flex-column sub-menu">
                           <li class="nav-item"> <a class="nav-link" href="{{url('/admin/wordByDay')}}">All Words</a></li>
                           <li class="nav-item"> <a class="nav-link" href="{{url('/admin/wordByDay/addWord')}}">Add  Word</a></li>                         
                        </ul>
                     </div>
                  </li>


                   <li class="nav-item">
                     <a class="nav-link" data-toggle="collapse" href="#ui-basic22" aria-expanded="false" aria-controls="ui-basic22">
                     <i class="mdi mdi-cart menu-icon"></i>
                     <span class="menu-title">Popular Words</span>
                     <i class="menu-arrow"></i>
                     </a>
                     <div class="collapse" id="ui-basic22">
                        <ul class="nav flex-column sub-menu">
                           <li class="nav-item"> <a class="nav-link" href="{{url('/admin/popular-word')}}">All Words</a></li>
                           <li class="nav-item"> <a class="nav-link" href="{{url('/admin/popular-word/add-popular-word')}}">Add  Word</a></li>                           
                        </ul>
                     </div>
                  </li>

                  <li class="nav-item">
                     <a class="nav-link" data-toggle="collapse" href="#ui-basic2345" aria-expanded="false" aria-controls="ui-basic2345">
                     <i class="mdi mdi-cart menu-icon"></i>
                     <span class="menu-title">Ads Manager</span>
                     <i class="menu-arrow"></i>
                     </a>
                     <div class="collapse" id="ui-basic2345">
                        <ul class="nav flex-column sub-menu">
                           <li class="nav-item"> <a class="nav-link" href="{{url('/admin/ads-manager')}}">All Ads</a></li>
                           <li class="nav-item"> <a class="nav-link" href="{{url('/admin/ads-manager/addAds')}}">Add Ads</a></li>    
                        </ul>
                     </div>
                  </li>

                    <li class="nav-item">
                     <a class="nav-link" data-toggle="collapse" href="#ui-basic234522" aria-expanded="false" aria-controls="ui-basic234522">
                     <i class="mdi mdi-cart menu-icon"></i>
                     <span class="menu-title">Newsletter</span>
                     <i class="menu-arrow"></i>
                     </a>
                     <div class="collapse" id="ui-basic234522">
                        <ul class="nav flex-column sub-menu">
                           <li class="nav-item"> <a class="nav-link" href="{{url('/admin/newsletter')}}">All Newsletter</a></li>
                           <li class="nav-item"> <a class="nav-link" href="{{url('/admin/newsletter/addNewsletter')}}">Add Newsletter</a></li> 
                           <li class="nav-item"> <a class="nav-link" href="{{url('/admin/subscribers')}}">Subscribers</a></li>    
                        </ul>
                     </div>
                  </li>



                    <li class="nav-item">
                     <a class="nav-link" data-toggle="collapse" href="#ui-basic234522" aria-expanded="false" aria-controls="ui-basic234522">
                     <i class="mdi mdi-cart menu-icon"></i>
                     <span class="menu-title">Subscription</span>
                     <i class="menu-arrow"></i>
                     </a>
                     <div class="collapse" id="ui-basic234522">
                        <ul class="nav flex-column sub-menu">
                           <li class="nav-item"> <a class="nav-link" href="{{url('/admin/subscription')}}">All Subscription</a></li>
                           <li class="nav-item"> <a class="nav-link" href="{{url('/admin/subscription/addSubscription')}}">Add Subscription</a></li>    
                        </ul>
                     </div>
                  </li>






                    <li class="nav-item">
                     <a class="nav-link" data-toggle="collapse" href="#ui-basic4" aria-expanded="false" aria-controls="ui-basic4">
                     <i class="mdi mdi-account-multiple  menu-icon"></i>
                     <span class="menu-title">Users</span>
                     <i class="menu-arrow"></i>
                     </a>
                     <div class="collapse" id="ui-basic4">
                        <ul class="nav flex-column sub-menu">
                           <li class="nav-item"> <a class="nav-link" href="{{url('/admin/users')}}">All Users</a></li>
                          <!----- <li class="nav-item"> <a class="nav-link" href="{{url('/admin/users/addUser')}}">Add  User</a></li>----->
                        </ul>
                     </div>
                  </li>
                  <!--<li class="nav-item">
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
                  </li>---->
               </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
               <div class="content-wrapper">
                  <div class="row">
         @yield('content')     

      <?php if(!isset($logSESSION)){  ?>
      <script>
         window.location= ("{{asset('login')}}");
      </script>
      <?php } ?>
   </body>
</html>

