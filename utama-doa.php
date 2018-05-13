
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
            <!-- Dynamic Table Full Pagination -->
            <div class="block">

                <div class="block-content block-content-full">
                    <table class="table table-hover table-vcenter js-dataTable-full-pagination">
                        <thead>
                        <tr>
                            <th class="text-center"></th>
                            <th>Title</th>
                            <th class="d-none d-sm-table-cell">Audio</th>
                            <th class="d-none d-sm-table-cell text-center" style="width: 15%;">Hits </th>
                            <th class="text-center" style="width: 15%;"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $q_doa = mysqli_query($db, "SELECT * FROM doa");
                        while($doa = mysqli_fetch_assoc($q_doa)) {
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $doa['id'] ?></td>
                            <td class="font-w600"><a href="doa.php?did=<?php echo $doa['id']; ?>"><?php echo $doa['title'] ?></a></td>
                            <td class="d-none d-sm-table-cell">
                                <span class="badge badge-warning">
                                    <?php if(is_null($doa['track'])  || $doa['track'] == ''){ echo 'ada'; }else{ echo 'tiada'; } ?>
                                <span class="badge badge-warning">
                            </td>
                            <td class="d-none d-sm-table-cell text-center">
                                <?php echo $doa['hits'] ?>
                            </td>
                            <td class="text-center">

                            </td>
                        </tr>
                        <?php } unset($doa); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END Dynamic Table Full Pagination -->
        </div>

    </main>
    <?php include('q-include/footer.php') ?>
    <script src="assets/js/pages/be_ui_icons.js"></script>
    <script src="assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page JS Code -->
    <script src="assets/js/pages/be_tables_datatables.js"></script>
    </body>
