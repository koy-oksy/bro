<!DOCTYPE html>
<html lang="ua" data-lt-installed="true">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>{title}</title>
    <meta name="description" content="{description}">
    <meta name="tags" content="{tags}">
    <meta name="robots" content="all,follow">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="/favicon.ico" />
    <link href="{css}/css.css" rel="stylesheet">
    <link rel="stylesheet" href="{css}/style.css">
    <link rel="stylesheet" href="{css}/bootstrap.min.css">
    <link rel="stylesheet" href="{css}/bootstrap-datepicker.css">
    <link rel="stylesheet" href="{css}/jquery.fancybox.min.css">
    <link rel="stylesheet" href="{css}/owl.carousel.min.css">
    <link rel="stylesheet" href="{css}/owl.theme.default.min.css">
    <link rel="stylesheet" href="{css}/flaticon.css">
    <link rel="stylesheet" href="{css}/aos.css">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{css}/style_2.css">
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300" data-aos-easing="slide" data-aos-duration="800" data-aos-delay="0">
    <div class="site-wrap" id="home-section">
        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>
        <header class="site-navbar site-navbar-target" role="banner">
            <div class="container">
                <div class="row align-items-center position-relative">
                    <div class="col-3 ">
                        <div class="site-logo">
                            <a href="/" class="font-weight-bold">
                                <img src="{img}/bro.png" alt="Bro" class="img-fluid">
                            </a>
                        </div>
                    </div>
                    <div class="col-9  text-right">
                        <span class="d-inline-block d-lg-none"><a href="/" class="text-white site-menu-toggle js-menu-toggle py-5 text-white"><span class="icon-menu h3 text-white"></span></a></span>
                        <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
                            <ul class="site-menu main-menu js-clone-nav ml-auto">
                                {menu_entries}
                                <li class="{active}"><a href="{url}" class="nav-link">{name}</a></li>
                                {/menu_entries}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>

        {!content!}

        <footer class="site-footer bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <img src="{img}/brofooter.png">
                    </div>
                    <div class="col-lg-3">
                        <h2 class="footer-heading mb-3">Знижки на спорядження від наших друзів та партнерів</h2>
                        <div class="row">
                            <div class="col-4 gal_col">
                                <a href="https://www.instagram.com/fest.food.mission/" target="_blank"><img src="{img}/fest.webp" alt="Image" class="img-fluid"></a>
                            </div>
                            <div class="col-4 gal_col">
                                <a href="https://www.instagram.com/northfinder.in.ua/" target=" _blank"><img src="{img}/northfinder.jpg" alt="Image" class="img-fluid"></a>
                            </div>
                            <div class="col-4 gal_col">
                                <a href="https://www.instagram.com/rockfront.ua/" target="_blank"><img src="{img}/rockfront.webp" alt="Image" class="img-fluid"></a>
                            </div>
                            <div class="col-4 gal_col">
                                <a href="https://www.instagram.com/gorgany/" target="_blank"><img src="{img}/gorgany.webp" alt="Image" class="img-fluid"></a>
                            </div>
                            <div class="col-4 gal_col">
                                <a href="https://www.instagram.com/vernadsky_ua/" target="_blank"><img src="{img}/vernadsky.webp" alt="Image" class="img-fluid"></a>
                            </div>
                            <div class="col-4 gal_col">
                                <a href="https://www.instagram.com/m_maklay_shop/" target="_blank"><img src="{img}/maklay.webp" alt="Image" class="img-fluid"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-6 ml-auto">
                                <h2 class="footer-heading mb-4">Слідкуйте за нами в соціальних мережах</h2>
                                <p>
                                    <a href="https://instagram.com/bro.tour?igshid=MzRlODBiNWFlZA==" target="_blank">
                                        Instagram
                                    </a>
                                </p>

                                <p>
                                    <a href="https://www.facebook.com/brotour.agency" target="_blank">
                                        Facebook
                                    </a>
                                </p>
                                <p>
                                    <a href="https://www.youtube.com/channel/UCfVL1QD2E-GUJROCgU12sOg" target="blank">
                                        Youtube
                                    </a>
                                </p>
                                <p>
                                    <a href="https://www.tiktok.com/@bro.tour?_t=8g3m5OZlD7d&_r=1" target="blank">
                                        Tiktok
                                    </a>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row pt-5 mt-5 text-center">
                    <div class="col-md-12">
                        <div class="border-top pt-5">
                            <p>© 2023 Brotour - Всі права захищені
                            </p>
                            <p> <a href="https://oksy.org.ua/" target="blank">Site development</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="{js}/jquery-3.3.1.min.js"></script>
    <script src="{js}/jquery-migrate-3.0.0.js"></script>
    <script src="{js}/popper.min.js"></script>
    <script src="{js}/bootstrap.min.js"></script>
    <script src="{js}/owl.carousel.min.js"></script>
    <script src="{js}/jquery.sticky.js"></script>
    <script src="{js}/jquery.waypoints.min.js"></script>
    <script src="{js}/jquery.animateNumber.min.js"></script>
    <script src="{js}/jquery.fancybox.min.js"></script>
    <script src="{js}/jquery.stellar.min.js"></script>
    <script src="{js}/jquery.easing.1.3.js"></script>
    <script src="{js}/bootstrap-datepicker.min.js"></script>
    <script src="{js}/isotope.pkgd.min.js"></script>
    <script src="{js}/jquery.counterup.min.js"></script>
    <script src="{js}/aos.js"></script>
    <script src="{js}/main.js"></script>
</body>

</html>