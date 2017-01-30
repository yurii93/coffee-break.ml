<div class="check-out">
    <?php if($data['productsInfo']): ?>
    <h2>Корзина</h2>
    <div class="to-center"><a href="/product/all" class="hvr-shutter-in-horizontal">Вернуться к покупкам</a></div>
        <?php if(isset($data['warning'])) :?>
            <div class="col-sm-4 col-sm-offset-4 alert alert-danger info-box" role="alert"><?php echo $data['warning']; ?></div>
        <?php endif; ?>
    <form action="" method="post">
        <table style="display: table;">
            <tr>
                <th>НАЗВАНИЕ</th>
                <th>КОЛИЧЕСТВО</th>
                <th>ЦЕНА</th>
                <th>СУММА</th>
                <th>УДАЛИТЬ</th>
            </tr>
            <?php foreach ($data['productsInfo'] as $product): ?>
            <tr>
                <td class="ring-in"><a href="/product/show/<?php echo $product['id']; ?>" class="at-in"><img src="<?php echo \Model\ProductModel::getImage($product['id']); ?>" width="70" class="img-responsive" alt=""></a>
                    <div class="sed">
                        <h5><?php echo $product['title']; ?></h5>
                        <p><?php echo \Common\Functions::sentence($product['description'], 2); ?></p>
                    </div>
                    <div class="clearfix"> </div></td>
                <td class="check"><input class="cart-input" type="number" min="1" onkeypress="return false" required name="products[<?php echo $product['id']; ?>]" value="<?php echo $data['orderList'][$product['id']]; ?>"></td>
                <td><?php echo $product['price'] - ($product['price'] * $product['discount']); ?> грн.</td>
                <td><?php echo ($product['price'] - ($product['price'] * $product['discount']))*($data['orderList'][$product['id']]); ?> грн.</td>
                <td><a href="/cart/clear/<?php echo $product['id']; ?>"><i class="fa fa-remove fa-2x"></i></a></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <div class="col-sm-6">
            <input id="post" class="cart-btn" type="submit" value="Пересчитать">
            <a href="/cart/delete" class="cart-btn cart-delete">Очистить корзину</a>
        </div>
    </form>
    <div class="col-sm-6">
        <div class="help">
        <span class="total">Общая сумма: <b><?php echo $data['totalPrice']; ?> грн.</b></span>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
        <div class="get-it"><a href="/order" class="hvr-shutter-in-horizontal">Оформить</a></div>
    <?php else: ?>
        <h2>Корзина пуста</h2>
        <div class="to-center"><a href="/product/all" class="hvr-shutter-in-horizontal">Вернуться к покупкам</a></div>
        <div class="help-cart-distance"></div>
    <?php endif; ?>
</div>