<?php


include ('includes/config.php');
include ('includes/database.php');
include ('includes/functions.php');
//include $_SERVER['DOCUMENT_ROOT']."/includes/functions.php";


include ('includes/com/page/header.php');


include ('includes/com/page/home.php');

//include $_SERVER['DOCUMENT_ROOT']."/includes/com/page/month_table.php";







$connect = mysqli_connect('localhost', 'root', '', 'testproflex');

$staffId = 167;
$month = 9;
$monthlyReport = getMonthlyReport($month, $staffId);
// echo "<pre>";
// print_r($monthlyReport);
// echo "<pre>";
// Вывод отчета по всем работам за сентябрь
echo "<table class=' tableded ' border='black 2px solid'>";
echo "<thead><tr class='tr-month_table'>
    <th class='th_month_table th_date'>Дата</th>
    <th class='th_month_table'>Начало <br> рабочего дня</th>
    <th class='th_month_table'>Конец <br> рабочего дня</th>
    <th class='th_month_table'>Кол-во <br> генеральных уборок</th>
    <th class='th_month_table'>Кол-во <br> текущих уборок</th>
    <th class='th_month_table'>Кол-во <br> заездов</th>
    <th class='th_month_table'>Сумма оплаты <br> за день</th>
    </tr></thead>";


//
$totalPayment = 0;
$totalPayment_day = 0;

foreach ($monthlyReport as $report) {
    echo "<tr>";
    // echo "<td><a class='href_date' href=\"date={$report['date']}\"> {$report['date']} </a></td>";
    echo "<td><a href=\"index.php?date={$report['date']}\" class='href_date'>{$report['date']}</a></td>";
    echo "<td>{$report['start_time']}</td>";
    echo "<td>{$report['end_time']}</td>";
    echo "<td>{$report['general_cleanings']}</td>";
    echo "<td>{$report['current_cleanings']}</td>";
    echo "<td>{$report['check_ins']}</td>";
    echo "<td>{$report['total_payment']}</td>";
    echo "</tr>";

    $totalPayment += $report['total_payment'];
}


echo "</table>";

echo "<p>Итоговая сумма за сентябрь: $totalPayment руб.</p>";




// Вывод списка работ за выбранный день


if (isset($_GET['date'])) {
    // Получаем переданную дату
    $date = $_GET['date'];
    // Выводим дату
    $workList = getDailyWork($date);





    // Вывод результатов
    echo "<table class='tableded'>";
    echo "<thead><tr><th>id_work</th><th>Номер комнаты</th><th>Категория комнаты</th><th>Тип уборки</th><th>Начало работы</th><th>Конец работы</th><th>Стоимость уборки</th></tr></thead>";
    echo "<tbody>";

    foreach ($workList as $work) {
        echo "<tr class='tr-month_table'>";
        echo "<td class='th_month_table'>{$work['id_work']}</td>";
        echo "<td class='th_month_table'>{$work['room_number']}</td>";
        echo "<td class='th_month_table'>{$work['category_room']}</td>";
        echo "<td class='th_month_table'>{$work['work_type']}</td>";
        echo "<td class='th_month_table'>{$work['start_clean']}</td>";
        echo "<td class='th_month_table'>{$work['end_clean']}</td>";
        echo "<td class='th_month_table'>{$work['cleaning_price']}</td>";
        echo "</tr>";
        $totalPayment_day += $work['cleaning_price'];
    }

    echo "</tbody>";
    echo "</table>";


    echo "<p>Итоговая сумма за день: $totalPayment_day руб.</p>";


    if (mysqli_connect_errno()) {
        exit('Failed to connect to MySQL: ' . mysqli_error($connect));
    }

// Пример использования функций для получения отчета по всем работам за сентябрь


    // $sql = "UPDATE books SET name = :name, genre = :genre WHERE id = :id";
// $stmt = $database->prepare($sql);
// $stmt->bindParam(':name', $name);
// $stmt->bindParam(':genre', $genre);
// $stmt->bindParam(':id', $book_id);
// $stmt->execute();





    // Здесь вы можете добавить свой код для обработки переданной даты и выполнения соответствующих действий
} else {
    // Если параметр 'date' не передан, вы можете вывести сообщение об ошибке или выполнить другие действия
    echo "Дата не указана.";
}




// Закрытие соединения

mysqli_close($connect);



?>



<style>
    .href_date{ text-decoration: none; color: #0a53be; font-weight: 700; }
    .th_date{ font-size: 22px; font-weight: 700; }
    .th_month_table{ padding: 15px 5px }




    .tableded{width:100%;border:none;border-collapse:separate}
    .tableded thead th{font-weight:bold;text-align:left;border:none;padding:15px 5px;background:#EDEDED;font-size:14px;border-top:1px solid #ddd}
    .tableded tbody td{text-align:left;border:none;padding:10px 5px;font-size:16px;vertical-align:top;font-weight:600}
    .tableded tr td:first-child,.table tr th:first-child{border-left:1px solid #ddd}
    .tableded tr td:last-child,.table tr th:last-child{border-right:1px solid #ddd}
    .tableded thead tr th:first-child{border-radius:20px 0 0 0}
    .tableded thead tr th:last-child{border-radius:0 20px 0 0}
    .tableded tbody tr:nth-child(2n){background:#F8F8F8}
    .tableded tbody tr:last-child td{border-bottom:1px solid #ddd}
    .tableded tbody tr:last-child td:first-child{border-radius:0 0 0 20px}
    .tableded tbody tr:last-child td:last-child{border-radius:0 0 20px 0}
</style>









<?php include ('includes/com/page/footer.php');





