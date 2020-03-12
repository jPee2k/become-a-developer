<?php

set_time_limit(0);

$incomingFile = fopen('../src/10m.txt', 'r');
$reed = fread($incomingFile, filesize('../src/10m.txt'));
fclose($incomingFile);

//Преобразовуем строку в массив
$numArray = explode(PHP_EOL, $reed);

//Отсеиваем "Мусорные" знаки
function weedOut(array $numArr)
{
    $stack = [];
    foreach ($numArr as $num) {
        if (!is_numeric($num)) {
            continue;
        } else {
            array_push($stack, $num);
        }
    }
    return $stack;
}

//Сортируем массив
$weed = weedOut($numArray);
sort($weed, SORT_NUMERIC);

//Ищем медиану
function median(array $numArr)
{
    $length = count($numArr);
    if ($length % 2) {
        $mid = ceil($length / 2);
        $result = $numArr[$mid - 1];
    } else {
        $mid = ceil($length / 2);
        $result = ($numArr[$mid - 1] + $numArr[$mid]) / 2;
    }
    return $result;
}

//Вычисляем среднее арифметическое
function calculateAverage(array $numArr)
{
    $sum = 0;
    foreach ($numArr as $num) {
        $sum += $num;
    }
    return ($sum / count($numArr));
}

$median = median($weed);
$average = calculateAverage($weed);

//Выводим результаты задания
//var_dump($weed);
echo 'Минимальное число: '.reset($weed).PHP_EOL;
echo 'Максимальное число: '.end($weed).PHP_EOL;
echo "Медиана: {$median}".PHP_EOL;
echo "Среднее арифметическое: {$average}".PHP_EOL;