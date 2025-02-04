<?php
    $profile="";
    function MoveFile($name){
        $profile=rand(1,1000).'_'.$_FILES[$name]['name'];
        $tmp_name=$_FILES[$name]['tmp_name'];
        $path='./assets/image/'.$profile;
        move_uploaded_file($tmp_name,$path);
        return $profile;
    }
?>