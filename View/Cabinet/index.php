<div class="cabinet">
    <h1>Здравствуйте, <?php echo \Common\Session::get('name'); ?></h1>
    <div>
            <ul class="cabinet-menu">
                <li data-toggle="tooltip" title="ИСТОРИЯ ВАШИХ ЗАКАЗОВ" data-placement="bottom"><a href="/cabinet/orders"><i class="fa fa-list fa-3x"></i></a></li>
                <li data-toggle="tooltip" title="ВАШИ ДАННЫЕ" data-placement="bottom"><a href="/cabinet/info"><i class="fa fa-user fa-3x"></i></a></li>
                <li class="last-item" data-toggle="tooltip" title="ИЗМЕНИТЬ ПАРОЛЬ" data-placement="bottom"><a href="/cabinet/password"><i class="fa fa-cogs fa-3x"></i></a></li>
            </ul>
    </div>
    <div class="clearfix"></div>
</div>