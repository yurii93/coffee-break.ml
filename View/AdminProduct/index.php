<div class="container">
    <?php if(isset($data['warning'])) :?>
        <div class="col-sm-4 col-sm-offset-4 alert alert-danger info-box" role="alert"><?php echo $data['warning']; ?></div>
    <?php endif; ?>
    <?php if(isset($data['success'])) :?>
        <div class="col-sm-4 col-sm-offset-4 alert alert-success info-box" role="alert"><?php echo $data['success']; ?></div>
    <?php endif; ?>
    <div class="clearfix"></div>
    <div class="title-to-center">
        <h2>Товары</h2>
    </div>
    <div class="add-product">
        <a href="/adminProduct/addProduct"><i class="fa fa-plus fa-lg"></i> Добавить товар</a>
        <div class="pull-right">
            <a href="/adminProduct/displayFormat/xml" class="btn btn-link">XML</a>|
            <a href="/adminProduct/displayFormat/json" class="btn btn-link">JSON</a>
        </div>
    </div>
    <?php if($data['productsInfo']): ?>
        <table class="table table-bordered">
            <tr class="active">
                <th>Id</th>
                <th>Название</th>
                <th>Производитель</th>
                <th>Тип</th>
                <th>Изображение</th>
                <th>Цена</th>
                <th>Редактировать</th>
                <th>Удалить</th>
            </tr>
            <?php foreach ($data['productsInfo'] as $product): ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td>
                        <b><a href="product/show/<?php echo $product['id']; ?>"><?php echo $product['title']; ?></a></b>
                    </td>
                    <td><?php echo $product['vendor']; ?></td>
                    <td><?php echo $product['type']; ?></td>
                    <td>
                       <img src="<?php echo \Model\ProductModel::getImage($product['id']); ?>" width="50">
                    </td>
                    <td><?php echo $product['price']; ?></td>
                    <td><a href="/adminProduct/editProduct/<?php echo $product['id']; ?>" data-toggle="tooltip" title="Редактировать"><i class="fa fa-pencil-square-o fa-lg"></i></a></td>
                    <td><a href="/adminProduct/deleteProduct/<?php echo $product['id']; ?>" data-toggle="tooltip" title="Удалить" onclick="return confirmDelete();"><i class="fa fa-times fa-lg"></i></a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <div class="title-to-center">
            <h3>Нет ни одного товара</h3>
        </div>
    <?php endif; ?>
</div>
