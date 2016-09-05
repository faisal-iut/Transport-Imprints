<?php

$d='trackimprints.byethost6.com';

$str=preg_replace('/^trackimprints\./', 'faisal.',$_SERVER['SERVER_NAME']);
$serverNameArray = explode('.', $_SERVER['SERVER_NAME']);
echo $serverNameArray;
;?>