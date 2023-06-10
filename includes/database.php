<?php

$connect = mysqli_connect('localhost',
    'root',
    '',
    'testproflex'
);

if (mysqli_connect_errno()){
    exit('Filed to connect to MySQL: ' . mysqli_error());
}

