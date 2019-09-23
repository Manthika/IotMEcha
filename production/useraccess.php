 <?php
 $link = mysqli_connect("localhost", "root", "root", "userdata");

  // Check connection

    if($link === false){

        die("ERROR: Could not connect. " . mysqli_connect_error());

    }
$name=mysqli_real_escape_string($link,$_POST['name']);
$user_name=mysqli_real_escape_string($link,$_POST['user_name']);
$email=mysqli_real_escape_string($link,$_POST['email']);
$epf=mysqli_real_escape_string($link,$_POST['number']);
$occu=mysqli_real_escape_string($link,$_POST['occupation']);
$pass=mysqli_real_escape_string($link,$_POST['password']);
$tele=mysqli_real_escape_string($link,$_POST['phone']);

$sql = "INSERT INTO user (name,user_name,email, epf,occu,password,tele) VALUES ('$name','$user_name', '$email', '$epf','$occu','$pass','$tele')";

    if(mysqli_query($link, $sql)){

        include ("user_sucs.php");

    } else{

        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);

    }

     

    // close connection

    mysqli_close($link);


?> 