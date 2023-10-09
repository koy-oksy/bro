<div class="container mt-5">

    <?php $validation = \Config\Services::validation(); ?>
    <form action="<?php echo base_url(); ?>/StaticPage/store" method="post">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control">
            <!-- Error -->
            <?php if ($validation->getError('name')) { ?>
                <div class='alert alert-danger mt-2'>
                    <?= $error = $validation->getError('name'); ?>
                </div>
            <?php } ?>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control">
            <!-- Error -->
            <?php if ($validation->getError('email')) { ?>
                <div class='alert alert-danger mt-2'>
                    <?= $error = $validation->getError('email'); ?>
                </div>
            <?php } ?>
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control">
            <!-- Error -->
            <?php if ($validation->getError('phone')) { ?>
                <div class='alert alert-danger mt-2'>
                    <?= $error = $validation->getError('phone'); ?>
                </div>
            <?php } ?>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
    </form>
</div>