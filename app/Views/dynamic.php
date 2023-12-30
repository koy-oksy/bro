<div class="site-section py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="heading-39101 mb-5">
                    <h2><?= $caption ?></h2>
                </div>
            </div>
        </div>
    </div>
</div>

<?php foreach ($chapters as $chapter) : ?>
    <div class="site-section py-5">
        <div class="container">
            <div class="row align-items-center">

                <?php $data = format_chapter_output($chapter['text']); ?>
                
                <div class="col-md-<?= count($data['figures']) ? '6' : '12' ?>">
                    <div class="heading-39101 mb-5"><?= $data['chapter'] ?></div>
                </div>
                
                <?php foreach ($data['figures'] as $i => $figure) : ?> 
                
                <div class="col-md-<?= image_cols(count($data['figures']), $i) ?>" data-aos="fade-right">
                    <?= $figure ?>
                </div>

                <?php endforeach ?>
                
                <hr />
            </div>
        </div>
    </div>
<?php endforeach ?> 
<?php // die('2') ?>
