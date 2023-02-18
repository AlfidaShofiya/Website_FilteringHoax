<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
	<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
		<div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
			<a class="navbar-brand brand-logo mr-15" href="#"><img src="<?php echo base_url('assets/image/logo1.png') ?>" style="min-width:130px; min-height:110px;" class="mr-2" alt="logo" /></a>
			<a class="navbar-brand brand-logo-mini" href="#"><img src="<?php echo base_url('assets/image/logo2.png') ?>" style="min-width:70px; min-height:50px;" alt="logo" /></a>
		</div>
		<div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
			<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
				<span class="icon-menu"></span>
			</button>
			<ul class="navbar-nav navbar-nav-right">
				<li class="nav-item nav-profile dropdown">
					<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
						<?php
							$username_bahan = $this->session->userdata['username'];
							$username = ucfirst($username_bahan);
							print_r($username);
						?>
					</a>
					<div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
						<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
							<i class="ti-power-off text-primary"></i>
							Logout
						</a>
					</div>
				</li>
			</ul>
			<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
				<span class="icon-menu"></span>
			</button>
		</div>
	</nav>
</body>
</html>