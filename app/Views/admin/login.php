<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Привіт Бро! | <?= $site_name ?></title>

        <!-- Bootstrap -->
        <link href="<?= base_url('/padmin/vendors/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?= base_url('/padmin/vendors/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
        <!-- NProgress -->
        <link href="<?= base_url('/padmin/vendors/nprogress/nprogress.css') ?>" rel="stylesheet">
        <!-- Animate.css -->
        <link href="<?= base_url('/padmin/vendors/animate.css/animate.min.css') ?>" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="<?= base_url('/padmin/css/custom.min.css') ?>" rel="stylesheet">
    </head>

    <body class="login">
        <div>
            <a class="hiddenanchor" id="signup"></a>

            <div class="login_wrapper">
                <div class="animate form login_form">
                    <section class="login_content">
                        <?= form_open('') ?>
                        <h1>Авторизація</h1>
                        <?php if (!empty($message)) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $message ?>
                        </div>
                        <?php endif ?>
                        <div>
                            <input name="login" type="text" class="form-control" placeholder="Логін" required="required" />
                        </div>
                        <div>
                            <input name="password" type="password" class="form-control" placeholder="Пароль" required="required" />
                        </div>
                        <div>
                            <button class="btn btn-default submit" href="index.html">Увійти</button>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">
                            <p class="change_link">Не заходить?
                                <a href="https://t.me/KsushaKravchuk" target="_blank" class="to_register"> Повідомьте </a>
                            </p>

                            <div class="clearfix"></div>
                            <br />

                            <div>
                                <h1><i class="fa fa-globe"></i> Привіт Бро!</h1>
                                <p>Розробка Oksy Developer, 2023</p>
                            </div>
                        </div>
                        <?= form_close() ?>
                    </section>
                </div>

                <div id="register" class="animate form registration_form">
                    <section class="login_content">
                        <form>
                            <h1>Create Account</h1>
                            <div>
                                <input type="text" class="form-control" placeholder="Username" required="" />
                            </div>
                            <div>
                                <input type="email" class="form-control" placeholder="Email" required="" />
                            </div>
                            <div>
                                <input type="password" class="form-control" placeholder="Password" required="" />
                            </div>
                            <div>
                                <a class="btn btn-default submit" href="index.html">Submit</a>
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">
                                <p class="change_link">Already a member ?
                                    <a href="#signin" class="to_register"> Log in </a>
                                </p>

                                <div class="clearfix"></div>
                                <br />

                                <div>
                                    <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                                    <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 4 template. Privacy and Terms</p>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </body>
</html>
