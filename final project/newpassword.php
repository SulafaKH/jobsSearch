<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA_Compatible" content="IE=edge">
        <meta name="viewport " content="width=device-width ,inital-scale=1.0">
        <title>Forgot Password</title>

        <!-- Css File-->
       <link rel="stylesheet" href="../dist/css/style.min.css">
         <link rel="stylesheet"
         href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

     </head>
     <body>
        <div class="account-form-container">
            <section class="account-form">
            <form method="POST">
                <h3>New Password</h3>
                  <input type="password" required name="password" maxlength="20" placeholder="Create new password" class="input" >
                <input type="submit" value="Change" name="change" class="btn">
                
                
            </form>
             </section>
          </div>
<?php
$username="root";
        $password="";
        $database =new PDO("mysql:host=localhost; dbname=jobsdb;charset=utf8", $username,$password );
     if(isset($_POST['change'])){
        $updatepassword=$database->prepare("UPDATE users SET password=:password WHERE email=:email");
        $updatepassword->bindParam("password",$_POST['password']);
        $updatepassword->bindParam("email",$_GET['email']);
        $getemail=$_POST['change'];
        $updatepassword->bindParam("email",$getemail);
    
        if($updatepassword->execute()){
            echo 'Password has been reset successfully';
             header("Location:login.php");
        }else{
            echo 'Failed to set a password';}
        }


?>