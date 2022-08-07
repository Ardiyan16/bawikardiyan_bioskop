<?php $this->load->view('header.php'); ?>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />
<script src="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"></script>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Penayangan</h1>
    <div class="card shadow py-2">
        <div class="card-body">
            <a href="<?= base_url('Bioskop/tayangan') ?>" class="btn btn-success mb-3"> <span class="fa fa-arrow-alt-circle-left"></span> Kembali</a>
            <hr>

            <form action="<?= base_url('Bioskop/save_tayangan'); ?>" method="POST" enctype="multipart/form-data">
                <!-- <label>Kode Film</label> -->
                <input name="kode_film" readonly type="hidden" placeholder="" class="form-control col-md-4 kode_film">
                <br>
                <label>Nama Film</label>
                <input readonly type="text" placeholder="Nama Film" class="form-control nama_film">
                <button type='button' class='btn-sm btn-success' title="cari film" onclick='cari_film()' style='margin-left: 4px; margin-top: 5px; margin-bottom: 5px;'> <i class='ace-icon fa fa-search'></i></button>
                <?= form_error('kode_film', '<small class="text-danger pl-3">', '</small>'); ?>
                <br>
                <label>Pilih Bioskop</label>
                <select name="kode_bioskop" class="form-control">
                    <?php foreach ($bioskop as $show) { ?>
                        <option value="<?= $show->kd_bioskop ?>"><?= $show->nama_bioskop ?></option>
                    <?php } ?>
                </select>
                <br>
                <label>Tanggal & Waktu</label>
                <input name="tgl_waktu" type="datetime-local" placeholder="" class="form-control col-md-4">
                <?= form_error('tgl_waktu', '<small class="text-danger pl-3">', '</small>'); ?>
                <br>
                <label>Jumlah Kursi</label>
                <input name="jumlah_kursi" type="number" placeholder="Jumlah Kursi" class="form-control">
                <?= form_error('jumlah_kursi', '<small class="text-danger pl-3">', '</small>'); ?>
                <br>
                <hr>
                <button type="reset" class="btn btn-danger"> <span class="fa fa-times"></span> Reset</button>
                <button type="submit" class="btn btn-primary"> <span class="fa fa-save"></span> Save</button>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="listfilm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">List data film</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="tabelfilm" class="tabelfilm">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Kode Film</td>
                            <td>Judul Film</td>
                            <td>Tanggal Launcing</td>
                            <td>Option</td>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    function cari_film() {
        // getDataBarang()
        $('#listfilm').modal('show');
        table2 = $('#tabelfilm').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true,
            "bDestroy": true,
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo base_url() ?>Bioskop/cari_film",
                "type": "POST"
            },

            order: [1, 'asc']

        }).fnDestroy();
        table2.ajax.reload();
    }

    function pencarian_kode(kd_film, judul_film) {
        $('.kode_film').val(kd_film);
        $('.nama_film').val(judul_film);

        $('#listfilm').modal('hide');
        // console.log('checkbox', chekbox1);
    }
</script>
<?php $this->load->view('footer.php'); ?>