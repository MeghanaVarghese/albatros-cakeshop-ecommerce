<?php
//establish a connection to the mysql database
$user1 = new mysqli("localhost", "root", "", "user");

//check for connection errors
if(!$user1){
    die("connection failed:" .$user1->connect_error);
}
//retrieve username & password from POST data
$uname = $_POST["username"];
$password = $_POST["password"]; 

//check if the username are already exists
$check_query = "SELECT * FROM user1 WHERE uname = '$uname' ";
$check_result = $user1->query($check_query);

if($check_result->num_rows > 0){
    //username already exists, display alert and redirect back to sign in
    echo '<script>alert("username already exists. please choose a different username.");
    window.location.href="signup.html";</script>';
    exit();
}

//insert the new user if the username doent exist
$sql ="INSERT INTO user1 (uname, password) 
VALUES ('$uname','$password')";

if (mysqli_query($user1, $sql) === TRUE){
//IF insertion is successful, redirect to index.html
header("Location: signin.html");
exit();
}else{
    //if there's an error during insertion, display the error message
    echo "Error:" .mysqli_error($user1);
}
?>