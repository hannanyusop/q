
    <?php include('q-include/meta.php') ?>
    <?php include('q-include/side-nav.php') ?>
    <?php include('q-include/nav-header.php') ?>
     <?php $title = "DOA:".$_GET['did']; ?>

    <?php
    //check if surah exist
    if(isset($_GET['did'])){

        $did = $_GET['did'];

        $doa_title = "TIADA";
        $qc = "SELECT * FROM doa WHERE id=$did";
        $fetch_surah = mysqli_query($db, $qc);

        if ($fetch_surah) {

            $data = mysqli_fetch_assoc($fetch_surah);
        }else{

            echo '<script>alert("Doa tidak wujud!");window.location="utama-doa.php"</script>';
        }

    }else{
        echo '<script>alert("Doa Pilih Surah!");window.location="utama-doa.php"</script>';
    }
?>

    <main id="main-container">
        <div class="content">
            <nav class="breadcrumb bg-white push">
                <a class="breadcrumb-item" href="index.php">Utama</a>
                <a class="breadcrumb-item" href="utama-doa.php">Senarai Doa</a>
                <span class="breadcrumb-item active">Doa <?php echo $data['title']; ?></span>
            </nav>
            <div class="row">
                <div class="col-xl-4">
                    <!-- Subscribe -->
                    <div class="block block-rounded">
                        <div class="block-content">
                            <a class="btn btn-block btn-hero btn-noborder btn-rounded btn-success mb-10" href="javascript:void(0)">Subscribe from $19/month</a>
                            <p class="text-center">or <a class="link-effect" href="javascript:void(0)">buy this course for $14</a></p>
                        </div>
                    </div>
                    <!-- END Subscribe -->

                    <!-- Course Info -->
                    <div class="block block-rounded">
                        <div class="block-header block-header-default text-center">
                            <h3 class="block-title">
                                <i class="fa fa-fw fa-info"></i>
                                Doa-doa Popular
                            </h3>
                        </div>
                        <div class="block-content">
                            <div class="font-size-sm text-muted text-center mb-20">
                                (<?php echo  'muka surat';?>)
                            </div>
                            <table class="table table-borderless table-striped">
                                <tbody>
                                 <?php $q_suggest = mysqli_query($db, "SELECT * FROM doa WHERE id != $did ORDER BY hits DESC LIMIT 10 ");
                                       while($doa_list = mysqli_fetch_assoc($q_suggest)) {
                                ?>
                                <tr>
                                    <td>
                                        <a class="link-effect text-primary h6" href="doa.php?did=<?php echo $doa_list['id']; ?>">
                                            <i class="si si-energy mr-10 text-info"></i> <?php echo "Doa ".$doa_list['title']." "; ?>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Course Info -->
                </div>
                <div class="col-xl-8">
                    <div class="block block-rounded">
                        <div class="block-content">
                            <nav class="clearfix push">
                                <button type="button" class="btn btn-square btn-secondary mr-5 mb-5">
                                    <i class="fa fa-play mr-5"></i>Play
                                </button>
                                <button type="button" class="btn btn-square btn-secondary mr-5 mb-5">
                                    <i class="fa fa-download mr-5"></i>Download
                                </button>
                                <h4 class="display-4">Doa <?php echo $data['title'] ?></h4><hr>
                                <p class="p-12 h5"><?php echo $data['arab_text'] ?></p><br>
                                <p class="text-muted h6"><mark><?php echo $data['malay_text'] ?></mark></p><br>
                                <p class="p-10 bg-primary-lighter text-primary-dark h6"><b>Maksudnya:</b><br>"<i><?php echo $data['means'] ?></i>" </p>
                            </nav>
                        </div>
                    </div>
                    <!-- END Lesson -->
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>
    <?php include('q-include/footer.php') ?>
