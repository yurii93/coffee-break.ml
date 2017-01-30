<!DOCTYPE html>
<html>
<head>
    <title><?php echo SITE_NAME; ?></title>
    <link rel="shortcut icon" href="/webroot/images/favicon.ico" type="image/x-icon">
    <link href="/webroot/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="/webroot/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Andika|Neucha" rel="stylesheet">
    <script src="/webroot/js/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/webroot/js/move-top.js"></script>
    <script type="text/javascript" src="/webroot/js/easing.js"></script>
    <script type="text/javascript" src="/webroot/js/jquery.jscrollpane.min.js"></script>
</head>
<body>
<!--header-->
<div class="header-index">
    <div class="container">
        <div class="header-top">
            <div class="logo">
                <a href="/"><i class="fa fa-coffee fa-4x"></i></a>
            </div>
            <div class="top-nav">
                <span class="menu"><img src="/webroot/images/menu.png" alt=""> </span>
                <ul class="icon1 sub-icon1">
                    <li><a href="/product/all" >Товары</a></li>
                    <li><a href="/page/show/about">О нас</a></li>
                    <li><a href="/page/show/delivery">Доставка</a></li>
                    <li><a href="/contact" >Контакты</a></li>
                    <li><a href="/cart" class="caret-fix"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span
                                id="cart-count" class="badge"><?php echo \Common\Cart::countItems(); ?></span></a>
					</li>
                    <?php if(\Common\Session::get('login')) :?>
                        <li><a href="/user/logout">Выход</a></li>
                    <?php else: ?>
                        <li><a href="/user/login">Вход</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<div class="banner">
    <div class="container">
        <h1>Всегда качественный и вкусный кофе</h1>
        <p>Мы так много хотим сделать. Мы не в лучшей форме. Мы не выспались ночью. Мы немного подавлены. Кофе решает все эти проблемы с помощью одной восхитительной маленькой чашки.</p>
        <a href="#content" class="scroll down"><img src="/webroot/images/arr.png" alt=""></a>
    </div>
</div>
<div class="clearfix"></div>