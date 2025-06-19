 <link rel="stylesheet" href="../dist/css/style.min.css">
  <title>My application</title>

<?php 
session_start();
if(isset($_SESSION['user'])){
$user_id = $_SESSION["user"]->user_id;

 
$username="root";
$password="";
$database =new PDO("mysql:host=localhost; dbname=jobsdb; charset=utf8", $username,$password);
}
?>
   <div class="container">


            <div class="job_disblay">
    <table class="job-disblay-table">
        <thead>
            <tr>
                
                <td>Job Title</td>
                <td>Company Name</td>
                <td>Date Applied</td>
            </tr>
        </thead>
        <tbody>
     <?php $getItem=$database->prepare("SELECT users.user_id, jobs.job_title ,Companies.name AS company_name ,applications.date_applied FROM applications JOIN users on 
           users.user_id= applications.user_id JOIN jobs on jobs.job_id =applications.job_id JOIN Companies ON Jobs.company_id = Companies.id WHERE users.user_id = $user_id " );
           $getItem->execute();
           foreach($getItem AS $Result){         
            ?>
        <tr>
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