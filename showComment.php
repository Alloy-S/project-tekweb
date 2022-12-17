<?php
// session_start();
include('connect.php');

$query = "SELECT * FROM comments ORDER BY comment_id ASC";
$result = mysqli_query($conn, $query);
$output = '';


foreach($result as $r) {
    $output .= '
    <div class="comment-header">By <b>' .$r["author"]. ' </b> on 
                <i>' .$r["date_created"]. '</i> </div>
    <div class="comment-content">' .$r["comment"]. '</div>
    <div class="reply">
    <button type="button" class="btn btn-default reply" id="'.$r["comment_id"].'">Reply</button>    
    </div>
    ';
}
echo $output;

// json_encode($output);
// var_dump($result);
// ?>


