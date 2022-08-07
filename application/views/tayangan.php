<?php $this->load->view('header.php'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">List Tayangan</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?= base_url('Bioskop/create_tayangan') ?>" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tambah Tayangan</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Tayang</th>
                            <th>Judul Film</th>
                            <th>Tanggal / Waktu</th>
                            <th>Jumlah Kursi</th>
                            <th>option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($tayangan as $show) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $show->kd_tayang ?></td>
                                <td><?= $show->judul_film ?></td>
                                <td><?= date('d-m-Y', strtotime($show->tgl_waktu)) ?> / <?= date('H:i', strtotime($show->tgl_waktu)) ?></td>
                                <td><?= $show->jumlah_kursi ?></td>
                                <td>
                                    <!-- <a href="<?= base_url('Bioskop/edit_tiket/' . $show->kd_tayang) ?>" class="badge bg-primary" title="edit" style="color: white;"><i class="fa fa-edit"></i></a> -->
                                    <a href="<?= base_url('Bioskop/delete_tayangan/' . $show->kd_tayang) ?>" onclick="return confirm('Aapakah anda yakin menghapus data ?')" class="badge bg-danger" title="edit" style="color: white;"><i class="fa fa-trash"></i></a>
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
            text: 'data tayangan berhasil disimpan',
            showConfirmButton: true,
            // timer: 1500
        })
    <?php elseif ($this->session->flashdata('success_update')) : ?>
        Swal.fire({
            icon: 'success',
            title: 'berhasil!',
            text: 'data tayangan berhasil diupdate / diubah',
            showConfirmButton: true,
            // timer: 1500
        })
    <?php elseif ($this->session->flashdata('success_delete')) : ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'data tayangan berhasil dihapus',
            showConfirmButton: true,
            // timer: 1500
        })
    <?php endif ?>
</script>

<?php $this->load->view('footer.php'); ?>