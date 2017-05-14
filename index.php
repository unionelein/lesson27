<?php
require_once 'library/func.php';

use library\MyZodiac as MyZodiac;

try {
    $myzodiac = new MyZodiac('1997-02-25');
    echo $myzodiac->zodiac();
} catch (Exception $e) {
    echo 'Выброшено исключение: '.$e->getMessage()."\n";
}
/**
 * bracnh1
 */