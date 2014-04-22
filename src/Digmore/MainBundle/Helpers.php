<?php

namespace Digmore\MainBundle;

class Helpers
{
    // URL to the script
    // Change WEBSERVER_IP to your Webserver IP or Webserver Domain if you have it.
    define('SCRIPT_URL', '/cgm/');

    // Time in Seconds to Auto Refresh the script
    define('SCRIPT_REFRESH', 30);

    // Show Pool and User name
    define('SHOW_POOLS', TRUE);

    // E-Mail for Alerts
    define('ALERT_EMAIL', 'your@email.com');

    // Maximum allowed GPU Temperature before Alert is sent
    define('ALERT_TEMP', 82);

    // Maximum allowed difference in percentage (%) between 5s MH/s and (avg) MH/s before Alert is sent.
    // Formula : DIFFERENCE = 100 - ((5s / avg) * 100)
    //
    // e.g. If (avg) is 500 and 5s drops to 400 the difference will be:
    // DIFFERENCE = 100 - ((400 / 500) * 100) = 20%
    // If ALERT_MHS is set to 20, Alert will be sent.
    define('ALERT_MHS', 20);

    // Maximum allowed stales percentage (%). If crossed it won't send Email, just color it red on dashboard.
    define('ALERT_STALES', 5);

    /* Connection Timeout in Seconds */
    define('SOCK_TIMEOUT', '3');

    ini_set('default_socket_timeout', SOCK_TIMEOUT);

    /* Script Allowed Execution Time */
    set_time_limit(0);

    public static function getsock($addr, $port)
    {
        $socket = null;
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

        if ($socket === false || $socket === null)
        {
            $error = socket_strerror(socket_last_error());
            $msg = "socket create(TCP) failed";
            //echo "ERR: $msg '$error'\n";
            return null;
        }

        socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => SOCK_TIMEOUT, 'usec' => 0));
        socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => SOCK_TIMEOUT, 'usec' => 0));

        $res = socket_connect($socket, $addr, $port);
        if ($res === false)
        {
            $error = socket_strerror(socket_last_error());
            $msg = "socket connect($addr,$port) failed";
            //echo "ERR: $msg '$error'\n";
            socket_close($socket);
            return null;
        }

        return $socket;
    }

    public static function readsockline($socket)
    {
        $line = '';
        while (true)
        {
            $byte = socket_read($socket, 1);
            if ($byte === false || $byte === '')
                break;
            if ($byte === "\0")
                break;
            $line .= $byte;
        }
        return $line;
    }

    public static function request($cmd, $ip, $port)
    {
        $socket = getsock($ip, $port);

        if ($socket != null)
        {
            socket_write($socket, $cmd, strlen($cmd));
            $line = readsockline($socket);
            socket_close($socket);

            if (strlen($line) == 0)
            {
                //echo "WARN: '$cmd' returned nothing\n";
                return $line;
            }

            if (substr($line,0,1) == '{')
                return json_decode($line, true);

            $data = array();

            $objs = explode('|', $line);
            foreach ($objs as $obj)
            {
                if (strlen($obj) > 0)
                {
                    $items = explode(',', $obj);
                    $item = $items[0];
                    $id = explode('=', $items[0], 2);
                    if (count($id) == 1 or !ctype_digit($id[1]))
                        $name = $id[0];
                    else
                        $name = $id[0].$id[1];

                    if (strlen($name) == 0)
                        $name = 'null';

                    if (isset($data[$name]))
                    {
                        $num = 1;
                        while (isset($data[$name.$num]))
                            $num++;
                        $name .= $num;
                    }

                    $counter = 0;
                    foreach ($items as $item)
                    {
                        $id = explode('=', $item, 2);
                        if (count($id) == 2)
                            $data[$name][$id[0]] = $id[1];
                        else
                            $data[$name][$counter] = $id[0];

                        $counter++;
                    }
                }
            }

            return $data;
        }

        return null;
    }

    public static function seconds_to_time($input_seconds)
    {
        $seconds_in_minute = 60;
        $seconds_in_hour   = 60 * $seconds_in_minute;
        $seconds_in_day    = 24 * $seconds_in_hour;

        // extract days
        $days = floor($input_seconds / $seconds_in_day);

        // extract hours
        $hour_seconds = $input_seconds % $seconds_in_day;
        $hours = floor($hour_seconds / $seconds_in_hour);

        // extract minutes
        $minute_seconds = $hour_seconds % $seconds_in_hour;
        $minutes = floor($minute_seconds / $seconds_in_minute);

        // extract the remaining seconds
        $remaining_seconds = $minute_seconds % $seconds_in_minute;
        $seconds = ceil($remaining_seconds);

        // return the final array
        $obj = array(
            'd' => (int)$days,
            'h' => sprintf('%02d', (int)$hours),
            'm' => sprintf('%02d', (int)$minutes),
            's' => sprintf('%02d', (int)$seconds)
        );
        return $obj;
    }

    /**
     * writeOut
     * in
     *  string  $varName
     * out
     *  variable log HMTL
     */
    public static function writeOut($varName) {
        echo '<pre>';

        if (gettype($$varName) == 'array')
        {
            print_r($$varName, 1);
        } else {
            echo $$varName;
        }

        echo '</pre>';
    }

    /**
     * writeField
     * in
     *  string  $name
     *  string/int  $value
     *  string  $unit
     *  bool    $buffer
     * out
     *  data field HTML
     */
    public static function writeField($name = '', $value = 0, $unit = '', $buffer = true)
    {
        $html = '<pre class="field">' . $name . ': <span class="value">' . $value . ' ' . $unit . '</span></pre>';

        if ($buffer)
        {
            return $html;
        } else {
            echo $html;
        }
    }

    /**
     * writeCondField
     * in
     *  string  $name
     *  bool    $test
     *  string  $trueLabel
     *  string  $falseLabel
     * out
     *  conditioned data field HTML
     */
    public static function writeCondField($name = '', $test = false, $trueLabel = 'ON', $falseLabel = 'OFF', $unit = '', $buffer = true)
    {
        return
            writeField(
                $name,
                '<span class="' . ($test ? 'ok' : 'error') . '">' . ($test ? $trueLabel : $falseLabel) . '</span>',
                $unit,
                $buffer
            );
    }
}
