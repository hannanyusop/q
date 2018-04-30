<!doctype html>
<html lang="en" class="fullscreen-bg">

<?php include_once('header.php'); ?>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box">
					<div class="content">
						<div class="header">
							<div class="logo text-center"><img src="assets/img/logo.png" alt="DiffDash"></div>
							<p class="lead">Login to your account</p>
						</div>
						<form class="form-auth-small" action="verify.php" method="post">
							<div class="form-group">
								<label for="signin-email" class="control-label sr-only">Email</label>
								<input type="email" class="form-control"  placeholder="Email" name="email">
							</div>
							<div class="form-group">
								<label for="signin-password" class="control-label sr-only">Password</label>
								<input type="password" class="form-control" placeholder="Password" name="password">
							</div>
							<div class="form-group clearfix">
								<label class="fancy-checkbox element-left">
									<input type="checkbox">
									<span>Remember me</span>
								</label>
							</div>
							<button type="submit" class="btn btn-primary btn-lg btn-block" name="login">LOGIN</button>
							<div class="bottom">
								<span class="helper-text"><i class="fa fa-lock"></i> <a href="forgot-password.php">Forgot password?</a></span>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>
