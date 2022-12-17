<?php
session_start();
include('connect.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $author =  $_POST["name"];
                $comment = $_POST["comment"];
                $resep_id = $_POST["id"];
                
                $query = "INSERT INTO `comments`(`comment_id`, `author`, `id_resep`, `comment`, `date_created`, `reply`) VALUES ('','$author','$resep_id','$comment',NOW(),'');";
                $result = mysqli_query($conn, $query);
                if ($result) {
                        $msg = "berhasil";
                } 
                else {
                        $msg = "gagal";
                }
         
        $query = "SELECT * FROM comments WHERE id_resep = $resep_id ORDER BY comment_id ASC";
        $result = mysqli_query($conn, $query);
        $output = '';
        

        foreach($result as $r) {
            $output .= '
            <div class="comment-header">By <b>' .$r["author"]. ' </b> on <i>' .$r["date_created"]. '</i> </div>
            <div class="comment-content">' .$r["comment"]. '</div>
            <div class="reply">
            <button type="button" class="btn btn-default reply" id="'.$r["comment_id"].'">Reply</button>    
            </div>
            ';
            echo $output;
        }
       
}
         

?>