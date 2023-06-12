<?php


include ('includes/config.php');
include ('includes/database.php');



// Функция для получения отчета по всем работам за сентябрь
function getMonthlyReport($month, $staffId)
{
    $connect = mysqli_connect('localhost', 'root', '', 'testproflex');

    // Запрос для получения отчета по всем работам за указанный месяц
    $query = "
    SELECT
    DATE_FORMAT(start, '%Y-%m-%d') AS date,
    MIN(start) AS start_time,
    MAX(end) AS end_time,
    SUM(CASE WHEN work = 1 THEN 1 ELSE 0 END) AS general_cleanings,
    SUM(CASE WHEN work = 2 THEN 1 ELSE 0 END) AS current_cleanings,
    SUM(CASE WHEN work = 3 THEN 1 ELSE 0 END) AS check_ins,
    (
        SELECT
            SUM(subquery.price)
        FROM
            (
                SELECT
                    s.created,
                    p.price
                FROM
                    statistics s
                INNER JOIN
                    prices p ON s.work = p.work
                WHERE
                    DATE(s.created) = DATE_FORMAT(start, '%Y-%m-%d')
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
        date ASC

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
        subquery.id_work,
        statistics.room AS room_number,
        rooms.type AS category_room,
        statistics.work AS work_type,
        statistics.since AS start_clean,
        statistics.till AS end_clean,
        subquery.cleaning_price
    FROM
        statistics
    INNER JOIN
        rooms ON statistics.room = rooms.num
    INNER JOIN
        (
        SELECT
            s.id AS id_work,
            p.price AS cleaning_price
        FROM
            statistics s
        INNER JOIN
            prices p ON s.work = p.work
        ) AS subquery ON statistics.id = subquery.id_work
    WHERE
        DATE(statistics.created) = ?;

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
