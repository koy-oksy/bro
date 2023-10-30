<div class="page-title">
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <h3>Вітаю!</h3>
        </div>
    </div>
</div>

<div class="clearfix"></div>

<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Список походів<small>Карпати</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <p class="text-muted font-13 m-b-30">
                                Responsive is an extension for DataTables that resolves that problem by optimising the table's layout for different screen sizes through the dynamic insertion and removal of columns from the table.
                            </p>
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Заголовок</th>
                                        <th>Аліас</th>
                                        <th>К-ть учасників</th>
                                        <th>Ціна</th>
                                        <th>К-ть днів</th>
                                        <th>Назва шаблону</th>
                                        <th>Картинка</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($hikes as $hike) : ?>
                                    <tr>
                                        <td><?= $hike->caption ?></td>
                                        <td><?= $hike->alias ?></td>
                                        <td><?= $hike->max_participants ?></td>
                                        <td><?= $hike->price ?></td>
                                        <td><?= $hike->number_of_days ?></td>
                                        <td><?= $hike->tpl_name ?></td>
                                        <td><?= $hike->image_name ? "Є" : "Немає" ?></td>
                                        <td><a href="<?= site_url('admin/carpatianhikes/' . $hike->alias) ?>">Редагування</a></td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>