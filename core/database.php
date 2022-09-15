<?php
define('CRLF', "\r\n");
error_reporting(E_ALL);

require 'lazydb.php';

$params = require __DIR__ . '/config.php';

// Please modify the below to fit your database config
// host, username, pw, database
$db = new LazyDB($params["HOST"], $params["USER"], $params["PASSWORD"], $params["DATABASE"]);
