<div class="clearfix"></div>
<div class="page-title">
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <h3>Загальна інформація</h3>
        </div>
    </div>
</div>

<div class="clearfix"></div>

<div class="">
    <div class="x_panel">
        <div class="x_content">
            
            <div class="row">
                <div class="col-12">
                    <div class="jumbotron">
                        <h1 class="display-4">Привіт Бро!</h1>
                        <p class="lead">Якщо ти вперше відкриваєш адмінку то запрошую подивитись сторінку допомоги )</p>
                        <hr class="my-4">
                        <p>На ній ти знайдеш підказки як користуватись адмінкою, додавати походи, сторінки та інше</p>
                        <p class="lead">
                            <a class="btn btn-primary btn-lg" href="<?= site_url('/admin/help') ?>" role="button"><i class="glyphicon glyphicon-question-sign"></i> Сторінка допомоги</a>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6">
                    <div class="tile-stats" data-toggle="tooltip" data-placement="top" title="Загальна кількість / З них не активних">
                        <div class="icon"><i class="fa fa-area-chart"></i></div>
                        <div class="count"><?= $carpatian_count ?> / <?= $not_active_carpatian_count ?></div>
                        <h3><a href="<?= site_url('/admin/hike/carpatian') ?>">Карпати</a></h3>
                        <p>Кількість походів</p>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6">
                    <div class="tile-stats" class="tile-stats" data-toggle="tooltip" data-placement="top" title="Загальна кількість / З них не активних">
                        <div class="icon"><i class="fa fa-plane"></i></div>
                        <div class="count"><?= $foreign_count ?> / <?= $not_active_foreign_count ?></div>
                        <h3><a href="<?= site_url('/admin/hike/foreighn') ?>">Закордон</a></h3>
                        <p>Кількість походів</p>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-plane"></i></div>
                        <div class="count"><?= $additional_pages ?></div>
                        <h3><a href="<?= site_url('/admin/dynamic/add') ?>">Допоміжні</a></h3>
                        <p>Кількість допоміжних сторінок</p>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-eye"></i></div>
                        <div class="count"><?= $all_count ?></div>
                        <h3>Переглядів</h3>
                        <p>Всіх сторінок сайту</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Останні відвідування</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <ul class="list-unstyled timeline">
                                <?php if(empty($logs)) : ?>
                                <h3>Поки немає відвідувань</h3>
                                <?php endif ?>
                                <?php foreach ($logs as $log) : ?>
                                <li>
                                    <div class="block">
                                        <div class="tags">
                                            <div class="tag">
                                                <span>
                                                    <?php if ($log['type'] === 'carpatian') : ?>
                                                    Карпати
                                                    <?php elseif ($log['type'] === 'foreign') : ?>
                                                    Закордон
                                                    <?php else : ?>
                                                    Сторінка
                                                    <?php endif ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="block_content">
                                            <h2 class="title">
                                                <a href="<?= $log['url'] ?>" target="_blank"><?= $log['title'] ?></a>
                                            </h2>
                                            <div class="byline">
                                                <span><?= $log['created_at'] ?></span>
                                            </div>
                                            <p class="excerpt">
                                                <?= $log['user_data'] ?><br>
                                                Переглядів цієї сторінки: 
                                                <b><?= get_url_view_count($log['url'], 'day') ?></b> (день), 
                                                <b><?= get_url_view_count($log['url'], 'week') ?></b> (тиждень), 
                                                <b><?= get_url_view_count($log['url'], 'month') ?></b> (місяць), 
                                                <b><?= get_url_view_count($log['url']) ?></b> (всього)
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach ?>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>