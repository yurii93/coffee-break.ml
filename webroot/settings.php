<?php

define('SITE_DIR', dirname(dirname(__FILE__)));
define('DS', DIRECTORY_SEPARATOR);

define('SITE_NAME', 'COFFEE-BREAK');

// DB settings
define('DB_HOST', 'mysql.zzz.com.ua');
define('DB_USER', 'php1000');
define('DB_PASS', 'php1000');
define('DB_NAME', 'php_dev');

//Salt
define('SALT', 'shdI4I1BsdaA32Sib');

//PHPMailer settings
define('FROM_NAME', 'COFEE-BREAK');
define('FROM_EMAIL', 'info@coffe-break.com');;
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', '587');
define('SMTP_CHARSET', 'UTF-8');
define('SMTP_USERNAME', 'withgodinyourheart@gmail.com');
define('SMTP_PASSWORD', 'withgodinheart');

// Timezone
define('TIME_ZONE', 'Europe/Kiev');

// Number of products on page
define('PRODUCTS_ON_PAGE', 6);

// Directory with cache
define('CACHE_DIRECTORY', SITE_DIR.DS.'cache/products');