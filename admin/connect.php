<?php
ob_start();
try {
    $conn = new PDO("mysql:host=localhost;dbname=camera;charset=utf8", "root", "");
} catch (PDOException $e) {
    echo $e->getMessage();
}
function selectAll($sql)
{
    $result = $GLOBALS['conn']->query($sql);
    return $result;
}
function exSQL($sql)
{
    $result =  $GLOBALS['conn']->prepare($sql);
    return $result->execute();
}
function rowCount($sql){
    $result =  $GLOBALS['conn']->query($sql);
    return $result->rowCount();
}
function editCate($sql)
{
    $result = $GLOBALS['conn']->query($sql);
    return $result->fetchAll();
}

?>
<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
$timestamp = time();
// $today = date('d-m-Y H:i:s',$timestamp);
$today = date('Y-m-d H:i:s', $timestamp);
?>