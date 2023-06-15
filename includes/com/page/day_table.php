<?php
include ('header.php');


include ('includes/config.php');
include ('includes/database.php');
include ('includes/functions.php');

include $_SERVER['DOCUMENT_ROOT']."/includes/functions.php";
include $_SERVER['DOCUMENT_ROOT']."/includes/database.php";


$connect = mysqli_connect('localhost', 'root', '', 'testproflex');



$staffId = 167;
$month = 9;
$monthlyReport = getMonthlyReport($month, $staffId);












include ('footer.php');

