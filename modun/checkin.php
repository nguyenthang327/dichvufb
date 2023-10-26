<?php
if(isset($_GET['service_type'])){
if($_GET['service_type'] == '0'){
$array = array("status" => false, "info" => '<table class="table mb-0">
<tbody>
<tr>
<td>Parameters</td> 
<td>Description</td>
</tr>    
<tr>
<td>key</td> 
<td>API Key</td>
</tr>
<tr>
<td>action</td>
<td>add</td>
</tr>
<tr>
<td>service</td>
<td>Service ID</td>
</tr>
<tr>
<td>link</td>
<td>Link</td>
</tr>
<tr>
<td>quantity</td>
<td>Needed quantity</td>
</tr> <tr>
<td>reaction (optional)</td>
<td>like,haha,wow,care,love,sad,angry (default like)</td>
</tr> 
<tr>
<td>minutes (optional)</td>
<td>30,45,60,90,120,150,180,210,240,270,300 (default 30)</td>
</tr>
<tr>
<td>dayvip (optional)</td>
<td>7,15,30,60,90,120,150,180 (default 30)</td>
</tr>
</tbody>
</table>');        
}elseif($_GET['service_type'] == '10'){
$array = array("status" => true, "info" => 'Not allow this type, please try again when have a notice !');         
}elseif($_GET['service_type'] == '2'){
$array = array("status" => true, "info" => '<table class="table mb-0">
<tbody>
<tr>
<td>Parameters</td> 
<td>Description</td>
</tr>    
<tr>
<td>key</td> 
<td>API Key</td>
</tr>
<tr>
<td>action</td>
<td>add</td>
</tr>
<tr>
<td>service</td>
<td>Service ID</td>
</tr>
<tr>
<td>link</td>
<td>Link</td>
</tr>
<tr>
<td>comments</td>
<td>Comments list separated by \n</td>
</tr>
<tr>
<td>dayvip (optional)</td>
<td>7,15,30,60,90,120,150,180 (default 30)</td>
</tr>
</tbody>
</table>');         
}elseif($_GET['service_type'] == '9'){
$array = array("status" => true, "info" => 'Not allow this type, please turn back later !');         
}elseif($_GET['service_type'] == '15'){
$array = array("status" => true, "info" => 'Not allow this type, please turn back later !');         
}elseif($_GET['service_type'] == '100'){
$array = array("status" => true, "info" => 'Not allow this type, please turn back later !');         
}else{
$array = array("status" => false, "info" => '0', "max" => '0', "comment" => '', "reaction" => '', "minutes" => '', "dayvip" => '', "infomation" => 'Bạn chưa đăng nhập');         
}
}else{
$array = array("status" => false, "info" => '<tr>
<td>quantity</td>
<td>Needed quantity</td>
</tr> <tr>
<td>reaction (optional)</td>
<td>like,haha,wow,care,love,sad,angry (default like)</td>
</tr> ');         
}
echo json_encode($array);
?>