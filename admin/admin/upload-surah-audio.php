<?php
if(isset($_POST['surah'])){

    include_once ('../config/database.php');

    //create dir if not exist
    $parent_dir = "../../track/";
    $surah_dir = $parent_dir.$_POST['surah'];
    if (!is_dir($surah_dir)) {
        mkdir($surah_dir);
    }

    //uploading file
    $target_dir = $surah_dir;
    $target_file = $target_dir . basename($_FILES["track"]["name"]);


    $valid_extension = array('.mp3');
    $file_extension = strtolower( strrchr( $_FILES["track"]["name"], "." ) );

    if( in_array( $file_extension, $valid_extension ) ){

        if(move_uploaded_file($_FILES["track"]["tmp_name"], $surah_dir."/" ."full.mp3"))
        {
            //inserting data to DB

            $track = 'track/'.$_POST['surah'].'/full.mp3';
            $file_name = $_FILES['track']['tmp_name'];
            $sql = "UPDATE surah SET track =  '$track' WHERE id = $_POST[surah]";
            if (mysqli_query($db, $sql)) {
                echo "<script>alert('Audio telah dimasukan.');window.location='lihat-surah.php?surah=$_POST[surah]&page=1'</script>";
            } else {
                echo "<script>alert('Gagal memasukan data ke pangkalan data!');window.location='lihat-surah.php?surah=$_POST[surah]&page=1'</script>";

            }
        }else{
            echo "<script>alert('Gagal memuat naik fail.');window.location='lihat-surah.php?surah=$_POST[surah]&page=1'</script>";

        }

    }
    else
    {
        echo "<script>alert('Fail tidak sah! Hanya .mp3 yang dibenarkan.');window.location='lihat-surah.php?surah=$_POST[surah]&page=1'</script>";
    }


}else{
    echo "<script>window.location='pengurusan-surah.php'</script>";
}