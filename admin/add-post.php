<?php 
    include('sidebar.php');
    include 'moveFile.php';

    $name_email=$_SESSION['user'];
    $conn = new mysqli('localhost', 'root', '', 'db_project');
    $getUserId="SELECT `user_id` FROM `tbl_user` WHERE `email` ='$name_email' || `user_name`='$name_email'";
    $result=$conn->query($getUserId);
    $userId=$result->fetch_assoc()['user_id'];
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Add Sport News</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="user_id" id="" value="<?php echo $userId ?>">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="title">
                                    </div>
                                    <div class="form-group">
                                        <label>Type</label>
                                        <select class="form-select" name="post_type">
                                            <option value="Sport">Sport</option>
                                            <option value="Social">Social</option>
                                            <option value="Entertainment">Entertainment</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-select" name="category">
                                            <option value="National">National</option>
                                            <option value="International">International</option>
                                        
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>File</label>
                                        <input type="file" class="form-control" name="thumbnial">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" id="" class="form-control" rows="7"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" name="submitNews">Post</button>
                                        <!-- <button type="submit" class="btn btn-success" name="editNews" id="editNews">Success</button> -->
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
    if(isset($_POST['submitNews'])){
        $user_id=$_POST['user_id'];
        $title=$_POST['title'];
        $post_type=$_POST['post_type'];
        $category=$_POST['category'];
        $thumbnial=MoveFile('thumbnial');
        $description=$_POST['description'];
        if(!empty($title) && !empty($post_type) && !empty($category) && !empty($thumbnial) &&!empty($description)){
            $insertNews="INSERT INTO `tbl__news`(`userID`, `title`, `thumbnail`, `post_type`, `category`, `description`) VALUES ('$user_id','$title','$thumbnial','$post_type','$category','$description')";
            $result=$conn->query($insertNews);
            try{
                if($result){
                    echo '
                        <script>
                            Swal.fire({
                                title: "Success",
                                text: "News was added!",
                                icon: "success"
                            });
                        </script>
                    ';
                }
            }catch(Exception $e){
                echo $e;
            }
        }else{
            echo '
                        <script>
                            Swal.fire({
                                title: "Error",
                                text: "Please enter all !",
                                icon: "error"
                            });
                        </script>
                    ';
        }
    }
?>