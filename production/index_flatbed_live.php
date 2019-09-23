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
    

    
    <!-- clock -->
	<link href="css/date_time.css" rel="stylesheet">
	<script type="text/javascript" src="js/date_time.js"></script>
   <!--/clock-->
    
    <!-- ON-OFF graph -->
    
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="js/mqttws31.js" type="text/javascript"></script>
<script src="http://code.highcharts.com/stock/highstock.js"></script>
<script src="http://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="js/tween-min.js" type="text/javascript"></script>
<script src="js/steelseries-min.js" type="text/javascript"></script>




<!-- ON_OFF
<script type="text/javascript">
/*
by @bordignon on twitter
Feb 2014

Simple example of plotting live mqtt/websockets data using highcharts.

public broker and topic you can use for testing.

	var MQTTbroker = 'broker.mqttdashboard.com';
	var MQTTport = 8000;
	var MQTTsubTopic_on_off = 'dcsquare/cubes/#'; //works with wildcard # and + topics dynamically now
*/
//https://launchpad.net/ubuntu/+archive/primary/+files/libwebsockets_1.2.2-1.debian.tar.gz

//settings BEGIN
	var MQTTbroker = '192.168.8.103';
	var MQTTport = 9001;
	var MQTTsubTopic_on_off = 'mas/on_off'; //works with wildcard # and + topics dynamically now
//settings END

	var chart_on_off; // global variuable for chart
	var dataTopics_on_off = new Array();

//mqtt broker 
	var client = new Paho.MQTT.Client(MQTTbroker, MQTTport,
				"myclientid_" + parseInt(Math.random() * 100, 10));
	client.onMessageArrived = onMessageArrived;
	client.onConnectionLost = onConnectionLost;
	//connect to broker is at the bottom of the on_off_graph() function !!!!
	

//mqtt connecton options including the mqtt broker subscriptions
	var options = {
		timeout: 3,
		onSuccess: function () {
			console.log("mqtt connected");
			// Connection succeeded; subscribe to our topics
			client.subscribe(MQTTsubTopic_on_off, {qos: 1});
		},
		onFailure: function (message) {
			console.log("Connection failed, ERROR: " + message.errorMessage);
			//window.setTimeout(location.reload(),20000); //wait 20seconds before trying to connect again.
		}
	};

//can be used to reconnect on connection lost
	function onConnectionLost(responseObject) {
		console.log("connection lost: " + responseObject.errorMessage);
		//window.setTimeout(location.reload(),20000); //wait 20seconds before trying to connect again.
	};

//what is done when a message arrives from the broker
	function onMessageArrived(message) {
		console.log(message.destinationName, '',message.payloadString);

		//check if it is a new topic, if not add it to the array
		if (dataTopics_on_off.indexOf(message.destinationName) < 0){
		    
		    dataTopics_on_off.push(message.destinationName); //add new topic to array
		    var y_on_off = dataTopics_on_off.indexOf(message.destinationName); //get the index no
		    
		    //create new data series for the chart
			var newseries = {
		            id: y_on_off,
		            name: message.destinationName,
		            data: []
		            };

			chart_on_off.addSeries(newseries); //add the series
		    
		    };
		 
		var y_on_off = dataTopics_on_off.indexOf(message.destinationName); //get the index no of the topic from the array
		var myEpoch_on_off = new Date().getTime(); //get current epoch time
		var thenum_on_off = message.payloadString.replace( /^\D+/g, ''); //remove any text spaces from the message
		var plotMqtt_on_off = [myEpoch_on_off, Number(thenum_on_off)]; //create the array
		if (isNumber(thenum_on_off)) { //check if it is a real number and not text
			console.log('is a propper number, will send to chart.')
			plot_on_off(plotMqtt_on_off, y_on_off);	//send it to the plot function
		};
	};

//check if a real number	
	function isNumber(n) {
	  return !isNaN(parseFloat(n)) && isFinite(n);
	};

//function that is called once the document has loaded
	function on_off_graph() {

		//i find i have to set this to false if i have trouble with timezones.
		Highcharts.setOptions({
			global: {
				useUTC: false
			}
		});

		// Connect to MQTT broker
		client.connect(options);

	};


