<div class="content">
    <?php if(isset($data['orderOk'])) :?>
        <div class="col-sm-4 col-sm-offset-4 alert alert-success info-box" role="alert"><?php echo $data['orderOk']; ?></div>
    <?php endif; ?>
    <?php if(isset($data['orderNo'])) :?>
        <div class="col-sm-4 col-sm-offset-4 alert alert-warning info-box" role="alert"><?php echo $data['orderNo']; ?></div>
    <?php endif; ?>
    <div class="clearfix"></div>
    <h3 class="future-men">Каталог товаров</h3>
    <div class="col-sm-3 side-bar-helper">
        <div class="w_sidebar">
            <form action="/product/filter" method="post">
                <section class="sky-form">
                    <h4>Производитель</h4>
                    <div class="row1 scroll-pane">
                        <div class="col col-4">
                            <?php if($data['filterData']['vendors']) :?>
                            <?php foreach ($data['filterData']['vendors'] as $vendor): ?>
                                <label class="checkbox"><input type="checkbox" name="vendor[]"
                                                               value="<?php echo $vendor; ?>"
                                    ><i></i><?php echo $vendor; ?></label>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
                <section class="sky-form">
                    <h4>Тип</h4>
                    <div class="row1 scroll-pane">
                        <div class="col col-4">
                            <?php if($data['filterData']['types']) :?>
                            <?php foreach ($data['filterData']['types'] as $type): ?>
                                <label class="checkbox"><input type="checkbox" name="type[]"
                                                               value="<?php echo $type; ?>"
                                    ><i></i><?php echo $type; ?>
                                </label>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
                <section class="sky-form">
                    <h4>Цена</h4>
                    <div class="row1 ">
                        <div class="col col-4 name-in name-in-2">
                            <?php if($data['filterData']['value']) :?>
                            <div id="slider-format"></div>
                            <input class="price-from" type="text" name="price-from" id="input-number1">
                            <input class="price-to" type="text" name="price-to" id="input-number2">
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
                <script>
                    var keypressSlider = document.getElementById('slider-format');

                    noUiSlider.create(keypressSlider, {
                        start: [0, <?php echo $data['filterData']['value'][1]; ?>],
                        connect: [false, true, false],
                        step: 1,
                        range: {
                            'min': [0],
                            'max': [ <?php echo $data['filterData']['value'][1]; ?> ]
                        },
                        format: wNumb({
                            decimals: 0,
                        })

                    });
                </script>
        </div>
        <?php if($data['isFilterWork']) :?>
        <input id="post" type="submit" class="product-in hvr-shutter-in-horizontal btn-helper" value="Фильтровать">
        <?php endif; ?>
        </form>
    </div>
    <div class="content-product col-sm-9 masonry" data-columns>
        <?php if($data['products']): ?>
        <?php foreach ($data['products'] as $product) : ?>
            <div class="col-d">
                <div class="men-grid in-men">
                    <?php if($product['is_new']): ?>
                        <img class="img-responsive new-product" src="/webroot/images/corner.png" width="40px" alt="">
                    <?php endif; ?>
                    <?php if($product['discount'] > 0 && $product['discount'] < 1): ?>
                        <span class="discount-all-prod">-<?php echo $product['discount'] * 100; ?>%</span>
                    <?php endif; ?>
                    <p><?php echo $product['title']; ?></p>
                    <a href="/product/show/<?php echo $product['id']; ?>"><img class="img-responsive"
                                               src="<?php echo \Model\ProductModel::getImage($product['id']); ?>" alt=""></a>
                    <?php if($product['discount'] > 0 && $product['discount'] < 1): ?>
                        <div class="value-in">
                            <span><s><?php echo $product['price']; ?> ₴</s></span>
                        </div>
                        <div class="value-in value-in-add">
                            <span><?php echo number_format(($product['price'] - ($product['price'] * $product['discount'])), 2); ?> ₴</span>
                        </div>
                    <?php else: ?>
                        <div class="value-in">
                            <span><?php echo $product['price']; ?> ₴</span>
                        </div>
                    <?php endif; ?>
                    <div class="to-center">
                        <a href="/product/show/<?php echo $product['id']; ?>" class="product-in hvr-shutter-in-horizontal btn-helper">Детально</a>
                        <a href="" class="add-to-cart product-in hvr-shutter-in-horizontal btn-helper" product-id="<?php echo $product['id']; ?>" amount="1">В корзину</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?php else: ?>
        <h2>Нет товаров</h2>
        <?php endif; ?>
    </div>
    <div class="clearfix"></div>
    <div class="pagination-wraper" style="text-align: center">
        <?php echo $data['pagination']->get(); ?>
    </div>
</div>