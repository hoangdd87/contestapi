<?php
/**
 * Created by PhpStorm.
 * User: HoangDD
 * Date: 10/15/16
 * Time: 10:23 PM
 */
include_once __DIR__ . '/PDOHelper.php';

$pdoHelper = new PDOHelper();
print_r( $pdoHelper->get_bainop( 1, 1));

//print_r($time1->getTimestamp()+$time1->format('.u'));

?>