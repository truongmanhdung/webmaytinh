<?php
include_once 'admin/connect.php';
$search = "SELECT * FROM products WHERE name LIKE '%" . $_POST["search"] . "%'";
$result = $conn->prepare($search);
$result->execute();
$count = $result->rowCount();
if ($count == 0) {
echo '
    <div class="d-flex pl-3 pb-2">
        <span class="text-danger">Không tìm thấy kết quả phù hợp !</span>
    </div>
';
} else {
foreach (selectAll("SELECT * FROM products WHERE name LIKE '%" . $_POST["search"] . "%'") as $row) {
    echo '
    <a class="d-flex mb-3 ml-3 hover-secondary" href="detail.php?id='.$row['id'].'">
        <img src="images/'.$row['image'].'" width="55px" height="55px" alt="">
        <div>
            <p class="pl-2 m-0" id="box">'.$row['name'].'
            </p>
            <div class="pl-2 mt-1 price">'.number_format($row['price'], 0, ',', '.').' VNĐ</div>
        </div>
    </a>
    ';
}
};
