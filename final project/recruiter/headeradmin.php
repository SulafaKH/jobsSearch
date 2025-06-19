<!DOCTYPE html>

<html lang="en"><head>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
        <meta http-equiv="X-UA_Compatible" content="IE=edge">
        <meta name="viewport " content="width=device-width ,inital-scale=1.0">
        <title>Manage job</title>

        <!-- Css File-->
         <link rel="stylesheet" href="\job_website\dist\css\style.min.css">
         <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    

     </head>
     <body>
        
         <!-- Header Section -->
          <header class="header">
            <section class="flex">
                <div class="bx bx-menu" id="menu-btn"></div>
                <a href="" class="logo"><i class=""></i> JobSearch </a>

                <nav class="navbar">
                    <a href="mangejob.php">Manage job</a>
                    <a href="Application.php">Application</a>

                </nav>                   
                <form><button  type='submit'  name='logout' class='btn' name=''>Logout</button></form>
                <?php session_start();
                if(isset($_SESSION['user'])){
                if($_SESSION['user']->user_type==="recruiter"){}}
       
                if(isset($_GET['logout'])){
                 session_unset();
                 session_destroy();
                 header("Location:../Login.php");
                }?>
        
            </section>
          </header>