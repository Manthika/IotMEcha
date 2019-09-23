<?php
session_start();

    if(isset($_SESSION['id'])) {
        $username = $_SESSION['username'];
        $userId = $_SESSION['id'];
      //  echo "Welcome, {$username}!";
    } else {
        header('Location: login_admin.php');
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

    <title>Machine Monitor</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.css" rel="stylesheet">
    
    <link rel="shortcut icon" href="images/icon.ico" type="image/x-icon">
  </head>

  <body class="nav-md footer_fixed">
  
    <div class="container body">
      <div class="main_container">
      
      <!-- top navigation -->
        <div class="top_nav" style="margin-left:0px;">
          <div class="nav_menu">
         

              <ul class="nav navbar-nav navbar-right">
               <li>
                  	<a href="form_user.php"><i class="fa fa-users"></i> Create Users <span class="fa fa-plus-circle"></span></a>
                  </li>
              
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.jpg" alt="">
					
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
     
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        
        
        
        <div class="right_col" role="main" style="margin-left:0px;">
          <div class="">
          
            
            
            <div class="row" style="padding-top:67px;">
            
           
            <a href="index_flatbed_live.php">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel" style="background:url(images/flatbed.jpg); height:300px;">
                
                
                </div>
              </div>
              </a>
			
            <a href="index_rotary_i_live.php">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel" style="background:url(images/rotary_1.png); height:300px;">
                	
             
                </div>
              </div>
           </a>
           
            </div>
            
            <div class="clearfix"></div>
              
            <div class="row">
            
            <a href="index_rotary_ii_live.php">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel" style="background:url(images/rotary_2.png); height:300px;">
                
     
                </div>
              </div>
			</a>
            
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel" style="background:url(images/uc.jpg); height:300px;">
                  
                </div>
              </div>
            </div>
            
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content 
        <footer style="margin-left:0px;">
          <div class="pull-right">
            <h1><i class="fa fa-paw"></i> RCCK</h1>
                  <p>©2016 All Rights Reserved RCCK Company(Pvt.)Ltd.</p>
          </div>
          <div class="clearfix"></div>
        </footer>
         /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
  </body>
</html>
