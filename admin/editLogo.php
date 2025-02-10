<?php 
    ob_start(); // Start output buffering
    include('sidebar.php');
    include "moveFile.php";
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $conn = new mysqli('localhost', 'root', '', 'db_project');
        $sql="SELECT `image` FROM `tbl_logo` WHERE `id`='$id'";
        $result=$conn->query($sql);
        $image='';
        while($row=$result->fetch_assoc()){
            $image=$row['image'];
        }
    }
?>

<div class="col-10">
    <div class="content-right">
        <div class="top">
            <h3>Edit Logo</h3>
        </div>
        <div class="bottom">
            <figure>
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>File</label>
                        <input type="file" class="form-control" name="profile">
                        <img width="80px" class="mt-2" src="./assets/image/<?php echo $image ?>" alt="">
                        <input type="hidden" name="hide_profile" id="" value="<?php  echo $image ?>">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="rounded btn btn-success" name="edit">Edit</button>
                        <button type="submit" class="rounded btn btn-danger">Cancel</button>
                    </div>
                </form>
            </figure>
        </div>
    </div>
</div>
<?php 
    date_default_timezone_set('Asia/Phnom_Penh');
    $update_at=date('ymdhis');
    if(isset($_POST['edit'])){
        $profile=MoveFile('profile');
        if(empty($profile)){
            $hide_profile=$_POST['hide_profile'];
            $sql="UPDATE `tbl_logo` SET `image`='$hide_profile',`update_at`='$update_at' WHERE `id`='$id'";
            $result=$conn->query($sql);
        }else{
            $sql="UPDATE `tbl_logo` SET `image`='$profile',`update_at`='$update_at' WHERE `id`='$id'";
            $result=$conn->query($sql);
        }
        echo '<script>window.location.href="viewLogo.php";</script>';
    }

?>