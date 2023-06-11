<?php //include ('includes/com/page/header.php'); ?>

<?php include ('header.php'); ?>







<h1> <?= 'hi Table Page!   He He :)' ?> </h1>


<?php

$connect = mysqli_connect('localhost',
    'root',
    '',
    'testproflex'
);

// Выполняем запрос к базе данных
$query = "SELECT * FROM statistics";
$result = mysqli_query($connect, $query);


// Выводим полученные данные на страницу
while ($row = mysqli_fetch_array($result)) {
    echo $row['start'] . ' ' . $row['end'] . "<br>";
}



// Закрываем соединение с базой данных
mysqli_close($connect);


?>





<?php include ('footer.php'); ?>


