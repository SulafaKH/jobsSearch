<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA_Compatible" content="IE=edge">
        <meta name="viewport " content="width=device-width ,inital-scale=1.0">
        <title>Login</title>

        <!-- Css File-->
         <link rel="stylesheet" href="../dist/css/style.min.css">
         <link rel="stylesheet"
         href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

     </head>
     <body>
        
          <!--account section starts-->
          <div class="account-form-container">
            <section class="account-form">
            <form action="" method="POST">
                <h3>Welcome back!</h3>
                <input type="email" required name="email" maxlength="50" placeholder="enter your email" class="input" >
                <input type="password" required name="pass" maxlength="20" placeholder="enter your password" class="input" >
                 <P><a href="security_question.php" >Forgot your password?</a></P>
                 <p>don't have an account? <a href="register.php" >register now</a></p>
               
                <input type="submit" value="Login" name="submit" class="btn">

            </form>
             </section>
          </div>
          <!--account section end--> 
          <?php 
     
   if(isset($_POST['submit'])){
     $username="root";
      $password="";
      $database =new PDO("mysql:host=localhost; dbname=jobsdb;charset=utf8", $username,$password );

      $login=$database->prepare("SELECT *FROM users WHERE email=:email AND password=:password ");
      $login->bindParam("email", $_POST['email']);
      $passwordUser=sha1($_POST['pass']);
      $login->bindParam("password", $passwordUser);
      ;
      if($login->execute()){
        $user=  $login->fetchObject() ;
          session_start();
          $_SESSION['user']=$user;
          //User or Admin
          if($user->user_type==="seeker"){
            
            header("Location:index.php");
    
            
           
          }else if($user->user_type==="recruiter"){	
           header("Location:recruiter\mangejob.php",true);
          }else{"no user type";}

      }else{
        echo'<div>password or email is incorrect</div>';
      }

      
    }

     ?>
     </body>

    