//this adds the plots to the chart	
    function plot_on_off(point, chartno) {
    	console.log(point);
    	
	        var series = chart_on_off.series[0],
	            shift = series.data.length > 20; // shift if the series is 
	                                             // longer than 20
	        // add the point
	        chart_on_off.series[chartno].addPoint(point, true, shift);  

	};

//settings for the chart
	$(document).ready(function() {
	    chart_on_off = new Highcharts.Chart({
	        chart_on_off: {
	            renderTo: 'container_on_off',
	            defaultSeriesType: 'spline'
	        },
	        title: {
	            text: 'Textprint MMS Realtime ON/OFF Graph'
	        },
	        subtitle: {
                                text: 'broker: ' + MQTTbroker + ' | port: ' + MQTTport + ' | topic : ' + MQTTsubTopic_on_off
                        },
	        xAxis: {
	            type: 'datetime',
	            tickPixelInterval: 150,
	            maxZoom: 20 * 1000

	        },
	        yAxis: {
	            minPadding: 0.2,
	            maxPadding: 0.2,
	            title: {
	                text: 'ON/OFF',
	                margin: 80
	            }
	        },
	credits: {
      enabled: false
  },
	        series: []
	    });        
	});

</script>

/ON-OFF graph -->


<!-- temperature graph -->

<script type="text/javascript">
/*
by @bordignon on twitter
Feb 2014

Simple example of plotting live mqtt/websockets data using highcharts.

public broker and topic you can use for testing.

	var MQTTbroker = 'broker.mqttdashboard.com';
	var MQTTport = 8000;
	var MQTTsubTopic = 'dcsquare/cubes/#'; //works with wildcard # and + topics dynamically now
*/
//https://launchpad.net/ubuntu/+archive/primary/+files/libwebsockets_1.2.2-1.debian.tar.gz

//settings BEGIN
var MQTTbroker = '18.217.194.138';
	var MQTTport = 9001;
	var MQTTsubTopic_temp = 'mas/on_off'; //works with wildcard # and + topics dynamically now
//settings END

	var chart; // global variuable for chart
	var dataTopics = new Array();

//mqtt broker 
	var client_temp_graph = new Paho.MQTT.Client(MQTTbroker, MQTTport,
				"myclientid_" + parseInt(Math.random() * 100, 10));
	client_temp_graph.onMessageArrived = onMessageArrived;
	client_temp_graph.onConnectionLost = onConnectionLost;
	//connect to broker is at the bottom of the on_off_graph() function !!!!
	

//mqtt connecton options including the mqtt broker subscriptions
	var options_temp = {
		timeout: 3,
		onSuccess: function () {
			console.log("mqtt connected");
			// Connection succeeded; subscribe to our topics
			client_temp_graph.subscribe(MQTTsubTopic_temp, {qos: 2});
		},
		onFailure: function (message) {
			console.log("Connection failed, ERROR: " + message.errorMessage);
			//window.setTimeout(location.reload(),20000); //wait 20seconds before trying to connect again.
		}
	};

//can be used to reconnect on connection lost
	function onConnectionLost(responseObject) {
		console.log("connection lost: " + responseObject.errorMessage);
		//window.setTimeout(location.reload(),20000); //wait 20seconds before trying to connect again.
	};

//what is done when a message arrives from the broker
	function onMessageArrived(message) {
		console.log(message.destinationName, '',message.payloadString);

		//check if it is a new topic, if not add it to the array
		if (dataTopics.indexOf(message.destinationName) < 0){
		    
		    dataTopics.push(message.destinationName); //add new topic to array
		    var y = dataTopics.indexOf(message.destinationName); //get the index no
		    
		    //create new data series for the chart
			var newseries = {
		            id: y,
		            name: message.destinationName,
		            data: []
		            };

			chart.addSeries(newseries); //add the series
		    
		    };
		 
		var y = dataTopics.indexOf(message.destinationName); //get the index no of the topic from the array
		var myEpoch = new Date().getTime(); //get current epoch time
		var thenum = message.payloadString.replace( /^\D+/g, ''); //remove any text spaces from the message
		var plotMqtt = [myEpoch, Number(thenum)]; //create the array
		if (isNumber(thenum)) { //check if it is a real number and not text
			console.log('is a propper number, will send to chart.')
			plot(plotMqtt, y);	//send it to the plot function
		};
	};

