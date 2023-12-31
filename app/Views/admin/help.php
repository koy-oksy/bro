<div class="clearfix"></div>
<div class="page-title">
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <h3>Допомога</h3>
        </div>
    </div>
</div>

<div class="clearfix"></div>

<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Редагування сторінок (не походів)</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="bs-example" data-example-id="simple-jumbotron">
                    <div class="card">
                        <img class="card-img-top" src="<?= base_url('/admin/img/general-page1.jpg') ?>" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">
                                Налаштування на цій сторінці впливають на весь сайт
                                <ul>
                                    <li>
                                        <strong>Структура</strong> - редагування структури сторінки, можна додавати html код, або додавати/видаляти/переставляти віджети. Віджет це блок, який використовується на гловній сторінці, наприклад слайдер це - {!slider!}
                                    </li>
                                    <li>
                                        <strong>Віджети</strong> - 
                                        <ul>
                                            <li>"Про Нас" - {!about!} - блок з коротким текстом про засновників клубу</li>
                                            <li>"Переваги" - {!advantage!} - переваги нашого клубу</li>
                                            <li>"Лічильники" - {!counters!} - лічільники на головній сторінці</li>
                                            <li>"Слайдер" - {!slider!} - слайдер з трьома фото і текстом</li>
                                            <li>"Ми любимо" - {!love!} - короткий слоган для привернення уваги та завоювання довіри користувача</li>
                                        </ul>
                                    </li>
                                    <li>
                                        Кожен віджет редагується на окремій вкладці з відповідною назвою. Для редагування внести зміни в текст(и) та/або змінити фото і натиснути <span class="btn btn-success"><i class="fa fa-save"></i> Завантажити / зберегти</span> для збереження змін
                                    </li>
                                </ul>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
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
                <div class="bs-example" data-example-id="simple-jumbotron">
                    <div class="card">
                        <img class="card-img-top" src="<?= base_url('/admin/img/settings.jpg') ?>" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">
                                Налаштування на цій сторінці впливають на весь сайт
                                <ul>
                                    <li>
                                        <strong>Включити сайт</strong> - якщо виключено, переводить сайт в режим обслуговування, відвідувач не може дивитись походи або статті.
                                    </li>
                                    <li>
                                        <strong>Назва сайту</strong> - відображається в браузері в заголовці вкладки з сайтом. Потрібно для SEO.
                                    </li>
                                    <li>
                                        <strong>Назва сторінки з походами по Карпатах</strong> - тут можна обрати назву сторінки з походами по Карпатах.
                                    </li>
                                    <li>
                                        <strong>SEO Description походи по Карпатах</strong> - потрібно для SEO.
                                    </li>
                                    <li>
                                        <strong>Назва сторінки з закордонними походами</strong> - тут можна обрати назву сторінки закордонні походи.
                                    </li>
                                    <li>
                                        <strong>SEO Description закордонні походи</strong> - потрібно для SEO.
                                    </li>
                                    <li>
                                        <strong>Telegram адреса для замовлення походів</strong> - дуже важливо - на який телеграм акаунт будуть переходи для замовлення походів з сайту
                                    </li>
                                </ul>
                            </p>
                            <p>Для збереження внесених змін натиснути кнопку <span class="btn btn-primary"><i class="fa fa-save"></i> Зберегти</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Додавання походів і їх перегляд</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="bs-example" data-example-id="simple-jumbotron">
                    <div class="card">
                        <img class="card-img-top" src="<?= base_url('/admin/img/hike-add.jpg') ?>" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">
                                <ul>
                                    <li>У верхній частині сторінки знаходиться список походів (спочатку може бути пустим). Там також є пошук по назвам, датам та вартості. Для кожного доданого походу відображається "Назва", "Дати", "Вартість", статус "Включений" та кнопки <span class="btn btn-secondary btn-sm"><i class="fa fa-pencil"></i> Редагування</span> та <span class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Видалення</span></li>
                                    <li>В нижній частині знаходиться форма для додавання походів. В текстовому полі потрібно вказати ссилку на похід в telegra.ph, наприклад "https://telegra.ph/Novij-R%D1%96k-p%D1%96d-Goverloyu-10-16" і натиснути кнопку <span class="btn btn-primary"><i class="fa fa-plus"></i> Додати!</span></li>
                                    <li>Сторінка telegra.ph, на яку веде вказане посилання, має бути оформлена по правилах:
                                        <ul>
                                            <li>Кожен "день" походу має бути відокремлений від інших трьома мінусами "---" з нової строки. Це є маркер для сканування, по ньому сайт буде розділяти опис походу на красиві блоки. Без символів "---" в тексті telegra.ph, похід буде відображатись як один блок</li>
                                            <li>Існує перелік параметрів які треба вказувати з двокрапкою на кінці: "<b>Тривалість:</b>", "<b>Дата:</b>", "<b>Дати:</b>", "<b>Формат:</b>", "<b>Вартість:</b>", "<b>Загальний бюджет подорожі:</b>", "<b>Кількість учасників:</b>", "<b>Протяжність:</b>", "<b>Маршрут:</b>", "<b>Складність:</b>". Докладніше дивитись >><a href="" class="font-weight-bold" style="text-decoration: underline" target='_blank'>приклад такої сторінки</a><<</li>
                                            <li>Не обов'язково вказувати всі параметри з переліку вище, можна тільки деякі - обирай сам які потрібні для відображення</li>
                                            <li>Часто буває що в тексті походу є посилання на окрему сторінку teltgra.ph з додатковою інформацією про спорядження або підготовку для походу. Для цього треба скористатись "Допоміжні сторінки => Додати сторінку", докладніше дивись останній блок</li>
                                        </ul>
                                    </li>
                                    <li>
                                        Додавання походу призведе до сканування сторінки по вказаному посиланню і копіюванню текстів та фото в базу даних сайту. Доданий на сайт похід не пропаде якщо якимось чином буде видалена сторінка telegra.ph з якої він був скопійований. Після додавання походу відобразиться сторінка редагування походу, дивиться докладніше в наступному блоці.
                                    </li>
                                </ul>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Редагування походів</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="bs-example" data-example-id="simple-jumbotron">
                    <div class="card">
                        <img class="card-img-top" src="<?= base_url('/admin/img/hike-edit.jpg') ?>" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">
                                <ul>
                                    <li>Одразу після додавання походу побачиш сторінку його редагування. У верхній частині сторінки будуть відображатись завантажені з telegra.ph фото. Вони будуть завантажуватись одне за одним - до того як завантажуться всі, будь ласка, не закривай цю сторінку. Якщо випадково закрив - нічого страшного, просто повернись до редагування і решта фото дозавантажиться.</li>
                                    <li>Нижче фото розташовані параметри походу
                                        <ul>
                                            <li><b>Включити відображення у списку:</b> це перемикач який відповідає за відображення походу для користувача. Зверни увагу - для щойно доданого походу він виключений щоб ти міг перевірити похід перед тим як показувати його відвідувачу</li>
                                            <li><b>Назва:</b> назва походу яку буде бачити відвідувач</li>
                                            <li><b>Аліас:</b> це спеціальний параметр, який буде присутній в адресі сторінки з походом. Краще лишити його без змін.</li>
                                            <li><b>SEO Description:</b> короткий опис сторінки з походом який важливий для пошукових систем в інтернеті. SEO спеціаліст в цьому розбирається. Краще лишити його без змін.</li>
                                            <li><b>Тривалість:</b> кількість днів на похід</li>
                                            <li><b>Дати:</b> дати початку та кінця походу або походів якщо планується декілька</li>
                                            <li><b>Формат:</b> колибінг, з палатками, з готелями та інше</li>
                                            <li><b>Вартість:</b> вартість участі в поході</li>
                                            <li><b>Загальний бюджет подорожі:</b> цей параметр більше для закордонних походів. Включає в себе всі розходи на похід, ціна перельоту та додаткові витрати</li>
                                            <li><b>Кількість учасників:</b> кількість учасників + гід або гіди</li>
                                            <li><b>Протяжність:</b> кілометраж маршруту</li>
                                            <li><b>Маршрут:</b> короткий опис маршруту, основні чекпоінти</li>
                                            <li><b>Складність:</b> це щоб учасник походу розумів куди він записується</li>
                                            <li><b>Звідки скачали:</b> це спеціальний параметр, який міняти не можна. Показується щоб було відомо по якому посиланню на telegra.ph скопійований похід</li>
                                        </ul>
                                    </li>
                                    <li>В самому низу сторінки розташовані чотири кнопки:
                                        <ul>
                                            <li><span class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Назад</span> - повернення до списку походів</li>
                                            <li><span class="btn btn-danger"><i class="fa fa-flash"></i> Пересканувати</span> - це спеціальна кнопка. Її треба натиснути якщо зробив зміни на сторінці telegra.ph з якої взяти похід. Тоді зроблені зміни попадуть на сайт. По суті теж саме що видалити похід і додати заново. Фото походу також будуть перезавантажені</li>
                                            <li><span class="btn btn-warning"><i class="fa fa fa-rotate-left"></i> Скинути</span> - це скидання ще не збережених змін</li>
                                            <li><span class="btn btn-primary"><i class="fa fa-save"></i> Зберегти</span> - зберігання форми редагування походу</li>
                                        </ul>
                                    </li>
                                </ul>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Додавання допоміжних сторінок</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="bs-example" data-example-id="simple-jumbotron">
                    <div class="card">
                        <img class="card-img-top" src="<?= base_url('/admin/img/additional-page.jpg') ?>" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">
                                <ul>
                                    <li>Ці сторінки відображаються по посиланнях зі сторінок походів</li>
                                    <li>Це сторінки на кшталт: "<b>Список речей та спорядження для зимового походу з наметами/в колибі</b>", "<b>Перелік речей для походу в Карпати в міжсезоння (осінь/весна) та влітку, а також взимку без наметів</b>"</li>
                                    <li>Додаються так само як і походи, тільки немає параметрів притаманних походам. Все інше теж саме - вказуєш посилання на сторінку в telegra.ph, натискаєш кнопку <span class="btn btn-primary"><i class="fa fa-plus"></i> Додати!</span></li>
                                </ul>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>