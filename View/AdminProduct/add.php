<div class="container">
    <?php if (isset($data['warning'])) : ?>
        <div class="col-sm-6 col-sm-offset-3 alert alert-danger info-box"
             role="alert"><?php echo $data['warning']; ?></div>
    <?php endif; ?>
    <div class="clearfix"></div>
    <div class="title-to-center">
        <h2>Новый товар</h2>
    </div>
    <div class="col-sm-6 col-sm-offset-3">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="name-in-order">
                <span>Название *</span>
                <input type="text" name="title">
            </div>
            <div class="name-in-order">
                <span>Производитель *</span>
                <input type="text" name="vendor">
            </div>
            <div class="name-in-order">
                <span>Тип *</span>
                <input type="text" name="type">
            </div>
            <div class="name-in-order">
                <span>Цена *</span>
                <input type="number" name="price" min="0">
            </div>
            <div class="name-in-order">
                <span>Скидка в % </span>
                <input type="number" name="discount" value="0" min="0" max="99">
            </div>
            <div class="name-in-order">
                <span>Описание *</span>
                <textarea name="description"></textarea>
            </div>
            <div class="name-in-order">
                <span>Изображение (.jpg)</span>
                <input type="file" name="image">
            </div>
            <div class="name-in-order">
                <span>Новинка </span>
                <input type="checkbox" name="is_new" value="1">
            </div>
            <div class="name-in-order">
                <span>Наличие </span>
                <input type="checkbox" name="in_stock" value="1" checked>
            </div>
            <div class="submit-btn">
                <input type="submit" value="Добавить" class="btn btn-success">
            </div>
        </form>
    </div>
</div>