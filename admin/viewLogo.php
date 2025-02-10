<?php 
    include('sidebar.php');
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>All Sport News</h3>
                        </div>
                        <div class="bottom view-post">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <!-- <div class="block-search">
                                        <input type="text" class="form-control" placeholder="SEARCH HERE">
                                        <button type="submit">
                                        <img src="search.png" alt=""></button>
                                    </div> -->
                                    <table class="table align-middle" border="1px" style="table-layout: fixed;">
                                        <tr>
                                            <th>Logo ID</th>
                                            <th>Logo</th>
                                            <th>Create At</th>
                                            <th>Update At</th>
                                            <th>Actions</th>
                                        </tr>
                                        
                                        <?php 
                                            $conn = new mysqli('localhost', 'root', '', 'db_project');
                                            $sql="SELECT * FROM `tbl_logo` ORDER BY `id` DESC";
                                            $result=$conn->query($sql);
                                            while($row=$result->fetch_assoc()){
                                                echo '
                                                     <tr>
                                                        <td>'.$row['id'].'</td>
                                                        <td><img width="80px" height="80px" src="./assets/image/'.$row['image'].'"/></td>
                                                        <td>'.$row['create_at'].'</td>
                                                        <td>'.$row['update_at'].'</td>
                                                
                                                        <td width="150px">
                                                            <a href="editLogo.php?id='.$row['id'].'" class="btn btn-primary rounded" >Update</a>
                                                            <button type="button" remove-id="'.$row['id'].'" class="btn btn-danger btn-remove rounded" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                Remove
                                                            </button>
                                                        </td>
                                                    </tr> 
                                                ';
                                            }
                                        ?>
                                        
                                    </table>
                                    <ul class="pagination">
                                        <li>
                                            <a href="">1</a>
                                            <a href="">2</a>
                                            <a href="">3</a>
                                            <a href="">4</a>
                                        </li>
                                    </ul>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <h5 class="modal-title" id="exampleModalLabel">Are you sure to remove this post?</h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="" method="post">
                                                        <input type="text" class="value_remove" name="remove_id">
                                                        <button type="submit" class="btn btn-danger" name="delete">Yes</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>  
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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


<?php 
ob_start(); // Start output buffering

if (isset($_POST['delete'])) {
    $deleteId = $_POST['remove_id'];
    $conn = new mysqli('localhost', 'root', '', 'db_project');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM `tbl_logo` WHERE `id`='$deleteId'";
    $result = $conn->query($sql);

    if ($result) {
        // Redirect before any output occurs
        header('Location: ./viewLogo.php');
        exit; // Ensure the script stops execution
    } else {
        echo '<script>
                Swal.fire({
                    title: "Delete Failed",
                    icon: "error"
                });
              </script>';
    }
}

ob_end_flush(); // End output buffering
?>
