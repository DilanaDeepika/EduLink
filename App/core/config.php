<?php
date_default_timezone_set('Asia/Colombo');
$apiKey = 'AIzaSyDC8T1B5J4DjmTkgxhEjv5i52Ryeix1gwo';

if($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == '127.0.0.1')
{

    define('DBNAME', 'EduLinkdb'); 

    define('DBHOST', 'mysql-2179f0ec-dilanasuwendra-3e06.i.aivencloud.com');
    define('DBUSER', 'avnadmin');
    
    define('DBPASS', git add App/core/config.php'YOUR_PASSWORD_HERE'); 


    define('DBPORT', 23163); 
    define('DBSSL', 'C:/xampp/htdocs/EDULINK/ca.pem'); 

    define('ROOT', 'http://localhost/EDULINK/public');
}
else
{
    define('ROOT', 'http://www.EduLink.lk');
}

define('APPROOT', dirname(__DIR__)); 
define('VIEWSROOT', dirname(APPROOT) . '/views');
?>

