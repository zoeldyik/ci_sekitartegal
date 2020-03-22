<div class="container my-5 col-md-4 offset-md-4">

    <h4 class="mb-5 text-center"><?= $title; ?></h4>

    <form action="" method="post">
        <div class="form-group">
            <label for="namakategori">Nama</label>
            <input type="text" name="nama" id="namakategori" class="form-control" placeholder="Nama Kategori"
                value="<?= set_value('nama'); ?>">
        </div>
        <?php if (form_error('nama')) : ?>
        <small class="text-danger"><?= form_error('nama'); ?></small>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary btn-sm">tambah</button>
    </form>

</div>