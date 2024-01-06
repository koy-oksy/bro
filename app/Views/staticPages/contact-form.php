<div class="ftco-blocks-cover-1">
    <div class="site-section-cover overlay" style="background-image: url('<?= $img ?>/contact_brotour.webp')">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-md-5" data-aos="fade-up">
                    <h1 class="mb-3 text-white">Контакти</h1>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="site-section">
    <div class="container">

        <div class="row justify-content-center text-center mb-5">
            <div class="col-md-10">
                <div class="heading-39101 mb-5">
                    <h3>Контакти</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 mb-5">
                <?php if (session()->has('frontend_message_controller')) : ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('frontend_message_controller'); ?>
                    </div>
                <?php endif; ?>
                <form action="<?= site_url('submit/contactFormSubmit') ?>" method="post">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="username" placeholder="Як вас звуть?" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="phone" placeholder="0ХХ-ХХХ-ХХ-ХХ" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <textarea name="text" id="" class="form-control" placeholder="Напишіть Ваше повідомлення." cols="30" rows="10" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 mr-auto">
                            <input type="submit" class="btn btn-block btn-primary text-white py-3 px-5" value="Відправити">
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div> <!-- END .site-section -->