<!doctype html>
<html lang="en">
<?php include_once ('include/logged-header.php'); ?>
<?php
    $q_check_user = "SELECT * FROM admin WHERE id = $_SESSION[id]";
    $fetch_user = mysqli_query($db,$q_check_user);
    $row = mysqli_fetch_assoc($fetch_user);
?>
<?php $title = "KOSONG"; ?>

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
            <div class="section-heading">
                <h1 class="page-title">User Profile</h1>
            </div>
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#myprofile" role="tab" data-toggle="tab">Info Pribadi</a></li>
                <li><a href="#account" role="tab" data-toggle="tab">Kata lalaluan</a></li>
            </ul>
                <div class="tab-content content-profile">
                    <!-- MY PROFILE -->
                        <div class="tab-pane fade in active" id="myprofile">
                            <form action="profile.php?type=profile" method="post">
                            <div class="profile-section">
                                <h2 class="profile-heading">Info Pribadi</h2>
                                <div class="clearfix">
                                    <!-- LEFT SECTION -->
                                    <div class="left">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" name="username" class="form-control" value="<?php echo $row['username'] ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Penuh</label>
                                            <input type="text" name="fullname" class="form-control" value="<?php echo $row['fullname'] ?>" >
                                        </div>
                                        <div class="form-group">
                                            <label>Emel</label>
                                            <input type="text" name="email" class="form-control" value="<?php echo $row['email'] ?>" >
                                        </div>
                                    </div>
                                    <!-- END LEFT SECTION -->
                                </div>
                                <p class="margin-top-30">
                                    <button type="submit" class="btn btn-primary">Update</button> &nbsp;&nbsp;
                                    <button type="button" class="btn btn-default">Cancel</button>
                                </p>
                            </div>
                            </form>
                        </div>
                    <!-- END MY PROFILE -->
                    <!-- ACCOUNT -->
                    <div class="tab-pane fade" id="account">
                        <form action="profile.php?type=password" method="post">
                        <div class="profile-section">
                            <div class="clearfix">
                                <!-- RIGHT SECTION -->
                                <div class="left">
                                    <h2 class="profile-heading">Kemaskini Katalaluan</h2>
                                    <div class="form-group">
                                        <label>Katalaluan Sekarang</label>
                                        <input name="current" type="password" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Kata Laluan Baru</label>
                                        <input name="new" type="password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Sahkan Katalaluan Baru</label>
                                        <input name="confirm" type="password" class="form-control">
                                    </div>
                                </div>
                                <!-- END RIGHT SECTION -->
                            </div>
                            <p class="margin-top-30">
                                <button type="submit" class="btn btn-primary">Update</button> &nbsp;&nbsp;
                                <button class="btn btn-default">Cancel</button>
                            </p>
                        </div>
                        </form>
                    </div>
                    <!-- END ACCOUNT -->
                </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
    <div class="clearfix"></div>
    <?= include('include/footer.php'); ?>
</div>
<?php
if(isset($_GET['type']) && $_GET['type'] ==  'profile')
{
    $sql = "UPDATE admin SET 
                    fullname = '$_POST[fullname]',
                    email = '$_POST[email]'
                    WHERE id = $_SESSION[id]";
    if (mysqli_query($db, $sql)) {
        echo "<script>alert('Profil telah dikemaskini.');window.location='profile.php'</script>";
    } else {
        echo "<script>alert('Gagal mengemaskini profile');window.location='profile.php'</script>";

    }
}

if(isset($_GET['type']) && $_GET['type'] ==  'password' && !is_null($_POST['current']))
{
    if($_POST['current'] != $row['password']){
        echo "<script>alert('katalaluan lama salah!');window.location='profile.php'</script>";
    }
    if($_POST['new'] != $_POST['confirm']){
        echo "<script>alert('Sahkan katalaluan tidak sama!');window.location='profile.php'</script>";
    }
    $sql = "UPDATE admin SET 
                    password = '$_POST[new]'
                    WHERE id = $_SESSION[id]";
    if (mysqli_query($db, $sql)) {
        echo "<script>alert('katalaluan telah dikemaskini.');window.location='profile.php'</script>";
    } else {
        echo "<script>alert('Gagal mengemaskini katalaluan');window.location='profile.php'</script>";

    }
}
?>

</body>

</html>
