<div class="x_content">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Додавання сторінки</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                <?= form_open(site_url('/admin/dynamic'), ['class' => 'form-horizontal form-label-left']) ?>
                    <div class="form-group">
                        <label class="col-sm-3 col-form-label"><b>Адреса сторінки яку треба додати</b></label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" class="form-control" name="parsed_url" placeholder="https://telegra.ph/...">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Додати!</button>
                                </span>
                            </div>
                        </div>
                    </div>
                <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="clearfix"></div>
