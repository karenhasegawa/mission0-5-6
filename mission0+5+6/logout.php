<?php

    session_start();

    $_SESSION['login'] = false;
    $_SESSION['name'] = '';
    $_SESSION['password'] = '';
    $_SESSION['email'] = '';
    
    header("Location: myprofile.php");
?>