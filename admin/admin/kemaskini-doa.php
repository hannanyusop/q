<!doctype html>
<html lang="en">

<?php include_once ('include/logged-header.php'); ?>
<?php $title = "KOSONG"; ?>

<body>
<?php include_once ('include/logged-header.php'); ?>
<?php $title = "SURAH:"; ?>

<?php
if(isset($_GET['did'])){

    $surah_name = "TIADA";
    $check_surah = "SELECT * FROM doa WHERE id = $_GET[did]  ";
    $fetch_surah = mysqli_query($db,$check_surah);
//    print_r($fetch_surah); die();

    if ($fetch_surah) {

        $data = mysqli_fetch_assoc($fetch_surah);
        $title = "Doa ".$data['title'];
    }else{

        echo '<script>alert("Doa tidak wujud!");window.location="pengurusan-doa?page=1"</script>';
    }

}else{
    echo '<script>alert("Sila Pilih Doa!");window.location="pengurusan-doa?page=1"</script>';
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
                    <h2 class="section-title"><i class="fa fa-refresh"></i><?= $title ?></h2>
                </div>
                <div class="col-md-6">
                    <div class="panel-content">
                        <form  method="POST" action="kemaskini-doa.php?<?php echo "did=".$_GET['did']?>">
                            <h2 class="heading"><i class="fa fa-square"></i>Tajuk</h2>
                            <div class="form-group">
                                <input class="form-control" type="text" name="title" value="<?php echo $data['title']; ?>">
                                <input type="hidden" name="did" value="<?php echo $_GET['did'] ?>">
                            </div>
                            <br>
                            <h2 class="heading"><i class="fa fa-square"></i>Arab</h2>
                                <div class="form-group">
                                    <textarea class="form-control" name="arab_text" rows="5" cols="30"><?php echo $data['arab_text']; ?></textarea>
                                </div>
                            <br>
                            <h2 class="heading"><i class="fa fa-square"></i>Rumi</h2>
                                <div class="form-group">
                                    <textarea class="form-control" rows="5" name="malay_text" cols="30" required><?php echo $data['malay_text']; ?></textarea>
                                </div>
                            <h2 class="heading"><i class="fa fa-square"></i>Terjemahan</h2>
                            <div class="form-group">
                                <textarea class="form-control" rows="5" name="means" cols="30" required><?php echo $data['means']; ?></textarea>
                            </div>
                            <h2 class="heading"><i class="fa fa-square"></i>Audio</h2>
                            <div class="form-group">
                                <?php

                                if ($data['track'] != null || $data['track'] != '') {
                                    ?>
                                    <audio controls>
                                        <source src='../../doa-track/<?php echo "$data[id].mp3"; ?>' type='audio/mp3'>
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
                                <form class="modal-content" enctype="multipart/form-data" method="post" action="upload-doa-audio.php">
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
                                                            <input type="hidden" name="did" value="<?php echo $_GET['did']; ?>">
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
        $sql = "UPDATE doa SET 
                    title = '$_POST[title]',
                    arab_text = '$_POST[arab_text]',
                    malay_text =  '$_POST[malay_text]',
                    means =  '$_POST[means]'
                    WHERE id = $_POST[did]";
        if (mysqli_query($db, $sql)) {
            echo "<script>alert('Doa telah dikemaskini.');window.location='kemaskini-doa.php?did=$_POST[did]'</script>";
        } else {
            echo "<script>alert('Gagal mengemaskini ayat');window.location='kemaskini-doa.php?did=$_POST[did]'</script>";

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
