
<?php

if ($_SERVER['PHP_SELF'] == '/index.php') $page = 'Home';
if ($_SERVER['PHP_SELF'] == '/includes/com/page/month_table.php') $page = 'Table salary';

if ($_SERVER['PHP_SELF'] == '/includes/com/page/month_table.php' || '/includes/com/page/day_table.php') {
    $href_month_table = '/includes/com/page/month_table.php';
} else {
    $href_month_table = 'includes/com/page/month_table.php';
}



//la la la
?>



<!doctype html>
<html lang="en">
<head>
    <title> Home </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Отель № 2</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Ссылка на таблицу (in develop)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contacts (none href)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled (none href)</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

