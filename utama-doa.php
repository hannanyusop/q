
    <?php include('q-include/meta.php') ?>
    <?php include('q-include/side-nav.php') ?>
    <?php include('q-include/nav-header.php') ?>

    <main id="main-container">
        <!-- Page Content -->
        <div class="content">
            <nav class="breadcrumb bg-white push">
                <a class="breadcrumb-item" href="index.php">Utama</a>
                <span class="breadcrumb-item active">Senarai Doa</span>
            </nav>
            <form class="push" action="utama-doa.php" method="post" onsubmit="return false;">
                <div class="input-group input-group-lg">
                    <input type="text" class="js-icon-search form-control" placeholder="">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>

            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Senarai <small><code>Doa</code></small></h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="js-icon-list row items-push-2x text-center">
                        <?php $q_doa = mysqli_query($db, "SELECT * FROM doa");
                        while($doa = mysqli_fetch_assoc($q_doa)) {
                        ?>
                        <div class="col-md-6 col-xl-4">
                            <p><a href="doa.php?did=<?php echo $doa['id']; ?>"><i class="si <?php echo $doa['icon'] ?> fa-2x"></i></a></p>
                            <code><?php echo$doa['title']?></code>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <?php include('q-include/footer.php') ?>
    <script src="assets/js/pages/be_ui_icons.js"></script>
