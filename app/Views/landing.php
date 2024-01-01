
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title><?= get_config('site-name') ?> - Вітання!</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="/favicon.ico" rel="icon">
        <link href="/favicon.ico" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="<?= base_url('/lassets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?= base_url('/lassets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="<?= base_url('/lassets/css/style.css') ?>" rel="stylesheet">

        <!-- =======================================================
        * Template Name: Maundy
        * Updated: Sep 18 2023 with Bootstrap v5.3.2
        * Template URL: https://bootstrapmade.com/maundy-free-coming-soon-bootstrap-theme/
        * Author: BootstrapMade.com
        * License: https://bootstrapmade.com/license/
        ======================================================== -->
    </head>

    <body>

        <!-- ======= Header ======= -->
        <header id="header" class="d-flex align-items-center">
            <div class="container d-flex flex-column align-items-center">
                <h1><?= get_config('site-name') ?></h1>
                <h2>Ми працюємо над сайтом прямо зараз щоб запросити Вас до нових цікавих пригод у горах!</h2>
                
                <div class='row countdown'>
                    <?php foreach ($widget_entries as $widget) : ?>
                        <div class='widg1 col-sm-12 col-md-6 col-lg-3'>
                            <div class='widg2'>
                                <h3><?= $widget['max_number'] ?></h3>
                                <h4><?= $widget['text'] ?></h4>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
                
                

                <div class="subscribe">
                    <h4>Наші контакти:</h4>
                </div>

                <div class="social-links text-center">
                    <a href="https://www.instagram.com/bro.tour/" class="instagram" target="_blank"><i class="bi bi-instagram"></i></a>
                    <a href="https://www.facebook.com/brotour.agency" class="facebook" target="_blank"><i class="bi bi-facebook"></i></a>

                    <a href="https://www.youtube.com/channel/UCfVL1QD2E-GUJROCgU12sOg" class="youtube" target="_blank"><i class="bi bi-youtube"></i></a>
                    <a href="https://www.tiktok.com/@bro.tour" class="tiktok" target="_blank"><i class="bi bi-tiktok"></i></a>
                </div>

            </div>
        </header><!-- End #header -->

        <!-- ======= Footer ======= -->
        <footer id="footer">
            <div class="container">
                <div class="copyright">
                    &copy; 2023 Brotour - Всі права захищено згідно законодавства України.
                </div>
                <div class="credits">
                    <a href="https://oksy.org.ua/" target="blank">Site development</a>
                </div>
            </div>
        </footer><!-- End #footer -->

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Vendor JS Files -->
        <script src="<?= base_url('/lassets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

    </body>

</html>