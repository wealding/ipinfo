<?php
ini_set('memory_limit', '512M');

require_once 'vendor/autoload.php';
require_once 'src/ding/ipinfo.php';

//默认初始化ipip和qqwry两个数据库
$ipinfo = new ding\ipinfo();
var_dump($ipinfo->find('104.19.250.66', 'CN'));
var_dump($ipinfo->findMap('202.102.232.6', 'CN'));
var_dump($ipinfo->findInfo('202.102.232.6', 'CN'));


//只初始化ipip数据库
$ipinfo = new ding\ipinfo('ipip');
var_dump($ipinfo->find('104.19.250.66', 'CN'));
var_dump($ipinfo->findMap('202.102.232.6', 'CN'));
var_dump($ipinfo->findInfo('202.102.232.6', 'CN'));
