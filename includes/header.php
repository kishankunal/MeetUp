<?php
   require 'config/config.php';
   //proper validation is used in this project
   //$query = mysqli_query($con,"INSERT INTO test VALUES(NULL,'Kunal')");
   if(isset($_SESSION['username'])){
       $userLoggedIn = $_SESSION['username'];
   }else{
       header("location:register.php");
   }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>fakebook</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <link rel="stylesheet" href="assets/css/bootstrap.css.css">
</head>
<body>
