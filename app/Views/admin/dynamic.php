<div class="x_content">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <input type="hidden" id="image-type" value="dynamic" />
                    <h2><?= $dynamic->caption ?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                    <p><a target="_blank" href="<?= site_url('/page/' . $dynamic->alias) ?>"><?= site_url('/page/' . $dynamic->alias) ?></a></p>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <?php foreach ($download_src as $image) : ?>
                            <div class="col-md-3 col-sm-6 py-3">
                                <img image_id="<?= $image['id'] ?>" loaded="<?= $image['loaded'] ? "1" : "0" ?>" src="<?= $image['loaded'] ? site_url('image' . modify_image_name_url($image['download_src'], 'horizontal_')) : base_url('img/loading.gif') ?>" class="img-fluid"/>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <?= form_open_multipart('', ['class' => 'form-horizontal form-label-left']) ?>
                    <input type="hidden" name="id" value="<?= $dynamic->id ?>"/>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-2 label-align" for="caption">
                            Назва <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-10">
                            <input type="text" id="caption" name="caption" required="required" class="form-control" value="<?= $dynamic->caption ?>"
                                   data-toggle="tooltip" data-placement="top" title="Назва сторінки яку бачить відвідувач сайту">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-2 label-align" for="alias">
                            Аліас <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-10">
                            <input disabled="disabled" type="text" id="alias" required="required" class="form-control" value="<?= $dynamic->alias ?>"
                                   data-toggle="tooltip" data-placement="top" title="Цей текст використовується в посиланні на сторінку. Міняти не можна">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-2 label-align" for="seo-description">
                            SEO Description
                        </label>
                        <div class="col-md-9 col-sm-10">
                            <textarea id="seo-description" name="description" class="form-control" rows="5"
                                      title="Опис сторінки який необхідний для SEO просування" 
                                      data-toggle="tooltip" data-placement="top" 
                                      ><?= $dynamic->description ?></textarea>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-2 label-align" for="parsed-url">
                            Звідки скачали
                        </label>
                        <div class="col-md-9 col-sm-10">
                            <input disabled="disabled" type="text" id="parsed-url" class="form-control" value="<?= $dynamic->parsed_url ?>"
                                   data-toggle="tooltip" data-placement="top" title="Посилання по якому була завантажена сторінка">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="item form-group">
                        <div class="col-md-9 col-sm-10 offset-md-3">
                            <a href="<?= site_url('admin/dynamic/' . $dynamic->alias . '/rescan') ?>" 
                               class="btn btn-danger" type="reset" 
                               data-toggle="tooltip" data-placement="top" title="Система ще раз просканує стрінку з telegra.ph та оновить всі данні"
                               onClick="if (confirm('Це призведе до перезапису даних сторінки, поїхали?')) {
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
