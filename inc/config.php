<?php
    ob_start();
    $timezone = date_default_timezone_set("Europe/London");
    
    $con = mysqli_connect("localhost", "root", "", "users");
    if (mysqli_connect_errno()) {
        echo "Faild to connect" . mysqli_connect_errno();
    }
