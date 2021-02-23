<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>
<div class="section-header">
    <h1>Beasiswa</h1>
</div>
<div class="section-body">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4>Detail Beasiswa</h4>
            <div class="card-header-action">
                <a href=" <?= base_url('Beasiswa/index'); ?>">
                    <button class=" btn btn-danger btn-sm"><i class="fa fa-arrow-left"></i> Kembali</button>
                </a>
            </div>


        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-3 col-lg-3">

                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <article class="article article-style-c">
                        <div class="article-header">
                            <div class="article-image" data-background="<?= base_url(); ?>/file/beasiswa/<?= $beasiswa['gambar']; ?>">
                            </div>
                        </div>
                        <div class="article-details">
                            <div class="article-category"><a href="#">Status</a>
                                <div class="bullet"></div> <span class="badge badge-pill badge-<?= $beasiswa['status'] == 'Dibuka' ? 'info' : 'danger' ?>"><?= $beasiswa['status']; ?></span>
                            </div>

                            <div class="article-title">
                                <h1><a href="#"><?= $beasiswa['nama_beasiswa']; ?></a></h1>
                            </div>
                            <p><?= $beasiswa['deskripsi']; ?></p>
                            <div class="article-user">
                                <div class="article-category"><a href="#">Kuota</a>
                                    <div class="bullet"></div> <span><?= $beasiswa['kuota']; ?> Orang</span>
                                </div>
                                <div class="article-category"><a href="#">Dibuka Pada</a>
                                    <div class="bullet"></div> <span><?= $beasiswa['dibuka']; ?></span>
                                </div>
                                <div class="article-category"><a href="#">Ditutup Pada</a>
                                    <div class="bullet"></div> <span><?= $beasiswa['ditutup']; ?></span>
                                </div>
                                <div class="article-category"></div> <span><?= $beasiswa['status_publish']; ?></span>
                            </div>

                        </div>
                </div>
                </article>
            </div>
            <div class="col-12 col-md-3 col-lg-3">

            </div>
        </div>
    </div>

</div>
</div>

<?= $this->endSection(); ?>