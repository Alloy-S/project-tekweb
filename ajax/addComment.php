<?php
session_start();
include('../connect.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // $author =  $_POST["name"];       
        if (isset($_SESSION["login_user"])) {
                $author = $_SESSION["username_user"];
        } else {
                $author = "Anonymous";
        }
        $comment = $_POST["comment"];
        $resep_id = $_POST["id_resep"];

        if (isset($_POST['id-reply'])) {
                $reply = $_POST['id-reply'];
                $query = "INSERT INTO `comments`(`comment_id`, `author`, `id_resep`, `comment`, `date_created`, `reply`) VALUES ('','$author','$resep_id','$comment',NOW(), $reply);";
        } else {
                $query = "INSERT INTO `comments`(`comment_id`, `author`, `id_resep`, `comment`, `date_created`, `reply`) VALUES ('','$author','$resep_id','$comment',NOW(), null);";
        }

        $result = mysqli_query($conn, $query);
        if ($result) {
                $msg = "Comment posted";
        } else {
                $msg = "Failed to post comment";
        }
        // echo $msg;
}

$query = "SELECT * FROM comments WHERE id_resep = '$resep_id' ORDER BY comment_id ASC";
$result = mysqli_query($conn, $query);

$result = mysqli_fetch_all($result, MYSQLI_ASSOC);


?>

<?php foreach ($result as $r) : ?>
        <?php if ($r['reply'] == 0) : ?>
                <div class="comment-header"><b><?= $r['author']; ?></b> on <i><?= $r["date_created"]; ?></i> </div>
                <div class="comment-content"><?= $r["comment"] ?></div>
                <div id="reply">
                        <button type="button" class="btn btn-secondary reply mb-2" id="<?= $r["comment_id"]; ?>" style="display:block;">Reply</button>
                        <div class="rep-container"></div>
                </div>
                
                <!-- <div id="reply-form" style="display:none;">
                <form action="addComment.php" method="POST">
                        <div class="col-auto mx-4 mb-2 mt-2">
                                <input type="hidden" value="$r[' . $r["comment_id"].'" name="reply-id">
                                <textarea class="form-control" name="rep" id="rep" name="rep" placeholder="Berikan balasan!" required></textarea>

                        </div>


                        <div class="mx-4 mb-3">
                                <input type="submit" id="submit-rep" name="submit-rep" class="btn btn-secondary" value="post">
                        </div>
                </form>
        </div> -->
        <?php else : ?>
                <div class="comment-header mx-3"><b><?= $r['author']; ?></b> on <i><?= $r["date_created"]; ?></i> </div>
                <div class="comment-content mx-3"><?= $r["comment"] ?></div>
        <?php endif; ?>
<?php endforeach; ?>