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
                // if($result){
                // $err = "<label class="text-success">Comment Added</label>";
                // } else (
                //         $err = "<label class="text-danger">Comment Failed to be Added</label>";
                // )

                // $data = array (
                //         'error' => $err
                // )
        //         $data = array (
        //                 'name' => $author,
        //                 'comment'=> $comment,
        //                 'id' => $resep_id,
        //         ); 

        //         echo json_encode($data);
        // }
                echo $author;
        }

?>