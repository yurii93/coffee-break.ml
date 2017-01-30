
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/webroot/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../../favicon.ico">
    <title><?php echo SITE_NAME; ?></title>
    <link href="/webroot/css/bootstrap.css" rel="stylesheet">
    <link href="/webroot/css/admin-style.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css">
    <script src="/webroot/js/jquery.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">
    <div class="header clearfix">
        <nav>
            <ul class="nav nav-pills pull-right">
                <li><a href="/adminProduct">Товары</a></li>
                <li class="btn-group">
                    <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Заказы <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/adminOrder/index/finished">Обработаные заказы</a></li>
                        <li><a href="/adminOrder/index/unfinished">Необработаные заказы</a></li>
                    </ul>
                </li>
                <li><a href="/adminMessage">Сообщения</a></li>
                <li><a href="/adminComment">Отзывы</a></li>
                <li><a href="/adminUser">Пользователи</a></li>
            </ul>
        </nav>
        <h3 class="text-muted">Coffe-Break Admin</h3>
    </div>
</div> <!-- /container -->
    <a href="/" class="btn btn-success admin-shop-btn" data-toggle="tooltip" data-placement="bottom" title="На сайт"><i class="fa fa-shopping-bag fa-lg"></i></a>
    <a href="/user/logout" class="btn btn-danger admin-close-btn" data-toggle="tooltip" data-placement="bottom" title="Выйти"><i class="fa fa-power-off fa-lg"></i></a>

    <?php echo $content; ?>

    <div class="clearfix"></div>
<div class="container">
    <footer class="footer">
        <p>&copy; 2017 Coffe-Break, Inc.</p>
    </footer>
</div>
<script src="/webroot/js/bootstrap.min.js"></script>
<script>

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });


    setTimeout("$('.info-box').fadeOut(3000);", 6500);

    function confirmDelete() {
        if (confirm('Подтвердить действие!')) {
            return true;
        } else {
            return false;
        }
    }
</script>
</body>
</html>
