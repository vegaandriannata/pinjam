<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Basic validation
    if (empty($username) || empty($password)) {
        header("Location: login.php?error=empty");
        exit();
    }

    // Perform SQL query to check user credentials
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            // Valid user, store user information in session
            session_start();
            $_SESSION['username'] = $username;

            // Redirect to dashboard or home page (index.php)
            header("Location: index.php");
            exit();
        } else {
            // Invalid user, redirect back to login with an error
            header("Location: login.html?error=invalid");
            exit();
        }
    } else {
        die("Error in SQL query: " . mysqli_error($koneksi));
    }
} else {
    // Redirect to login page if accessed directly
    header("Location: login.html");
    exit();
}
?>
