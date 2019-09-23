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

  <body class="nav-md" >
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a class="site_title"><i class="fa fa-adn"></i> <span>Rotary II Machine</span></a>
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
                  <li><a href="index_rotary_ii_live.php"><i class="fa fa-dashboard"></i> Rotary II Live Status <span class="fa fa-chevron-down"></span></a>
                   <ul class="nav child_menu">
                      
                   </ul>
                  </li>
                  <li>
                  	<a href="index_rotary_ii.php"><i class="fa fa-dashboard"></i> Rotary II Status <span class="fa fa-chevron-down"></span></a>
                    <!--<ul class="nav child_menu">
                      
                    </ul>-->
                  </li>
                  <li>
                  	<a href="index_rotary_ii_dryer.php"><i class="fa fa-dashboard"></i> Dryer Status <span class="fa fa-chevron-down"></span></a>
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

<!-- clock-->
              
              <div class="col-md-3 col-sm-3 col-xs-6 tile" id=outer style=" height:auto; width:25%;">
      <!--  <span id="date_time"></span>   -->
      <div id=cover>
          	<div id="time"></div> <div id="da"></div> <div id="dt"></div> <div id="salute"> </div>
            
      </div>
      
               
            <script type="text/javascript">window.onload = date_time('date_time');</script>
            
              </div>
<!-- /clock-->              
            </div>
            <br />


            <div class="row">
            
            <!-- on_off time graph -->
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="dashboard_graph x_panel">
                  <div class="row x_title">
                      
                    
                   <div class="col-md-6" style="width:auto;"><h3><label> 
                   Machine ON/OFF time graph</label></h3> </div>
                    
                  </div>
                  <div class="x_content">
                    <div class="demo-container" style="height:600px">
   
	<canvas id="mycanvas"></canvas>
             
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
            
            <!-- on_off time table -->
            
              <div class="col-md-4 col-sm-6 col-xs-12" style="width:100%">
                <div class="x_panel fixed_height_320">
                  <div class="x_title">
                    <h2><label>ON/OFF time</label></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   		<table style="height:240px; width:100%;">
							<tr>
                            	<th rowspan="2">Shift</th>
                            	<th colspan="2">Monday</th>
                                <th colspan="2">Tuesday</th>
                                <th colspan="2">Wednesday</th>
                                <th colspan="2">Thursday</th>
                                <th colspan="2">Friday</th>
                                <th colspan="2">Saturday</th>
                                <th colspan="2">Sunday</th>
                                
                            </tr>
		
                        	<tr>
                            	
                                <td>First ON</td>
                                <td>Last OFF</td>
                                <td>First ON</td>
                                <td>Last OFF</td>
                                <td>First ON</td>
                                <td>Last OFF</td>
                                <td>First ON</td>
                                <td>Last OFF</td>
                                <td>First ON</td>
                                <td>Last OFF</td>
                                <td>First ON</td>
                                <td>Last OFF</td>
                                <td>First ON</td>
                                <td>Last OFF</td>
                             
                        	</tr>
                            
                            <tr>
                            	<td>7 A.M. to 7 P.M.</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                
                            </tr>
                            <tr>
                            	<td>7 P.M. to 7 A.M.</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                           
                        </table>
                 
                  </div>
                </div>
              </div>
              <!-- /on_off time table -->

			  <!-- machine speed gauge -->
             
<!-- gauge -->
    
 <script>
 var k =[];
 function fetchdata(){

  $.ajax({
  url: 'data.php',
  type: 'post',
  success: function(data){
   d3.json("data.php", function(error, data) {  
   data.forEach(function(d) {
    
        //d.event = d.event;
        d.sensor1 = +d.sensor1; 
        k.push(d.sensor1)
        

    });
var last = k[k.length - 1];
var gauge = iopctrl.arcslider()
                .radius(120)
                .events(false)
                .indicator(iopctrl.defaultGaugeIndicator);

        var svg = d3.select("#speedometer")
                .append("svg:svg")
                .attr("width", 400)
                .attr("height", 400);
<!-- important -->
$("svg").css({top: 30, left: 30, position:'absolute'});
        
        gauge.axis().orient("in")
                .normalize(true)
                .ticks(12)
                .tickSubdivide(3)
                .tickSize(10, 8, 10)
                .tickPadding(5)
                .scale(d3.scale.linear()
                        .domain([0, 160])
                        .range([-3*Math.PI/4, 3*Math.PI/4]));

        var segDisplay = iopctrl.segdisplay()
                .width(80)
                .digitCount(6)
                .negative(false)
                .decimals(0);

        svg.append("g")
                .attr("class", "segdisplay")
                .attr("transform", "translate(130, 200)")
                .call(segDisplay);

        svg.append("g")
                .attr("class", "gauge")
                .call(gauge);

        segDisplay.value(last);

        gauge.value(last);
        
       
   });

  },
  complete:function(data){
   setTimeout(fetchdata,1000);
   d3.selectAll("svg").remove();
  

  }  
 });
}


$(document).ready(function(){
setTimeout(fetchdata,1000);


});
    
</script>
    
<!-- /gauge --> 
    
			
              <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="x_panel fixed_height_320" style="background-color:#585858;">
                  <div class="x_title">
                    <h2><label>Machine Speed</label></h2>
                    
                    <div class="clearfix"></div>
                  </div>
              
                   <div id="speedometer"></div>
                
                </div>
              </div>
              
              <!-- /machine speed gauge -->
              
              
              
              <!-- counter -->
              <div class="col-md-4 col-sm-6 col-xs-12" style="width:66.6%">
                <div class="x_panel fixed_height_320" >
                  <div class="x_title">
                    <h2>Fabric Printed Length</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                
<link href="src/counter_css.css" media="screen" rel="stylesheet" type="text/css" />
	<script src="src/jquery.min.js" type="text/javascript"></script>
    <script src="src/jquery.counter.js" type="text/javascript"></script>
   
        <span class="counter counter-analog2" data-direction="up" data-format="2359599" data-stop="1000000" data-interval="1000">0:00.0</span>
    
   
    <script>
        $('.counter').counter();
        $('#custom').addClass('counter-analog').counter({
            initial: '0:00.0',
            direction: 'up',
            interval: '1',
            format: '9999',
            stop: '2012'
        });
    </script>
                </div>
              </div>
              <!-- /counter -->
              
             
              
              
              
              
              
              
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