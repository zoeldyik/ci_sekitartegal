<div class="container my-5">
    <div class="row">
        <div class="col-md-5">
            <h4 class="mb-4 font-italic"><?= $title; ?></h4>
            <a class="btn btn-warning btn-sm" href="<?= base_url('kategori/tambah'); ?>" role="button">Tambah
                kategori</a>

            <ul class="list-group mt-3">
                <?php foreach ($kategori as $kat) : ?>
                <li class="list-group-item border-top-0 border-left-0 border-right-0 border-primary">
                    <?= $kat['nama']; ?>
                    <a class="badge badge-danger float-right"
                        href="<?= base_url(); ?>home/hapus_kategori/<?= $kat['id']; ?>"> delete</a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>