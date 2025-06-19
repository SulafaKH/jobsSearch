<?php
include __DIR__ . '/headeradmin.php';
$username="root";
$password="";
$database =new PDO("mysql:host=localhost; dbname=jobsdb; charset=utf8", $username,$password);


  $getTtem=$database->prepare("SELECT users.name ,users.email ,jobs.job_title ,applications.date_applied FROM applications JOIN users on 
  users.user_id= applications.user_id JOIN jobs on jobs.job_id =applications.job_id ");
  $getTtem->execute();
?>
          <div class="container">


            <div class="job_disblay">
    <table class="job-disblay-table">
        <thead>
            <tr>
                <td>Name</td>
                <td>Email</td>
                <td>Job Title</td>
                <td>Company Name</td>
                <td>Date Applied</td>
            </tr>
        </thead>
        <tbody>
     <?php $getItem=$database->prepare("SELECT users.name ,users.email ,jobs.job_title ,Companies.name AS company_name ,applications.date_applied FROM applications JOIN users on 
           users.user_id= applications.user_id JOIN jobs on jobs.job_id =applications.job_id JOIN Companies ON Jobs.company_id = Companies.id");
           $getItem->execute();
           foreach($getItem AS $Result){         
            ?>
        <tr>
            <td><?php echo $Result['name']?></td>
            <td><?php echo $Result['email']?></td>
            <td><?php echo $Result['job_title']?></td>
            <td><?php echo $Result['company_name']?></td>
            <td><?php echo $Result['date_applied']?></td>
        </tr>
               <?php    } ?>
        </tbody>
    </table>

          </div>
          </div>
           <!-- js File-->
           <script src="./dist/js/script.min.js"></script>
     </body>
</html>