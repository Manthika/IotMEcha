<?php
session_start();

    if(isset($_SESSION['id'])) {
        $username = $_SESSION['username'];
        $userId = $_SESSION['id'];
      //  echo "Welcome, {$username}!";
    } else {
        header('Location: index_flatbed.php');
       // die();
    }

?>


<!DOCTYPE html>
<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Panel</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.css" rel="stylesheet">
    
    
    <link rel="shortcut icon" href="images/icon.ico" type="image/x-icon">
    
    <script type="text/javascript" src="js/jquery.min.js"></script>
    
    <!-- clock-->
	<link href="css/date_time.css" rel="stylesheet">
	<script type="text/javascript" src="js/date_time.js"></script>
    <!-- /clock-->
    
    
    <!-- gauge -->
    
    <link rel='stylesheet' href="css/gauge_style.css" type='text/css'>
    <script src="js/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="js/d3.v3.min.js"></script>
    <!--<script type="text/javascript" src="js/gauge/pointerevents.js"></script>
    <script type="text/javascript" src="js/gauge/pointergestures.js"></script>-->
    
    <script type="text/javascript" src="http://iop.io/js/vendor/polymer/PointerEvents/pointerevents.js"></script>
    <script type="text/javascript" src="http://iop.io/js/vendor/polymer/PointerGestures/pointergestures.js"></script>
    <script type="text/javascript" src="js/gauge/iopctrl.js"></script>
   
    <!-- gauge -->
    
    <!-- <script src="js/d3.min.js"></script> -->
    
    <!-- table -->
    <style>
    table.main{width:92%;margin:0 4%;border-collapse:collapse}

	.main td{padding:0;text-align:center}

	table.dc{border:0;margin:0 auto;height:57px;border-collapse:collapse}

	table, th, td {
   		 border: 1px solid black;
		 text-align:center;}
	
	.dc td{border:0;text-align:center;padding:0}
    </style>
    <!-- /table -->
    
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a class="site_title"><i class="fa fa-adn"></i> <span>Flatbed Machine</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php
                echo "{$username}";
				
				?></h2>
              </div>
              
            </div>
            <!-- /menu profile quick info -->

            <br/>
           

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
              &nbsp;
              &nbsp;
              &nbsp;
                
                <ul class="nav side-menu">
                  <li><a href="index_flatbed_live.php"><i class="fa fa-dashboard"></i> Flatbed Live Status <span class="fa fa-chevron-down"></span></a>
                   <ul class="nav child_menu">
                      
                   </ul>
                 </li>
                 <li><a href="index_flatbed_dryer_live.php"><i class="fa fa-dashboard"></i> Dryer Live Status <span class="fa fa-chevron-down"></span></a>
                   <ul class="nav child_menu">
                      
                   </ul>
                 </li>
                  <li><a href="index_flatbed.php"><i class="fa fa-dashboard"></i> Flatbed Status <span class="fa fa-chevron-down"></span></a>
                    <!--<ul class="nav child_menu">
                      
                    </ul>-->
                  </li>
                  <li><a href="index_flatbed_dryer.php"><i class="fa fa-dashboard"></i> Dryer Status <span class="fa fa-chevron-down"></span></a>
                    <!--<ul class="nav child_menu">
                      
                    </ul>-->
                  </li>
                  <li>
                  </br>
                  </li>
                  <li>
                  	<a href="index_back.php"><i class="fa fa-arrow-left"></i> Back to Machines List </a>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.jpg" alt="">
                    <i class="fa fa-gears"></i>
				<?php
                echo "{$username}";
				?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                   
                    <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
        <div class="">
            <div class="row top_tiles" >
            
 <!-- machine on_off -->           

              <div  class="col-md-3 col-sm-3 col-xs-6 tile" style="height:100px; width:75%;">
             
              </div>
     
<!-- /machine on_off --> 


              
            <div class="col-md-3 col-sm-3 col-xs-6 tile" id=outer style=" height:auto; width:25%;">
      <!--  <span id="date_time"></span>   -->
      <div id=cover>
          	<div id="time"></div> <div id="da"></div> <div id="dt"></div> <div id="salute"> </div>
            
      </div>
      
               
            <script type="text/javascript">window.onload = date_time('date_time');</script>
            
              </div>
              
            </div>
            <br />


            <div class="row">
            
            <!-- on_off time graph -->
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="dashboard_graph x_panel">
                  <div class="row x_title">
                   
                   
				   <div class="col-md-6" style="width:auto;"><h3>
				     <label>     
				     
				   Temperature graph</label></h3> </div>
                    
                  </div>
                  <div class="x_content">
                    <div class="demo-container" style="height:600px">
                  

    					<canvas id="mycanvas2"></canvas>


                   <!--   	<div id="chart-container1" style="height:500px; width:100%;">
							<canvas id="mycanvas"></canvas>
						
                      </div>  -->
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
			<!-- /on_off time graph -->

            <div class="row">
            
           
      
              

 
              <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="x_panel fixed_height_320">
                  <div class="x_title">
                    <h2>Current Temperature</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  
                </div>
              </div>
              
              
               <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="x_panel fixed_height_320">
                  <div class="x_title">
                    <h2>HeatUp Time</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                 
                </div>
              </div>
              
              
              <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="x_panel fixed_height_320">
                  <div class="x_title">
                    <h2>Temperature Difference</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  
                </div>
              </div>
              
              
              
            </div>
          </div>
          
          
        </div>
        <!-- /page content -->
    
  
        <!-- footer content -->
        <footer id="footer">
          <div class="pull-right">
            <h1><i class="fa fa-adn"></i> ANIMAX</h1>
                  <p>©2016 All Rights Reserved ANIMAX Company(Pvt.)Ltd.</p>

          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    
    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- bootstrap-daterangepicker -->
    
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!-- Custom Theme Scripts -->
  <script src="../build/js/custom.min.js"></script>
   
   
   	<!--<script type="text/javascript" src="js/jquery.min.js"></script>-->
	<script type="text/javascript" src="js/Chart.min.js"></script>
	<script type="text/javascript" src="js/line.js"></script>
    <script type="text/javascript" src="js/temp.js"></script>
	   

    
  </body>
  

  
  
</html>