<div class="check-out-2">
    <h2>Оформить заказ</h2>
    <div class="to-center"><a href="/cart" class="hvr-shutter-in-horizontal">В корзину</a></div>
    <?php if($data['productsInfo']): ?>
    <table class="col-sm-6 order">
        <tr>
            <th>Название</th>
            <th>КОЛИЧЕСТВО</th>
            <th>СУММА</th>
        </tr>
        <?php foreach ($data['productsInfo'] as $product): ?>
        <tr>
            <td class="ring-in"><a href="/product/show/<?php echo $product['id']; ?>" class="at-in"><img src="<?php echo \Model\ProductModel::getImage($product['id']); ?>"
                                                                         class="img-responsive" width="70" alt=""></a>
                <p class="improve"><?php echo $product['title']; ?></p>
                <div class="clearfix"></div>
            </td>
            <td class="check"><?php echo $data['orderList'][$product['id']]; ?></td>
            <td class="check"><?php echo ($data['orderList'][$product['id']] * ($product['price'] - ($product['price'] * $product['discount']))); ?></td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td class="improve">Общая сумма:</td>
            <td colspan="2" class="improve-2"><?php echo $data['totalPrice']; ?> грн.</td>
        </tr>
        <tr>
            <?php if($data['totalPrice'] >= 500): ?>
                <td colspan="3" class="delivery">Доставка за наш счет!</td>
            <?php else: ?>
                <td colspan="3" class="delivery-user">Доставку оплачиваете Вы!</td>
            <?php endif; ?>
        </tr>
    </table>
    <?php endif; ?>
    <div class="col-sm-5 col-sm-offset-1 contact-form order-form">
        <?php if(isset($data['warning'])) :?>
            <div class="col-sm-12 alert alert-danger info-box" role="alert"><?php echo $data['warning']; ?></div>
        <?php endif; ?>
        <form action="" method="post">
            <input type="hidden" name="userId" value="<?php if(isset($data['userInfo']['id'])) {echo $data['userInfo']['id'];} else {echo 0;} ?>">
            <div class="name-in-order">
                <span>Имя *</span>
                <input type="text" name="name" value="<?php if(isset($data['userInfo']['name'])) {echo $data['userInfo']['name'];} ?>">
            </div>
            <div class="name-in-order">
                <span>Фамилия *</span>
                <input type="text" name="surname" value="<?php if(isset($data['userInfo']['surname'])) {echo $data['userInfo']['surname'];} ?>">
            </div>
            <div class="name-in-order">
                <span>Телефон *</span>
                <input type="text" name="tel" value="<?php if(isset($data['userInfo']['tel'])) {echo $data['userInfo']['tel'];} ?>">
            </div>
            <div class="name-in-order">
                <span>Имейл *</span>
                <input type="text" name="email" value="<?php if(isset($data['userInfo']['email'])) {echo $data['userInfo']['email'];} ?>">
            </div>
            <div class="name-in-order">
                <span>Город *</span>
                <input type="text" name="city" value="<?php if(isset($data['userInfo']['city'])) {echo $data['userInfo']['city'];} ?>">
            </div>
            <div class="name-in-order">
                <span>Адрес</span>
                <input type="text" name="addres">
            </div>
            <div class="name-on">
                <span>Дополнительные сведения</span>
                <textarea name="message"></textarea>
            </div>
            <div class="to-center">
                <input type="submit" value="Отправить">
            </div>
        </form>
    </div>
    <div class="clearfix"></div>
</div>