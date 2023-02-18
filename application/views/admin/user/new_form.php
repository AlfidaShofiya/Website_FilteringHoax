<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admin/_partials/head.php") ?>
</head>

<body>
	<div class="container-scroller">
		<!-- partial navbar -->
		<?php $this->load->view("admin/_partials/navbar.php") ?>
		<!-- partial -->
		<div class="container-fluid page-body-wrapper">
			<!-- partial sidebar -->
			<?php $this->load->view("admin/_partials/sidebar.php") ?>
			<!-- partial -->
			<div class="main-panel">
				<div class="content-wrapper">
					<div class="row">
						<div class="col-12 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<h3 class="card-title">Tambah Data Admin</h3>
									<?php $this->load->view("admin/_partials/breadcrumb.php") ?>
									<a href="<?php echo site_url('user') ?>" class="btn btn-outline-info btn-fw">Kembali</a>
									<form class="forms-sample" action="<?php echo site_url('User/input'); ?>" method="POST">
										<br>
										<div class="form-group">
											<label for="username">Username</label>
											<input type="text" class="form-control <?php echo form_error('username') ? 'is-invalid':'' ?>" name="username" id="username" value="<?php echo set_value('username'); ?>" placeholder="Username" required />
											<span style="color: red;"><?php echo form_error('username'); ?></span>
										</div>
										<div class="form-group">
											<label for="password">Password</label>
											<input type="password" class="form-control <?php echo form_error('password') ? 'is-invalid':'' ?>" name="password" id="password" value="<?php echo set_value('password'); ?>" placeholder="Password" required />
											<span style="color: red;"><?php echo form_error('password'); ?></span>
										</div>
										<div class="form-group">
											<input type="hidden" class="form-control <?php echo form_error('dibuat') ? 'is-invalid':'' ?>" name="dibuat" id="dibuat" value="<?php echo date("Y-m-d H:i:s"); ?>" placeholder="Dibuat Pada" required>
										</div>
										<button class="btn btn-primary float-right mr-2" style="background-color: #f58924; border:black;" type="submit" name="btn"> Simpan </button> 
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- partial footer -->
					<?php $this->load->view("admin/_partials/footer.php") ?>
					<!-- partial -->
				</div>
				<!-- content-wrapper ends -->
			</div>
			<!-- main-panel ends -->
		</div>
		<!-- page-body-wrapper ends -->
	</div>
	<!-- partial modal-->
	<?php $this->load->view("admin/_partials/modal.php") ?>
	<!-- partial -->
	<!-- partial js -->
	<?php $this->load->view("admin/_partials/js.php") ?>
	<!-- partial -->
</body>

</html>
