<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- @theme style -->
    <link rel="stylesheet" href="assets/style/theme.css">

    <!-- @Bootstrap -->
    <link rel="stylesheet" href="assets/style/bootstrap.css">

    <!-- @script -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/bootstrap.js"></script>

    <!-- @tinyACE -->
    <script src="https://cdn.tiny.cloud/1/5gqcgv8u6c8ejg1eg27ziagpv8d8uricc4gc9rhkbasi2nc4/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

</head>
<body>
    <?php 
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    ?>
    <main class="admin">
        <div class="container-fluid">
            <div class="row">
                <div class="col-2">
                    <div class="content-left">
                        <div class="wrap-top"> 
                            <img class="rounded-circle" width="80px" height="80px" src="./assets/image/<?php
                                    $conn = new mysqli('localhost', 'root', '', 'db_project');
                                    $sql="SELECT `image` FROM `tbl_logo` ORDER BY `id` DESC LIMIT 1";
                                    $result = $conn->query($sql);
                                    $result = $result->fetch_assoc()['image'];
                                    echo $result;?>" alt="">
                            <h5>ចង់ដឹងព័ត៌មាន</h5>
                        </div>
                        <div class="wrap-center">
                            <img src="https://via.placeholder.com/40" alt="">
                            <h6>Welcome <?php 

                               $conn = new mysqli('localhost', 'root', '', 'db_project');
                               $mail= $_SESSION['user'];
                               $sql="SELECT `user_name` FROM `tbl_user` WHERE `email`= '$mail'";	
                                $result = $conn->query($sql);
                                echo $result->fetch_assoc()['user_name'];
                            ?></h6>
                        </div>
                        <div class="wrap-bottom">
                            <ul>
                                <li class="parent">
                                    <a class="parent" href="javascript:void(0)">
                                        <span>MAIN MENU</span>
                                        <img src="assets/icon/arrow.png" alt="">
                                    </a>
                                    <ul class="child">
                                        <li>
                                            <a href="view-post.php">View Post</a>
                                            <a href="add-post.php">Add New</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="parent">
                                    <a class="parent" href="javascript:void(0)">
                                        <span>Logo</span>
                                        <img src="assets/icon/arrow.png" alt="">
                                    </a>
                                    <ul class="child">
                                        <li>
                                            <a href="viewLogo.php">View Logo</a>
                                            <a href="addLogo.php">Add Logo</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="parent">
                                    <a class="parent" href="javascript:void(0)">
                                        <span>Account</span>
                                        <img src="assets/icon/arrow.png" alt="">
                                    </a>
                                    <ul class="child">
                                        <li>
                                            <a href="logout.php">Logout</a>
                                
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>