<!doctype html>
<html lang="en">

<?php include_once ('include/logged-header.php'); ?>
<?php $title = "KOSONG"; ?>

<body>
<?php include_once ('include/logged-header.php'); ?>
<?php $title = "SURAH:"; ?>

<?php

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
                    <h2 class="section-title"><i class="fa fa-refresh"></i>Tambah Doa</h2>
                </div>
                <div class="col-md-6">
                    <div class="panel-content">
                        <form  method="POST" action="tambah-doa.php">
                            <h2 class="heading"><i class="fa fa-square"></i>Tajuk</h2>
                            <div class="form-group">
                                <input class="form-control" type="text" name="title">
                            </div>
                            <h2 class="heading"><i class="fa fa-square"></i>Icon</h2>
                            <div class="form-group">
                                <input class="form-control" type="text" name="icon">
                                <span class="help-block">Rujuk <a target="_blank" href="http://simplelineicons.com/">http://simplelineicons.com/</a> bagi mendapatkan icon</span>
                            </div>
                            <h2 class="heading"><i class="fa fa-square"></i>Arab</h2>
                                <div class="form-group">
                                    <textarea class="form-control" name="arab_text" rows="5" cols="30"></textarea>
                                </div>
                            <br>
                            <h2 class="heading"><i class="fa fa-square"></i>Rumi</h2>
                                <div class="form-group">
                                    <textarea class="form-control" rows="5" name="malay_text" cols="30" required></textarea>
                                </div>
                            <h2 class="heading"><i class="fa fa-square"></i>Terjemahan</h2>
                            <div class="form-group">
                                <textarea class="form-control" rows="5" name="means" cols="30" required></textarea>
                            </div>
                            <button type="submit" name="add" class="btn btn-primary">Kemaskini</button>

                        </form>

                        <!-- MODAL -->
                     </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php
    if(isset($_POST['add']))
    {
        $sql = "INSERT INTO doa (title, arab_text, malay_text, means, hits, icon) 
                VALUES ('$_POST[title]', '$_POST[arab_text]', '$_POST[malay_text]', '$_POST[means]', 0, '$_POST[icon]')";

        if (mysqli_query($db, $sql)) {
            echo "<script>alert('Doa telah dimasukan.');window.location='pengurusan-doa.php'</script>";
        } else {
            echo "<script>alert('Gagal memasukan doa');</script>";

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
