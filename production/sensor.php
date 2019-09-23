<?php
   $con=mysqli_connect("localhost","root","root","arduino");
   
   $sensor1 =$_GET['sensor1'];
   $sensor2 =$_GET['sensor2'];
   $sensor3 =$_GET['sensor3'];
   
   $sql_insert="insert into tbard (sensor1,sensor2,sensor3)values('$sensor1','$sensor2','$sensor3')";
   
   mysqli_query($con,$sql_insert);
   
   if($sql_insert){
	   echo"insert success";
   }else{
	   echo "insert not success";
   }
   
?>