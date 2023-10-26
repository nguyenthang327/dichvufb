<?
require_once('./system/config.php');

header('Content-Type: application/json');

$data = array();
$respawn = mysqli_query($ketnoi,"SELECT * FROM `function` WHERE `username` ='tai2k6' AND `type` = 'Share Rẻ'  order by id desc");
while ($row = mysqli_fetch_array($respawn, MYSQLI_ASSOC)){
    array_push($data, $row);
}

echo json_encode($data, JSON_PRETTY_PRINT)
?>