<!doctype html>
<html lang="en" class="fullscreen-bg">

<? include_once('header.php'); ?>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box forgot-password">
					<div class="content">
						<div class="header">
							<div class="logo text-center"><img src="assets/img/logo.png" alt="DiffDash"></div>
							<p class="lead">Recover my password</p>
						</div>
						<p class="text-center margin-bottom-30">Please enter your email address below to receive instructions for resetting password.</p>
						<form class="form-auth-small" action="index.php">
							<div class="form-group">
								<label for="signup-password" class="control-label sr-only">Password</label>
								<input type="password" class="form-control" id="signup-password" placeholder="Password">
							</div>
							<button type="submit" class="btn btn-primary btn-lg btn-block">RESET PASSWORD</button>
							<div class="bottom">
								<span class="helper-text">Know your password? <a href="login.php">Login</a></span>
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
