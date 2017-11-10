<?php
require_once('config.php');
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password is invalid";
    }
else{
    $username=$_POST['username'];
    $password=$_POST['password'];
    
    // Selecting Database
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // SQL query to fetch information of registerd users and finds user match.
    $sql = "select UserID, UserName, Password, Salt, State, DateJoined, DateLastModified from UsersLogin where UserName='$username'";
    $result = $pdo-> query ($sql);
    while ($row = $result->fetch()){
        $salt = $row['Salt'];
        $pass = md5($_POST['password'].$salt);
        if ($row['Password'] == $pass) {
            $_SESSION['userid']= $row['UserID']; // Initializing Session
            $sql2 = "select UserID, FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email from Users";
            $result2 = $pdo-> query($sql2);
            while ($row = $result2->fetch()){
                $_SESSION['firstname']=$row['FirstName'];
                $_SESSION['lastname']=$row['LastName'];
                $_SESSION['email']=$row['Email'];
            }
            header("location: index.php"); // Redirecting To Other Page
        } else {
            $error = "Username or Password is invalid";
        }
    }
    $pdo = null; // Closing Connection
    }
}
?>