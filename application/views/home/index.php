<div class="container my-5" id="home">
    <h4>Pilih berdasarkan</h4>
    <div class="btn-group flex-wrap " role="group" id="nav-kategori">
        <a class="btn btn-sm btn-outline-primary mb-1 mr-1 mr-md-0" href="<?= base_url(); ?>" role="button">All</a>
        <?php foreach ($kategori as $kat) : ?>
        <a class="btn btn-sm btn-outline-primary mb-1 mr-1 mr-md-0 "
            href="<?= base_url(); ?>home/by_kategori/<?= $kat['id']; ?>" role="button"><?= $kat['nama']; ?></a>
        <?php endforeach; ?>
    </div>


    <div class="data my-5">
        <!-- jika tidak ada data untuk di tampilkan -->
        <?php if ($datas === []) : ?>
        <h2 class="text-center text-danger "> Belum ada datanya nih :( </h2>
        <?php endif; ?>


        <?php foreach ($datas as $data) : ?>

        <div class="card mb-5">
            <div class="row">
                <div class="col-md-4">
                    <img src="<?= base_url(); ?>image/thumbnail/thumb_<?= $data['foto']; ?>" class="img-fluid">
                </div>
                <div class="col-md-8">
                    <h4 class="mt-3 mt-md-0 text-capitalize font-weight-bolder"><?= $data['tempat']; ?></h4>
                    <p class="text-justify text-md-left"><?= word_limiter($data['teks'], 50); ?></p>

                    <a class="btn btn-primary btn-sm" href="<?= $data['instagram']; ?>" role="button">
                        <i class="material-icons align-middle mr-1">camera</i>
                        Instagram
                    </a>

                    <a class="btn btn-primary btn-sm" href="<?= $data['website']; ?>" target="blank" role="button">
                        <i class="material-icons align-middle mr-1">directions</i>
                        lokasi
                    </a>

                    <?php if ($this->session->dahLogin) : ?>
                    <br>
                    <a class="btn btn-warning btn-sm mt-2" href="<?= base_url(); ?>home/edit/<?= $data['id']; ?>"
                        target="blank" role="button">
                        edit
                    </a>
                    <a class="btn btn-danger btn-sm mt-2" href="<?= base_url(); ?>home/hapus/<?= $data['id']; ?>"
                        role="button">
                        hapus
                    </a>
                    <?php endif; ?>

                </div>
            </div>
        </div>

        <?php endforeach; ?>

    </div>
    <!-- penutup div data -->


    <?= $this->pagination->create_links(); ?>

</div>
<div class="section bg-primary text-white" id="about">
    <div class="mt-5 container pt-5">
        <div class="row">
            <div class="col-md-7">
                <h4 class="text-center mb-5">About</h4>
                <p>project ini terinspirasi oleh web <span><a
                            class="text-decoration-none font-italic font-weight-bolder"
                            href="https://littlemakassar.com/">littemakassar.com</a></span> website ini di buat
                    menggunakan <span><a class="text-decoration-none font-italic font-weight-bolder"
                            href="https://getbootstrap.com/">bootstrap</a></span> dan
                    framework <span><a class="text-decoration-none font-italic font-weight-bolder"
                            href="https://codeigniter.com/">codeigniter</a></span>. Website ini di buat bertujuan untuk
                    memuat informasi mengenai tempat nongkrong atau destinasi wisata di sekitaran tegal, kamu dapat
                    dengan mudah
                    menambahkan
                    data pada website ini <span><a class="text-decoration-none font-italic font-weight-bolder"
                            href="<?= base_url('home/tambah'); ?>">disini</a></span> jika menurutmu ada tempat nongkrong
                    atau
                    lokasi wisata yang wajib di kunjungi jika sedang berada di tegal
                </p>
            </div>
            <div class="mt-5 mt-md-0 col-md-4 offset-md-1">
                <h4 class="text-center mb-5">Contact Me</h4>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="email">email</label>
                        <input type="text" name="email" id="email" class="form-control form-control-sm"
                            placeholder="email" value="<?= set_value('email'); ?>">
                        <small class="text-danger"><?= form_error('email'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="pesan">pesan</label>
                        <textarea name="pesan" id="pesan" rows="3" placeholder="Pesanmu"
                            class="form-control form-control-sm"><?= set_value('pesan'); ?></textarea>
                        <small class="text-danger"><?= form_error('pesan'); ?></small>
                    </div>

                    <button type="submit" class="btn btn-success btn-sm float-right">kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="sweetalert-box" data-target="<?= $this->session->flashdata('message'); ?>"></div>