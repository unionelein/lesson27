<?php
function __autoload($c)
{
    require_once $c.'.php';
}

function isLeap($year)
{
    return date("L", mktime(0,0,0, 7,7, $year));
}
