<!doctype html>
<html lang="en">

<?php include_once ('include/logged-header.php'); ?>
<?php $title = "SURAH:"; ?>

<?php
//check if surah exist
if(isset($_GET['surah'])){

    if(empty($_GET['page'])){
        echo "<script>window.location='lihat-surah.php?surah=$_GET[surah]&page=1';</script>";
    }



    $surah_name = "TIADA";
    $check_surah = "SELECT * FROM surah WHERE id='$_GET[surah]'";
    $fetch_surah = mysqli_query($db,$check_surah);

    if ($fetch_surah) {


        $data = mysqli_fetch_assoc($fetch_surah);
        $surah_id = $data['id'];
        $surah_name = $data['arabic_title'].'('.$data['malay_title'].')';

        $current_page = $_GET['page'];
        $query = "SELECT * FROM texts where surah_id = $surah_id";
        $page = mysqli_num_rows(mysqli_query($db,$query));
        $ttl_page = $page/10;
        if(is_float ( $ttl_page)){$ttl_page+=1;}
        $last_page = (int)$ttl_page;

        //pagination
        $offset = ($current_page-1)*10;
        $sql = "SELECT * FROM texts where surah_id = $surah_id LIMIT 10 OFFSET ".$offset;
        $get_ayat = mysqli_query($db, $sql);

    }else{

        echo '<script>alert("Surah tidak wujud!");window.location="pengurusan-surah.php"</script>';
    }

}else{
    echo '<script>alert("Sila Pilih Surah!");window.location="pengurusan-surah.php"</script>';
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
                    <h2 class="section-title"><i class="fa fa-pie-chart"></i><?= $title.$surah_name ?></h2>
                </div>
            </div>

            <!-- SALES SUMMARY -->
            <div class="dashboard-section">
                <div class="row">
                    <div class="col-md-3">
                        <div class="panel-content">
                            <h2 class="heading"><i class="fa fa-search"></i> Carian</h2>
                            <form id="basic-form" method="post" novalidate>
                                <div class="form-group">
                                    <label>Nama Surah</label>
                                    <input type="text" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Tempat Turun</label>
                                    <select class="form-control">
                                        <option>MAKKAH</option>
                                        <option>MADINAH</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="panel-content">
                            <h3 class="heading"><i class="fa fa-list"></i> Senarai Surah</h3>
                            <div class="table-responsive">
                                <table class="table table-striped no-margin">
                                    <thead>
                                    <tr>
                                        <th>No. Ayat</th>
                                        <th>Ayat</th>
                                        <th>Audio</th>
                                        <th>Kemaskini</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    while ($row = mysqli_fetch_assoc($get_ayat))
                                    {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['ayat_num'] ?></td>
                                            <td><?php echo $row['arabic'] ?><br></br>
                                                <small>
                                                    <?php echo $row['malay'] ?>
                                                </small>
                                            </td>
                                            <td><button class="btn btn-xs btn-info"><i class="fa fa-play">Main</i> </button></td>
                                            <td><a href="kemaskini-surah.php?surah=<?php echo $surah_id; ?>&ayat=<?php echo $row['id']; ?>"><i class="fa fa-edit">Kemaskini</i> </a></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>

                                <?php if($last_page > 1){ ?>
                                <ul class="pagination pagination-sm">
                                    <li class="disabled"><a href="#"><i class="fa fa-angle-left"></i><span class="sr-only">Previous</span></a></li>
                                    <?php for($i = 1; $i < $last_page; $i++){ ?>
                                        <li><a href="lihat-surah.php?surah=<?php echo $surah_id; ?>&page=<?php echo $i; ?>" <?php if($i === $current_page) { echo "class='active'"; }?>><?php echo $i; ?></a></li>
                                    <?php } ?>
                                    <li><a href="#"><i class="fa fa-angle-right"></i><span class="sr-only">Next</span></a></li>
                                </ul>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END SALES SUMMARY -->

        </div>
    </div>

    <!-- END MAIN CONTENT -->
    <div class="clearfix"></div>
    <?= include('include/footer.php'); ?>
</div>
<!-- END WRAPPER -->

<!-- Javascript -->

</body>

</html>
