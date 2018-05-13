
    <?php include('q-include/meta.php') ?>
    <?php include('q-include/side-nav.php') ?>
    <?php include('q-include/nav-header.php') ?>
    <?php include_once ('tracker.php'); ?>
     <?php $title = "SURAH:".$_GET['sid']; ?>

    <?php
    //check if surah exist
    if(isset($_GET['sid'])){

        $sid = $_GET['sid'];
        $ms= $_GET['ms'];

        $surah_name = "TIADA";
        $check_surah = "SELECT * FROM surah WHERE id=$sid";
        $fetch_surah = mysqli_query($db,$check_surah);

        if ($fetch_surah) {
            $total_ayat_page = 10;

            $data = mysqli_fetch_assoc($fetch_surah);
            $surah_id = $data['id'];

            //get total page
            $count_ayat =mysqli_num_rows(mysqli_query($db,"SELECT * FROM texts WHERE surah_id=$surah_id"));
            $ttl_page = $count_ayat/$total_ayat_page;

            //if float, we need add one additional page for surah.
            if(is_float ( $ttl_page)){
                $ttl_page+=1;
            }

            $last_page = (int)$ttl_page;
//            print_r($last_page);
//            die();
            $surah_name = $data['arabic_title'].'('.$data['malay_title'].')';
        }else{

            echo '<script>alert("Surah tidak wujud!");window.location="utama-surah.php"</script>';
        }

    }else{
        echo '<script>alert("Sila Pilih Surah!");window.location="utama-surah.php"</script>';
    }
?>

    <main id="main-container">
        <div class="content">
            <nav class="breadcrumb bg-white push">
                <a class="breadcrumb-item" href="index.php">Utama</a>
                <a class="breadcrumb-item" href="utama-quran.php">Senarai Surah</a>
                <span class="breadcrumb-item active"><?php echo $surah_name; ?></span>
            </nav>
            <div class="row">
                <div class="col-xl-4">
                    <!-- Subscribe -->
                    <div class="block block-rounded">
                        <div class="block-content text-center">
                            <audio id="myAudio">
                                <source src="<?php echo $data['track'] ?>" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                            <button class="btn btn-hero btn-noborder btn-success mb-10" onclick="playAudio()")>
                                <i class="si si-control-play"></i>
                                Play
                            </button>
                            <button class="btn btn-hero btn-noborder btn-danger mb-10" onclick="pauseAudio()")>
                                <i class="si si-control-pause"></i>
                                Pause
                            </button>
                            <p class="text-center">atau <a class="link-effect" href="<?php echo $data['track'] ?>" download>Muat turun Audio</a></p>
                        </div>
                    </div>
                    <!-- END Subscribe -->

                    <!-- Course Info -->
                    <div class="block block-rounded">
                        <div class="block-header block-header-default text-center">
                            <h3 class="block-title">
                                <i class="fa fa-fw fa-info"></i>
                                Pautan Pantas
                            </h3>
                        </div>
                        <div class="block-content">
                            <div class="font-size-sm text-muted text-center mb-20">
                                (<?php echo $count_ayat.'Ayat & '.$last_page.' muka surat';?>)
                            </div>
                            <table class="table table-borderless table-striped">
                                <tbody>
                                <?php $ayt_step = 0; $ayat_from = 1; $now = 1; while ($now <= $last_page): $ayt_step+=$total_ayat_page;?>
                                <tr>
                                    <td>
                                        <a class="link-effect text-primary h6" href="surah.php?sid=<?php echo $sid; ?>&ms=<?php echo $now; ?>">
                                            <i class="si si-energy mr-10 text-info"></i> <?php echo "M/S ".$now." (Ayat ".$ayat_from."-".$ayt_step.")"; ?>
                                        </a>
                                    </td>
                                </tr>
                                <?php $ayat_from+=$total_ayat_page; $now++; endwhile; ?>
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
                                <?php
                                $offset = $total_ayat_page*$ms;
                                if($last_page == 1){
                                    $offset = 0;
                                }
                                $get_text = mysqli_query($db,"SELECT * FROM texts as a WHERE a.surah_id = $surah_id LIMIT $total_ayat_page OFFSET $offset");

                                while ($text = mysqli_fetch_assoc($get_text)) { ?>
                                    <p class="some-intro">
                                    <h4><?php echo "(".$text['ayat_num'].").".$text['arabic']; ?></h4>
                                    <small><?php echo $text['malay']; ?></small>
                                    </p>
                                    <?php if($text['track'] != ""): ?>
                                    <audio controls>
                                        <source src='track/<?php echo $text['surah_id']."/".$text['ayat_num'] ?>.mp3' type='audio/mp3'>
                                        Your browser does not support the audio tag.
                                    </audio>
                                    <?php else: echo '<small class="p-10 bg-primary-lighter text-primary-dark font-w500">tiada track bagi surah ini</small>'; endif;?>

                                    <hr>
                                    <?php } ?>
                                <?php if($ms != $last_page): ?>
                                <a  href="surah.php?sid=<?php echo $sid; ?>&ms=<?php echo($ms+1); ?>" class="btn btn-alt-secondary min-width-100 float-right">Next</a>
                                <?php endif; ?>
                                <?php if($ms != 1 ): ?>
                                <a href="surah.php?sid=<?php echo $sid; ?>&ms=<?php echo($ms-1); ?>" class="btn btn-alt-secondary min-width-100 float-left">Previous</a>
                                <?php endif; ?>
                            </nav>
                        </div>
                    </div>
                    <!-- END Lesson -->
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>
    <script>
        var x = document.getElementById("myAudio");

        function playAudio() {
            x.play();
        }

        function pauseAudio() {
            x.pause();
        }
    </script>
    <?php include('q-include/footer.php') ?>
