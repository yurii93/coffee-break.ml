<div class="container">
<?php if(isset($data['warning'])) :?>
    <div class="col-sm-4 col-sm-offset-4 alert alert-danger info-box" role="alert"><?php echo $data['warning']; ?></div>
<?php endif; ?>
<?php if(isset($data['success'])) :?>
    <div class="col-sm-4 col-sm-offset-4 alert alert-success info-box" role="alert"><?php echo $data['success']; ?></div>
<?php endif; ?>
<div class="clearfix"></div>
<div class="title-to-center">
    <h2>Отзывы</h2>
</div>
<?php if($data['comments']): ?>
    <table class="table table-bordered">
        <tr class="active">
            <th>Id</th>
            <th>Товар</th>
            <th>Автор</th>
            <th>Отзыв</th>
            <th>Дата</th>
            <th>Удалить</th>
        </tr>
        <?php foreach ($data['comments'] as $comment): ?>
            <tr>
                <td><?php echo $comment['id']; ?></td>
                <td>
                    <?php foreach ($data['productsInfo'] as $product): ?>
                        <?php if($comment['productId'] == $product['id']):?>
                            <b><a href="product/show/<?php echo $product['id']; ?>"><?php echo $product['title']; ?></a></b>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </td>
                <td><?php echo $comment['author']; ?></td>
                <td><?php echo $comment['comment']; ?></td>
                <td><?php echo $comment['date']; ?></td>
                <td><a href="/adminComment/deleteComment/<?php echo $comment['id']; ?>" data-toggle="tooltip" title="Удалить" onclick="return confirmDelete();"><i class="fa fa-times fa-lg"></i></a></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <div class="title-to-center">
        <h3>Нет ни одного отзыва</h3>
    </div>
<?php endif; ?>
</div>
    