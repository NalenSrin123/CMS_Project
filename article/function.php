<!-- @import jquery & sweet alert  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php 
// @Connection database
$conn = new mysqli('localhost', 'root', '', 'db_project');
function get_treding(){
    global $conn;
    $get_title="SELECT `title` FROM `tbl__news` ORDER BY `id` DESC LIMIT 6";
    $result=$conn->query($get_title);
    while($row=$result->fetch_assoc()){
        echo '
        <i class="fas fa-angle-double-right"></i>
        <a href="">'.$row['title'].' </a> &ensp;
        ';
    }
}
function get_main_news(){
    global $conn;
    $get_pop="SELECT * FROM `tbl__news` ORDER BY `id` DESC LIMIT 1";
    $result=$conn->query($get_pop);
    while($row=$result->fetch_assoc()){
        echo '<div class="col-8 content-left">
                    <figure>
                        <a href="news-detail.php">
                            <div class="thumbnail">
                                <img width="730px" height="415px" src="../admin/assets/image/'.$row['thumbnail'].'" alt="">
                                <div class="title">
                                   '.$row['title'].'
                                </div>
                            </div>
                        </a>
                    </figure>
                </div>';
    }
   
    
}
function get_sub_news(){
    global $conn;
    $get_pop="SELECT * FROM `tbl__news` WHERE `id` !=(SELECT `id` FROM `tbl__news` ORDER BY `id` DESC LIMIT 1) ORDER BY `id` DESC LIMIT 2";
    $result=$conn->query($get_pop);
    while($row=$result->fetch_assoc()){
        echo '<div class="col-12">
                        <figure>
                            <a href="">
                                <div class="thumbnail">
                                    <img width="350px" height="200px" src="../admin/assets/image/'.$row['thumbnail'].'" alt="">
                                <div class="title">
                                    '.$row['title'].'
                                </div>
                                </div>
                            </a>
                        </figure>
                    </div>';
    }
}

?>