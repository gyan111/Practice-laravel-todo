<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
       @yield('title')
    </title>
  <!-- BOOTSTRAP STYLES-->
    {{ HTML::style('/theme/assets/css/bootstrap.css'); }}
     <!-- FONTAWESOME STYLES-->
    {{ HTML::style('/theme/assets/css/font-awesome.css'); }}
        <!-- CUSTOM STYLES-->
    {{ HTML::style('/theme/assets/css/custom.css'); }}
     <!-- GOOGLE FONTS-->
    {{ HTML::style('http://fonts.googleapis.com/css?family=Open+Sans'); }}

</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ Request::root() }}/dashboard">To-Do App</a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> Last access : {{ $user -> updated_at}} &nbsp; <a href="{{ Request::root() }}/logout" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <a href="{{ Request::root() }}/update-image" class="edit_image"><img src="{{ Request::root() }}/uploads/images/thumbs/{{ $user -> username }}.jpg" class="user-image img-responsive"/></a>
					</li>
                    <li>
                        <a
                        @if (Request::path() == 'dashboard')
						    class="active-menu"
						@endif

                        href="{{ Request::root() }}/dashboard"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
                    </li>
                    <li>
                        <a 

                        @if (Request::path() == 'edit')
						    class="active-menu"
						@endif
						 href="{{ Request::root() }}/edit"><i class="fa fa-desktop fa-3x"></i> Edit Profile</a>
                    </li>
                   <!--   <li>
                        <a href="to-do"><i class="fa fa-table fa-3x"></i> To-do</a>
                    </li> -->
                    <!-- li>
                        <a  href="tab-panel.html"><i class="fa fa-qrcode fa-3x"></i> Tabs & Panels</a>
                    </li>
						   <li  >
                        <a  href="chart.html"><i class="fa fa-bar-chart-o fa-3x"></i> Morris Charts</a>
                    </li>	
                      <li  >
                        <a  href="table.html"><i class="fa fa-table fa-3x"></i> Table Examples</a>
                    </li>
                    <li  >
                        <a  href="form.html"><i class="fa fa-edit fa-3x"></i> Forms </a>
                    </li>				
					<li  >
                        <a   href="login.html"><i class="fa fa-bolt fa-3x"></i> Login</a>
                    </li>	
                     <li  >
                        <a   href="registeration.html"><i class="fa fa-laptop fa-3x"></i> Registeration</a>
                    </li!-->	
					                   
                    <li  @if (Request::path() == 'projects' OR Request::path() == 'projects/create' OR Request::path() == 'projects/view')
						    class="active"
						@endif 
					>
                        <a 
                         @if (Request::path() == 'projects' OR Request::path() == 'projects/create' OR Request::path() == 'projects/view')
						    class="active-menu"
						@endif
                        href="projects"><i class="fa fa-table fa-3x"></i> Projects<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>	
                                <a
                                 @if (Request::path() == 'projects' )
								    class="active-menu"
								@endif  
                                href="{{ Request::root() }}/projects">View</a>
                            </li>
                            <li>
                                <a
                                @if (Request::path() == 'projects/create' )
								    class="active-menu"
								@endif 
                                href="{{ Request::root() }}/projects/create">Create</a>
                            </li>
                            <!--  <li>
                                <a href="#">Manage</a>
                            </li> -->
                         	<li>
                                <a href="{{ Request::root() }}/tasks">Tasks<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                   <!--  <li>
                                        <a href="{{ Request::root() }}/tasks/view">View</a>
                                    </li> -->
                                    <li>
                                        <a href="{{ Request::root() }}/tasks/create">create</a>
                                    </li>
                                   <!--  <li>
                                        <a href="#">Manage</a>
                                    </li> -->

                                </ul>
                            </li> 
                        </ul>
                      </li>  
                 <!--  <li  >
                        <a href="blank.html"><i class="fa fa-square-o fa-3x"></i> Blank Page</a>
                    </li> -->
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
            @yield('content')
            
               <!--  <div class="row">
                    <div class="col-md-12">
                     	<h2>Blank Page</h2>   
                        <h5>Welcome Jhon Deo , Love to see you back. </h5>
                    </div>
                </div> -->
                 <!-- /. ROW  -->
                 <hr />
               
   			 </div>
             <!-- /. PAGE INNER  -->
        </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
     <!-- Modal -->
	<div class="modal fade" id="image_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content" id="image_modal_content"></div>
	    </div>
	</div>

     <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    {{ HTML::script('/theme/assets/js/jquery-1.10.2.js'); }}
      <!-- BOOTSTRAP SCRIPTS -->
    {{ HTML::script('/theme/assets/js/bootstrap.min.js'); }}
    <!-- METISMENU SCRIPTS -->
    {{ HTML::script('/theme/assets/js/jquery.metisMenu.js'); }}
     <!--Morris Script -->
    {{-- HTML::script('/theme/assets/js/morris.min.js'); --}}
     <!--Form Validator-->
     {{ HTML::script('/theme/assets/js/BootstrapValidator.min.js'); }}
      <!-- CUSTOM SCRIPTS -->
    {{ HTML::script('/theme/assets/js/custom.js'); }}
      <!-- My CUSTOM SCRIPTS -->
    {{ HTML::script('/theme/assets/js/laravel_todo.js'); }}
</body>
</html>
