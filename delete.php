<?php
require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/parts/connect_db.php'; 

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$sql = "DELETE FROM address_book WHERE sid={$sid}";

$pdo->query($sql);

$come_from = 'list.php';

//刪除資料不跳頁(但還是會重刷)
if(! empty($_SERVER['HTTP_REFERER'])){
    $come_from = $_SERVER['HTTP_REFERER'];
}

header("Location: {$come_from}");