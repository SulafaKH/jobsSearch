<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION["user"])) {
    die("You must be logged in to apply for a job.");
}

$user_id = $_SESSION["user"]->user_id;

// Connect to the database using PDO
$username = "root";
$password = "";
try {
    $database = new PDO("mysql:host=localhost;dbname=jobsdb;charset=utf8", $username, $password);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["Apply"]) && isset($_POST["job_id"])) {
    $job_id = intval($_POST["job_id"]);

    // Check if application already exists
    $check_sql = "SELECT * FROM applications WHERE job_id = :job_id AND user_id = :user_id";
    $stmt = $database->prepare($check_sql);
    $stmt->execute([
        ':job_id' => $job_id,
        ':user_id' => $user_id
    ]);

    if ($stmt->rowCount() > 0) {
        echo "You have already applied for this job.";
    } else {
        // Insert new application
        $insert_sql = "INSERT INTO applications (job_id, user_id, status) VALUES (:job_id, :user_id, 'Pending')";
        $insert_stmt = $database->prepare($insert_sql);
        $success = $insert_stmt->execute([
            ':job_id' => $job_id,
            ':user_id' => $user_id
        ]);

        if ($success) {
            echo "Application submitted successfully!";
            // Optional redirect:
            // header("Location: success.php");
        } else {
            echo "Failed to submit application.";
        }
    }
} else {
    echo "Invalid request.";
}
