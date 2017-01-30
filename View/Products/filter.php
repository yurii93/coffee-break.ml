<?php if(\Common\Session::has('vendorChecked') || \Common\Session::has('typeChecked') || \Common\Session::has('from') || \Common\Session::has('to')) :?>
    <a href="/product/refreshFilter" class="filter-make"><div id="filter-delete" data-toggle="tooltip" title="Очистить фильтр"><i class="fa fa-paint-brush fa-2x"></i></div></a>
<?php endif; ?>
<div class="content">
    <h3 class="future-men">Каталог товаров (фильтр)</h3>
    <div class="col-sm-3 side-bar-helper">
        <div class="w_sidebar">
            <form action="" method="post">
                <section class="sky-form">
                    <h4>Производитель</h4>
                    <div class="row1 scroll-pane">
                        <div class="col col-4">
                            <?php foreach ($data['filterData']['vendors'] as $vendor): ?>
                                <label class="checkbox"><input type="checkbox" name="vendor[]"
                                                               value="<?php echo $vendor; ?>"
                                        <?php if (\Common\Session::get('vendorChecked')) : ?>
                                            <?php foreach (unserialize(\Common\Session::get('vendorChecked')) as $vendorChecked) : ?>
                                                <?php if ($vendorChecked == $vendor): ?>
                                                    checked
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    ><i></i><?php echo $vendor; ?></label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
                <section class="sky-form">
                    <h4>Тип</h4>
                    <div class="row1 scroll-pane">
                        <div class="col col-4">
                            <?php foreach ($data['filterData']['types'] as $type): ?>
                                <label class="checkbox"><input type="checkbox" name="type[]"
                                                               value="<?php echo $type; ?>"
                                        <?php if (\Common\Session::get('typeChecked')) : ?>
                                            <?php foreach (unserialize(\Common\Session::get('typeChecked')) as $typeChecked) : ?>
                                                <?php if ($typeChecked == $type): ?>
                                                    checked
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    ><i></i><?php echo $type; ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
                <section class="sky-form">
                    <h4>Цена</h4>
                    <div class="row1 ">
                        <div class="col col-4 name-in name-in-2">
                            <div id="slider-format"></div>
                            <input class="price-from" type="text" name="price-from" id="input-number1">
                            <input class="price-to" type="text" name="price-to" id="input-number2">
                        </div>
                    </div>
                </section>
                <script>
                    var keypressSlider = document.getElementById('slider-format');

                    noUiSlider.create(keypressSlider, {
                        start: [

                            <?php if(\Common\Session::has('from') && \Common\Session::has('to')): ?>

                                <?php echo \Common\Session::get('from') . ',' . \Common\Session::get('to'); ?>

                            <?php elseif(\Common\Session::has('from')): ?>

                                <?php echo \Common\Session::get('from') . ',' . $data['filterData']['value'][1]; ?>

                            <?php elseif(\Common\Session::has('to')): ?>

                                <?php echo '0,' . \Common\Session::get('to'); ?>

                            <?php else:?>

                                <?php echo '0,' . $data['filterData']['value'][1]; ?>

                            <?php endif; ?>

                        ],
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
        <input id="post" type="submit" class="product-in hvr-shutter-in-horizontal btn-helper" value="Фильтровать">
        </form>
    </div>
    <div class="content-product col-sm-9 masonry" data-columns>
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
                        <a href="#" class="add-to-cart product-in hvr-shutter-in-horizontal btn-helper" product-id="<?php echo $product['id']; ?>" amount="1">В корзину</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="clearfix"></div>
</div>