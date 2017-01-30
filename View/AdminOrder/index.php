<?php if(isset($data['warning'])) :?>
    <div class="col-sm-4 col-sm-offset-4 alert alert-danger info-box" role="alert"><?php echo $data['warning']; ?></div>
<?php endif; ?>
<?php if(isset($data['success'])) :?>
    <div class="col-sm-4 col-sm-offset-4 alert alert-success info-box" role="alert"><?php echo $data['success']; ?></div>
<?php endif; ?>
<div class="clearfix"></div>
<div class="title-to-center">
<?php if($data['ordersType'] === 'finished'): ?>
    <h2>Обработанные заказы</h2>
<?php else: ?>
    <h2>Необработанные заказы</h2>
<?php endif; ?>
</div>
<?php if($data['ordersInfo']): ?>
<div class="admin-order-table">
    <table class="table table-bordered">
        <tr class="active">
            <th>Id</th>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Товары</th>
            <th>Сумма</th>
            <th>Телефон</th>
            <th>Email</th>
            <th>Город</th>
            <th>Адрес</th>
            <th>Сообщение</th>
            <th>Дата</th>
            <th>Статус</th>
            <th>Удалить</th>
        </tr>
        <?php foreach ($data['ordersInfo'] as $order): ?>
            <tr>
                <td><?php echo $order['id']; ?></td>
                <td><?php echo $order['name']; ?></td>
                <td><?php echo $order['surname']; ?></td>
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
                <td><?php echo $order['sum']; ?></td>
                <td><?php echo $order['tel']; ?></td>
                <td><?php echo $order['email']; ?></td>
                <td><?php echo $order['city']; ?></td>
                <td><?php echo $order['addres']; ?></td>
                <td><?php echo $order['message']; ?></td>
                <td><?php echo $order['date']; ?></td>
                <td>
                    <?php if($order['status']): ?>
                        <?php echo '<b>Обработан</b>'; ?>
                    <?php else: ?>
                        <a href="/adminOrder/changeOrderStatus/<?php echo $order['id']; ?>" data-toggle="tooltip" title="Обработать" onclick="return confirmDelete();"><i class="fa fa-check fa-lg"></i></a>
                        <div><?php echo '<b>Не обработан</b>'; ?></div>
                    <?php endif; ?>
                </td>
                <td><a href="/adminOrder/deleteOrder/<?php echo $order['id']; ?>" data-toggle="tooltip" title="Удалить" onclick="return confirmDelete();"><i class="fa fa-times fa-lg"></i></a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php else: ?>
    <div class="title-to-center">
        <h3>Нет ни одного заказа</h3>
    </div>
<?php endif; ?>