<div class="cabinet">
    <h2>Изменить пароль</h2>
    <div class="col-sm-4 col-sm-offset-4">
        <?php if(isset($data['warning'])) :?>
            <div class="alert alert-danger info-box" role="alert"><?php echo $data['warning']; ?></div>
        <?php endif; ?>
        <?php if(isset($data['success'])) :?>
            <div class="alert alert-success info-box" role="alert"><?php echo $data['success']; ?></div>
        <?php endif; ?>
        <form class="cabinet-form" action="" method="post">
            <div class="name-in-order">
                <span>Старый пароль *</span>
                <input type="password" name="old-password">
            </div>
            <div class="name-in-order">
                <span>Новый пароль *</span>
                <input type="password" name="new-password">
            </div>
            <div class="to-center">
                <input type="submit" value="Изменить">
            </div>
        </form>
        <a href="/cabinet" class="hvr-shutter-in-horizontal cabinet-btn">Назад</a>
    </div>
    <div class="clearfix"></div>
</div>