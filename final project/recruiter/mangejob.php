<?php 
include __DIR__ . '/headeradmin.php';


$username="root";
$password="";
$database =new PDO("mysql:host=localhost; dbname=jobsdb; charset=utf8", $username,$password);


if(isset($_POST['add_job'])){
    $companyname = $_POST['company-name'];
    $jobname =$_POST['job-name'];
    $location =$_POST['location'];
    $salary =$_POST['salary'];
    $jobtype =$_POST['job-type'];
    $description =$_POST['description'];
  

    
$addcompany=$database->prepare(" INSERT INTO companies(name) VALUE('$companyname');");
$addcompany->execute();
$company_id=$database->lastInsertId();

    $addjob=$database->prepare("INSERT INTO jobs(company_id,job_title,location,salary,job_type,description)
    VALUES(1,' $jobname ',' $location',' $salary ',' $jobtype', '$description')");
    if($addjob->execute()){echo "job add successfully";}else{echo "could not add the job";};}
?>

<div class="container">

<div class="admin-job-form-container">
    <form action="" method="POST">
          <h3>Add a New Job</h3>
          <input type="text" placeholder="company name" name="company-name" maxlength="20" class="box">
          <input type="text" placeholder="job title" name="job-name" maxlength="20" class="box">
          <input type="text" placeholder="location" name="location" maxlength="20" class="box">
          <input type="text" placeholder="Salary" name="salary" maxlength="20" class="box">
          <input type="text" placeholder="Job type" name="job-type" maxlength="20" class="box">
          <input type="text" placeholder="description" name="description" maxlength="500" class="box"> 
          <input type="submit" class="btn-admin" name="add_job" value="Add a job">
    </form>
</div>


<div class="job_disblay">
                <table class="job-disblay-table">
                    <thead>
                        <tr>
                            <td>Title</td>
                            <td>Company Name</td>
                            <td>Location</td>
                            <td>Description</td>
                            <td>Salary</td>
                            <td>Job Type</td>
                            <td>Date Posted</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                         $getItem =$database->prepare("SELECT Jobs.*, Companies.name AS company_name 
                                                FROM Jobs 
                                               JOIN Companies ON Jobs.company_id = Companies.id 
                                                 ORDER BY date_posted DESC");

                         $getItem->execute();
                        
                         foreach($getItem AS $Result){
                        ?>
                        
                         <td><?php echo $Result['job_title']?></td>
                         <td> <?php echo $Result['company_name']?></td>
                         <td><?php echo $Result['location']?></td>
                         <td><?php echo $Result['description']?></td>
                         <td><?php echo $Result['salary']?></td>
                         <td><?php echo $Result['job_type']?></td>
                         <td><?php echo $Result['date_posted'] ?></td>
                          <td>
                         <form method="POST">
                            <button class="btn-delete" name="delete" type="submit" value= "<?php echo $Result['job_id']?> ">Delete</button>
                            <a href="Edit.php?edit=<?php echo $Result['job_id']?>" class="btn-edit">Edit</a></form>
                           
                        </td>
                         </tr>
                         <?php
                         };
                         if(isset($_POST['delete'])){
                            $removeJob = $database->prepare("DELETE FROM jobs WHERE job_id= :id");
                            $getId = $_POST['delete'];
                            $removeJob->bindParam("id",$getId);
                           
                          if($removeJob->execute()) {
                            echo'seccess';
                          } else{echo'not de';}
                          }
                        ?>
                 </tbody></table>

            </div>
          </div>