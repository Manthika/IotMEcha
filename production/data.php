<?php
header('Content_Type:application/json');
define('localhost','127.0.0.1');
define('DB_USERNAME','root');
define('DB_PASSWORD','root');
define('DB_NAME','arduino');
$mysqli=new mysqli(localhost,DB_USERNAME,DB_PASSWORD,DB_NAME);
if(!$mysqli){
	die("Connection failed:".$mysqli->error);
}
$query =sprintf("SELECT id,sensor1,sensor2,sensor3,event FROM tbard ORDER BY id");
$result =$mysqli->query($query);

$data =array();
foreach($result as $row){
	$data[]=$row;
}
$result->close();
$mysqli->close();
print json_encode($data);
?>
