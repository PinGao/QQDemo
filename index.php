<?php
//入口文件

//把目前tp的生产模式变为开发模式
define('APP_DEBUG',true);//开发者模式的话，每次都会加载27个左右的文件。而生产者模式每次只会加载7个左右的文件
require_once 'ThinkPHP/ThinkPHP.php';//引入核心文件
?>