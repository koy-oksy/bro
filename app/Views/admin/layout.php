<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{title}</title>

        <!-- Bootstrap -->
        <link href="{vendors}/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{vendors}/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="{vendors}/nprogress/nprogress.css" rel="stylesheet">
        <!-- jQuery custom content scroller -->
        <link href="{vendors}/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>
	<!-- Switchery -->
        <link href="{vendors}/switchery/dist/switchery.min.css" rel="stylesheet">
        
        <!-- Custom Theme Style -->
        <link href="{css}/custom.min.css" rel="stylesheet">

        <link href="{vendors}/pnotify/dist/pnotify.css" rel="stylesheet">

        <style id="style2" type="text/css"></style>
        <link id="theme1" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/vs2015.min.css" rel="stylesheet" />

    </head>

    <body class="nav-md footer_fixed">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Welcome, Bro!</span></a>
                        </div>

                        <div class="clearfix"></div>

                        <!-- menu profile quick info -->
                        <div class="profile clearfix">
                            <div class="profile_pic">
                                <img src="{img}/img.jpg" alt="..." class="img-circle profile_img">
                            </div>
                            <div class="profile_info">
                                <span>Welcome,</span>
                                <h2>Admin</h2>
                            </div>
                        </div>
                        <!-- /menu profile quick info -->

                        <br />

                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <h3>Загальне</h3>
                                <ul class="nav side-menu">
                                    <li>
                                        <a href="{admin}/home"><i class="fa fa-home"></i> Дім</a>
                                    </li>
                                    <li><a><i class="fa fa-edit"></i> Сторінки <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li class="active"><a>Головна<span class="fa fa-chevron-down"></span></a>
                                                <ul class="nav child_menu" style="display: block;">
                                                    <li class="sub_menu">
                                                        <a href="{admin}/main">Html</a>
                                                    </li>
                                                    <li>
                                                        <a href="{admin}/main/slider">Slider</a>
                                                    </li>
                                                    <li>
                                                        <a href="{admin}/main/counters">Counters</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="{admin}/useful">Корисне</a></li>
                                            <li><a href="{admin}/contacts">Контакти</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="menu_section">
                                <h3>Каталог</h3>
                                <ul class="nav side-menu">
                                    <li><a><i class="fa fa-table"></i> Походи <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="{admin}/hike/carpatian">Походи в Карпати</a></li>
                                            <li><a href="{admin}/hike/foreign">Мандрівки закордон</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>

                            <div class="menu_section">
                                <h3>Сайт</h3>
                                <ul class="nav side-menu">
                                    <li>
                                        <a href="{admin}/settings"><i class="fa fa-gear"></i> Налаштування</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- /sidebar menu -->

                        <!-- /menu footer buttons -->
                        <div class="sidebar-footer hidden-small">
                            <a data-toggle="tooltip" data-placement="top" title="Налаштування">
                                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="Lock">
                                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="Вийти" href="login.html">
                                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                            </a>
                        </div>
                        <!-- /menu footer buttons -->
                    </div>
                </div>

                <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                        <nav class="nav navbar-nav">
                            <ul class="navbar-right">
                                <li class="nav-item dropdown open" style="padding-left: 15px;">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                        <img src="{img}/img.jpg" alt="">Admin
                                    </a>
                                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item"  href="javascript:;">Допомога</a>
                                        <a class="dropdown-item"  href="login.html"><i class="fa fa-sign-out pull-right"></i> Вийти</a>
                                    </div>
                                </li>

                                <li role="presentation" class="nav-item dropdown open">
                                    <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-envelope-o"></i>
                                        <span class="badge bg-green">6</span>
                                    </a>
                                    <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                                        <li class="nav-item">
                                            <a class="dropdown-item">
                                                <span class="image"><img src="{img}/img.jpg" alt="Profile Image" /></span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="dropdown-item">
                                                <span class="image"><img src="{img}/img.jpg" alt="Profile Image" /></span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="dropdown-item">
                                                <span class="image"><img src="{img}/img.jpg" alt="Profile Image" /></span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="dropdown-item">
                                                <span class="image"><img src="{img}/img.jpg" alt="Profile Image" /></span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <div class="text-center">
                                                <a class="dropdown-item">
                                                    <strong>See All Alerts</strong>
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /top navigation -->

                <!-- page content -->
                <div class="right_col" role="main">
                    {!content!}
                </div>
                <!-- /page content -->

                <!-- footer content -->
                <footer>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
        </div>

        <!-- jQuery -->
        <script src="{vendors}/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="{vendors}/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <!-- FastClick -->
        <script src="{vendors}/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="{vendors}/nprogress/nprogress.js"></script>
        <!-- jQuery custom content scroller -->
        <script src="{vendors}/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
        <!-- Switchery -->
        <script src="{vendors}/switchery/dist/switchery.min.js"></script>
        
        <script src="{vendors}/pnotify/dist/pnotify.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/highlight.min.js" type="text/javascript"></script>

        <script src="{vendors}/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="{vendors}/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="{vendors}/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="{vendors}/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
        <script src="{vendors}/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="{vendors}/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="{vendors}/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="{vendors}/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
        <script src="{vendors}/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="{vendors}/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="{vendors}/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
        <script src="{vendors}/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
        
        
        <!-- Custom Theme Scripts -->
        <script src="{js}/custom.min.js"></script>
        
        {if $message}
        <script type="text/javascript">
            jQuery(document).ready(function () {
                new PNotify({
                    title: '',
                    text: "{!message!}",
                    styling: 'bootstrap3',
                });
            });
        </script>
        {endif}
    </body>
</html>