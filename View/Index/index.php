
<div class="content" id="content">
    <div class="content-top">
        <div class="container">
            <div class="content-top-at">
                <a  href="/product/all" class="product-in hvr-shutter-in-horizontal">Каталог товаров</a>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!---->
    <div class="container">
        <div class="content-grid">
            <h3 class="future">Новинки</h3>
            <div class="clearfix"> </div>
            <ul id="flexiselDemo1">
                <?php foreach ($data['newProducts'] as $newProduct) : ?>
                <li>
                    <div class="men-grid in-men index-page">
                        <img class="img-responsive new-product" src="/webroot/images/corner.png" width="40px" alt="">
                        <h4><?php echo $newProduct['title']; ?></h4>
                        <a href="single.html">
                            <a href="/product/show/<?php echo $newProduct['id']; ?>"><img class="img-responsive" src="<?php echo \Model\ProductModel::getImage($newProduct['id']); ?>" width="150px" alt=""></a>
                        <div class="value-in">
                            <span><?php echo number_format($newProduct['price'], 2); ?> ₴</span>
                        </div>
                        <div class="to-center">
                            <a href="/product/show/<?php echo $newProduct['id']; ?>" class="product-in hvr-shutter-in-horizontal btn-helper">Детально</a>
                            <a href="" class="add-to-cart product-in hvr-shutter-in-horizontal btn-helper" product-id="<?php echo $newProduct['id']; ?>" amount="1">В корзину</a>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>

            </ul>
            <script type="text/javascript">
                $(window).load(function() {
                    $("#flexiselDemo1").flexisel({
                        visibleItems: <?php if(count($data['newProducts']) >= 3) {echo 3;} else{ echo 1;} ?>,
                        animationSpeed: 1000,
                        autoPlay: true,
                        autoPlaySpeed: 3000,
                        pauseOnHover: true,
                        enableResponsiveBreakpoints: true,
                        responsiveBreakpoints: {
                            portrait: {
                                changePoint:480,
                                visibleItems: 1
                            },
                            landscape: {
                                changePoint:640,
                                visibleItems: 2
                            },
                            tablet: {
                                changePoint:768,
                                visibleItems: 2
                            }
                        }
                    });

                });
            </script>
        </div>
        <div class="content-grid">
            <h3 class="future">Товары со скидкой</h3>
            <div class="clearfix"> </div>
            <ul id="flexiselDemo2">
                <?php foreach ($data['discountProducts'] as $discountProduct) : ?>
                    <li>
                        <div class="men-grid in-men index-page index-page-discount">
                            <span class="discount">-<?php echo $discountProduct['discount'] * 100; ?>%</span>
                            <h4><?php echo $discountProduct['title']; ?></h4>
                            <a href="single.html"><img class="img-responsive" src="<?php echo \Model\ProductModel::getImage($discountProduct['id']); ?>" width="150px" alt=""></a>
                            <div class="value-in">
                                <span><s><?php echo $discountProduct['price']; ?> ₴</s></span>
                            </div>
                            <hr>
                            <div class="value-in value-in-add">
                                <span><?php echo number_format(($discountProduct['price'] - ($discountProduct['price'] * $discountProduct['discount'])), 2); ?> ₴</span>
                            </div>
                            <div class="to-center">
                                <a href="single.html" class="product-in hvr-shutter-in-horizontal btn-helper">Детально</a>
                                <a href="single.html" class="product-in hvr-shutter-in-horizontal btn-helper">В корзину</a>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
            <script type="text/javascript">
                $(window).load(function() {
                    $("#flexiselDemo2").flexisel({
                        visibleItems: <?php if(count($data['discountProducts']) >= 3) {echo 3;} else{ echo 1;} ?>,
                        animationSpeed: 1000,
                        autoPlay: true,
                        autoPlaySpeed: 3000,
                        pauseOnHover: true,
                        enableResponsiveBreakpoints: true,
                        responsiveBreakpoints: {
                            portrait: {
                                changePoint:480,
                                visibleItems: 1
                            },
                            landscape: {
                                changePoint:640,
                                visibleItems: 2
                            },
                            tablet: {
                                changePoint:768,
                                visibleItems: 2
                            }
                        }
                    });

                });
            </script>
            <script type="text/javascript" src="/webroot/js/jquery.flexisel.js"></script>
        </div>
    </div>
    <!---->

</div>
