<div class="container my-5 pt-5">

    <div class="card col-md-4 offset-md-4 py-4 bg-primary text-white">
        <h3 class="text-center mb-4">Login</h3>

        <?php if ($this->session->flashdata('error')) : ?>
        <div class="alert alert-danger" role="alert">
            <?= $this->session->flashdata('error'); ?>
        </div>
        <?php endif; ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control"
                    value="<?= set_value('username'); ?>">
                <?php if (form_error('username')) : ?>
                <small class="text-danger font-italic"> <?= form_error('username'); ?></small>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="password">password</label>
                <input type="password" id="password" name="password" class="form-control">
                <?php if (form_error('password')) : ?>
                <small class="text-danger font-italic"> <?= form_error('password'); ?></small>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-info">submit</button>
        </form>
    </div>
</div>