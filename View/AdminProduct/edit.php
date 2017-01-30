<div class="container">
    <?php if (isset($data['warning'])) : ?>
        <div class="col-sm-6 col-sm-offset-3 alert alert-danger info-box"
             role="alert"><?php echo $data['warning']; ?></div>
    <?php endif; ?>
    <div class="clearfix"></div>
    <div class="title-to-center">
        <h2>Редактирование товара</h2>
    </div>
    <div class="col-sm-6 col-sm-offset-3">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="name-in-order">
                <span>Название *</span>
                <input type="text" name="title" value="<?php echo $data['productInfo']['title'];?>">
            </div>
            <div class="name-in-order">
                <span>Производитель *</span>
                <input type="text" name="vendor" value="<?php echo $data['productInfo']['vendor'];?>">
            </div>
            <div class="name-in-order">
                <span>Тип *</span>
                <input type="text" name="type" value="<?php echo $data['productInfo']['type'];?>">
            </div>
            <div class="name-in-order">
                <span>Цена *</span>
                <input type="number" name="price" min="0" value="<?php echo $data['productInfo']['price'];?>">
            </div>
            <div class="name-in-order">
                <span>Скидка в % </span>
                <input type="number" name="discount" value="<?php if($data['productInfo']['discount'] <1)
                {echo $data['productInfo']['discount'] * 100;} else { echo 0;}?>" min="0" max="99">
            </div>
            <div class="name-in-order">
                <span>Описание *</span>
                <textarea name="description"><?php echo $data['productInfo']['description'];?></textarea>
            </div>
            <div class="name-in-order">
                <span>Текущее изображение </span>
                <img src="<?php echo \Model\ProductModel::getImage($data['productInfo']['id']); ?>" width="100">
            </div>
            <div class="name-in-order">
                <span>Новое изображение (.jpg)</span>
                <input type="file" name="image">
            </div>
            <div class="name-in-order">
                <span>Новинка </span>
                <input type="checkbox" name="is_new" value="1" <?php if($data['productInfo']['is_new']) echo 'checked';?>>
            </div>
            <div class="name-in-order">
                <span>Наличие </span>
                <input type="checkbox" name="in_stock" value="1" <?php if($data['productInfo']['in_stock']) echo 'checked';?>>
            </div>
            <div class="submit-btn">
                <input type="submit" value="Редактировать" class="btn btn-success">
            </div>
        </form>
    </div>
</div>