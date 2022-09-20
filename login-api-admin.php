<?php
require __DIR__ . '/parts/connect_db.php';
header('Content-Type:application/json');

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
];

if (empty($_POST['account']) or empty($_POST['password'])) {
    $output['error'] = '參數不足';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit; // 結束程式
}

//用帳號找資料
$res = "SELECT * FROM shop WHERE account=?";

$stmt = $pdo->prepare($res);

$stmt->execute(
    [$_POST['account']
]);

$check = $stmt->fetch();

if (empty($check)) {
    $output['error'] = '帳號或密碼錯誤'; // 帳號錯誤
    $output['code'] = 401;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit; // 結束程式
}
$checkAC = $check['account'];
$inAC = $_POST['account'];
$checkPW = $check['password'];
$inPW = $_POST['password'];
// 驗證密碼
// if (password_verify($_POST['password'], $row['password'])) {
//         $output['success'] = true;
//         $_SESSION['admin'] = [
//             'sid' => $row['sid'],
//             'account' => $row['account'],
//         ];
//     } else {
//     $output['error'] = '帳號或密碼錯誤'; // 帳號錯誤
//     $output['code'] = 421;
// }

if($checkPW == $inPW){
    $output['success'] = true;
    if($inAC =='admin@test.com'){
        $_SESSION['admin'] = [
            'account' => $check['account'],
            'nickname' => $check['name'],
            'sid'=>$check['sid'],
        ];
    }else{
        $_SESSION['user'] = [
            'account' => $check['account'],
            'nickname' => $check['name'],
            'sid'=>$check['sid'],
        ];
    }
    if(!isset($_SESSION['cartTotal'])){
        $_SESSION['cartTotal'] = 0;
    }
}
else {
    $output['error'] = '帳號或密碼錯誤';
    $output['code'] = 421;
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
