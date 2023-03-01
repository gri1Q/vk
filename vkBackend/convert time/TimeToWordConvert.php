<?php
require_once "TimeToWordConverteringInterface.php";
class  TimeToWordConvert implements TimeToWordConverteringInterface
{
    // мультибайтовая функция для верхнего регистра
    private function mb_ucfirst(string $string): string
    {
        $string = mb_strtolower($string);
        $firstSymbol = mb_substr($string, 0, 1);
        $otherSymbol = mb_substr($string, 1);
        $result = mb_strtoupper($firstSymbol) . $otherSymbol;
        return $result;
    }

    public function convert(int $hours, int $minutes): string
    {
        // Проверка валидности указанного времени
        if (($hours < 13 && $minutes < 60) && ($hours > 0 && $minutes >= 0)) {
            // Массив часов
            $hoursArray = [
                1 => ["Один", "часа", "первого"],
                2 => ["Два", 'двух', "второго"],
                3 => ["три", "трех", "третьего"],
                4 => ["Четыре", "четырех", "четвертого"],
                5 => ["Пять", "пяти", "пятого"],
                6 => ["Шесть", "шести", "шестого"],
                7 => ["Семь", "семи", "седьмого"],
                8 => ["Восемь", "восьми", "восьмого"],
                9 => ["Девять", "девяти", "девятого"],
                10 => ["Десять", "десяти", "десятого"],
                11 => ["Одиннадцать", "одиннадцати", "одиннадцатого"],
                12 => ["Двенадцать", "двенадцати", "двенадцатого"]
            ];

            //Массив минут
            $minutesArray = [
                0 => '',
                1 => 'одна минута',
                2 => 'две минуты',
                3 => 'три минуты',
                4 => 'четыре минуты',
                5 => 'пять минут',
                6 => 'шесть минут',
                7 => 'семь минут',
                8 => 'восемь минут',
                9 => 'девять минут',
                10 => 'десять минут',
                11 => 'одиннадцать минут',
                12 => 'двенадцать минут',
                13 => 'тринадцать минут',
                14 => 'четырнадцать минут',
                15 => 'четверть',
                16 => 'шестнадцать минут',
                17 => 'семнадцать минут',
                18 => 'восемнадцать минут',
                19 => 'девятнадцать минут',
                20 => 'двадцать минут',
                21 => 'двадцать одна минута',
                22 => 'двадцать две минуты',
                23 => 'двадцать три минуты',
                24 => 'двадцать четыре минуты',
                25 => 'двадцать пять минут',
                26 => 'двадцать шесть минут',
                27 => 'двадцать семь минут',
                28 => 'двадцать восемь минут',
                29 => 'двадцать девять минут',
                30 => 'половина',
                45 => 'пятнадцать минут'
            ];

            $newHours = $hours;
            $prepostion = '';
            if ($minutes > 30) {

                $prepostion = ' до ';
            } elseif ($minutes < 30 && $minutes > 0 && $minutes != 15) {
                $prepostion = ' после ';
            }
            // если 13 часов то будет 1, т.к. 12 часовой формат
            if ($minutes == 15 || $minutes == 30 || $minutes > 30) {
                $newHours += 1;
            }
            if ($newHours == 13) {
                $newHours = 1;
            }

            // Определение больше либо меньше 30 минут
            if ($minutes == 45) {
                $newMinutes = $minutesArray[$minutes];
            } elseif ($minutes > 30) {
                $newMinutes = 60 - $minutes;
            } else {
                $newMinutes = $minutesArray[$minutes];
            }

            //Определение времени
            $hoursWithoutMinutes = '';
            $hoursWithMinutes = '';
            $result = '';
            if ($minutes == 0) {
                $hoursWithoutMinutes = $hoursArray[$newHours][0];
                if ($newHours == 1) {
                    $hoursWithoutMinutes .= " час"; // Один час
                } elseif ($newHours >= 2 && $newHours <= 4) {
                    $hoursWithoutMinutes .= " часа"; // Два часа
                } elseif ($newHours >= 5) {
                    $hoursWithoutMinutes .= " часов"; // Шесть часов
                }
            } elseif ($minutes == 15 || $minutes == 30) {
                if ($minutes == 30) {

                    $hoursWithMinutes = $minutesArray[$minutes] . " " . $hoursArray[$newHours][2];
                } else {

                    $hoursWithMinutes = $minutesArray[$minutes] . " " . $hoursArray[$newHours][2];
                }
            } elseif ($minutes > 30 && $minutes != 45) {
                $hoursWithMinutes = $minutesArray[$newMinutes] . $prepostion .  $hoursArray[$newHours][1];
            } else {
                $hoursWithMinutes = $minutesArray[$minutes] . $prepostion .  $hoursArray[$newHours][1];
            }

            $result = "$hours:$minutes - " . $this->mb_ucfirst($hoursWithMinutes . $hoursWithoutMinutes) . ".";
            return $result;
        } else {
            return "Введите корректное время: 12 часовой формат времени и не больше 59 секунд<br>Не должно быть отрицательным!";
        }
    }
}
