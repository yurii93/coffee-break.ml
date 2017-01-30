<div class="check-out-2">
    <h2>Вход</h2>
    <?php if(isset($data['warning'])) :?>
        <div class="col-sm-4 col-sm-offset-4 alert alert-danger info-box" role="alert"><?php echo $data['warning']; ?></div>
    <?php endif; ?>
    <?php if(isset($data['success'])) :?>
        <div class=" col-sm-4 col-sm-offset-4 alert alert-success info-box" role="alert"><?php echo $data['success']; ?></div>
    <?php endif; ?>
    <div class="col-sm-4 col-sm-offset-4 contact-form order-form">
        <form action="" method="post">
            <div class="name-in-order">
                <span>Email *</span>
                <input type="text" name="email">
            </div>
            <div class="name-in-order">
                <span>Пароль *</span>
                <input type="password" name="password">
            </div>
            <div class="to-center">
                <input type="submit" value="Войти">
            </div>
        </form>
        <div class="to-center">
            <a href="/user/register" class="register">РЕГИСТРАЦИЯ</a>
        </div>
    </div>
    <div class="clearfix"></div>
</div>