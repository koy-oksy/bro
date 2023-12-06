<div class="site-section py-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6">
        <div class="heading-39101 mb-5">
          <h2><?= $caption ?></h2>
          <?= show_param('Дати', $dates) ?>
          <?= show_param('Тривалість', $days) ?>
          <?= show_param('Формат', $format) ?>
          <?= show_param('Вартість', $price) ?>
          <?= show_param('Кількість учасників', $participants) ?>
          <?= show_param('Протяжність', $distance) ?>
          <?= show_param('Маршрут', $route) ?>
          <button type="button" class="btn btn-light"><a href="https://t.me/sanyasakovets" target="blank">Забронювати місце можна тут) </a></button>
        </div>
        
      </div>
      <div class="col-md-6" data-aos="fade-right">
          <img src="<?= site_url('image' . modify_image_name_url($image_name, 'horizontal_')) ?>" alt="<?= $alias ?>" class="img-fluid">
      </div>
    </div>
  </div>
</div>

<?php foreach ($chapters as $chapter) : ?>
<div class="site-section py-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6">
        <div class="heading-39101 mb-5"><?= $chapter['text'] ?></div>
      </div>
      <div class="col-md-6" data-aos="fade-right">
        <img src="<?= site_url('image' . modify_image_name_url($image_name, 'horizontal_')) ?>" alt="<?= $alias ?>" class="img-fluid">
        <p>Кімнати 6-місні, ліжка з постіллю, балкон з видом на Чорногору</p>
      </div>
    </div>
  </div>
</div>
<?php endforeach ?> 
