<?php

include __DIR__ . '/header.php';
if (session_status() === PHP_SESSION_NONE) {
   session_start();
}
$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost; dbname=jobsdb; charset=utf8", $username, $password);
?>

</header>
<!-- Header Section end-->
<!--home section start-->
<div class="home-container">
   <section class="home">
      <form method="GET">
         <h3>find your job</h3>
         <p style="font-size: 1.8rem; color: #777;text-transform: capitalize;padding-left: 1rem;"> </p>
         <input type="text" name="title" placeholder="job title "
            required maxlength="20" class="input">
         <button type="submit" name="btn-search" class="btn">search</button>

      </form>
   </section>
</div>

<!--home section end-->

<?php
if (isset($_GET['btn-search'])) {
   $SEARCH = $database->prepare(" SELECT Jobs.*, Companies.name AS company_name 
                                                FROM Jobs 
                                               JOIN Companies ON Jobs.company_id = Companies.id  WHERE job_title LIKE :job_title ");
   $SEARCHTITLE = "%" . $_GET['title'] . "%";
   $SEARCH->bindParam("job_title", $SEARCHTITLE);
   $SEARCH->execute();
   echo '
    <h1 class="heading">Result</h1>
    <section class="jobs-container">
      <div class="box-container"> ';
   foreach ($SEARCH as $Result) {
?>


      <div class="box">
         <div class="company">
          
            <div>
               <h3><?php echo $Result['company_name'] ?></h3>
               <p><?php echo $Result['date_posted'] ?></p>
            </div>
         </div>
         <h3 class="job-titel"><?php echo $Result['job_title'] ?></h3>
         <p class="location">
            <span><?php echo $Result['location'] ?></span>
         </p>
         <div class="tags">
            <p class="salary"><span><?php echo $Result['salary'] ?>$ </span></p>
            <p class="job-type"><?php echo $Result['job_type'] ?></span></p>
         </div>
         <p class="description">
            <span><?php echo $Result['description'] ?></span>
         </p>
         <div class="flex-btn">
            <form action="apply.php" method="POST">
               <input type="hidden" name="job_id" value="<?php echo $Result['job_id'] ?>">
               <button type="submit" name="Apply" class="btn">Apply</button>

            </form>
         </div>

      </div>
<?php }
} ?>
</div>
</section>

<!--job section start-->

<section class="jobs-container">

   <h1 class="heading">The jobs</h1>

   <div class="box-container">
      <?php
      $getItem = $database->prepare("SELECT Jobs.*, Companies.name AS company_name 
                                                FROM Jobs 
                                               JOIN Companies ON Jobs.company_id = Companies.id 
                                               ORDER BY date_posted DESC");
      $getItem->execute();
      foreach ($getItem as $Result) {
      ?>
         <div class="box">
            <div class="company">
               <div>
                  <h3><?php echo $Result['company_name'] ?></h3>
                  <p><?php echo $Result['date_posted'] ?></p>
               </div>
            </div>
            <h3 class="job-titel"><?php echo $Result['job_title'] ?></h3>
            <p class="location">
               <span><?php echo $Result['location'] ?></span>
            </p>
            <div class="tags">
               <p class="salary"><span><?php echo $Result['salary'] ?>$ </span></p>
               <p class="job-type"><?php echo $Result['job_type'] ?></span></p>
            </div>
            <p class="description">
               <span><?php echo $Result['description'] ?></span>
            </p>
            <div class="flex-btn">
               <form action="apply.php" method="POST">

                  <input type="hidden" name="job_id" value="<?php echo $Result['job_id'] ?>">
                  <button type="submit" name="Apply" class="btn">Apply</button>


               </form>
            </div>

         </div><?php };
               ?>

   </div>
   </div>
</section>

<!--job section end-->

<?php
include  __DIR__ . '/footer.php';
?>