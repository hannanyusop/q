<?php

    $db =mysqli_connect("localhost","root","","quran");
    mysqli_set_charset($db,"utf8");

if (mysqli_connect_errno()) {

        $_SESSION['error'] =
            [
                'code' => 500,
                'name' => mysqli_connect_error(),
                'desc' => 'Apparently we\'re experiencing an error. But don\'t worry, we will solve it shortly. Please try after some time.',
                'redirect' => 'login.php'
            ];

        echo '<script>window.location("error.php")</script>';

    }
?>