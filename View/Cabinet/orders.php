<div class="cabinet">
    <h2>Ваши заказы</h2>
    <div class="col-sm-10 col-sm-offset-1">
        <?php if ($data['ordersInfo']): ?>
            <table class="table table-bordered cabinet-info">
                <tr>
                    <th>№ заказа</th>
                    <th>Дата и время</th>
                    <th>Товары и их количество</th>
                    <th>Общая сума заказа</th>
                </tr>
                <?php foreach ($data['ordersInfo'] as $order): ?>
                    <tr>
                        <td><b><?php echo $order['id']; ?></b></td>
                        <td><b><?php echo $order['date']; ?></b></td>
                        <td>
                            <?php foreach ($data['idsAndAmountsByOrder'] as $orderId => $productsIdAndAmount): ?>

                                <?php if ($orderId == $order['id']): ?>

                                    <?php foreach ($productsIdAndAmount as $productId => $amount): ?>

                                        <?php foreach ($data['productsInfo'] as $productInfo): ?>

                                            <?php if ($productInfo['id'] == $productId): ?>

                                                <div><b>
                                                        <a href="/product/show/<?php echo $productInfo['id']; ?>"><?php echo $productInfo['title']; ?></a>
                                                    </b> - <span class="badge"><?php echo $amount; ?> шт.</span>
                                                </div>

                                            <?php endif; ?>

                                        <?php endforeach; ?>

                                    <?php endforeach; ?>

                                <?php endif; ?>

                            <?php endforeach; ?>
                        </td>
                        <td><b><?php echo $order['sum']; ?></b></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <h3 class="orders-none">У вас еще не было заказов</h3>
        <?php endif; ?>
        <a href="/cabinet" class="hvr-shutter-in-horizontal cabinet-btn">Назад</a>
    </div>
    <div class="clearfix"></div>
</div>