<?php

use function PHPSTORM_META\type;

require_once 'vendor/autoload.php';
$faker = Faker\Factory::create('id_ID');


// Connect to DB
$db = new PDO('mysql:host=localhost;dbname=go-mart', 'root', '');
$db->query("DELETE FROM vehicle");

for ($i=0; $i<300; $i++) {
    // LICENSE PLATE
    $plat_kode = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'J', 'K', 'L', 'M', 'W', 'Z', 'AA', 'AB', 'AD', 'BH', 'DK'];
    $random_behind = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 2);
    $number = rand(1234, 7865);
    $license_plate = "{$plat_kode[array_rand($plat_kode)]}{$number}{$random_behind}";

    //TYPE
    $type = ['Vario 150', 'BeAT', 'Vario 125', 'New Revo X', 'NMAX', 'Genio', 'Xeon', 'ADV 150', 'Jupyter MX', 'CBR250RR', 'KLX 150', 'Aerox 155', 'Scoopy'];
    $type = $type[array_rand($type)];

    //color
    $color = ['Black', 'Red', 'Brown', 'Red', 'Yellow', 'Navy', 'Silver', 'White'];
    $color = $color[array_rand($color)];

    $db->query("INSERT INTO vehicle
    (license_plate, type, color)
    VALUES ('{$license_plate}', '{$type}', '{$color}')
    ");
}