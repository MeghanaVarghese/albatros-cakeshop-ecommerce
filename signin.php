<?php
// Start a session to manage user sessions
session_start();

// Establish a connection to the MySQL database
$user1 = new mysqli("localhost", "root", "", "user");

// Check for connection errors
if ($user1->connect_error) {
    die("Connection failed: " . $user1->connect_error);
}

// Check if the request method is POST (form submission)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from POST data
    $uname = $_POST['username'];
    $password = $_POST['password'];

    // Use a prepared statement to prevent SQL injection
    $query = "SELECT * FROM user1 WHERE uname=?";
    $stmt = $user1->prepare($query);
    $stmt->bind_param("s", $uname);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any rows are returned (if the username exists)
    if ($result->num_rows > 0) {
        // Fetch the row
        $row = $result->fetch_assoc();

        if (strcmp($password, $row['password']) === 0) {
            // Passwords match, set session variable and redirect to index.html
            $_SESSION['uname'] = $uname;
            header("Location: index.html");
            exit();
        } else {
            // Passwords don't match, display error message and redirect back to signin.html
            echo '<script>alert("Invalid password");
             window.location.href = "signin.html";</script>';
        }
    } else {
        // Username not found, display error message and redirect back to signin.html
        echo '<script>alert("User not found");
         window.location.href ="signin.html";</script>';
    }
    // Close the prepared statement
    $stmt->close();
} 
// Close the database connection
$user1->close();
?>
