<?php
// session_start();
include('connect.php');

if(isset($_POST)){
    $resep_id = $_POST['resep_id'];
}

$query = "SELECT * FROM comments WHERE id_resep = '$resep_id' ORDER BY comment_id ASC";
$result = mysqli_query($conn, $query);
$output = '';
// $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
// var_dump($result);

// if (mysqli_num_rows($result) = 0){
//     $output = ' ';
// } else {

foreach($result as $r) {
    $output .= '
    <div class="comment-header"><b>' .$r["author"]. ' </b> on <i>' .$r["date_created"]. '</i> </div>
    <div class="comment-content">' .$r["comment"]. '</div>
    <div id="reply">
    <button type="button" class="btn btn-secondary reply mb-2" id="'.$r["comment_id"].'" onclick="showReply()" style="display:block;">Reply</button>    
    </div> 
    <div id = "reply-form" style="display:none;">
    <div class="col-auto mx-4 mb-2 mt-2">
        <textarea class="form-control" name="rep" id="rep" name="rep" placeholder = "Berikan balasan!" required></textarea>
    </div>


<div class="mx-4 mb-3">
    <input type="submit" id="submit-rep" name="submit-rep" class="btn btn-secondary" value = "post">
</div>
</div>
';
    // $output .= get_reply_comment($conn, $r["comment_id"]);
};

echo $output;


function get_reply_comment($conn, $parent_id = 0, $marginleft = 0){
 $query = "SELECT * FROM comments WHERE reply = '".$reply."'";
 $output = '';
 $result = mysqli_query($conn, $query);
 $count = mysqli_num_rows($result);
    if($parent_id == 0)
    {
    $marginleft = 0;
    }
    else
    {
    $marginleft = $marginleft + 48;
    }
 if($count > 0)
 {
  foreach($result as $r)
  {
   $output .= '
   <div class="panel panel-default" style="margin-left:'.$marginleft.'px">
    <div class="panel-heading">By <b>'.$r["author"].'</b> on <i>'.$row["date_created"].'</i></div>
    <div class="panel-body">'.$row["comment"].'</div>
    <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button></div>
   </div>
   ';
   $output .= get_reply_comment($conn, $r["comment_id"], $marginleft);
  }
 }
 return $output;
}

// // json_encode($output);
// // <? var_dump($result); ?>
<script>
    function showReply(){
    document.getElementById('reply-form').style.display = "block";
    document.getElementById('reply').style.display = "none";
    }

    // $("#submit-rep").click(function(event) {
    //     event.preventDefault();

    // })
</script>



