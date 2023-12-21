<div class="ftco-blocks-cover-1">
    <div class="site-section-cover overlay" style="background-image: url('<?= $img ?>/carpatian_hikes.webp')">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-md-5" data-aos="fade-up">
                    <h1 class="mb-3 text-white">Походи в Карпати</h1>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="">
                    <h3>Розклад походів на 2023 рік</h3>
                    <p>Привіт, бро! Дякуємо, що цікавишся нашими мандрівками)</p>
                    <p>Нагадуємо, що окрім запропонованих маршрутів ти можеш замовити індивідуальний або корпоративний похід. Збирай від 5-ти друзів і більше та погнали на відпочинок) Від тебе тільки бажання - решту організуємо ми. Для груп діє приємна система знижок, можемо розробити
                        маршрут за твоїми побажаннями.</p>
                    <p>Щоб замовити корпоративну подорож - <a href="https://t.me/tetiana_sakovets">пищи менеджеру Тані</a></p>
                    <p>Раптом тобі щось треба прикупити для походу чи мандрівки - сміливо можеш писати нашим друзям партнерам - <a href="https://t.me/brotour/31" target="_blank">тут всі деталі про партнерів та промокоди</a></p>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="site-section">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-md-7">
                <div class="heading-39101 mb-5">
                    <?php if (empty($hikes)) : ?>
                        <h3>Походи скоро з'являться, не перемикайтесь!</h3>
                    <?php else : ?>
                        <h3>Найближчі походи</h3>
                    <?php endif ?>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach ($hikes as $hike) : ?>

                <div class="col-lg-4 col-md-6 mb-4 aos-init" data-aos="fade-up">
                    <div class="listing-item">
                        <div class="listing-image">
                            <img src="<?= site_url('image' . modify_image_name_url($hike['image_name'], 'vertical_')); ?>" alt="<?= $hike['alias'] ?>" class="img-fluid">
                        </div>
                        <div class="listing-item-content">
                            <h2 class="mb-1"><?= $hike['caption'] ?></h2>
                            <?php if ($hike['dates']) : ?>
                                <a class="px-3 mb-3 category bg-success" href="<?= site_url('carpatian-hikes/' . $hike['alias']) ?>"><?= $hike['dates'] ?></a>
                            <?php endif ?>
                            <a class="px-3 mb-3 category" href="<?= site_url('carpatian-hikes/' . $hike['alias']) ?>">Детальніше</a>
                            <?php if ($hike['price']) : ?>
                                <p class="text-success"><?= $hike['price'] ?></p>
                            <?php endif ?>
                        </div>
                    </div>
                </div>

            <?php endforeach ?>

        </div>
    </div>
</div>