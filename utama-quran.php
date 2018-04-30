
    <?php include('q-include/meta.php') ?>
    <?php include('q-include/side-nav.php') ?>
    <?php include('q-include/nav-header.php') ?>

    <main id="main-container">
        <div class="content">
            <nav class="breadcrumb bg-white push">
                <a class="breadcrumb-item" href="index.php">Utama</a>
                <span class="breadcrumb-item active">Senarai Surah</span>
            </nav>
            <form class="push" action="utama-quran.php" method="get">
                <div class="input-group input-group-lg">
                    <input type="text"
                           name="title"
                           class="js-icon-search form-control"
                           placeholder="Masukan nama surah..."
                           value="<?php if(isset($_GET['title'])){ echo $_GET['title']; } ?>">
                    <div class="input-group-append">
                        <button class="input-group-text" type="submit">
                                <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <div class="block">
                <div class="block-content">
                    <!-- Intro Category -->
                    <table class="table table-striped table-borderless table-vcenter">
                        <thead class="thead-light">
                        <tr>
                            <th colspan="2"></th>
                            <th class="d-none d-md-table-cell text-center" style="width: 90px;">Urutan Pewahyuan</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        //get all surah
                        $r_surah = mysqli_query($db, "SELECT * FROM surah as a");
                        if(isset($_GET['title'])){
                            $title = $_GET['title'];
                            $r_surah = mysqli_query($db, "SELECT * FROM surah WHERE malay_title LIKE '%$title%'");
                        }
                        while($surah = mysqli_fetch_assoc($r_surah)) {
                        ?>
                            <tr>
                            <td class="text-center" style="width: 65px;">
                                <i class="si si-check fa-2x"></i>
                            </td>
                            <td>
                                <a class="font-size-h5 font-w600" href="surah.php?sid=<?php echo $surah['id']; ?>&ms=1"><?php echo $surah['arabic_title'].' ('.$surah['malay_title'].')'; ?></a>
                                <div class="text-muted my-5"><?php echo $surah['meaning'] ?></div>
                                <div class="font-size-sm text-muted">
                                    <em><strong class="font-w600">Tempat Turun:</strong> <span class="badge badge-success"><?php echo $surah['tempat_turun']; ?></span></em> | Jumlah Ayat: <?php echo $surah['total_text']; ?>
                                </div>
                            </td>
                            <td class="d-none d-md-table-cell text-center">
                                <a class="font-w600" href="javascript:void(0)"> <?php echo $surah['urutan_pewahyuan']; ?></a>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <!-- END Intro Category -->
                </div>
            </div>
            <!-- END Categories Block -->
        </div>
        <!-- END Page Content -->

    </main>
    <?php include('q-include/footer.php') ?>
