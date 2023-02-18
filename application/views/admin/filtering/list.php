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
                        <div class="container-fluid">
                            <?php if ($this->session->flashdata('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?php echo $this->session->flashdata('success'); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php $this->session->unset_userdata('success') ?>
                            <?php endif; ?>
                        </div>
                        <div class="container-fluid">
                            <?php if ($this->session->flashdata('gagal')) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $this->session->flashdata('gagal'); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php $this->session->unset_userdata('gagal') ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Halaman Aktivasi System Filtering</h3>
                                    <?php $this->load->view("admin/_partials/breadcrumb.php") ?>
                                    <div class="row">
                                        <div class="col-md">
                                            <div class="card" style="border: 1px solid #3DD880; min-height: 50vh;">
                                                <div class="card-body">
                                                    <h5 class="card-header bg-success text-center">Detik.com</h5><br>
                                                    <form class="forms-sample" action="main-detik.py" method="POST">
                                                        <div class="form-group">
                                                            <label for="kata_kunci_detik" style="color: black;">Kata Kunci Pencarian</label><br>
                                                            <input type="text" class="form-control <?php echo form_error('kata_kunci_detik') ? 'is-invalid' : '' ?>" name="kata_kunci_detik" id="kata_kunci_detik" value="<?php echo set_value('kata_kunci_detik'); ?>" placeholder="Contoh : Kesehatan" required>
                                                            <span style="color: red;"><?php echo form_error('kata_kunci_detik'); ?></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nomor_hal_detik" style="color: black;">Nomor Halaman</label><br>
                                                            <input type="number" class="form-control <?php echo form_error('nomor_hal_detik') ? 'is-invalid' : '' ?>" name="nomor_hal_detik" id="nomor_hal_detik" value="<?php echo set_value('nomor_hal_detik'); ?>" placeholder="Contoh : 1" required>
                                                            <span style="color: red;"><?php echo form_error('nomor_hal_detik'); ?></span>
                                                        </div>
                                                        <button class="btn btn-primary float-right mr-2 mt-2 mb-2" style="background-color: #f58924; border:black;" type="submit" name="btn"> Turn ON </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="card" style="border: 1px solid #3DD880; min-height: 50vh;">
                                                <div class="card-body">
                                                    <h5 class="card-header bg-success text-center">Cnbcindonesia.com</h5><br>
                                                    <form class="forms-sample" action="main-cnbc.py" method="POST">
                                                        <div class="form-group">
                                                            <label for="kata_kunci_cnbc" style="color: black;">Kata Kunci Pencarian</label><br>
                                                            <input type="text" class="form-control <?php echo form_error('kata_kunci_cnbc') ? 'is-invalid' : '' ?>" name="kata_kunci_cnbc" id="kata_kunci_cnbc" value="<?php echo set_value('kata_kunci_cnbc'); ?>" placeholder="Contoh : Kesehatan" required>
                                                            <span style="color: red;"><?php echo form_error('kata_kunci_cnbc'); ?></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nomor_hal_cnbc" style="color: black;">Nomor Halaman</label><br>
                                                            <input type="number" class="form-control <?php echo form_error('nomor_hal_cnbc') ? 'is-invalid' : '' ?>" name="nomor_hal_cnbc" id="nomor_hal_cnbc" value="<?php echo set_value('nomor_hal_cnbc'); ?>" placeholder="Contoh : 1" required>
                                                            <span style="color: red;"><?php echo form_error('nomor_hal_cnbc'); ?></span>
                                                        </div>
                                                        <button class="btn btn-primary float-right mr-2 mt-2 mb-2" style="background-color: #f58924; border:black;" type="submit" name="btn"> Turn ON </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="card" style="border: 1px solid #3DD880; min-height: 50vh;">
                                                <div class="card-body">
                                                    <h5 class="card-header bg-success text-center">TVonenews.com</h5><br>
                                                    <form class="forms-sample" action="main-tvone.py" method="POST">
                                                        <div class="form-group">
                                                            <label for="kata_kunci_tvone" style="color: black;">Kata Kunci Pencarian</label><br>
                                                            <input type="text" class="form-control <?php echo form_error('kata_kunci_tvone') ? 'is-invalid' : '' ?>" name="kata_kunci_tvone" id="kata_kunci_tvone" value="<?php echo set_value('kata_kunci_tvone'); ?>" placeholder="Contoh : Kesehatan" required>
                                                            <span style="color: red;"><?php echo form_error('kata_kunci_tvone'); ?></span>
                                                        </div>
                                                        <h5 style="padding-top: 85px;"> </h5>
                                                        <button class="btn btn-primary float-right mr-2 mt-2 mb-2" style="background-color: #f58924; border:black; margin-top: 200px;" type="submit" name="btn"> Turn ON </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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