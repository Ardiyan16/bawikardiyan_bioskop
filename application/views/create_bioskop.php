<?php $this->load->view('header.php'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Bioskop</h1>
    <div class="card shadow py-2">
        <div class="card-body">
            <a href="<?= base_url('Bioskop/bioskop') ?>" class="btn btn-success mb-3"> <span class="fa fa-arrow-alt-circle-left"></span> Kembali</a>
            <hr>

            <form action="<?= base_url('Bioskop/save_bioskop'); ?>" method="POST" enctype="multipart/form-data">
                <label>Kode Bioskop</label>
                <input name="kd_bioskop" type="text" placeholder="Kode Bioskop" class="form-control">
                <?= form_error('kd_bioskop', '<small class="text-danger pl-3">', '</small>'); ?>
                <br>
                <label>Nama Bioskop</label>
                <input name="nama_bioskop" type="text" placeholder="Nama Bioskop" class="form-control">
                <?= form_error('nama_bioskop', '<small class="text-danger pl-3">', '</small>'); ?>
                <br>
                <label>Alamat</label>
                <input name="alamat_bioskop" type="text" placeholder="Alamat" class="form-control">
                <?= form_error('alamat_bioskop', '<small class="text-danger pl-3">', '</small>'); ?>
                <br>
                <label>Kota</label>
                <input name="kota" type="text" placeholder="Kota" class="form-control">
                <?= form_error('kota', '<small class="text-danger pl-3">', '</small>'); ?>
                <br>
                <hr>
                <button type="reset" class="btn btn-danger"> <span class="fa fa-times"></span> Reset</button>
                <button type="submit" class="btn btn-primary"> <span class="fa fa-save"></span> Save</button>
            </form>
        </div>
    </div>
</div>

<?php $this->load->view('footer.php'); ?>