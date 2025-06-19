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
            <form action="" method="POST">
                <h3>Answer question!</h3>
                  <input type="email" required name="email" maxlength="50" placeholder="enter your email" class="input" >
                <input type="text" required name="security_question" 
                 maxlength="20" placeholder="What is the name of your best childhood friend?" class="input" >
                <input type="submit" value="Continue" name="submit" class="btn">
            </form >
             </section>
          </div>

    <?php  $username="root";
        $password="";
        $database =new PDO("mysql:host=localhost; dbname=jobsdb;charset=utf8", $username,$password );
     if(isset($_POST['submit'])){
       
        
    $check=$database->prepare("SELECT *FROM users WHERE email=:email AND security_question=:security_question ");
    $email = $_POST['email'];
    $check->bindParam("email",  $email);

    $security_question=$_POST['security_question'];
    $check->bindParam("security_question",$security_question);
    $check->execute();

    
      if($check->rowCount()>0){
        header("Location:newpassword.php?email=".$email."");
      }else{echo'<div>Some thing error</div>';}
    }


    ?>