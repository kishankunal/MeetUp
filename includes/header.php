<?php
   require 'config/config.php';
   //proper validation is used in this project
   //$query = mysqli_query($con,"INSERT INTO test VALUES(NULL,'Kunal')");
   if(isset($_SESSION['username'])){
       $userLoggedIn = $_SESSION['username'];
       $user_details_query = mysqli_query($con,"SELECT * FROM user WHERE username='$userLoggedIn'");
       $user = mysqli_fetch_array($user_details_query);
   }else{
       header("location:register.php");
   }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MeetUp</title>
    <!--Javascript-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    
    <!--css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
</head>
<body>
     <div class="top_bar">
        <div class="logo">
            <a href="index.php">MeetUp !</a>
        </div>
        <nav>
            <a href="<?php echo $userLoggedIn?>"><?php echo $user['first_name']?></i></a>
            <a href="index.php"><i class="fa fa-home fa-lg"></i></a>
            <a href=""><i class="fa fa-envelop fa-lg"></i></a>
            <a href=""><i class="fa fa-bell-o fa-lg"></i></a>
            <a href=""><i class="fa fa-users fa-lg"></i></a>
            <a href=""><i class="fa fa-cog fa-lg"></i></a>
            <a href="includes/handlers/logout.php"><i class="fa fa-sign-out fa-lg"></i></a>
        </nav>
     </div>
     <div class="wrapper">
