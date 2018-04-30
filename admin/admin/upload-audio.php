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

        if(move_uploaded_file($_FILES["track"]["tmp_name"], $surah_dir."/" . $_POST['ayat'].".mp3"))
        {
            //inserting data to DB

            $track = 'track/'.$_POST['surah'].'/'.$_POST['ayat'].'.mp3';
            $file_name = $_FILES['track']['tmp_name'];
            $sql = "UPDATE texts SET track =  '$track' WHERE ayat_num = $_POST[ayat] AND surah_id = $_POST[surah]";
            if (mysqli_query($db, $sql)) {
                echo "<script>alert('Audio telah dimasukan.');window.location='kemaskini-surah.php?surah=$_POST[surah]&ayat=$_POST[ayat]'</script>";
            } else {
                echo "<script>alert('Gagal memasukan data ke pangkalan data!');window.location='kemaskini-surah.php?surah=$_POST[surah]&ayat=$_POST[ayat]'</script>";

            }
        }else{
            echo "<script>alert('Gagal memuat naik fail.');window.location='kemaskini-surah.php?surah=$_POST[surah]&ayat=$_POST[ayat]'</script>";

        }

    }
    else
    {
        echo "<script>alert('Fail tidak sah! Hanya .mp3 yang dibenarkan.');window.location='kemaskini-surah.php?surah=$_POST[surah]&ayat=$_POST[ayat]'</script>";
    }


}else{
    echo "<script>window.location='pengurusan-surah.php'</script>";
}