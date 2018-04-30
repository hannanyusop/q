<?php

include_once('config/database.php');

    if(isset($_POST['login'])) {

        $q_check_user = 'SELECT id,username,email,fullname FROM admin WHERE email = "'.$_POST['email'].'" AND password = "'.$_POST['password'].'"';
        $fetch_user = mysqli_query($db,$q_check_user);
        $count_user = mysqli_num_rows($fetch_user);

        if ($count_user > 0) {

            $row = mysqli_fetch_assoc($fetch_user);
            $_SESSION['usermame'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['fullname'] = $row['fullname'];

            echo '<script>window.location="admin/dashboard.php"</script>';

        }else{

            echo '<script>alert("Data pengguna tidak wujud!");window.location="login.php"</script>';

        }

    }else{

        echo '<script>window.location("login.php")</script>';

    }
