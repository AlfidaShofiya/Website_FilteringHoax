<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="stylesheet" href="<?php echo base_url('skydash/css/style.css') ?>">
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
						<div class="col-md-12 grid-margin">
							<div class="row">
								<div class="col-12 col-xl-8 mb-4 mb-xl-0">
									<h3 class="font-weight-bold">Filtering Hoax Dinas Kesehatan</h3>
								</div>
							</div>
						</div>
					</div>
					<div class="row" style="margin-top: -20px;">
						<!-- <div class="col-md-9"> -->
							<div class="row">
								<div class="col">
									<div class="card text-white bg-success mb-3">
										<div style="font-size: 25px;" class="card-header">Selamat datang, 
											<?php
												$username_bahan = $this->session->userdata['username'];
												$username = ucfirst($username_bahan);
												print_r($username);
											?>.
										</div>
										<div class="card-body">
											<div class="row">
												<div class="col-md-8 pl-5 mt-5 ">
													<h3 class="card-title"></h3>
													<p style="align-items:center; font-size: 22px;" class="card-text">Kami sangat senang menyapa anda, <br> Di Dashboard ini Anda bisa mengatur aktivitas sistem <br>Silahkan atur website Filtering Hoax Anda</p>
												</div>
												<div class="col-md-4">
													<img style="vertical-align: middle;" class="card-img-top" src="<?php echo base_url('assets/image/orang.png') ?>" alt="Card image cap">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md">
									<div class="card mb-3" style="border: 1px solid #3DD880; min-height: 35vh;">
										<a href="<?php echo site_url('user') ?>" class="card-link" style="color:black">
											<div class="card-body">
												<div class="row">
													<div class="col">
														<div class="circle">
															<div class="col px-2 py-2">
																<i class="mdi mdi-account" style="color: #ffffff; font-size:36px;"></i>
															</div>
														</div>
													</div>
													<div class="col-md-5">
														<i class="mdi mdi-dots-horizontal" style="color: grey; font-size: 36px;"></i>
													</div>
												</div> <br>
												<h5 class="card-title">Admin</h5>
												<p class="card-text">Klik disini untuk mengatur daftar data admin yang tersimpan</p>
											</div>
										</a>
									</div>
								</div>
								<div class="col-md">
									<div class="card mb-3 " style="border: 1px solid #3DD880; min-height: 35vh;">
										<a href="<?php echo site_url('systemfiltering') ?>" class="card-link" style="color:black">
											<div class="card-body">
												<div class="row">
													<div class="col">
														<div class="circle-two">
															<div class="col px-2 py-2">
																<i class="mdi mdi-power" style="color: #ffffff; font-size:36px;"></i>
															</div>
														</div>
													</div>
													<div class="col-md-5">
														<i class="mdi mdi-dots-horizontal" style="color: grey; font-size: 36px;"></i>
													</div>
												</div> <br>
												<h5 class="card-title">Filtering</h5>
												<p class="card-text">Klik disini untuk mengaktifkan system filtering hoax</p>
											</div>
										</a>
									</div>
								</div>
								<div class="col-md">
									<div class="card mb-3 " style="border: 1px solid #3DD880; min-height: 35vh;">
										<a href="<?php echo site_url('validasi') ?>" class="card-link" style="color:black">
											<div class="card-body">
												<div class="row">
													<div class="col">
														<div class="circle-three">
															<div class="col px-2 py-2">
																<i class="mdi mdi-check" style="color: #ffffff; font-size:36px;"></i>
															</div>
														</div>
													</div>
													<div class="col-md-5">
														<i class="mdi mdi-dots-horizontal" style="color: grey; font-size: 36px;"></i>
													</div>
												</div> <br>
												<h5 class="card-title">Validasi</h5>
												<p class="card-text">Klik disini untuk memvalidasi berita yang akan anda tampilkan</p>
											</div>
										</a>
									</div>
								</div>
								<div class="col-md">
									<div class="card mb-3" style="border: 1px solid #3DD880; min-height: 35vh;">
										<a href="<?php echo site_url('databerita') ?>" class="card-link" style="color:black">
											<div class="card-body">
												<div class="row">
													<div class="col">
														<div class="circle-four">
															<div class="col px-2 py-2">
																<i class="mdi mdi-library-books" style="color: #ffffff; font-size:35px;"></i>
															</div>
														</div>
													</div>
													<div class="col-md-5">
														<i class="mdi mdi-dots-horizontal" style="color: grey; font-size: 36px;"></i>
													</div>
												</div> <br>
												<h5 class="card-title">Data Berita</h5>
												<p class="card-text">Klik disini untuk mengatur data berita yang akan anda tampilkan</p>
											</div>
										</a>
									</div>
								</div>
								<div class="col-md">
									<div class="card mb-3" style="border: 1px solid #3DD880; min-height: 35vh;">
										<a href="<?php echo site_url('riwayat') ?>" class="card-link" style="color:black">
											<div class="card-body">
												<div class="row">
													<div class="col">
														<div class="circle-four" style="background-color: blue;">
															<div class="col px-2 py-2">
																<i class="mdi mdi-history" style="color: #ffffff; font-size:35px;"></i>
															</div>
														</div>
													</div>
													<div class="col-md-5">
														<i class="mdi mdi-dots-horizontal" style="color: grey; font-size: 36px;"></i>
													</div>
												</div> <br>
												<h5 class="card-title">Riwayat</h5>
												<p class="card-text">Klik disini untuk mengatur berita yang akan anda tampilkan</p>
											</div>
										</a>
									</div>
								</div>
							</div>
						<!-- </div> -->
					</div>
				</div>
			</div>
		</div>
	</div>

	</ul>
	</div>
	</div>
	</div>
	</div>
	</div>
	<!-- content-wrapper ends -->
	<!-- partial footer -->
	<?php $this->load->view("admin/_partials/footer.php") ?>
	<!-- partial -->
	</div>
	<!-- main-panel ends -->
	</div>
	<!-- page-body-wrapper ends -->
	</div>
	<!-- container-scroller -->

	<!-- partial js -->
	<?php $this->load->view("admin/_partials/modal.php") ?>
	<?php $this->load->view("admin/_partials/js.php") ?>
	<!-- partial -->
</body>

</html>