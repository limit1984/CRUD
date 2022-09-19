<?php
require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/parts/connect_db.php';

header('Content-Type: application/json');

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
    'postData' => $_POST, //除錯用的
];

if (empty($_POST['name'])) {
    $output['error'] = '參數不足';
    $output['code'] = 400;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// TODO: 檢查欄位資料

$sql = "INSERT INTO `shop`(
    `name`,`account`,`password`,`address`,`phone`,`food_type_sid`,`bus_day`,`bus_start`,`bus_End`,`rest_right`,`plat_right`,`src`,`pay`,`side`,`created_at`
    )  VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())";

$stmt = $pdo->prepare($sql);

// $birthday = null;
// if (strtotime($_POST['birthday']) !== false) {
//     $birthday = $_POST['birthday'];
// }

try {
    $stmt->execute([
        $_POST['name'],
        $_POST['account'],
        $_POST['password'],
        $_POST['address'],
        $_POST['phone'],
        $_POST['food_type_sid'],
        $_POST['bus_day'],
        $_POST['bus_start'],
        $_POST['bus_end'],
        $_POST['rest_right'],
        $_POST['plat_right'],
        $_POST['src'],
        $_POST['pay'],
        $_POST['side']
    ]);
} catch (PDOException $ex) {
    $output['error'] = $ex->getMessage();
}


if ($stmt->rowCount()) {
    $output['success'] = true;
} else {
    $output['error'] = '參數不足';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
