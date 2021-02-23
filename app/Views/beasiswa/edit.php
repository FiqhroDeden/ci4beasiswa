<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>
<div class="section-header">
    <h1>Beasiswa</h1>
</div>
<div class="section-body">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4>Edit Beasiswa</h4>
            <div class="card-header-action">
                <a href=" <?= base_url('Beasiswa/index'); ?>">
                    <button class=" btn btn-danger btn-sm"><i class="fa fa-arrow-left"></i> Kembali</button>
                </a>
            </div>


        </div>
        <div class="card-body">
            <form action="/beasiswa/update/<?= $beasiswa['id']; ?>" method="POST" class="needs-validation" enctype="multipart/form-data">
                <?php csrf_field(); ?>
                <input type="hidden" name="gambar_lama" value="<?= $beasiswa['gambar']; ?>">
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Beasiswa</label>
                    <div class="col-sm-12 col-md-7">
                        <input type="text" name="nama_beasiswa" value="<?= $beasiswa['nama_beasiswa']; ?>" class="form-control" required="">
                        <div class="invalid-feedback">
                            Nama Beasiswa wajib diisi
                        </div>
                    </div>

                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kuota Beasiswa</label>
                    <div class="col-sm-6 col-md-2">
                        <input type="number" name="kuota" value="<?= $beasiswa['kuota']; ?>" class="form-control" required="">
                        <div class="invalid-feedback">
                            Kuota Wajib diisi
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Deskripsi Beasiswa</label>
                    <div class="col-sm-12 col-md-7">
                        <textarea class="summernote-simple" name="deskripsi" required=""><?= $beasiswa['deskripsi']; ?></textarea>
                        <div class=" invalid-feedback">
                            Deskripsi wajib diisi
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                    <div class="col-sm-12 col-md-7">
                        <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label">Choose File</label>
                            <input type="file" name="gambar" id="image-upload" />
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Dibuka Pada</label>
                    <div class="col-sm-12 col-md-7">
                        <input type="date" name="dibuka" value="<?= $beasiswa['dibuka']; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Ditutup Pada</label>
                    <div class="col-sm-12 col-md-7">
                        <input type="date" name="ditutup" value="<?= $beasiswa['ditutup']; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status Beasiswa</label>
                    <div class="col-sm-12 col-md-7">
                        <select class="form-control selectric" name="status">
                            <option value="Dibuka" <?php if ($beasiswa == 'Dibuka') : ?> selected <?php endif; ?>>Dibuka</option>
                            <option value="Ditutup" <?php if ($beasiswa == 'Ditutup') : ?> selected <?php endif; ?>>Ditutup</option>

                        </select>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status Publish</label>
                    <div class="col-sm-12 col-md-7">
                        <select class="form-control selectric" name="status_publish">
                            <option value="Publish" <?php if ($beasiswa == 'Publish') : ?> selected <?php endif; ?>>Publish</option>
                            <option value="Draft" <?php if ($beasiswa == 'Draft') : ?> selected <?php endif; ?>>Draft</option>
                            <option value="Pending" <?php if ($beasiswa == 'Pending') : ?> selected <?php endif; ?>>Pending</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                    <div class="col-sm-12 col-md-7">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>

<?= $this->endSection(); ?>