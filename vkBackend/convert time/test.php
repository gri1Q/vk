<?php

/* 
Если вас не затруднит, можно будет обратную связь, что не так или показать
пример как нужно было сделать


#######################################################
*/



require "TimeToWordConvert.php";

$time=explode(":",date("h:i"));
// var_dump($date);

$class = new TimeToWordConvert;
echo $class->convert($time[0], $time[1]);
