<div class="x_content">
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Похід <?= $hike->caption ?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a class="dropdown-item" href="#">Settings 1</a>
                                </li>
                                <li><a class="dropdown-item" href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <?php foreach ($download_src as $image) : ?>
                        <div class="col-md-3 col-sm-6 py-3">
                            <?php if ($hike->image_name === $image['download_src']) : ?>
                            <div class="position-absolute p-3 btn btn-sm"><i class="fa fa-check-square-o"></i> Обкладинка</div>
                            <?php else : ?>
                            <div class="position-absolute p-2">
                                <a href="#" class="btn btn-sm btn-light">Зробити обкладинкою</a>
                            </div>
                            <?php endif ?>
                            <img image_id="<?= $image['id'] ?>" image_src="" src="<?= $image['loaded'] ? site_url('image' . modify_image_name_url($image['download_src'], 'horizontal_')) : base_url('img/loading.gif') ?>" class="img-fluid"/>
                        </div>
                        <?php endforeach ?>
                    </div>
                    <?= form_open_multipart('', ['class' => 'form-horizontal form-label-left']) ?>
                        <input type="hidden" name="id" value="<?= $hike->id ?>"/>
                        <div class="item form-group">
                            <label for="active-hike" class="col-form-label col-md-3 col-sm-3 label-align">
                                Активний
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <label>
                                    <input id="active-hike" name="active" type="checkbox" class="js-switch" <?= $hike->active ? 'checked' : '' ?> />
                                </label>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="caption">
                                Назва <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="caption" name="caption" required="required" class="form-control" value="<?= $hike->caption ?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="alias">
                                Аліас <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="alias" name="alias" required="required" class="form-control" value="<?= $hike->alias ?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="seo-description">
                                SEO Description
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <textarea id="seo-description" name="description" class="form-control" rows="5"><?= $hike->description ?></textarea>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="days" class="col-form-label col-md-3 col-sm-3 label-align">
                                Днів
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="days" class="form-control" type="text" name="days" value="<?= $hike->days ?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="dates" class="col-form-label col-md-3 col-sm-3 label-align">
                                Дати
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="dates" class="form-control" type="text" name="dates" value="<?= $hike->dates ?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="format" class="col-form-label col-md-3 col-sm-3 label-align">
                                Формат
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="format" class="form-control" type="text" name="format" value="<?= $hike->format ?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="price" class="col-form-label col-md-3 col-sm-3 label-align">
                                Ціна
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="price" class="form-control" type="text" name="price" value="<?= $hike->price ?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="participants" class="col-form-label col-md-3 col-sm-3 label-align">
                                Учасники
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="participants" class="form-control" type="text" name="participants" value="<?= $hike->participants ?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="distance" class="col-form-label col-md-3 col-sm-3 label-align">
                                Дистанція
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="distance" class="form-control" type="text" name="distance" value="<?= $hike->distance ?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="route" class="col-form-label col-md-3 col-sm-3 label-align">
                                Маршрут
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="route" class="form-control" type="text" name="route" value="<?= $hike->route ?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="parsed-url">
                                Звідки скачали
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="parsed-url" class="form-control" value="<?= $hike->parsed_url ?>">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <a href="<?= site_url('admin/hike/' . $hike->hike_type) ?>" class="btn btn-secondary" type="button">
                                    <i class="fa fa-arrow-left"></i> Назад
                                </a>
                                <button class="btn btn-warning" type="reset" onClick="if (confirm('Delete selected item?')){location.reload();}else{event.stopPropagation(); event.preventDefault();};">
                                    <i class="fa fa-rotate-left"></i> Скинути
                                </button>
                                <button type="submit" class="btn btn-primary">
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
