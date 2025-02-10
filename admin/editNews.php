<?php 
    include('sidebar.php');
    include 'moveFile.php';
    $name_email=$_SESSION['user'];
    $conn = new mysqli('localhost', 'root', '', 'db_project');
    $getUserId="SELECT `user_id` FROM `tbl_user` WHERE `email` ='$name_email' || `user_name`='$name_email'";
    $result=$conn->query($getUserId);
    $userId=$result->fetch_assoc()['user_id'];

    //get id news
    if(isset($_GET['id'])){
        $news_id=$_GET['id'];
        $selectNews="SELECT * ,`user_name` FROM `tbl__news` INNER JOIN `tbl_user` WHERE `userID` = `user_id` AND `id`='$news_id' ";
        $result=$conn->query($selectNews);
        $news='';
        while($row=$result->fetch_assoc()){
            $news=$row;
        }
    }
   
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Edit News</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="user_id" id="" value="<?php echo $userId ?>">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="title" value="<?php echo $news['title'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Type</label>
                                        <select class="form-select" name="post_type">   
                                            <option value="Sport" <?= ($news['post_type'] ?? '') == 'Sport' ? 'selected' : '' ?>>Sport</option>
                                            <option value="Social" <?=($news['post_type'] ?? '') == 'Social' ? 'selected' : '' ?>>Social</option>
                                            <option value="Entertainment" <?= ($news['post_type'] ?? '') == 'Entertainment' ? 'selected' : '' ?>>Entertainment</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-select" name="category">
                                            <option value="National" <?= ($news['category'] ?? '') == 'National' ? 'selected' : '' ?>>National</option>
                                            <option value="International" <?= ($news['category'] ?? '') == 'International' ? 'selected' : '' ?>>International</option>
                                        
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>File</label>
                                        <input type="file" class="form-control" name="thumbnial">
                                        <img width="60px" class="mt-2" src="./assets/image/<?php echo $news['thumbnail'] ?>" alt="">
                                        <input type="text" name="hide_thumbnail" id="" value="<?php echo $news['thumbnail'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" id=""  class="form-control" rows="7"><?php echo $news['description'] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <!-- <button type="submit" class="btn btn-primary" name="submitNews">Post</button> -->
                                        <button type="submit" class="btn btn-success" name="editNews" id="editNews">Success</button>
                                        <button type="button" class="btn btn-danger" id="cancel">Cancel</button>
                                    </div>
                                </form>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
<script>
    $(document).ready(function(){
        $('#cancel').click(function(){
           window.location.href='view-post.php';   
        })
    })
</script>
<?php 
$conn = new mysqli('localhost', 'root', '', 'db_project');
    date_default_timezone_set('Asia/Phnom_Penh');
    if(isset($_POST['editNews'])){
        $user_id=$_POST['user_id'];
        $title=$_POST['title'];
        $post_type=$_POST['post_type'];
        $category=$_POST['category'];
        $update_at=date('ymdhis');
        $thumbnail=MoveFile('thumbnial');
        $des=$_POST['description'];
        if(empty($thumbnail)){
            $hide_thumbnail=$_POST['hide_thumbnail'];
            $sql="UPDATE `tbl__news` SET `userID`='$user_id',`title`='$title',`thumbnail`='$hide_thumbnail',`post_type`='$post_type',`category`='$category',`description`='$des',`update_at`='$update_at' WHERE `id`='$news_id'";
        }else{
            $sql="UPDATE `tbl__news` SET `userID`='$user_id',`title`='$title',`thumbnail`='$thumbnail',`post_type`='$post_type',`category`='$category',`description`='$des',`update_at`='$update_at' WHERE `id`='$news_id'";
        }
        if($conn->query($sql)){
            echo "<script>window.location.href='view-post.php'</script>";
        }
        
    }
?>