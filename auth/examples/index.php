<?php
/**
 * Created by PhpStorm.
 * User: appeon
 * Date: 2020/7/2
 * Time: 15:34
 */

use Auth\DefaultApiAuthencator;
require '../vendor/autoload.php';

$request = 'https://www.666.com/login?appId=1001&timestamp=1454568865&token=a78cdefhrtes998erej';
$apiAuth = new DefaultApiAuthencator();
try{
    $apiAuth->auth($request);
}catch (\RuntimeException $e){
    echo $e->getMessage();
}
