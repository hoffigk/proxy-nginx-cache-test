<?php

$now = new DateTime($ts);
$expires = clone $now;
$expires->add(new DateInterval('PT10S'));

$ts = gmdate("D, d M Y H:i:s", $now->getTimestamp()) . " GMT";
$ts1 = gmdate("D, d M Y H:i:s", $expires->getTimestamp()) . " GMT";

header("Expires: $ts1");
header("Last-Modified: $ts");
header("Cache-Control: public");

echo $_SERVER['REQUEST_URI'] . ' ' . date('Y-m-d H:i:s');
