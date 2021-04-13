<?php
    session_start();
    include_once('.\config\config.php');
    if(isset($_SESSION['email'])){
        $_SESSION['email'] = '';
        header('Location: landing.php');
    }
    else{
        header('Location: landing.php');
    }

?>