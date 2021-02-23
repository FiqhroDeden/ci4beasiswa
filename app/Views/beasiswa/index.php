<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>
<div class="section-header">
    <h1>Beasiswa</h1>
</div>
<div class="section-body">
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4>Kelola Daftar Beasiswa</h4>
            <div class="card-header-action">
                <a href=" <?= base_url('Beasiswa/tambah'); ?>">
                    <button class=" btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Beasiswa</button>
                </a>
            </div>


        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover dt-bootstrap4" id="dataTable" width="100%" cellspacing="0">
                    <thead style="color: blue">
                        <tr>
                            <th>#</th>
                            <th>Nama Beasiswa</th>
                            <th>Kuota</th>
                            <th>Dibuka
                                <br> Ditutup
                            </th>
                            <th>Status Beasiswa</th>
                            <th><span class="fa fa-cog"></span></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($beasiswa as $p) : ?>
                            <tr>

                                <td><?= $i++; ?></td>
                                <td><?= $p['nama_beasiswa']; ?></td>
                                <td><?= $p['kuota']; ?></td>
                                <td><?= $p['dibuka']; ?>
                                    <hr> <?= $p['ditutup']; ?>
                                </td>
                                <td><span class="badge badge-pill badge-<?= $p['status'] == 'Dibuka' ? 'info' : 'danger' ?>"><?= $p['status']; ?></span></td>
                                <td>
                                    <a href="/beasiswa/edit/<?= $p['id']; ?>" class="btn btn-primary"><span class="fa fa-edit"></span></a>
                                    <a href="/beasiswa/delete/<?= $p['id']; ?>" onclick="return confirm('apakah anda yakin?');" class="btn btn-danger"><span class="fa fa-trash"></span></a>
                                </td>


                            </tr>
                        <?php endforeach; ?>



                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection(); ?>