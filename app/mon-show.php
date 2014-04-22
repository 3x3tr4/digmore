<?php
$rrdFile = dirname(__FILE__) . "/data.rrd";

$info = rrd_info($rrdFile);

print_r($info);
?>