//check if a real number	
	function isNumber(n) {
	  return !isNaN(parseFloat(n)) && isFinite(n);
	};

//function that is called once the document has loaded
	function temp_graph() {

		//i find i have to set this to false if i have trouble with timezones.
		Highcharts.setOptions({
			global: {
				useUTC: false
			}
		});

		// Connect to MQTT broker
		client_temp_graph.connect(options_temp);

	};


//this adds the plots to the chart	
    function plot(point, chartno) {
    	console.log(point);
    	
	        var series = chart.series[0],
	            shift = series.data.length > 20; // shift if the series is 
	                                             // longer than 20
	        // add the point
	        chart.series[chartno].addPoint(point, true, shift);  

	};

//settings for the chart
	$(document).ready(function() {
	    chart = new Highcharts.Chart({
	        chart: {
	            renderTo: 'container_temp',
	            defaultSeriesType: 'spline'
	        },
	        title: {
	            text: 'Textprint MMS Realtime ON/OFF Status Graph'
	        },
	        subtitle: {
                                text: 'broker: ' + MQTTbroker + ' | port: ' + MQTTport + ' | topic : ' + MQTTsubTopic_temp
                        },
	        xAxis: {
	            type: 'datetime',
	            tickPixelInterval: 150,
	            maxZoom: 20 * 1000

	        },
	        yAxis: {
	            minPadding: 0.2,
	            maxPadding: 0.2,
	            title: {
	                text: 'ON/OFF',
	                margin: 80
	            }
	        },
	credits: {
      enabled: false
  },
	        series: []
	    });        
	});

</script>

 <!-- /temperature graph -->


<!-- speed gauge --> 
	
    <script type="text/javascript">
    var speedGauge;

	var MQTTsubTopic_speed = 'mas/speed'; //works with wildcard # and + topics dynamically now
//settings END

//mqtt broker 
	var client_speed = new Paho.MQTT.Client(MQTTbroker, MQTTport,
				"myclientid_" + parseInt(Math.random() * 100, 10));
	

    client_speed.onConnectionLost = function (responseObject) {
        alert("connection lost: " + responseObject.errorMessage);
        speedGauge.setLedColor(steelseries.LedColor.RED_LED); //change status LED to RED on broker disconnection 

    };

    client_speed.onMessageArrived = function (message) {
        speedGauge.setValue(message.payloadString);
    };

    var option = {
        timeout: 3,
        onSuccess: function () {
            // alert("Connected");
            // Connection succeeded; subscribe to our topic
            client_speed.subscribe('mas/speed', {qos: 2});
            speedGauge.setLedColor(steelseries.LedColor.GREEN_LED); //change status LED to GREEN on broker connection
			

        },
        onFailure: function (message) {
            alert("Connection failed: " + message.errorMessage);
            speedGauge.setLedColor(steelseries.LedColor.RED_LED); //change status LED to RED on broker disconnection 

        }
    };

    function speed_gauge() {
        // by @jpmens, Sep 2013
        // from @bordignons Sep 2013
        // original idea.. http://www.desert-home.com/2013/06/how-to-use-steelseries-gauges-with.html
        // with help.. http://harmoniccode.blogspot.com.au/
        // and code.. https://github.com/HanSolo/SteelSeries-Canvas

        speedGauge = new steelseries.Radial('gaugeCanvas', {
            gaugeType: steelseries.GaugeType.TYPE4,
            minValue:0,
            maxValue:10,
            size: 300,
            frameDesign: steelseries.FrameDesign.CHROME,
            knobStyle: steelseries.KnobStyle.STEEL,
            pointerType: steelseries.PointerType.TYPE1,
            lcdDecimals: 0,
            section: null,
            area: null,
            titleString: 'Belt Speed',
            unitString: 'm/min',
            threshold: 10,
            lcdVisible: true,
            lcdDecimals: 1
           });
        speedGauge.setValue(''); //gives a blank display 'NaN' until broker has connected
        speedGauge.setLedColor(steelseries.LedColor.RED_LED); //set the LED RED until connected


        /* Connect to MQTT broker */
        client_speed.connect(option);
    }

    </script>

