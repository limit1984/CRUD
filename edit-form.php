<?php
require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/parts/connect_db.php';
$pageName = 'edit';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if(empty($sid)){
    header('Location: list.php');
    exit;
}
$sql = "SELECT * FROM shop WHERE sid=$sid";
$r = $pdo->query($sql)->fetch();
if(empty($r)){
    header('Location: list.php');
    exit;
}


?>
<?php require __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/navbar.php'; ?>
<div class="container">
    <div class="row"></div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">修改資料</h5>
                <form name="form1" onsubmit="checkForm(); return false;" novalidate>
                <input type="hidden" name="sid" value="<?= $r['sid'] ?>">
                    <div class="mb-3">
                        <label for="name" class="form-label">店名</label>
                        <input type="text" class="form-control" id="name" name="name" required value="<?= htmlentities($r['name']) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="account" class="form-label">帳號</label>
                        <input type="email" class="form-control" id="account" name="account" value="<?= $r['account'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">密碼</label>
                        <input type="text" class="form-control" id="password" name="password" value="<?= $r['password'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">地址</label>
                        <textarea class="form-control" name="address" id="address" cols="50" rows="3"><?= $r['address'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">電話</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?= $r['phone'] ?>" pattern="/\d{10}/">
                    </div>
                    <div class="mb-3">
                        <label for="food_type_sid" class="form-label">種類</label>
                        <input type="text" class="form-control" id="food_type_sid" name="food_type_sid" value="<?= $r['food_type_sid'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="bus_day" class="form-label">營業時間(週)</label>
                        <input type="text" class="form-control" id="bus_day" name="bus_day" value="<?= $r['bus_day'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="bus_start" class="form-label">開始營業時間</label>
                        <input type="text" class="form-control" id="bus_start" name="bus_start" value="<?= $r['bus_start'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="bus_end" class="form-label">結束營業時間</label>
                        <input type="text" class="form-control" id="bus_end" name="bus_end" value="<?= $r['bus_end'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="rest_right" class="form-label">上架狀態(店家)</label>
                        <input type="text" class="form-control" id="rest_right" name="rest_right" value="<?= $r['rest_right'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="plat_right" class="form-label">上架狀態(平台)</label>
                        <input type="text" class="form-control" id="plat_right" name="plat_right" value="<?= $r['plat_right'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="src" class="form-label">圖檔路徑</label>
                        <input type="text" class="form-control" id="src" name="src" value="<?= $r['src'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="pay" class="form-label">付款方式</label>
                        <input type="text" class="form-control" id="pay" name="pay" value="<?= $r['pay'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="side" class="form-label">外帶/外送/內用選擇</label>
                        <input type="text" class="form-control" id="side" name="side" value="<?= $r['side'] ?>">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php include __DIR__ . '/parts/scripts.php'; ?>
<script>
    function checkForm(){
        // document.form1.email.value
        const fd = new FormData(document.form1);

        for(let k of fd.keys()){
            console.log(`${k}:${fd.get(k)}`);
        }
        // TODO: 檢查欄位資料

        fetch('edit-api.php',{
            method:'POST',
            body:fd
        }).then(r=>r.json()).then(obj=>{
            console.log(obj);
            if(! obj.success){
                alert(obj.error);
            } else {
                alert ('修改成功')
                location.href = 'list.php';
            }
        })


    }
</script>
<?php include __DIR__ . '/parts/html-foot.php'; ?>