<?php
$time_start = microtime(true);
session_set_cookie_params(0);
$tz = 'Europe/Kirov';
$startTimestamp = microtime(true);
$dt = new DateTime("now", new DateTimeZone($tz));
$dt->setTimestamp($startTimestamp);
$startTime = $dt->format('d.m.Y, H:i:s');

session_start();
if (!isset($_SESSION['data']))
    $_SESSION['data'] = array();
//session_start();
function check($x, $y, $r){
    if ($x >= 0 && $y >= 0) return $x <= $r && $y <= $r;
    if ($x < 0 && $y >= 0) return false;
    if ($x < 0 && $y < 0) return $y >= - $x - 0.5 * $r;
    if ($x >= 0 && $y < 0) return $r * $r - $x * $x >= 0 && $y <= -sqrt($r * $r - $x * $x);
    return false;
}

//Получаем параметры через GET запрос
$x = $_GET["x_coordinate"] ?? null;
$y = $_GET["y_coordinate"] ?? null;
$r = $_GET["r_coordinate"] ?? null;
$timezone= microtime(true);
$x = str_replace(",", ".", $x);
if (is_numeric($x) && is_numeric($y) && is_numeric($r)) {
    if ($x >= -3 && $x <= 5 && in_array($y, [-3, -2, -1, 0, 1, 2, 3, 4, 5]) && in_array($r, [1, 2, 3, 4, 5])) {
        $is_inside = check($x, $y, $r);
        $hit_fact = $is_inside ? "Попадание": "Промах";
        $startTimestamp = microtime(true);
        $dt = new DateTime("now", new DateTimeZone($tz));
        $dt->setTimestamp($startTimestamp);
        $current_time = $dt->format('d.m.Y, H:i:s');
        $execution_time = round((microtime(true) - $startTimestamp) * 1000, 4);
        $answer = array("x"=>$x, "y"=>$y, "r"=>$r, "hit_fact"=>$hit_fact, "current_time"=>$current_time, "execution_time"=>$execution_time);
        array_push($_SESSION['data'], $answer);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class = "hat">
    <h6>Результаты</h6>
    </div >

<div class="but">
    <a href="index.html">Назад</a>
    <form action="clear.php" class = but>
        <button>Очистить таблицу</button>
    </form>
</div>
<table id="result_table">
    <div class="columns">
    <th >
        <div >
            <blockquote class="text">
                <p>X</p>
            </blockquote>
        </div>
    </th>
    <th >
        <div >
            <blockquote class="text">
                <p>Y</p>
            </blockquote>
        </div>
    </th>
    <th >
        <div>
            <blockquote class="text">
                <p>R</p>
            </blockquote>
        </div>
    </th>
    <th >
        <div >
            <blockquote class="text">
                <p>Попадание</p>
            </blockquote>
        </div>
    </th>
    <th >
        <div >
            <blockquote class="text">
                <p>Текущее время</p>
            </blockquote>
        </div>
    </th>
    <th >
        <div >
            <blockquote class="text">
                <p>Время работы</p>
            </blockquote>
        </div>
    </th>
        <?php
        foreach ($_SESSION['data'] as $elem) {?>
        <tr>
            <td>
                <?php
                echo $elem['x']
                ?>
            </td>
            <td>
                <?php
                echo $elem['y']
                ?>
            </td>
            <td>
                <?php
                echo $elem['r']
                ?>
            </td>
            <td>
                <?php
                echo $elem['hit_fact']
                ?>
            </td>
            <td>
                <?php
                echo $elem['current_time']
                ?>
            </td>
            <td>
                <?php
                echo $elem['execution_time']
                ?> мс
            </td>
        </tr>
        <?php }?>
    </div>
</table>
</body>
</html>