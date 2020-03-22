<!doctype html>
<html lang="en">

<head>
    <title>Sekitar Tegal</title>
    <!-- google material icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/flatly.bootstrap.min.css'); ?>">

    <!-- my css -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url(); ?>">Seputar Tegal</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-item nav-link" href="<?= base_url('home/tambah'); ?>">Tambah data</a>
                    <a class="nav-item nav-link" href="<?= base_url(); ?>home#about">About</a>

                    <!-- hanya akan muncul jika admin sudah login -->
                    <?php if ($this->session->dahLogin) : ?>
                    <a class="nav-item nav-link" href="<?= base_url('kategori'); ?>">kategori</a>
                    <a class="nav-item nav-link" href="<?= base_url('admin/logout'); ?>">Log out</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>