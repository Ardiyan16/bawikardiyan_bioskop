<?php $this->load->view('header.php'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Bioskop</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?= base_url('Bioskop/create_bioskop') ?>" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tambah Bioskop</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Bioskop</th>
                            <th>Nama Bioskop</th>
                            <th>Alamat</th>
                            <th>Kota</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($bioskop as $show) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $show->kd_bioskop ?></td>
                                <td><?= $show->nama_bioskop ?></td>
                                <td><?= $show->alamat_bioskop ?></td>
                                <td><?= $show->kota ?></td>
                                <td>
                                    <a href="<?= base_url('Bioskop/edit_bioskop/' . $show->kd_bioskop) ?>" class="badge bg-primary" title="edit" style="color: white;"><i class="fa fa-edit"></i></a>
                                    <a href="<?= base_url('Bioskop/delete_bioskop/' . $show->kd_bioskop) ?>" onclick="return confirm('apakah anda yakin menghapus data ?')" class="badge bg-danger" title="hapus" style="color: white;"><i class="fa fa-trash"></i></a>
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
            text: 'Data bioskop berhasil disimpan',
            showConfirmButton: true,
            // timer: 1500
        })
    <?php elseif ($this->session->flashdata('success_update')) : ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Data bioskop berhasil diupdate',
            showConfirmButton: true,
            // timer: 1500
        })
    <?php elseif ($this->session->flashdata('success_delete')) : ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'data bioskop berhasil dihapus',
            showConfirmButton: true,
            // timer: 1500
        })
    <?php endif ?>
</script>

<?php $this->load->view('footer.php'); ?>