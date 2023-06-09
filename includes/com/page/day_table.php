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

    // Закрытие соединения



    ////////////////
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




// Вывод списка работ за выбранный день

    // Здесь вы можете добавить свой код для обработки переданной даты и выполнения соответствующих действий
} else {
    // Если параметр 'date' не передан, вы можете вывести сообщение об ошибке или выполнить другие действия
    echo "Дата не указана.";
}

mysqli_close($connect);





include ('footer.php');

