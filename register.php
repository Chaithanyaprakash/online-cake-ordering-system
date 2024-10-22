<?php
// Start the session
session_start();

// Database connection details
$servername = "localhost";
$username = "root"; // Your database username
$password = "";     // Your database password
$dbname = "login";  // Your database name

// Create the database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    // Hash the password before saving it to the database
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    // Insert user into the database
    $sql = "INSERT INTO Users (username, password) VALUES ('$user', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful! Redirecting to login page...";
        // Redirect to login page after registration
        header("Refresh: 2; URL=login page.html");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
