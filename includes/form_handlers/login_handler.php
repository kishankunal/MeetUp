<?php
   if(isset($_POST['login_button'])){
       $email = filter_var($_POST['log_email'],FILTER_SANITIZE_EMAIL);
       $_SESSION['log_email'] = $email; //store email into session var
       $password = md5($_POST['log_password']);//get password after encryption
       $check_datbase_query = mysqli_query($con,"SELECT * FROM user WHERE email='$email' AND password='$password'");
       $check_login_query = mysqli_num_rows($check_datbase_query);

       if($check_login_query == 1){
           $row = mysqli_fetch_array($check_datbase_query);
           $username = $row['username'];

           $user_closed_query = mysqli_query($con,"SELECT * FROM user where email ='$email' AND user_closed='yes'");
           if(mysqli_num_rows($user_closed_query)==1){
               $reopen_account = mysqli_query($con,"UPDATE user SET user_closed ='no' WHERE email ='$email'");
           }
           $_SESSION['username'] = $username;
           header("Location:index.php");
           exit();
       }
       else{
           array_push($error_array,"Email or Password is incorrect<br>");
       }
   }
?>