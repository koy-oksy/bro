<?php $entry = $entries[0]; ?>
<?= form_open_multipart('admin/main/' . $name) ?>
<div class="col-md-6">
    <img src="<?= $uploads ?>/<?= $entry['image_name'] ?>" class="img-fluid"/>
    <input type="hidden" name="id" value="<?= $entry['id'] ?>" />
    <div class="form-group">
        <label data-original-title="Вкажіть новий файл картинки якщо хочете замінити її" data-toggle="tooltip" data-placement="right" for="image<?= $entry['id'] ?>">Замінити картинку <icon class="fa fa-question-circle"></icon></label>
        <input type="file" class="form-control" id="image<?= $entry['id'] ?>" name="image">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label data-original-title="Тут можна використовувати html теги" data-toggle="tooltip" data-placement="right" for="text<?= $entry['id'] ?>">
            Текст <icon class="fa fa-question-circle"></icon>
        </label>
        <div class="textarea-editor" id="text<?= $name ?>-editor">
            <textarea style="display:none;" name="text" text<?= $entry['id'] ?>><?= $entry['text'] ?></textarea>
        </div>
    </div>
</div>
<div class="col-md-12">
    <hr />
    <div class="form-group">
        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Завантажити / Зберегти</button>
    </div>
</div>
<?= form_close() ?>