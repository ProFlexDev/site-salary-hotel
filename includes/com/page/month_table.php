
<?php include ('header.php'); ?>


<?php

$href_day_table = 'includes/com/page/day_table.php';


include ('includes/config.php');
include ('includes/database.php');
include ('includes/functions.php');

include $_SERVER['DOCUMENT_ROOT']."/includes/functions.php";
include $_SERVER['DOCUMENT_ROOT']."/includes/database.php";

$connect = mysqli_connect('localhost', 'root', '', 'testproflex');



$staffId = 167;
$month = 9;
$monthlyReport = getMonthlyReport($month, $staffId);

// Вывод отчета по всем работам за сентябрь
echo "<table class='table table-striped'>";
echo "<thead><tr class='tr-month_table'>
    <th class='th_month_table th_date'>Дата</th>
    <th class='th_month_table'>Начало <br> рабочего дня</th>
    <th class='th_month_table'>Конец <br> рабочего дня</th>
    <th class='th_month_table'>Кол-во <br> генеральных уборок</th>
    <th class='th_month_table'>Кол-во <br> текущих уборок</th>
    <th class='th_month_table'>Кол-во <br> заездов</th>
    <th class='th_month_table'>Сумма оплаты <br> за день</th>
    </tr></thead>";


echo "<tbody>";

$totalPayment = 0;

foreach ($monthlyReport as $report) {
    echo "<tr>";
    echo "<td><a class='href_date' href=' <?= $href_day_table ?> '>{$report['date']}</a></td>";
    echo "<td>{$report['start_time']}</td>";
    echo "<td>{$report['end_time']}</td>";
    echo "<td>{$report['general_cleanings']}</td>";
    echo "<td>{$report['current_cleanings']}</td>";
    echo "<td>{$report['check_ins']}</td>";
    echo "<td>{$report['total_payment']}</td>";
    echo "</tr>";

    $totalPayment += $report['total_payment'];
}

echo "</tbody>";
echo "</table>";

echo "<p>Итоговая сумма за сентябрь: $totalPayment руб.</p>";



// Закрытие соединения

mysqli_close($connect);



?>



<style>
    .href_date{ text-decoration: none; color: #0a53be; font-weight: 700; }
    .th_date{ font-size: 22px; font-weight: 700; }
</style>



<?php include ('footer.php'); ?>


