<?php
    class User{
        private $user_obj;
        private $con;
        public function __construct($con,$user){
            $this->con =$con;
            $this->user_obj = new User($con,$user);
        }
        public function submitPost($post, $user_to){
           $body = strip_tags($body);//removes html code
           $body = mysqli_real_escape_string($this->con,$body);
           $check_empty = preg_replace('/\s+/','',$body);//deletes all spaces
           
           if($check_empty =! ""){


            //Current date and time
               $date_added = date("Y-m-d H:i:s");
               $added_by = $this->user_obj->getUsername();

               //none if post from own profile
               if($user_to == added_by){
                   $user_to = "none";
               }
                
               //insert post
               $query = mysqli_query($this->con,"INSERT INTO posts VALUES('','$body','$added_by','$user_to','$date_added,'no','no','0'");
               $returned_id = mysqli_insert_id($this->con);
               
               //Insert notification
               

               //update post
               $num_posts = $this_>user_obj->geetNumPosts();
               $num_posts++;
               $update_query = mysqli_query($this->con,"UPDATE users SET num_posts='$num_posts' where username='$added_by'");
           }
        }
    }
?>