<!-- /speed gauge -->  


<!-- efficiency gauge --> 

	
    <script type="text/javascript">
    var temprGauge;

	var MQTTsubTopic_tempr = 'mas/effi'; //works with wildcard # and + topics dynamically now
//settings END

//mqtt broker 
	var client_tempr = new Paho.MQTT.Client(MQTTbroker, MQTTport,
				"myclientid_" + parseInt(Math.random() * 100, 10));
	

    client_tempr.onConnectionLost = function (responseObject) {
        alert("connection lost: " + responseObject.errorMessage);
        temprGauge.setLedColor(steelseries.LedColor.RED_LED); //change status LED to RED on broker disconnection 

    };

    client_tempr.onMessageArrived = function (message) {
        temprGauge.setValue(message.payloadString);
    };

    var optio = {
        timeout: 3,
        onSuccess: function () {
            // alert("Connected");
            // Connection succeeded; subscribe to our topic
            client_tempr.subscribe('mas/effi', {qos: 0});
            temprGauge.setLedColor(steelseries.LedColor.GREEN_LED); //change status LED to GREEN on broker connection
			

        },
        onFailure: function (message) {
            alert("Connection failed: " + message.errorMessage);
            temprGauge.setLedColor(steelseries.LedColor.RED_LED); //change status LED to RED on broker disconnection 

        }
    };

    function temp_gauge() {
        // by @jpmens, Sep 2013
        // from @bordignons Sep 2013
        // original idea.. http://www.desert-home.com/2013/06/how-to-use-steelseries-gauges-with.html
        // with help.. http://harmoniccode.blogspot.com.au/
        // and code.. https://github.com/HanSolo/SteelSeries-Canvas

        temprGauge = new steelseries.Radial('gaugeCanvas_temp', {
            gaugeType: steelseries.GaugeType.TYPE4,
            minValue:0,
            maxValue:100,
            size: 300,
            frameDesign: steelseries.FrameDesign,
            knobStyle: steelseries.KnobStyle.STEEL,
            pointerType: steelseries.PointerType.TYPE2,
            lcdDecimals: 0,
            section: null,
            area: null,
            titleString: 'Machine Efficiency',
            unitString: '%',
            threshold: 100,
            lcdVisible: true,
            lcdDecimals: 1
           });
        temprGauge.setValue(''); //gives a blank display 'NaN' until broker has connected
        temprGauge.setLedColor(steelseries.LedColor.RED_LED); //set the LED RED until connected


        /* Connect to MQTT broker */
        client_tempr.connect(optio);
    }

    </script>

<!-- /efficiency gauge --> 


<!-- Machine Status -->

<script>

    var led1;
    
	var MQTTsubTopic_status = 'mas/on_off_status'; //works with wildcard # and + topics dynamically now
//settings END

//mqtt broker 
	var client_status = new Paho.MQTT.Client(MQTTbroker, MQTTport,
				"myclientid_" + parseInt(Math.random() * 100, 10));

    client_status.onConnectionLost = function (responseObject) {
       alert("Can not connect to the server: " + responseObject.errorMessage +"Please refresh the page or try again later");
        led1.setLedColor(steelseries.LedColor.RED_LED);
		led1.blink(true); //change status LED to RED on broker disconnection 

    };

    client_status.onMessageArrived = function (message) {
        led1.setLedColor(steelseries.LedColor.YELLOW_LED);
     	
    };

    var opti = {
        timeout: 3,
        onSuccess: function () {
            // alert("Connected");
            // Connection succeeded; subscribe to our topic
            client_status.subscribe('mas/on_off_status', {qos: 0});

            led1.setLedColor(steelseries.LedColor.GREEN_LED);
			led1.blink(true);
        
            //change status LED to GREEN on broker connection

        },
        onFailure: function (message) {
            //alert("Connection failed: " + message.errorMessage);
             alert("Can not connect to the server: " + responseObject.errorMessage +"Please refresh the page or try again later");
            led1.setLedColor(steelseries.LedColor.RED_LED);
			led1.blink(true);
           
            //change status LED to RED on broker disconnection 

        }
    };

