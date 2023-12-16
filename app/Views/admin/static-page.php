<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>
                    <?= $page['title'] ?> 
                    <small><a href="<?= site_url('page/' . $page['alias']) ?>" target="_blank"><?= site_url('page/' . $page['alias']) ?></a></small>
                </h2>
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
                <div class="col-sm-3 col-md-2">
                    <!-- required for floating -->
                    <!-- Nav tabs -->
                    <div class="nav nav-tabs flex-column  bar_tabs" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="page-home-tab" data-toggle="pill" href="#page-home-content" role="tab" aria-controls="page-home-content" aria-selected="true">Структура</a>
                        <?php foreach ($widgets as $widget) : ?>
                            <a class="nav-link" id="page-<?= $widget['name'] ?>-tab" data-toggle="pill" href="#page-<?= $widget['name'] ?>-content" role="tab" aria-controls="page-<?= $widget['name'] ?>-content" aria-selected="false"><?= $widget['caption'] ?></a>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="col-sm-9 col-md-10">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="page-home-content" role="tabpanel" aria-labelledby="page-home-tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <?= form_open('admin/' . $page['alias']) ?>
                                    <div class="form-group">
                                        <label data-original-title="Тут можна використовувати html теги" data-toggle="tooltip" data-placement="right" for="structure">HTML сторінки <icon class="fa fa-question-circle"></icon></label>
                                        <?php if ($widgets) : ?>
                                        <p>На цій сторінці можна використовувати наступні віджети:</p>
                                        <ul>
                                        <?php foreach ($widgets as $widget) : ?>
                                            <li>{!<?= $widget['name']; ?>!}</li>
                                        <?php endforeach ?>
                                        </ul>
                                        <?php endif ?>
                                        <div id="textarea-editor">
                                        <textarea style="display:none;" name="template_code"><?= $structure ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-warning" type="reset" 
                                            data-toggle="tooltip" data-placement="top" title="Перезавантажить сторінку, скинувши всі зроблені та не збережені зміни"
                                            onClick="if (confirm('Скинути всі останні зміни?')){location.reload();}else{event.stopPropagation(); event.preventDefault();};"
                                        >
                                            <i class="fa fa-rotate-left"></i> Скинути
                                        </button>
                                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Зберігти зміни</button>
                                    </div>
                                    <?= form_close() ?>
                                </div>
                            </div>
                        </div>
                        <?php foreach ($widgets as $widget) : ?>
                            <div class="tab-pane fade" id="page-<?= $widget['name'] ?>-content" role="tabpanel" aria-labelledby="page-<?= $widget['name'] ?>-tab">
                                <?= $widget['content'] ?>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>