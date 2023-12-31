<div class="x_content">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <input type="hidden" id="image-type" value="hike" />
                    <h2>Похід <?= $hike->caption ?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                    <p><a target="_blank" href="<?= site_url($hike->hike_type . '-hikes/' . $hike->alias) ?>"><?= site_url($hike->hike_type . '-hikes/' . $hike->alias) ?></a></p>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <?php foreach ($download_src as $image) : ?>
                            <div class="col-md-3 col-sm-6 py-3">
                                <?php if ($hike->image_name === $image['download_src']) : ?>
                                    <div class="position-absolute m-2 px-2 py-1 btn btn-sm bg-info text-white"
                                         data-toggle="tooltip" data-placement="bottom" title="Це фото буде відображатись на сторінці переліку походів">
                                        <i class="fa fa-check-square-o"></i> Обкладинка
                                    </div>
                                <?php else : ?>
                                    <div class="position-absolute p-2">
                                        <a href="<?= site_url("admin/hike/" . $hike->hike_type . "/setposter?hike=" . $hike->alias . "&set_poster=" . $image['id']) ?>" class="btn btn-sm btn-light">
                                            Зробити обкладинкою
                                        </a>
                                    </div>
                                <?php endif ?>
                                <img image_id="<?= $image['id'] ?>" loaded="<?= $image['loaded'] ? "1" : "0" ?>" src="<?= $image['loaded'] ? site_url('image' . modify_image_name_url($image['download_src'], 'horizontal_')) : base_url('img/loading.gif') ?>" class="img-fluid"/>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <?= form_open_multipart('', ['class' => 'form-horizontal form-label-left']) ?>
                    <input type="hidden" name="id" value="<?= $hike->id ?>"/>
                    <div class="item form-group">
                        <label for="active-hike" class="col-form-label col-md-3 col-sm-2 label-align">
                            Включити відображення у списку
                        </label>
                        <div class="col-md-9 col-sm-10">
                            <label data-toggle="tooltip" data-placement="top" title="Перемикач який відповідає за показ походу для відвідувача">
                                <input id="active-hike" name="active" type="checkbox" class="js-switch" <?= $hike->active ? 'checked' : '' ?> />
                            </label>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-2 label-align" for="caption">
                            Назва <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-10">
                            <input type="text" id="caption" name="caption" required="required" class="form-control" value="<?= $hike->caption ?>"
                                   data-toggle="tooltip" data-placement="top" title="Назва походу яку бачить відвідувач сайту">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-2 label-align" for="alias">
                            Аліас <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-10">
                            <input type="text" id="alias" name="alias" required="required" class="form-control" value="<?= $hike->alias ?>"
                                   data-toggle="tooltip" data-placement="top" title="Цей текст використовується в посиланні на похід. Не допускаються спеціальні символи крім '-', пробіли">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-2 label-align" for="seo-description">
                            SEO Description
                        </label>
                        <div class="col-md-9 col-sm-10">
                            <textarea id="seo-description" name="description" class="form-control" rows="5"
                                      title="Опис сторінки з походом який необхідний для SEO просування" 
                                      data-toggle="tooltip" data-placement="top" 
                                      ><?= $hike->description ?></textarea>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label for="days" class="col-form-label col-md-3 col-sm-2 label-align">
                            Днів
                        </label>
                        <div class="col-md-9 col-sm-10">
                            <input id="days" class="form-control" type="text" name="days" value="<?= $hike->days ?>"
                                   data-toggle="tooltip" data-placement="top" title="Кількість днів на які розрахован похід">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label for="dates" class="col-form-label col-md-3 col-sm-2 label-align">
                            Дати
                        </label>
                        <div class="col-md-9 col-sm-10">
                            <input id="dates" class="form-control" type="text" name="dates" value="<?= $hike->dates ?>"
                                   data-toggle="tooltip" data-placement="top" title="Дата або перелік дат походу">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label for="format" class="col-form-label col-md-3 col-sm-2 label-align">
                            Формат
                        </label>
                        <div class="col-md-9 col-sm-10">
                            <input id="format" class="form-control" type="text" name="format" value="<?= $hike->format ?>"
                                   data-toggle="tooltip" data-placement="top" title="Формат проведення походу">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label for="price" class="col-form-label col-md-3 col-sm-2 label-align">
                            Вартість
                        </label>
                        <div class="col-md-9 col-sm-10">
                            <input id="price" class="form-control" type="text" name="price" value="<?= $hike->price ?>"
                                   data-toggle="tooltip" data-placement="top" title="Вартість участі в поході">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label for="total_price" class="col-form-label col-md-3 col-sm-2 label-align">
                            Загальний бюджет подорожі
                        </label>
                        <div class="col-md-9 col-sm-10">
                            <input id="total_price" class="form-control" type="text" name="total_price" value="<?= $hike->total_price ?>"
                                   data-toggle="tooltip" data-placement="top" title="Загальна вартість походу">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label for="participants" class="col-form-label col-md-3 col-sm-2 label-align">
                            Кількість учасників
                        </label>
                        <div class="col-md-9 col-sm-10">
                            <input id="participants" class="form-control" type="text" name="participants" value="<?= $hike->participants ?>"
                                   data-toggle="tooltip" data-placement="top" title="Кількість учасників">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label for="distance" class="col-form-label col-md-3 col-sm-2 label-align">
                            Протяжність
                        </label>
                        <div class="col-md-9 col-sm-10">
                            <input id="distance" class="form-control" type="text" name="distance" value="<?= $hike->distance ?>"
                                   data-toggle="tooltip" data-placement="top" title="Дистанція, кілометраж">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label for="route" class="col-form-label col-md-3 col-sm-2 label-align">
                            Маршрут
                        </label>
                        <div class="col-md-9 col-sm-10">
                            <input id="route" class="form-control" type="text" name="route" value="<?= $hike->route ?>"
                                   data-toggle="tooltip" data-placement="top" title="Короткий опис маршруту">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label for="route" class="col-form-label col-md-3 col-sm-2 label-align">
                            Складність
                        </label>
                        <div class="col-md-9 col-sm-10">
                            <input id="route" class="form-control" type="text" name="difficulty" value="<?= $hike->difficulty ?>"
                                   data-toggle="tooltip" data-placement="top" title="Рівень складності маршруту">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-2 label-align" for="parsed-url">
                            Звідки скачали
                        </label>
                        <div class="col-md-9 col-sm-10">
                            <input disabled="disabled" type="text" id="parsed-url" class="form-control" value="<?= $hike->parsed_url ?>"
                                   data-toggle="tooltip" data-placement="top" title="Посилання по якій був завантажений похід">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="item form-group">
                        <div class="col-md-9 col-sm-10 offset-md-3">
                            <a href="<?= site_url('admin/hike/' . $hike->hike_type) ?>" 
                               class="btn btn-secondary" type="button"
                               data-toggle="tooltip" data-placement="top" title="Повернутись до списку походів"
                               >
                                <i class="fa fa-arrow-left"></i> Назад
                            </a>
                            <a href="<?= site_url('admin/hike/' . $hike->hike_type . '/rescan' . '?hike=' . $hike->alias) ?>" 
                               class="btn btn-danger" type="reset" 
                               data-toggle="tooltip" data-placement="top" title="Система ще раз просканує похід з telegra.ph та оновить всі данні"
                               onClick="if (confirm('Це призведе до перезапису даних походу, поїхали?')) {
                                                return true;
                                            } else {
                                                event.stopPropagation();
                                                event.preventDefault();
                                            }
                                            ;"
                               >
                                <i class="fa fa-flash"></i> Пересканувати
                            </a>
                            <button class="btn btn-warning" type="reset" 
                                    data-toggle="tooltip" data-placement="top" title="Перезавантажить сторінку, скинувши всі зроблені та не збережені зміни"
                                    onClick="if (confirm('Скинути всі останні зміни?')) {
                                                location.reload();} else {
                                                event.stopPropagation();
                                                event.preventDefault();
                                            }
                                            ;"
                                    >
                                <i class="fa fa-rotate-left"></i> Скинути
                            </button>
                            <button type="submit" class="btn btn-primary"
                                    data-toggle="tooltip" data-placement="top" title="Зберегти зроблені зміни"
                                    >
                                <i class="fa fa-save"></i> Зберегти
                            </button>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="clearfix"></div>
