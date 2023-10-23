<div class="site-section">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-md-7">
                <div class="heading-39101 mb-5">
                    <span class="backdrop text-center d-none">Досягнення</span>
                    <h5>Наша місія – робити людей щасливими, закохуючи в гори та природу нашої планети!</h5>
                </div>
            </div>
        </div>
        <div class="row counter-fix">
            {widget_entries}
            <div class="col-lg-3 col-md-6 mb-3 aos-init" data-aos="fade-up">
                <div class="listing-item">
                    <div class="listing-image">
                        <img src="{uploads}/{image_name}" alt="Image" class="img-fluid">
                    </div>
                    <div class="listing-item-content">
                        <h1 class="px-3 mb-3 category bg-success counter">{max_number}</h1>
                        <h2 class="mb-1">{text}</h2>
                    </div>
                </div>
            </div>
            {/widget_entries}
        </div>
    </div>
</div>