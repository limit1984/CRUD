<div class="row">
    <div class="col">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">
                        <i class="fa-solid fa-trash-can"></i>
                    </th>
                    <th scope="col">#</th>
                    <th scope="col">店名</th>
                    <th scope="col">帳號</th>
                    <th scope="col">密碼</th>
                    <th scope="col">地址</th>
                    <th scope="col">電話</th>
                    <th scope="col">種類</th>
                    <th scope="col">營業日(週)</th>
                    <th scope="col">營業開始時間</th>
                    <th scope="col">營業結束時間</th>
                    <th scope="col">上架狀態(店家)</th>
                    <th scope="col">上架狀態(平台)</th>
                    <th scope="col">圖片位址</th>
                    <th scope="col">付款方式</th>
                    <th scope="col">送餐方式</th>
                    <th scope="col">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $r) : ?>
                    <tr>
                        <td>
                            <a href="javascript: delete_it(<?= $r['sid'] ?>)">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </td>
                        <td><?= $r['sid'] ?></td>
                        <td><?= $r['name'] ?></td>
                        <td><?= $r['account'] ?></td>
                        <td><?= $r['password'] ?></td>
                        <td><?= htmlentities($r['address']) ?></td>
                        <td><?= $r['phone'] ?></td>
                        <td><?= $r['food_type_sid'] ?></td>
                        <td><?= $r['bus_day'] ?></td>
                        <td><?= $r['bus_start'] ?></td>
                        <td><?= $r['bus_end'] ?></td>
                        <td><?= $r['rest_right'] ?></td>
                        <td><?= $r['plat_right'] ?></td>
                        <td><?= $r['src'] ?></td>
                        <td><?= $r['pay'] ?></td>
                        <td><?= $r['side'] ?></td>
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