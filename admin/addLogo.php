<?php 
    ob_start(); // Start output buffering
    include('sidebar.php');
?>

<div class="col-10">
    <div class="content-right">
        <div class="top">
            <h3>Add Logo</h3>
        </div>
        <div class="bottom">
            <figure>
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>File</label>
                        <input type="file" class="form-control" name="profile">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="rounded btn btn-primary" name="submit">Submit</button>
                        <button type="submit" class="rounded btn btn-danger">Cancel</button>
                    </div>
                </form>
            </figure>
        </div>
    </div>
</div>

<?php 
    include "moveFile.php";

    if(isset($_POST['submit'])){
        $conn = new mysqli('localhost', 'root', '', 'db_project');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $profile = MoveFile('profile');
        if ($profile) { // Ensure file was successfully uploaded
            $sql = "INSERT INTO `tbl_logo`(`image`) VALUES ('$profile')";
            if ($conn->query($sql) === TRUE) {
                header('Location: ./viewLogo.php');
                exit; // Stop further execution
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "File upload failed!";
        }
    }

    ob_end_flush(); // End output buffering
?>
