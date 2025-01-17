<?php
    session_start();
    session_destroy();
    header("Location:../bussiness_login.php");
?>