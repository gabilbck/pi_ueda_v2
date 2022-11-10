<?php
    session_start();
    include_once "../include/MySql.php";
    include_once "../include/functions.php";
    if($_SESSION['adm'] != 1){
        header("location:n_adm_msg.php");
        die;
    }
?>