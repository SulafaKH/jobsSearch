<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA_Compatible" content="IE=edge">
    <meta name="viewport " content="width=device-width ,inital-scale=1.0">
    <title>update</title>

    <!-- Css File-->
    <link rel="stylesheet" href="\job_website\dist\css\style.min.css">
    <link rel="stylesheet"
        href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">



</head>
<?php

$username="root";
$password="";
$database =new PDO("mysql:host=localhost; dbname=jobsdb; charset=utf8", $username,$password);

if(isset($_GET['edit'])){
    $getjobs=$database->prepare("SELECT Jobs.*, Companies.name AS company_name 
                                                FROM Jobs 
                                               JOIN Companies ON Jobs.company_id = Companies.id  WHERE job_id=:job_id ");
    $getjobs->bindParam("job_id",$_GET['edit']);
    $getjobs->execute();
foreach($getjobs AS $Result){
        echo' <div class="container">
         <div class="centered">
            <div class="admin-job-form-container ">
                <form action="" method="POST" enctype="multipart/form-data">
                      <h3>Update the Job</h3>
                      
                      <input type="text" placeholder="company name"  name="company_name" value="'.$Result['company_name'].'" class="box">
                      <input type="text" placeholder="job title" name="job_title"  value="'.$Result['job_title'].'" class="box">
                      <input type="text" placeholder="location" name="location"  value="'.$Result['location'].'" class="box">
                      <input type="text" placeholder="Salary" name="salary"  value="'.$Result['salary'].'" class="box">
                      <input type="text" placeholder="Job type" name="job_type"  value="'.$Result['job_type'].'" class="box">
                      <input type="text" placeholder="description" name="description" value="'.$Result['description'].'" class="box"> 
                     <button class="btn-admin" name="update" type="submit" value= "'.$Result['job_id'].' ">update</button>
                      <a href="mangejob.php" class="btn-admin">Back</a>
                </form>
            </div>
        </div>';
    }
    if(isset($_POST['update'])){
    
      $update=$database->prepare("UPDATE Jobs JOIN Companies ON Jobs.company_id = Companies.id
                                  SET name=:company_name ,job_title=:job_title,location=:location,
                                 salary=:salary, description=:description ,job_type=:job_type WHERE job_id=:id");
      $update->bindParam("company_name",$_POST['company_name']);
      $update->bindParam("job_title",$_POST['job_title']);
      $update->bindParam("location",$_POST['location']);
      $update->bindParam("salary",$_POST['salary']);
      $update->bindParam("job_type",$_POST['job_type']);
      $update->bindParam("description",$_POST['description']);

      $getId=$_POST['update'];
      $update->bindParam("id",$getId);
      if($update->execute()){ echo'seccess';
      } else{echo'not de';}
    
    
      header("refresh:0.5;");
     
    }    
}

?>