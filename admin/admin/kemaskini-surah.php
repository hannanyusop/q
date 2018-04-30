<!doctype html>
<html lang="en">

<?php include_once ('include/logged-header.php'); ?>
<?php $title = "KOSONG"; ?>

<body>
<?php include_once ('include/logged-header.php'); ?>
<?php $title = "SURAH:"; ?>

<?php
//check if surah exist
if(isset($_GET['surah']) && isset($_GET['ayat'])){

    $surah_name = "TIADA";
    $check_surah = "SELECT * FROM texts as a LEFT JOIN surah as b ON a.surah_id = b.id WHERE surah_id = $_GET[surah] AND ayat_num = $_GET[ayat]  ";
    $fetch_surah = mysqli_query($db,$check_surah);
//    print_r($fetch_surah); die();

    if ($fetch_surah) {

        $data = mysqli_fetch_assoc($fetch_surah);
        $title = $data['arabic_title'].'('.$data['malay_title'].')';
    }else{

        echo '<script>alert("Ayat tidak wujud!");window.location="lihat-surah.php?surah='.$_GET[surah].'"</script>';
    }

}else{
    echo '<script>alert("Sila Pilih Ayat!");window.location="lihat-surah.php?surah='.$_GET[surah].'"</script>';
}

?>
<body>
<!-- WRAPPER -->
<div id="wrapper">
    <!-- NAVBAR -->
    <?= include('include/nav-bar.php'); ?>
    <!-- END NAVBAR -->
    <!-- LEFT SIDEBAR -->
    <?= include('include/left-side-bar.php'); ?>
    <!-- END LEFT SIDEBAR -->

    <!-- MAIN CONTENT -->
    <div id="main-content">
        <div class="container-fluid">
            <h1 class="sr-only"><?= $title ?></h1>

            <div class="dashboard-section">
                <div class="section-heading clearfix">
                    <h2 class="section-title"><i class="fa fa-pie-chart"></i><?= $title ?></h2>
                </div>
                <div class="col-md-6">
                    <div class="panel-content">
                        <form  method="POST" action="kemaskini-surah.php?<?php echo "surah=".$_GET['surah']."&ayat=".$_GET['ayat'] ?>">
                            <h2 class="heading"><i class="fa fa-square"></i>Arab</h2>
                                <div class="form-group">
                                    <textarea class="form-control" rows="5" cols="30" disabled><?php echo $data['arabic']; ?></textarea>
                                </div>
                            <br>
                            <h2 class="heading"><i class="fa fa-square"></i>Terjemahan</h2>
                                <div class="form-group">
                                    <input type="hidden" name="surah" value="<?php echo $_GET['surah']; ?>">
                                    <input type="hidden" name="ayat" value="<?php echo $_GET['ayat']; ?>">
                                    <textarea class="form-control" rows="5" name="malay" cols="30" required><?php echo $data['malay']; ?></textarea>
                                </div>
                            <h2 class="heading"><i class="fa fa-square"></i>Audio</h2>
                            <div class="form-group">
                                <?php

                                if ($data['track'] != null || $data['track'] != '') {
                                    ?>
                                    <audio controls>
                                        <source src='../../track/<?php echo "$data[surah_id]/$data[ayat_num].mp3"; ?>' type='audio/mp3'>
                                        Your browser does not support the audio tag.
                                    </audio>
                                <?php }else { ?>

                                    <div class="alert alert-warning">
                                        Tiada Audio
                                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#uploadTrack" data-whatever="@mdo">Tambah Audio</button>
                                    </div>

                                <?php } ?>
                            </div>
                            <br>
                            <button type="submit" name="update" class="btn btn-primary">Kemaskini</button>

                        </form>

                        <!-- MODAL -->

                        <div class="modal fade" id="uploadTrack"  role="dialog" >
                            <div class="modal-dialog" role="document">
                                <form class="modal-content" enctype="multipart/form-data" method="post" action="upload-audio.php">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Audio</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                                <div class="row setup-content" id="step-1">
                                                    <div class="col-xs-12">
                                                        <div class="col-md-12 well text-center">
                                                            <label for="fileToUpload">Sila pilih track (.mp3)</label><br />
                                                            <input type="file" name="track"/>
                                                            <input type="hidden" name="surah" value="<?php echo $_GET['surah']; ?>">
                                                            <input type="hidden" name="ayat" value="<?php echo $_GET['ayat']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Kemaskini</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php
    if(isset($_POST['update']))
    {
        $sql = "UPDATE texts SET malay =  '$_POST[malay]' WHERE ayat_num = $_POST[ayat] AND surah_id = $_POST[surah]";
        if (mysqli_query($db, $sql)) {
            echo "<script>alert('Ayat telah dikemaskini.');window.location='kemaskini-surah.php?surah=$_POST[surah]&ayat=$_POST[ayat]'</script>";
        } else {
            echo "<script>alert('Gagal mengemaskini ayat');window.location='kemaskini-surah.php?surah=$_POST[surah]&ayat=$_POST[ayat]'</script>";

        }
    }

?>


    <!-- END MAIN CONTENT -->
    <div class="clearfix"></div>
    <?= include('include/footer.php'); ?>
</div>
<!-- END WRAPPER -->

<!-- Javascript -->

</body>

</html>