function on_off_status() {
        // Initialzing gauge
      
       led1 = new steelseries.Led('canvasLed1', {
                            width: 80,
                            height: 80
                            });
    
  client_status.connect(opti);   

   }
  
</script>

 <!--/Machine Status -->
 
 
 
 <!-- counter -->
 
 <script>

    var odometer1, n = 999999.9;

    function count_print() {
        // Initialzing counter
        
        odometer1 = new steelseries.Odometer('printing_counter', {});

        // Start the random update
      
        printing_length();

   }

    function printing_length() {
        n += 0.005
        odometer1.setValue(n);
        setTimeout("printing_length()", 50);
    }

 
</script>
 <!-- /counter --> 
 
 
 <!-- display 
 
 <script type="text/javascript">
 
 var single3;
 
 
 function display(){
	single3 = new steelseries.DisplaySingle('canvasSingle3', {
                            width: 200,
                            height: 50,
                            unitString: "unit",
                            unitStringVisible: true,
                            headerString: "header",
                            headerStringVisible: true
                            });
	function setRandomValue2(gauge, range) {
        gauge.setValue(Math.random() * range);
    }
	setInterval(function(){ setRandomValue2(single3, 100); }, 1500);						
 }
 
 </script>
 <!-- /display -->
 
 
 <!-- new -->
 
 <script type="text/javascript">
    var newGauge;

	var MQTTsubTopic_new = 'mas/new'; //works with wildcard # and + topics dynamically now
//settings END

//mqtt broker 
	var client_new = new Paho.MQTT.Client(MQTTbroker, MQTTport,
				"myclientid_" + parseInt(Math.random() * 100, 10));
	

    client_new.onConnectionLost = function (responseObject) {
        alert("connection lost: " + responseObject.errorMessage);
        newGauge.setLedColor(steelseries.LedColor.RED_LED); //change status LED to RED on broker disconnection 

    };

    client_new.onMessageArrived = function (message) {
        newGauge.setValue(message.payloadString);
    };

    var option_new = {
        timeout: 3,
        onSuccess: function () {
            // alert("Connected");
            // Connection succeeded; subscribe to our topic
            client_new.subscribe('mas/new', {qos: 0});
            newGauge.setLedColor(steelseries.LedColor.GREEN_LED); //change status LED to GREEN on broker connection
			

        },
        onFailure: function (message) {
            alert("Connection failed: " + message.errorMessage);
            newGauge.setLedColor(steelseries.LedColor.RED_LED); //change status LED to RED on broker disconnection 

        }
    };

    function new_gauge() {
        // by @jpmens, Sep 2013
        // from @bordignons Sep 2013
        // original idea.. http://www.desert-home.com/2013/06/how-to-use-steelseries-gauges-with.html
        // with help.. http://harmoniccode.blogspot.com.au/
        // and code.. https://github.com/HanSolo/SteelSeries-Canvas

        newGauge = new steelseries.DisplaySingle('gaugeCanvas_new', {
                            width: 200,
                            height: 50,
                            unitString: "unit",
                            unitStringVisible: true,
                            headerString: "header",
                            headerStringVisible: true
           });
        newGauge.setValue(''); //gives a blank display 'NaN' until broker has connected
        newGauge.setLedColor(steelseries.LedColor.RED_LED); //set the LED RED until connected


        /* Connect to MQTT broker */
        client_new.connect(option_new);
    }

    </script>
 
 <!-- /new -->
 
  </head>

  <body class="nav-md" onload="temp_graph(); speed_gauge(); date_time('date_time'); temp_gauge(); count_print(); new_gauge();">
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
                    <ul class="nav child_menu">
                      
                    </ul>
                  </li>
                  <li><a href="index_flatbed_dryer.php"><i class="fa fa-dashboard"></i> Dryer Status <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      
                    </ul>
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
              
              <canvas id="canvasLed1" width="100" height="100"></canvas>
               
    

              </div>
              <div  class="col-md-3 col-sm-3 col-xs-6 tile">
            
     		  </div>
