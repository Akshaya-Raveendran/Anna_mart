<?php
session_start();
   $servername = "localhost";
$username = "root";
$password = "";
$db="userdata";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

   
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($conn,"select r_no from info where r_no = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['r_no'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:sign-up form.php");
      die();
   }
?>