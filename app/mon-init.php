<?
$f = fopen('log.mon-init', 'a');

$date = date("j.n.y G:i:s");

fwrite($f, $date . "\n");

$rrdFile = dirname(__FILE__) . "/data.rrd";

$options = array(
    "--step", "60",            // Use a step-size of 15 seconds
    "--start", "1398124800",     // this rrd started 61 week
    "DS:speed:GAUGE:120:0:10000",
    "RRA:AVERAGE:0.5:1:1000",
    "RRA:MIN:0.5:60:24",
    "RRA:MAX:0.5:3600:30"
);


if (! ($r = rrd_create($rrdFile, $options)))
{
    fwrite($f, 'Creation error: ' . rrd_error());
}

fwrite($f, ' ' . $rrdFile . ' created.');

fwrite($f, "\n");

fclose($f);
?>
