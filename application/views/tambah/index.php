<div class="container py-5 col-md-6 offset-md-3" id="tambah">
    <h3 class="text-center font-weight-bolder font-italic mb-5"><?= $title; ?></h3>
    <div class="card">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="tempat">Nama Tempat</label>
                <input type="text" class="form-control" id="tempat" name="tempat" placeholder="Nama tempat"
                    value="<?= set_value("tempat"); ?>">
                <small class="text-danger"><?= form_error('tempat'); ?></small>
            </div>
            <div class="form-group">
                <label for="teks">Deskripsi</label>
                <textarea name="teks" id="teks" cols="30" rows="10" class="form-control"
                    placeholder="Deskripsi tempat"><?= set_value('teks'); ?></textarea>
                <small class="text-danger"><?= form_error('teks'); ?></small>
            </div>
            <div class="form-group">
                <label for="website">website</label>
                <input type="text" class="form-control" id="website" name="website"
                    placeholder="kosongkan jika tidak ada" value="<?= set_value("website"); ?>">
            </div>
            <div class="form-group">
                <label for="instagram">instagram</label>
                <input type="text" class="form-control" id="instagram" name="instagram"
                    placeholder="kosongkan jika tidak ada" value="<?= set_value("instagram"); ?>">
            </div>
            <div class="form-group">
                <label for="kategori">kategori</label>
                <select class="form-control" name="kategori" id="kategori">
                    <?php foreach ($kategori as $kat) : ?>
                    <option value="<?= $kat['id']; ?>"><?= $kat['nama']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <img src="" class="img-preview" style="max-width: 200px;">
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