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
                    <br />
                    <?= form_open_multipart('', ['class' => 'form-horizontal form-label-left']) ?>
                        <div class="item form-group">
                            <label for="active-hike" class="col-form-label col-md-3 col-sm-3 label-align">
                                Активний
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <label>
                                    <input id="active-hike" name="active" type="checkbox" class="js-switch" <?= $hike->active ? 'checked' : '' ?> /> Checked
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
                                <input type="text" id="seo-description" name="description" class="form-control" value="<?= $hike->description ?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="seo-tags" class="col-form-label col-md-3 col-sm-3 label-align">
                                SEO Tags
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="seo-tags" class="form-control" type="text" name="tags" value="<?= $hike->tags ?>">
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
                            <label for="image_name" class="col-form-label col-md-3 col-sm-3 label-align">
                                Обкладинка
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <img class="img-fluid" src="<?= site_url('image/' . $hike->image_name ) ?>" />
                                <input id="image_name" class="form-control" type="file" name="image_name">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="parsed_url" class="col-form-label col-md-3 col-sm-3 label-align" data-toggle="tooltip" data-placement="top" title="При вказанні цієї адреси адмінка спробує скопіювати текст та фото походу">
                                Адреса Telegram сторінки
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="parsed_url" class="form-control" type="text" name="parsed_url" placeholder="<?= $hike->parsed_url ?>">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <a href="<?= site_url('admin/hike/' . $hike->hike_type) ?>" class="btn btn-primary" type="button">Назад</a>
                                <button class="btn btn-primary" type="reset" onClick="if (confirm('Delete selected item?')){location.reload();}else{event.stopPropagation(); event.preventDefault();};">Скинути</button>
                                <button type="submit" class="btn btn-success">Зберегти</button>
                            </div>
                        </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>