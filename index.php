<?php 
    session_start();
    if(empty($_SESSION['user'])){
        header('location: ./admin/login.php');
    }elseif($_SESSION['role']=='admin'){
        header('location: ./admin/index.php');
    }else{
        header('location: ./article/index.php');
    }
    session_unset();
?>