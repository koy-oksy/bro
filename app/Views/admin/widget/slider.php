<?php foreach ($entries as $entry) : ?>
<?= form_open_multipart('admin/main/' . $name) ?>
<div class="col-md-6">
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
        <textarea rows="6" class="form-control" id="text<?= $entry['id'] ?>" name="text"><?= $entry['text'] ?></textarea>
    </div>
</div>
<div class="col-md-6">
    <img src="<?= $uploads ?>/<?= $entry['image_name'] ?>" class="img-fluid"/>
    <input type="hidden" name="id" value="<?= $entry['id'] ?>" />
</div>
<div class="col-md-12">
    <div class="form-group">
        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Завантажити / Зберегти</button>
    </div>
    <hr />
</div>
<?= form_close() ?>
<?php endforeach ?>