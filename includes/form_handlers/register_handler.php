<?php
   //declaring varibales to prevent errors
   $fname = ""; //First Name
   $lname = ""; //Last Name
   $em = ""; // email
   $em2 = ""; //email2
   $password = ""; //password
   $password2 = ""; //password2
   $date = ""; //signup date
   $error_array = array(); //holds error messages

   if(isset($_POST['register_button'])){
       //registration form values
       
       //First Name
       $fname = strip_tags($_POST['reg_fname']);//strip tags is used to remove unwanted html tags from the input values
       $fname = str_replace(' ','',$fname); // it will remove unwanted space from the name
       $fname = ucfirst(strtolower($fname));//First letter upper Case
       $_SESSION['reg_fname'] = $fname;

       //Last Name
       $lname = strip_tags($_POST['reg_lname']);
       $lname = str_replace(' ','',$lname); 
       $lname = ucfirst(strtolower($lname));
       $_SESSION['reg_lname'] = $lname;

       //Email
       $em = strip_tags($_POST['reg_email']);
       $em = str_replace(' ','',$em); 
       $em = ucfirst(strtolower($em));
       $_SESSION['reg_email'] = $em;

       //Email2
       $em2 = strip_tags($_POST['reg_email2']);
       $em2 = str_replace(' ','',$em2); 
       $em2 = ucfirst(strtolower($em2));
       $_SESSION['reg_email2'] = $em2;

       //password
       $password = strip_tags($_POST['reg_password']);

       //password2
       $password2 = strip_tags($_POST['reg_password2']);

       //date"
       $date = date("Y-m-d"); //this will give the current date


       if($em == $em2){
           //check valid email format
           if(filter_var($em,FILTER_VALIDATE_EMAIL)){
                $em = filter_var($em,FILTER_VALIDATE_EMAIL);
                $e_check = mysqli_query($con,"SELECT email FROM user where email='$em'");
                
                //count number of rows returned
                $num_rows = mysqli_num_rows($e_check);
                if($num_rows > 0){
                    array_push($error_array,"Email already registered<br>");
                }
           }else{
                array_push($error_array,"Invalid email format<br>");  
           }
       }
       else{
            array_push($error_array,"Emails don't match<br>");
       }
       if(strlen($fname) > 25 || strlen($fname) < 2){
            array_push($error_array,"Your first name must be between 2 and 25 characters<br>");
       }
       if(strlen($lname) > 25 || strlen($lname) < 2){
            array_push($error_array,"Your last name must be between 2 and 25 characters<br>");
       }
       if($password != $password2){
            array_push($error_array,"Your passwords do not match<br>");
       }
       else{
           if(preg_match('/[^A-Za-z0-9]/',$password )){
                array_push($error_array,"Your password can only contain english characters or numbers<br>");
           }
       }
       if(strlen($password) > 30 || strlen($password) < 5){
            array_push($error_array,"Your password must be betwen 5 and 30 characters<br>");
       }
       if(empty($error_array)){
           $password = md5($password);//this will encrypt password before sending to database
            
            //generating user name by concating firstname and lastname
            $username = strtolower($fname."_".$lname);
            $check_username_query = mysqli_query($con,"SELECT username FROM user WHERE username='$username'");
            $i = 0;
            //if username exists add number to username
            $temp_username = $username;
            while(mysqli_num_rows($check_username_query) != 0){
                $i++;
                $temp_username = $username . "_" .$i;
                $check_username_query = mysqli_query($con,"SELECT username FROM user WHERE username='$temp_username'");
            }
            $username = $temp_username;
            //profile pic assignment
            $rand = rand(1,2);
            if($rand==1){
                $profile_pic = "assets/images/profile_pic/deafults/default_profile_pic.png";
            }
            else if($rand==2){
                $profile_pic = "assets/images/profile_pic/deafults/default_2.png";
            }
            $query = mysqli_query($con,"INSERT INTO user VALUES (NULL,'$fname','$lname','$username','$em','$password','$date','$profile_pic','0','0','no',',')");
    
            array_push($error_array,"<span style='color:#14c800;'>You're all set!  Go ahead and login!</span><br>");

            //clear session variables
            $_SESSION['reg_fname']="";
            $_SESSION['reg_lname']="";
            $_SESSION['reg_email']="";
            $_SESSION['reg_email2']="";
       } 
   }
?>