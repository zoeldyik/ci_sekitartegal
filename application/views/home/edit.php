<div class="container col-md-6 offset-md-3 my-5">
    <h3 class="font-italic text-center mb-5"><?= $title; ?></h3>
    <form action="" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?= $data['id']; ?>">

        <div class="form-group">
            <label for="tempat">Nama Tempat</label>
            <input type="text" class="form-control" id="tempat" name="tempat" placeholder="Nama tempat"
                value="<?= $data['tempat']; ?>">
            <small class="text-danger"><?= form_error('tempat'); ?></small>
        </div>
        <div class="form-group">
            <label for="teks">Deskripsi</label>
            <textarea name="teks" id="teks" cols="30" rows="10" class="form-control"
                placeholder="Deskripsi tempat"><?= $data['teks']; ?></textarea>
            <small class="text-danger"><?= form_error('teks'); ?></small>
        </div>
        <div class="form-group">
            <label for="website">website</label>
            <input type="text" class="form-control" id="website" name="website" placeholder="kosongkan jika tidak ada"
                value="<?= $data['website']; ?>">
        </div>
        <div class="form-group">
            <label for="instagram">instagram</label>
            <input type="text" class="form-control" id="instagram" name="instagram"
                placeholder="kosongkan jika tidak ada" value="<?= $data['instagram']; ?>">
        </div>
        <div class="form-group">
            <label for="kategori">kategori</label>
            <select class="form-control" id="kategori" name="kategori">
                <?php foreach ($kategori as $kat) : ?>
                <?php if ($kat['id'] === $data['kategori_id']) : ?>
                <option value="<?= $kat['id']; ?>" selected><?= $kat['nama']; ?></option>
                <?php else : ?>
                <option value="<?= $kat['id']; ?>"><?= $kat['nama']; ?></option>
                <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>

        <img src="<?= base_url(); ?>image/<?= $data['foto']; ?>" class="img-preview" style="max-width: 200px;">
        <br>

        <div class="form-group">
            <input type="file" class="form-control" id="foto" name="foto">
            <?php if ($this->session->flashdata('error')) : ?>
            <small class="text-danger"><?= $this->session->flashdata('error'); ?></small>
            <?php endif; ?>
        </div>

        <small class="text-primary font-weight-bolder font-italic " id="file-help">NOTE:</small>
        <br>
        <small class="text-primary" id="file-help"> - gunakan foto berbentuk landscape</small>
        <br>
        <small class="text-primary" id="file-help"> - ekstensi foto harus jpg / png</small>
        <br>
        <small class="text-primary" id="file-help"> - max size foto 1mb</small>
        <br>
        <br>
        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
    </form>

</div>

<script>
// sumber https://developer.mozilla.org/en-US/docs/Web/API/FileReader/readAsDataURL

document.querySelector("#foto").addEventListener("change", previewFile);

function previewFile() {
    const preview = document.querySelector('.img-preview');
    const file = document.querySelector('#foto').files[0];
    const reader = new FileReader();

    reader.addEventListener("load", function() {
        // convert image file to base64 string
        preview.src = reader.result;
    }, false);

    if (file) {
        reader.readAsDataURL(file);
    }
}
</script>