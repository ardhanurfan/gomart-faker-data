<?php

// Connect to DB
$db = new PDO('mysql:host=localhost;dbname=go-mart', 'root', '');
$db->query("DELETE FROM order_item");

$json = file_get_contents("item_with_store.json");
$item = json_decode($json, true)['item'];

for ($i=0; $i<200; $i++) {
    $order_id = $i+1;

    // yang menjual barang hanya 145 dari 150
    $store_id = rand(1, 145);

    // nyari item_id yang di toko tersebut
    $item_id_in_store = [];
    for ($j=0; $j<count($item); $j++) {
        if ($item[$j]['store_id'] == $store_id) {
            array_push($item_id_in_store, $item[$j]['item_id']);
        }
    }

    $banyak_item_dibeli = rand(1, count($item_id_in_store));
    $shuffle = shuffle($item_id_in_store);

    // masukin ke DB
    for ($j=0; $j<$banyak_item_dibeli; $j++) {
        $item_id = $item_id_in_store[$j];
        $sequence = $j+1;
        $quantity = rand(1, 10);

        $db->query("INSERT INTO order_item
        (order_id, item_id, sequence, quantity)
        VALUES ('{$order_id}', '{$item_id}', '{$sequence}', '{$quantity}')
        ");

    }
}

