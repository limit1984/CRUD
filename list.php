<?php require __DIR__ . '/parts/connect_db.php';
$pageName = 'list';

$perPage = 20; //一頁有幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// 算總筆數
$t_sql = "SELECT COUNT(1) FROM shop ";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
//$pdo->query($t_sql) 抓到的總頁數
//FETCH_NUM將抓到的總頁數轉成陣列

$totalPages = ceil($totalRows / $perPage); //把總頁數除以設定的一頁5筆

//如果有資料，頁數小於1則跳轉到第一頁，如果大於總頁數則跳到最後一頁
if ($totalPages) {
    if ($page < 1) {
        header('Location: ?page=1');
        exit;
    }
    if ($page > $totalPages) {
        header('Location: ?page=' . $totalPages);
        exit;
    }

    $sql = sprintf(
        "SELECT * FROM shop ORDER BY sid ASC LIMIT %s,%s",
        ($page - 1) * $perPage,
        $perPage
    );
    $rows = $pdo->query($sql)->fetchAll();
}


$output = [
    'totalRows' => $totalRows,
    'totalPages' => $totalPages,
    'page' => $page,
    'rows' => $rows,
    'perPage' => $perPage,
];

//echo json_encode($output); exit;
?>
<?php require __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/navbar.php'; ?>
<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page - 1 ?>">
                        <span>上一頁</span>
                            <i class="fa-solid fa-circle-left"></i>
                        </a>
                    </li>

                    <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                        if ($i >= 1 and $i <= $totalPages) :
                    ?>
                            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                    <?php
                        endif;
                    endfor; ?>

                    <li class="page-item <?= $totalPages == $page ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page + 1 ?>">
                        <span>下一頁</span>
                            <i class="fa-solid fa-circle-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <?php 
    if(empty($_SESSION['admin'])){
        include __DIR__. '/list-table-no-admin.php';
    } else {
        include __DIR__. '/list-table-admin.php';
    }
    
    ?>

    <!-- <div class="row">
        <div class="col">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">
                            <i class="fa-solid fa-trash-can"></i>
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">姓名</th>
                        <th scope="col">email</th>
                        <th scope="col">手機</th>
                        <th scope="col">生日</th>
                        <th scope="col">地址</th>
                        <th scope="col">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r) : ?>
                        <tr>
                            <td>
                            <a href="javascript: delete_it(<?= $r['sid'] ?>">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </td>
                            <td><?= $r['sid'] ?></td>
                            <td><?= $r['name'] ?></td>
                            <td><?= $r['email'] ?></td>
                            <td><?= $r['mobile'] ?></td>
                            <td><?= $r['birthday'] ?></td>
                            <td><?= strip_tags($r['address']) ?></td>
                            <td><?= htmlentities($r['address']) ?></td>
                            XSS防範
                            <td>
                                <a href="edit-form.php?sid=<?= $r['sid'] ?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div> -->

<?php include __DIR__ . '/parts/scripts.php'; ?>
<script>
    const table = document.querySelector('table');

    function delete_it(sid){
        if(confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)){
            location.href = `delete.php?sid=${sid}`;
        }
    }
    // table.addEventListener('click', function(event) {
    //     const t = event.target;
    //     console.log(event.target);
    //     if (t.classList.contains('fa-trash-can')) {
    //         t.closest('tr').remove();
    //     };
    //     if (t.classList.contains('fa-pen-to-square')) {
    //         // console.log(t.closest('tr').querySelectorAll('td'));
    //         console.log(t.closest('tr').querySelectorAll('td')[2].innerHTML);
    //     };
    // });
</script>
<?php include __DIR__ . '/parts/html-foot.php'; ?>