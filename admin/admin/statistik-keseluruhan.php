<!doctype html>
<html lang="en">
<meta charset="utf-8">
<?php include_once ('include/logged-header.php'); ?>
<?php $title = "Senarai Surah"; ?>
<?php $tempat_turun = [
        'Semua' => 'MEKKAH/MADINAH',
        'Mekkah' => 'MEKKAH',
        'Madinah' => 'MADINAH'
    ];

    if(empty($_GET['page'])){
        echo "<script>window.location='statistik-keseluruhan.php?page=1';</script>";
    }

    if(isset($_POST['cari'])){


        if($_POST['tempat_turun'] == "Semua"){
            $tempat_turun = "";
        }else{
            $tempat_turun = 'AND tempat_turun = "'.$_POST['tempat_turun'].'"';
        }
        $query = "SELECT * FROM statistics WHERE malay_title like '%$_POST[surah]%' $tempat_turun. ";
    }else{
        $query = "SELECT * FROM statistics";
    }


    $current_page = $_GET['page'];
    $page =mysqli_num_rows(mysqli_query($db,$query));
    $ttl_page = $page/10;
    if(is_float ( $ttl_page)){$ttl_page+=1;}
    $last_page = (int)$ttl_page;

    //pagination
    $offset = ($current_page-1)*10;
    $sql = $query." LIMIT 10 OFFSET ".$offset;
    $get_surah = mysqli_query($db, $sql);

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
            </div>

            <!-- SALES SUMMARY -->
            <div class="dashboard-section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel-content">
                            <h3 class="heading"><i class="fa fa-list"></i> Statistik</h3>
                            <div class="table-responsive">
                                <table class="table table-striped no-margin">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>IP Address</th>
                                        <th>Hostname</th>
                                        <th>Negara</th>
                                        <th>Negeri</th>
                                        <th>Bandar</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php


                                    while ($row = mysqli_fetch_assoc($get_surah))
                                    {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['id'] ?></td>
                                        <td><?php echo $row['ip_address'] ?></td>
                                        <td><?php echo $row['hostname'] ?></td>
                                        <td><?php echo $row['country']; ?></td>
                                        <td><?php echo $row['state']; ?></td>
                                        <td><?php echo $row['city']; ?></td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>

                                <ul class="pagination pagination-sm">
                                    <li class="disabled"><a href="#"><i class="fa fa-angle-left"></i><span class="sr-only">Previous</span></a></li>
                                    <?php for($i = 1; $i < $last_page; $i++){ ?>
                                    <li><a href="pengurusan-surah.php?page=<?php echo $i; ?>" <?php if($i === $current_page) { echo "class='active'"; }?>><?php echo $i; ?></a></li>
                                    <?php } ?>
                                    <li><a href="#"><i class="fa fa-angle-right"></i><span class="sr-only">Next</span></a></li>
                                </ul>

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
