<?php

require_once 'vendor/autoload.php';
$faker = Faker\Factory::create('id_ID');


// Connect to DB
$db = new PDO('mysql:host=localhost;dbname=go-mart', 'root', '');
$db->query("DELETE FROM address");
$db->query("ALTER TABLE address AUTO_INCREMENT = 1");

$json = file_get_contents("provinsi.json");
$provinsi = json_decode($json, true);

$json = file_get_contents("kabupaten.json");
$kabupaten = json_decode($json, true);

for ($i=0; $i<500; $i++) {
    $street = $faker->streetName;

    $block = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1);

    $number = $faker->buildingNumber;

    $idx_add = rand(0, 513);
    $city = $kabupaten[$idx_add]['kab_name'];

    $prov_id = $kabupaten[$idx_add]['prov_id'];
    $cek = false;
    $j = 0;
    while (!$cek) {
        if ($prov_id == $provinsi[$j]['prov_id']) {
            $province = $provinsi[$j]['prov_name'];
            $cek = true;
        } else {
            $j += 1;
        }
    }

    $db->query("INSERT INTO address
    (street, block, number, city, province, country)
    VALUES ('Jl. {$street}', '{$block}', '{$number}', '{$city}', '{$province}', 'Indonesia')
    ");
}

