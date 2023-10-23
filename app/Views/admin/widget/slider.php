<div class="clearfix"></div>
<div class="page-title">
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <h3>Налаштування Слайдера</h3>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <?php foreach ($widget_entries as $entry) : ?>
        <?= form_open_multipart('admin/main/slider') ?>
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Слайд <?= $entry['id'] ?></h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width: 45px">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <img src="<?= $uploads ?>/<?= $entry['image_name'] ?>" class="img-fluid"/>
                    <input type="hidden" name="id" value="<?= $entry['id'] ?>" />
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <label data-original-title="Вкажіть новий файл картинки якщо хочете замінити її" data-toggle="tooltip" data-placement="right" for="image<?= $entry['id'] ?>">Замінити картинку <icon class="fa fa-question-circle"></icon></label>
                        <input type="file" class="form-control" id="image<?= $entry['id'] ?>" name="image">
                    </div>
                    <div class="form-group">
                        <label data-original-title="Тут можна використовувати html теги" data-toggle="tooltip" data-placement="right" for="caption<?= $entry['id'] ?>">Заголовок <icon class="fa fa-question-circle"></icon></label>
                        <input type="text" class="form-control" id="caption<?= $entry['id'] ?>" value="<?= $entry['caption'] ?>" name="caption">
                    </div>
                    <div class="form-group">
                        <label data-original-title="Тут можна використовувати html теги" data-toggle="tooltip" data-placement="right" for="text<?= $entry['id'] ?>">Текст <icon class="fa fa-question-circle"></icon></label>
                        <input type="text" class="form-control" id="text<?= $entry['id'] ?>" value="<?= $entry['text'] ?>" name="text">
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Завантажити / Зберегти</button>
                </div>
            </div>
        </div>
        <?= form_close() ?>
    <?php endforeach ?>
</div>
