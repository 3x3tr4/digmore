<?php
//log
$f = fopen(dirname(__FILE__) . '/log.mon-2', 'a');

$date = date("j.n.y. h:i:s");
fwrite($f, $date . "\n");

$rrdFile = dirname(__FILE__) . "/data.rrd";

//graph output
if (! ($r = rrd_graph(
    dirname(__FILE__) . "/../web/bundles/ticker/images/mon-2.png",
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
        "AREA:realspeed1#000033:myspeed,15,*",
        "AREA:realspeed2#000066:myspeed,30",
        "AREA:realspeed3#000099:myspeed,60,*",
        "AREA:realspeed4#0000CC:myspeed,120,*",
        "AREA:realspeed5#0000FF:myspeed,240,*"
    )))
)
{
    fwrite($f, " Graph error: " . rrd_error());
}

fwrite($f, ' Graph OK');

fwrite($f, "\n");

fclose($f);
?>

