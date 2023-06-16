

<?php



include ('includes/config.php');
include ('includes/functions.php');

include $_SERVER['DOCUMENT_ROOT']."/includes/functions.php";



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
    echo "<td><a class='href_date' href='  '> {$report['date']} </a></td>";
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




// Вывод списка работ за выбранный день


if (isset($_GET['date'])) {
    // Получаем переданную дату
    $date = $_GET['date'];
    // Выводим дату
    $workList = getDailyWork($date);



    // Вывод результатов
    echo "<table class='table table-striped'>";
    echo "<thead><tr><th>id_work</th><th>Номер комнаты</th><th>Категория комнаты</th><th>Тип уборки</th><th>Начало работы</th><th>Конец работы</th><th>Стоимость уборки</th></tr></thead>";
    echo "<tbody>";

    foreach ($workList as $work) {
        echo "<tr>";
        echo "<td>{$work['id_work']}</td>";
        echo "<td>{$work['room_number']}</td>";
        echo "<td>{$work['category_room']}</td>";
        echo "<td>{$work['work_type']}</td>";
        echo "<td>{$work['start_clean']}</td>";
        echo "<td>{$work['end_clean']}</td>";
        echo "<td>{$work['cleaning_price']}</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";


    // echo "<p>Итоговая сумма за день: $totalPayment руб.</p>";


    if (mysqli_connect_errno()) {
        exit('Failed to connect to MySQL: ' . mysqli_error());
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
</style>