<!-- /machine on_off --> 

<!-- clock -->      
              <div class="col-md-3 col-sm-3 col-xs-6 tile" id=outer style="width:25%;">

      <div id=cover>
          	<div id="time"></div> <div id="da"></div> <div id="dt"></div> <div id="salute"> </div>
            
      </div>
      
               
            <!--<script type="text/javascript">window.onload = date_time('date_time');</script>-->
            
              </div>      
            </div>
<!-- /clock-->                    
            
            <br />


            <div class="row">
            
            <!-- on_off time graph 
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="dashboard_graph x_panel">
                  <div class="row x_title">
                      
                    
                   <div class="col-md-6" style="width:auto;"><h3><label> 
                   Machine ON/OFF time graph</label></h3> </div>
                    
                  </div>
                  <div class="x_content">
                    <div class="demo-container" style="height:600px">
   
	
             <div id="container_on_off" style="height: 500px; min-width: 500px"></div>
                      
                    </div>
                  </div>
                </div>
              </div>
             /on_off time graph -->
              
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="dashboard_graph x_panel">
                  <div class="row x_title">
                      
                    
                   <div class="col-md-6" style="width:auto;">
                   <h3><label>Machine ON/OFF Status</label></h3> </div>
                    
                  </div>
                  <div class="x_content">
                    <div class="demo-container" style="height:600px">
   
	
             <div id="container_temp" style="height: 500px; min-width: 500px"></div>
                      
                    </div>
                  </div>
                </div>
              </div>
             
            </div>
			

            <div class="row">
            
            

			  <!-- machine speed gauge -->
         <div class="col-md-4 col-sm-6 col-xs-12" >
                <div class="x_panel fixed_height_320" style="height:380px;">
                  <div class="x_title">
                    <h2><label>Belt Speed</label></h2>
                    
                    <div class="clearfix"></div>
                  </div>
              		<div style="margin-left:10%; margin-right:10%; alignment-adjust:middle;">
                	<canvas id=gaugeCanvas>No canvas in your browser...sorry...</canvas>
                	</div>
                </div>
              </div>
              
              <!-- /machine speed gauge -->
              
              
              
              <!-- temperature -->
            <div class="col-md-4 col-sm-6 col-xs-12" >
                <div class="x_panel fixed_height_320" style="height:380px;">
                  <div class="x_title">
                    <h2><label>Machine Efficiency</label></h2>
                    
                    <div class="clearfix"></div>
                  </div>
              		<div style="margin-left:10%; margin-right:10%; alignment-adjust:middle;">
                	<canvas id=gaugeCanvas_temp>No canvas in your browser...sorry...</canvas>
                	</div>
                </div>
              </div>
            <!-- /temperature -->
            
            <!-- counter -->  
             <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="x_panel fixed_height_320" style="height:190px;">
                  <div class="x_title">
                    <h2><label>Printing Length</label></h2>
                    
                    <div class="clearfix"></div>
                  </div>
              		<div style="margin-left:10%; margin-right:10%; alignment-adjust:middle;">
              		<canvas id="printing_counter" width="100" height="40" ></canvas>
                    <canvas id="gaugeCanvas_new" width="120" height="50"></canvas>
                	</div>
                </div>
              </div>
              <!-- /counter -->
              
               <!-- new 
            <div class="col-md-4 col-sm-6 col-xs-12" >
                <div class="x_panel fixed_height_320" style="height:380px;">
                  <div class="x_title">
                    <h2><label>Machine Temperature</label></h2>
                    
                    <div class="clearfix"></div>
                  </div>
              		<div style="margin-left:10%; margin-right:10%; alignment-adjust:middle;">
                	<canvas id=gaugeCanvas_new>No canvas in your browser...sorry...</canvas>
                	</div>
                </div>
              </div>
            <!-- /new -->
    
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

    
  </body>

</html>