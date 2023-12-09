<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Структура головної сторінки</h2>
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
                {!form_open!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label data-original-title="Тут можна використовувати html теги" data-toggle="tooltip" data-placement="right" for="text<?= $entry['id'] ?>">Текст <icon class="fa fa-question-circle"></icon></label>
                            <textarea rows="20" class="form-control" name="template_code">{!template_content!}</textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary reset_template" template_name="{template_name}" type="button"><i class="fa fa-close"></i> Скинути зміни</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Зберігти зміни</button>
                        </div>
                    </div>
                </div>
                {!form_close!}
            </div>
        </div>
    </div>
</div>