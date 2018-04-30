<?php
if(isset($_POST['did'])){

    include_once ('../config/database.php');

    //create dir if not exist
    $dir = "../../doa-track/";
    if (!is_dir($dir)) {
        mkdir($dir);
    }

    //uploading file
    $target_file = $dir . basename($_FILES["track"]["name"]);


    $valid_extension = array('.mp3');
    $file_extension = strtolower( strrchr( $_FILES["track"]["name"], "." ) );

    if( in_array( $file_extension, $valid_extension ) ){

        if(move_uploaded_file($_FILES["track"]["tmp_name"], $dir."/" . $_POST['did'].".mp3"))
        {
            //inserting data to DB

            $track = 'doa-track/'.$_POST['did'].'.mp3';
            $file_name = $_FILES['track']['tmp_name'];
            $sql = "UPDATE doa SET track =  '$track' WHERE id = $_POST[did]";
            if (mysqli_query($db, $sql)) {
                echo "<script>alert('Audio telah dimasukan.');window.location='kemaskini-doa.php?did=$_POST[did]'</script>";
            } else {
                echo "<script>alert('Gagal memasukan data ke pangkalan data!');window.location='kemaskini-doa.php?did=$_POST[did]'</script>";

            }
        }else{
            echo "<script>alert('Gagal memuat naik fail.');window.location='kemaskini-doa.php?did=$_POST[did]'</script>";

        }

    }
    else
    {
        echo "<script>alert('Fail tidak sah! Hanya .mp3 yang dibenarkan.');window.location='kemaskini-doa.php?did=$_POST[did]'</script>";
    }


}else{
    echo "<script>window.location='pengurusan-doa.php'</script>";
}