<!DOCTYPE html>
<html>
<head>
    <title><?php echo SITE_NAME; ?></title>
    <link rel="shortcut icon" href="/webroot/images/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="/webroot/css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="/webroot/css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link rel="stylesheet" href="/webroot/css/jquery-ui.css">
    <link href="/webroot/css/nouislider.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Andika|Neucha" rel="stylesheet">
    <script src="/webroot/js/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/webroot/js/move-top.js"></script>
    <script type="text/javascript" src="/webroot/js/easing.js"></script>
    <script type="text/javascript" src="/webroot/js/jquery.jscrollpane.min.js"></script>
    <script src="/webroot/js/nouislider.min.js"></script>
    <script src="/webroot/js/wNumb.js"></script>
    <style>
        .pagination li a, .pagination li span {
            font-weight: bold;
            color: #444;
            border: 1px solid #aa9b77;
            background: none;
            margin-right: 10px;
        }

        .pagination li a:hover {
            background: #444;
            color: white;
        }

        .check-out .check input[type=number] {
            width: 40%;
            text-align: center;
        }
    </style>
</head>
<body>
<!--header-->
<div class="header">
    <div class="container">
        <div class="header-top">
            <div class="logo">
                <a href="/"><i class="fa fa-coffee fa-4x"></i></a>
            </div>
            <div class="top-nav">
                <span class="menu"><img src="/webroot/images/menu.png" alt=""> </span>
                <ul class="icon1 sub-icon1">
                    <li><a href="/product/all">Товары</a></li>
                    <li><a href="/page/show/about">О нас</a></li>
                    <li><a href="/page/show/delivery">Доставка</a></li>
                    <li><a href="/contact">Контакты</a></li>
                    <li><a href="/cart" class="caret-fix"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span
                                id="cart-count" class="badge"><?php echo \Common\Cart::countItems(); ?></span></a>
					</li>
                    <?php if (\Common\Session::get('login')) : ?>
                        <li><a href="/user/logout">Выход</a></li>
                    <?php else: ?>
                        <li><a href="/user/login">Вход</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="clearfix"></div>