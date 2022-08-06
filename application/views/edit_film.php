<?php $this->load->view('header.php'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Film</h1>
    <div class="card shadow py-2">
        <div class="card-body">
            <a href="<?= base_url('Bioskop') ?>" class="btn btn-success mb-3"> <span class="fa fa-arrow-alt-circle-left"></span> Kembali</a>
            <hr>

            <form action="<?= base_url('Bioskop/update_film'); ?>" method="POST" enctype="multipart/form-data">
                <label>Judul Film</label>
                <input name="kd_film" value="<?= $view->kd_film ?>" type="hidden" placeholder="Judul Film" class="form-control">
                <input name="judul_film" value="<?= $view->judul_film ?>" readonly type="text" placeholder="Judul Film" class="form-control">
                <?= form_error('judul_film', '<small class="text-danger pl-3">', '</small>'); ?>
                <br>
                <label>Tanggal Launcing</label>
                <input name="tgl_launc" value="<?= $view->tgl_launc ?>" type="date" placeholder="Harga Satuan" class="form-control col-md-4">
                <?= form_error('tgl_launc', '<small class="text-danger pl-3">', '</small>'); ?>
                <br>
                <label>Sinopsis</label>
                <textarea id="summernote" name="synopys" rows="12"><?= $view->synopys ?></textarea>
                <?= form_error('synopys', '<small class="text-danger pl-3">', '</small>'); ?>
                <br>
                <hr>
                <button type="reset" class="btn btn-danger"> <span class="fa fa-times"></span> Reset</button>
                <button type="submit" class="btn btn-primary"> <span class="fa fa-save"></span> Save</button>
            </form>
        </div>
    </div>
</div>

<?php $this->load->view('footer.php'); ?>