<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Налаштування Ми любимо, те що робимо</h2>
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
                    <?php $entry = $widget_entries[0]; ?>
                    <?= form_open_multipart('admin/main/' . $widget_name) ?>
                    <div class="col-md-12">
                        <img src="<?= $uploads ?>/<?= $entry['image_name'] ?>" class="img-fluid"/>
                        <input type="hidden" name="id" value="<?= $entry['id'] ?>" />
                        <div class="form-group">
                            <label data-original-title="Вкажіть новий файл картинки якщо хочете замінити її" data-toggle="tooltip" data-placement="right" for="image<?= $entry['id'] ?>">Замінити картинку <icon class="fa fa-question-circle"></icon></label>
                            <input type="file" class="form-control" id="image<?= $entry['id'] ?>" name="image">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label data-original-title="Тут можна використовувати html теги" data-toggle="tooltip" data-placement="right" for="text<?= $entry['id'] ?>">Текст <icon class="fa fa-question-circle"></icon></label>
                            <textarea rows="5" class="form-control" id="text<?= $entry['id'] ?>" name="text"><?= $entry['text'] ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr />
                        <div class="form-group">
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Завантажити / Зберегти</button>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
