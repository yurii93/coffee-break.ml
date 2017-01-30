<?php include_once SITE_DIR . "/View/include/index-header.php"?>

<?php if(\Common\Session::get('login') && !isset($data['noCabinetOrAdmin'])): ?>
    <div id="click" data-toggle="tooltip" title="<?php if(\Common\Session::get('role') == 'admin') {echo 'АДМИН ПАНЕЛЬ';} else {echo 'КАБИНЕТ';} ?>">
        <?php if(\Common\Session::get('role') == 'admin'): ?>
            <a href="/admin"><span class="fa fa-sign-in fa-2x"></span></a>
        <?php else: ?>
            <a href="/cabinet"><span class="fa fa-sign-in fa-2x"></span></a>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php if(\Common\Session::get('orderActive') && \Common\Session::get('products')) :?>
    <a href="/order" class="filter-make"><div id="order-active" data-toggle="tooltip" title="К ОФОРМЛЕНИЮ"><i class="fa fa-shopping-basket fa-2x"></i></div></a>
<?php endif; ?>

<?php echo $content; ?>

<?php include_once SITE_DIR . "/View/include/footer.php"?>