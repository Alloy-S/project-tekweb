<?php
session_start();
include('connect.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                // $author =  $_POST["name"];       
                if(isset($_SESSION["login_user"])){
                        $author = $_SESSION["username_user"];
                } else {
                        $author = "Anonymous";
                }
                $comment = $_POST["comment"];
                $resep_id = $_POST["id"];
                
                $query = "INSERT INTO `comments`(`comment_id`, `author`, `id_resep`, `comment`, `date_created`, `reply`) VALUES ('','$author','$resep_id','$comment',NOW(),'');";
                $result = mysqli_query($conn, $query);
                if ($result) {
                        $msg = "Comment posted";
                } 
                else {
                        $msg = "Failed to post comment";
                }
                echo $msg;
         
   
        

        
       
}
         

?>