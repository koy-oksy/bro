<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2><?= $hike_type == "carpatian" ? "Карпати" : "Мандрівки закордон"?><small>Список походів</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
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
                                        <th>Заголовок</th>
                                        <th><span class="d-none d-sm-block">Включений</span><span class="d-sm-none">Вкл.</span></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($hikes as $hike) : ?>
                                        <tr>
                                            <td>
                                                <a href="<?= site_url($hike->hike_type . '-hikes/' . $hike->alias) ?>" data-toggle="tooltip" data-placement="top" title="Для перегляду як виглядає похід для відвідувача тисни сюди" target="_blank">
                                                    <?= $hike->caption ?>
                                                </a>
                                                <?php if ($hike->price && $hike->dates) : ?>
                                                <br/>
                                                <?= $hike->price ?> | <?= $hike->dates ?>
                                                <?php elseif ($hike->price) : ?>
                                                <?= $hike->price ?>
                                                <?php elseif ($hike->dates) : ?>
                                                <?= $hike->dates ?>
                                                <?php endif ?>
                                            </td>
                                            <td><i class="fa <?= $hike->active ? 'fa-check' : 'fa-power-off' ?>"></i></td>
                                            <td>
                                                <a class="btn btn-secondary btn-sm" href="<?= site_url(sprintf('admin/hike/%s?hike=%s', $hike->hike_type, $hike->alias)) ?>">
                                                    <span class="d-none d-sm-block"><i class="fa fa-pencil"></i> Редагування</span><span class="d-sm-none"><i class="fa fa-pencil"></i></span>
                                                </a>
                                                <br/>
                                                <a class="btn btn-danger btn-sm" onClick="return confirm('Ви впевнені що хочете видалити цей похід?');" href="<?= site_url(sprintf('admin/hike/%s/delete?hike=%s', $hike->hike_type, $hike->alias)) ?>">
                                                    <span class="d-none d-sm-block"><i class="fa fa-trash"></i> Видалити</span><span class="d-sm-none"><i class="fa fa-trash"></i></span>
                                                </a>
                                            </td>
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
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="col-12">
                    <p>Для додавання походу вкажіть адресу сторінки Telegram, де міститься опис походу і натисність кнопку "<i class="fa fa-plus"></i> Додати!"</p>
                    <p>Система проаналізує сторінку по посиланню і скопіює звідти картинки, текст та параметри походу</p>
                    <p>Сторінка може містити вказані нижче параметри, які розпізнаються системою:</p>
                    <ul>
                        <li><b>Тривалість:</b></li>
                        <li><b>Дата:</b></li>
                        <li><b>Дати:</b></li>
                        <li><b>Формат:</b></li>
                        <li><b>Вартість:</b></li>
                        <li><b>Загальний бюджет подорожі:</b></li>
                        <li><b>Кількість учасників:</b></li>
                        <li><b>Протяжність:</b></li>
                        <li><b>Маршрут:</b></li>
                        <li><b>Складність:</b></li>
                    </ul>
                    <p>Будь ласка, зверніть увагу що всі назви параметрів на сторінці мають закінчуватись на <b>двокрапку</b> інакше система їх не побачить (але можна буде додати їх потім вручну)</p>

                </div>

                <?= form_open('', ['class' => 'form-horizontal form-label-left']) ?>
                    <div class="form-group">
                        <label class="col-sm-3 col-form-label"><b>Адреса сторінки опису походу</b></label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" class="form-control" name="parsed_url" placeholder="https://telegra.ph/...">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Додати!</button>
                                </span>
                            </div>
                        </div>
                    </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>