<?php

require_once 'vendor/autoload.php';
$faker = Faker\Factory::create('id_ID');

// Connect to DB
$db = new PDO('mysql:host=localhost;dbname=go-mart', 'root', '');
$db->query("DELETE FROM orders");
$db->query("ALTER TABLE orders AUTO_INCREMENT = 1");

// Driver and License_Plate Foreign Key
$json = file_get_contents("driver.json");
$driver = json_decode($json, true)['driver'];

$json = file_get_contents("payment.json");
$payment = json_decode($json, true);

$cek_customer = [];

$data = [];

$time_arr = [];

//GENERATE DATETIME
$datetime = [];
for ($i=0; $i<200; $i++) {
    $gen_datetime = $faker->dateTimeBetween($startDate = '-3 years', $endDate = 'now', $timezone = null);
    array_push($datetime, $gen_datetime);
}
sort($datetime);


// masukin data
for ($i=0; $i<200; $i++) {
    $acc_num = $payment[$i]['account_number']; 

    // cek customer udah ada apa belum
    $customer_id = rand(1, 300);
    while (in_array((string)$customer_id, $cek_customer)) {
        $customer_id = rand(1, 300);
    }
    array_push($cek_customer, (string)$customer_id);

    // cek jika account number sama, terus dimasukin ke data sesuai indeksnya
    for ($j=0; $j<200; $j++) {
        if ($acc_num == $payment[$j]['account_number']) {

            $time = $datetime[$j]->format('H:i:s');
            $date = $datetime[$j]->format('Y-m-d');
        
            $driver_idx = rand(1, 300);
            $driver_id = $driver[$driver_idx-1]['account_id'];
            $license_plate = $driver[$driver_idx-1]['license_plate'];
    
            $payment_id = $j+1;

            $data[$j] = [
                'time' => $time,
                'date' => $date,
                'customer_id' => $customer_id,
                'driver_id' => $driver_id,
                'payment_id' => $payment_id,
                'license_plate' => $license_plate,
            ];
        }

    }
    

}


// masukin ke DB
for ($i=0; $i<200; $i++) {

    $db->query("INSERT INTO orders
    (time, date, customer_id, driver_id, payment_id, license_plate)
    VALUES ('{$data[$i]['time']}', '{$data[$i]['date']}', '{$data[$i]['customer_id']}', '{$data[$i]['driver_id']}', '{$data[$i]['payment_id']}', '{$data[$i]['license_plate']}')
    ");
}
