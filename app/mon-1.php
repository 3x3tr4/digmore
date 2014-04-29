<?php
// open log file
$f = fopen(dirname(__FILE__) . '/log.mon-1', 'a');

// rrd DB
$rrdFile = dirname(__FILE__) . "/data.rrd";

// exec time
$date = date("j.n.y G:i:s");
// actual time
$now = mktime();
// actual value
$val = rand(1000,9000);

fwrite($f, $date . "\n");

// update rrd DB
$r = rrd_update(
    $rrdFile,
    array("$now:$val")
);

fwrite($f, ' Update ' . $rrdFile . '..');

if (! $r)
{
    fwrite($f, 'error: ' . rrd_error());
}

fwrite($f, 'insert mon(' . $date . ') = ' . $val);

fwrite($f, "\n");

fwrite($f, ' Generate graph..');

// generate graph
$r = rrd_graph(
    dirname(__FILE__) . "/../web/bundles/ticker/images/mon-1.png",
    array(
        "--start", "1398124800",
        "--end", "1398211200",
        "--vertical-label", "m/s",
        "--slope-mode",
        //"-–height", "600",
        //"–-width", "800",
        //"–-alt-autoscale-max",
        "--title=Work Utility",
        "DEF:myspeed=$rrdFile:speed:AVERAGE",
        "CDEF:realspeed1=myspeed,15,*",
        "CDEF:realspeed2=myspeed,30,*",
        "CDEF:realspeed3=myspeed,60,*",
        "CDEF:realspeed4=myspeed,120,*",
        "CDEF:realspeed5=myspeed,240,*",
        "LINE:realspeed1#330000",
        "LINE2:realspeed2#660000",
        "LINE3:realspeed3#990000",
        "LINE4:realspeed4#CC0000",
        "LINE5:realspeed5#FF0000"
    )
);

if (! $r)
{
    fwrite($f, 'error: ' . rrd_error());
}

fwrite($f, 'OK');

fwrite($f, "\n");

fclose($f);
?>

