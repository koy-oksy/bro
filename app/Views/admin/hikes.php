<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Список походів<small>Карпати</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <p class="text-muted font-13 m-b-30">
                                Responsive is an extension for DataTables that resolves that problem by optimising the table's layout for different screen sizes through the dynamic insertion and removal of columns from the table.
                            </p>
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Заголовок / Аліас</th>
                                        <th>Ціна</th>
                                        <th>Дати</th>
                                        <th>Активно</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($hikes as $hike) : ?>
                                        <tr>
                                            <td><?= $hike->caption ?><br><?= $hike->alias ?></td>
                                            <td><?= $hike->price ?></td>
                                            <td>1-2 грудня / 16-17 грудня / 20-21 січня / 10-11 лютого</td>
                                            <td><i class="fa <?= $hike->active ? 'fa-eye' : 'fa-power-off' ?>"></i></td>
                                            <td><a href="<?= site_url(sprintf('admin/hike/%s?hike=%s', $hike->hike_type, $hike->alias)) ?>">Редагування</a></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Додавання походів</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="col-12">
                    <p>Для додавання походу вкажіть адресу сторінки Telegram, де міститься опис походу і натисність кнопку "<i class="fa fa-plus"></i> Додати!"</p>
                    <p>Сторінка може містити вказані нижче параметри, які розпізнаються системою:</p>
                    <ul>
                        <li><b>Тривалість:</b></li>
                        <li><b>Дата:</b></li>
                        <li><b>Дати:</b></li>
                        <li><b>Формат:</b></li>
                        <li><b>Вартість:</b></li>
                        <li><b>Кількість місць:</b></li>
                        <li><b>Протяжність:</b></li>
                        <li><b>Маршрут:</b></li>
                    </ul>
                    <p>Будь ласка, зверніть увагу що всі назви параметрів на сторінці мають закінчуватись на <b>двокрапку</b> інакше система їх не побачить (але можна буде додати їх потім вручну)</p>

                </div>


                <form class="form-horizontal form-label-left">
                    <div class="form-group">
                        <label class="col-sm-3 col-form-label"><b>Адреса сторінки опису походу</b></label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" class="form-control" name="" placeholder="https://telegra.ph/...">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Додати!</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>