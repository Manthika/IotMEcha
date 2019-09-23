<?php
    session_start();

    if (isset($_POST['submit'])) {
        include("connection_user.php"); //connection.php
        $username = strip_tags($_POST['name']);
        $password = strip_tags($_POST['password']);
        
        $sql = "SELECT id, user_name, password FROM user WHERE user_name = '$username' AND activated = '1' LIMIT 1";
        
        $query = mysqli_query($dbCon, $sql); 
         if ($query) {
            $row = mysqli_fetch_row($query); 
            $userId = $row[0];
            $dbUsername = $row[1];
            $dbPassword = $row[2];
			
		    
           
         }
        if ($username == $dbUsername && $password == $dbPassword) {
            $_SESSION['user_name'] = $username;
            $_SESSION['id'] = $userId;
            header('Location: index_back_user.php');
        } else {
            header('Location: incorrect.php');
			//echo"<h>".$userId."</h>";
			 //echo"<h>".$dbUsername."</h>";
			 // echo"<h>".$dbPassword."</h>";
        }
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

    <title> User Login </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="css/style.css">
    
    <link rel="shortcut icon" href="images/icon.ico" type="image/x-icon" />

  </head>

  <body class="login" style="background-image:url(images/innovation.jpg); background-size:cover;">
  
  <div style= "background-image: url(images/logo_1.png); height: 65px; width: 350px; margin-left:auto; margin-right:auto; margin-top:50px; margin-bottom:10px;">
  
  </div>
  
  <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post" action="login_user.php">
              <h1>User Sign In</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" name="name"  required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="password" required="" />
              </div>
              <div>
               <div style="margin-left:25%; margin-right:50%;">
              <input class="btn btn-custom-outline" type="submit" name="submit" value="Login" />
             </div>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-adn"></i> ANIMAX</h1>
                  <p>©2016 All Rights Reserved ANIMAX Company(Pvt.)Ltd.</p>
                  <p>&nbsp;</p>
                  <p>&nbsp;</p>
                  <a href="index.php"><div class="btn btn-custom-outline">Back</div></a>
                </div>
              </div>
            </form>
          </section>
        </div>

      </div>
    </div>
    </div>
  </body>
</html>
