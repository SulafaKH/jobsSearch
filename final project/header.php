<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA_Compatible" content="IE=edge">
    <meta name="viewport " content="width=device-width ,inital-scale=1.0">
    <title>Home</title>

    <!-- Css File-->
    <link rel="stylesheet" href="../dist/css/style.min.css">
    <link rel="stylesheet"
        href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">



</head>

<body>

    <!-- Header Section strart-->
    <header class="header">
        <section class="flex">
            <div class='bx bx-menu' id="menu-btn"></div>
            <a href="index.php" class="logo"> JobSearch </a>

            <nav class="navbar">
                <a href="index.php">Home</a>
                <a href="About.php">About Us</a>
                <a href="\Chatbot-reactjs\index.html">Chatbot</a>
                
            </nav>
            <?php
            if (!isset($_SESSION["user"]) && empty($_SESSION["user"]->user_id)) {
                $button_text = "Login";
                $button_url = "login.php";
            }
            if (isset($_SESSION["user"]) && !empty($_SESSION["user"]->user_id)) {
                $button_text = "My Applications";
                $button_url = "user_applications.php";
            }
            ?>
            <a href="<?php echo $button_url ?>" class="btn" style="margin-top:0% ;"><?= $button_text ?></a>
        </section>
    </header>