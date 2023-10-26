<?php
$folder_path = "temp";
$files = glob($folder_path.'/*'); 
foreach($files as $file) {
    if(is_file($file)) 
        unlink($file);
}
echo "Đã xóa rác định kỳ thành công";        
?>