<?php $this->load->view('header.php'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">List Film</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?= base_url('Bioskop/create_film') ?>" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tambah Film</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Film</th>
                            <th>Judul Film</th>
                            <th>Tanggal Launcing</th>
                            <th>Sinopsis</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($film as $show) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $show->kd_film ?></td>
                                <td><?= $show->judul_film ?></td>
                                <td><?= date('d-m-Y', strtotime($show->tgl_launc)) ?></td>
                                <td><?= $show->synopys ?></td>
                                <td>
                                    <a href="<?= base_url('Bioskop/edit_film/' . $show->kd_film) ?>" class="badge bg-primary" title="edit" style="color: white;"><i class="fa fa-edit"></i></a>
                                    <a href="<?= base_url('Bioskop/delete_film/' . $show->kd_film) ?>" onclick="return confirm('Aapakah anda yakin menghapus data ?')" class="badge bg-danger" title="edit" style="color: white;"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    <?php if ($this->session->flashdata('success_create')) : ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'data film berhasil disimpan',
            showConfirmButton: true,
            // timer: 1500
        })
    <?php elseif ($this->session->flashdata('success_update')) : ?>
        Swal.fire({
            icon: 'success',
            title: 'berhasil!',
            text: 'data film berhasil diupdate / diubah',
            showConfirmButton: true,
            // timer: 1500
        })
    <?php elseif ($this->session->flashdata('success_delete')) : ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'data film berhasil dihapus',
            showConfirmButton: true,
            // timer: 1500
        })
    <?php endif ?>
</script>

<?php $this->load->view('footer.php'); ?>