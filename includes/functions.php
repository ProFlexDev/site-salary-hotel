<?php


include ('includes/config.php');
include ('includes/database.php');



$staffId = 167;
$month = 9;

// Функция для получения отчета по всем работам за сентябрь
function getMonthlyReport($month, $staffId)
{
    $connect = mysqli_connect('localhost', 'root', '', 'testproflex');





    // Запрос для получения отчета по всем работам за указанный месяц
    $query = "
    SELECT
    DATE_FORMAT(start, '%Y-%m-%d') AS date,
    (
        SELECT TIME_FORMAT(Time(start), '%H:%i') FROM statistics WHERE DATE(start) = date AND work = 0
    ) AS start_time,
    
    (
        SELECT TIME_FORMAT(Time(end), '%H:%i') FROM statistics WHERE DATE(start) = date AND work = 0
    ) AS end_time,
    SUM(CASE WHEN work = 1 THEN 1 ELSE 0 END) AS general_cleanings,
    SUM(CASE WHEN work = 2 THEN 1 ELSE 0 END) AS current_cleanings,
    SUM(CASE WHEN work = 3 THEN 1 ELSE 0 END) AS check_ins,
    (
        SELECT SUM(cleaning_price)
        FROM
        (
            SELECT
                s.id AS id_work,
                p.price AS cleaning_price
            FROM
                statistics AS s
            INNER JOIN
                prices AS p ON s.work = p.work
            INNER JOIN 
                rooms ON rooms.id = s.room
            WHERE
                (
                    (s.work = 1 AND rooms.id = 2) OR
                    (s.work = 1 AND rooms.type = 3) OR
                    (s.work = 1 AND rooms.type = 1) OR
                    (s.work = 2 AND rooms.type = 1) OR
                    (s.work = 3 AND rooms.type = 1) OR
                    (s.work = 2 AND rooms.type = 2) OR
                    (s.work = 2 AND rooms.type = 3) OR
                    (s.work = 3 AND rooms.type = 2) OR
                    (s.work = 3 AND rooms.type = 3)
                )
                AND
                DATE(s.created) = date
        ) AS subquery
    ) AS total_payment
FROM
    statistics
INNER JOIN
    works ON statistics.work = works.id
WHERE
    staff = ?
    AND MONTH(start) = ?
GROUP BY
    date
ORDER BY
    date ASC;
    ";

    $stmt = $connect->prepare($query);
    $stmt->bind_param('is', $staffId, $month);
    $stmt->execute();
    if ($stmt->errno) {
        exit('Failed to execute statement: ' . $stmt->error);
    }
    $result = $stmt->get_result();
    $report = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();

    return $report;
}

// Проверка соединения
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_error());
}

// Пример использования функции getMonthlyReport


// Функция для получения списка работ за выбранный день
function getDailyWork($date)
{
    $connect = mysqli_connect('localhost', 'root', '', 'testproflex');

    if (mysqli_connect_errno()) {
        exit('Failed to connect to MySQL: ' . mysqli_error());
    }

    // Запрос для получения списка работ за выбранный день
    $query = "
    SELECT
        s.id AS id_work,
        s.room AS room_number,
        rooms.type AS category_room,
        s.work AS work_type,
        s.since AS start_clean,
        s.till AS end_clean,
        p.price AS cleaning_price
    FROM
        statistics AS s
    INNER JOIN
        prices p ON s.work = p.work
    INNER JOIN 
    rooms ON
  rooms.id = s.room
        WHERE 
((s.work = 1 AND rooms.id = 2) OR
        (s.work = 1 AND rooms.type = 3) OR
        (s.work = 1 AND rooms.type = 1) OR
        (s.work = 2 AND rooms.type = 1) OR
        (s.work = 3 AND rooms.type = 1) OR
        (s.work = 2 AND rooms.type = 2) OR
        (s.work = 2 AND rooms.type = 3) OR
        (s.work = 3 AND rooms.type = 2) OR
        (s.work = 3 AND rooms.type = 3))
        AND
        DATE(s.created) = ?


    ";

    $stmt = $connect->prepare($query);
    $stmt->bind_param('s', $date);
    $stmt->execute();

    $result = $stmt->get_result();
    $workList = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();
    $connect->close();

    return $workList;
}


?>
