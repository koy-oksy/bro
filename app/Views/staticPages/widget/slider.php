<div id="carouselExampleControls" class="carousel slide hotfix" data-ride="carousel">
    <ol class="carousel-indicators">
        {widget_entries}
        <li data-target="#carousel{id}" data-slide-to="{id}" class="{special_class}"></li>
        {/widget_entries}
    </ol>
    <div class="carousel-inner">
    {widget_entries}
        <div class="carousel-item {special_class}">
            <img src="{uploads}/{image_name}" class="d-block w-100" alt="{image}">
            <div class="carousel-caption d-md-block">
                <h5>{caption}</h5>
                {!text!}
            </div>
        </div>
    {/widget_entries}
    </div>
    <div class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Попереднє</span>
    </div>
    <div class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Наступне</span>
    </div>
</div>