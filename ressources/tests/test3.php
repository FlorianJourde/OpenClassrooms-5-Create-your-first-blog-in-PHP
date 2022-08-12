<?php

class Car
{
	public $name;
	public $age;
	public $color;
}

$car = new Car();
$car->age = 19;
$car->name = 'Alpha Romeo';
$car->age = 'Blue';

var_dump($car);
var_dump(($car instanceof Car) ? 'Yes' : 'No');

// D’abord, l’exemple sans chaînage :
$date = new DateTime;
$newDate = $date->modify('+1 day');

var_dump($date->format('d/m/Y').PHP_EOL);
var_dump($newDate->format('d/m/Y').PHP_EOL);

// Maintenant avec le chaînage. Nous exploitons directement
// l'objet qui nous est retourné sans le stocker dans une variable :
$formatedDate = $date->modify('+1 day')->format('d/m/Y');
var_dump($formatedDate.PHP_EOL);

$s = '{
	"date":"2021-03-23 07:35:44.011207",
    "timezone_type":3,
    "timezone":"Europe/Paris"
}';

var_dump(json_decode($s));
var_dump($s);
var_dump((json_decode($s) instanceof stdClass)?'Yes':'No');
var_dump(($s instanceof stdClass)?'Yes':'No');

