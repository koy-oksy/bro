<div class="x_content">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Налаштування сайту</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                <?= form_open(site_url('/admin/settings'), ['class' => 'form-horizontal form-label-left']) ?>
                    <div class="item form-group">
                        <label for="active-hike" class="col-form-label col-md-3 col-sm-2 label-align">
                            Включити сайт
                        </label>
                        <div class="col-md-9 col-sm-10">
                            <label data-toggle="tooltip" data-placement="top" title="Перемикач який відповідає за показ сайту для відвідувача">
                                <input id="active-hike" name="site-active" type="checkbox" class="js-switch" <?= $settings['site-active'] ? 'checked' : '' ?> />
                            </label>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-2 label-align" for="caption">
                            Назва сайту<span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-10">
                            <input type="text" id="caption" name="site-name" required="required" class="form-control" value="<?= $settings['site-name'] ?>"
                                   data-toggle="tooltip" data-placement="top" title="Назва сайту яку бачить відвідувач сайту">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-2 label-align" for="caption">
                            Назва сторінки з походами по Карпатах<span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-10">
                            <input type="text" id="caption" name="carpatians-title" required="required" class="form-control" value="<?= $settings['carpatians-title'] ?>"
                                   data-toggle="tooltip" data-placement="top" title="Назва сторінки походів по Карптах яку бачить відвідувач сайту">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-2 label-align" for="caption">
                            SEO Description походи по Карпатах<span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-10">
                            <input type="text" id="caption" name="carpatians-description" required="required" class="form-control" value="<?= $settings['carpatians-description'] ?>"
                                   data-toggle="tooltip" data-placement="top" title="Потрібно для просування сайту в пошукових системах">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-2 label-align" for="caption">
                            Назва сторінки з закордонними походами<span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-10">
                            <input type="text" id="caption" name="foreign-title" required="required" class="form-control" value="<?= $settings['foreign-title'] ?>"
                                   data-toggle="tooltip" data-placement="top" title="Назва сторінки закордонних походів яку бачить відвідувач сайту">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-2 label-align" for="caption">
                            SEO Description закордонні походи<span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-10">
                            <input type="text" id="caption" name="foreign-description" required="required" class="form-control" value="<?= $settings['foreign-description'] ?>"
                                   data-toggle="tooltip" data-placement="top" title="Потрібно для просування сайту в пошукових системах">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-2 label-align" for="caption">
                            Telegram адреса для замовлення походів<span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-10">
                            <input type="text" id="caption" name="contact-telegram" required="required" class="form-control" value="<?= $settings['contact-telegram'] ?>"
                                   data-toggle="tooltip" data-placement="top" title="Користувачі будуть писати сюди">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="item form-group">
                        <div class="col-md-9 col-sm-10 offset-md-3">
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
