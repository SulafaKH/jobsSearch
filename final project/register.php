<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA_Compatible" content="IE=edge">
        <meta name="viewport " content="width=device-width ,inital-scale=1.0">
        <title>Register</title>
        <link rel="stylesheet" href="../dist/css/style.min.css">
        <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
     </head>
     <body>
          <div class="account-form-container">
            <section class="account-form">
            <form action="" method="POST">
                <h3>Creat New Account!</h3>
                <input type="text" required name="name" maxlength="20" placeholder="enter your name" class="input" >
                <input type="email" required name="email" maxlength="50" placeholder="enter your email" class="input" >
                <input type="password" required name="pass" maxlength="20" placeholder="enter your password" class="input" >
                <input type="password" required name="c_pass" maxlength="20" placeholder="confirm your password" class="input" >
                <input type="text"  name="security" maxlength="20" placeholder="What is the name of your best childhood friend?" class="input" >
                <p>already have an account? <a href="Login.php" >Login now</a></p>
                <input type="submit" value="register" name="submit" class="btn">
            </form>
             </section>
          </div>
     </body>
     <?php
    $username = "root";
    $password = "";
    $database = new PDO("mysql:host=localhost; dbname=jobsdb;charset=utf8", $username, $password);
   
    if(isset($_POST['submit'])){ 
        $checkEmail = $database->prepare("SELECT * FROM users WHERE email = :email");
        $email = $_POST['email'];
        $checkEmail->bindParam("email", $email);
        $checkEmail->execute();
    
        if($checkEmail->rowCount() > 0){
            echo '<div>This account already exists</div>';
        }
        else{
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = sha1($_POST['pass']);
            $c_password = sha1($_POST['c_pass']);
            $security = $_POST['security'];  
            
            if($password !== $c_password){
                echo '<div>The passwords do not match</div>';
            } else { 
                $addusers = $database->prepare("INSERT INTO users(name, email, password, security_question) VALUES(:name, :email, :password, :security_question)");
                $addusers->bindParam("name", $name);
                $addusers->bindParam("email", $email);
                $addusers->bindParam("password", $password); 
                $addusers->bindParam("security_question", $security);
                
                if($addusers->execute()){
                    echo "Account created successfully!";  
                } else {
                    echo "Error creating account!";  
                }
            }
        }
    }
    ?>