<?php
 
// Lớp database
class DB
{
 
    // Biến lưu trữ kết nối
    public $cn = NULL;
 
    // Hàm kết nối
    public function connect()
    {
        $this->cn = mysqli_connect(LOCALHOST,USERNAME,PASSWORD,DATABASE);

if (!$this->cn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
    }
 
    // Hàm ngắt kết nối
    public function close()
    {
        if ($this->cn)
        {
            mysqli_close($this->cn);
        }
    }
 
    // Hàm truy vấn
    public function query($sql = null) 
    {       
        if ($this->cn)
        {
            mysqli_query($this->cn, $sql);
        }
    }
 
    // Hàm đếm số hàng
    public function num_rows($sql = null) 
    {
        if ($this->cn)
        {
            $query = mysqli_query($this->cn, $sql);
            if ($query)
            {
                $row = mysqli_num_rows($query);
                return $row;
            }   
        }       
    }

    // Hàm đếm tổng số hàng
    public function fetch_row($sql = null) 
    {
        if ($this->cn)
        {
            $query = mysqli_query($this->cn, $sql);
            if ($query)
            {
                $row = $query->fetch_row();
                return $row[0];
            }   
        }       
    }


    // Hàm lấy dữ liệu
    public function fetch_assoc($sql = null, $type)
    {
        if ($this->cn)
        {
            $query = mysqli_query($this->cn, $sql);
            if ($query)
            {
                if ($type == 0)
                {
                    // Lấy nhiều dữ liệu gán vào mảng
                    while ($row = mysqli_fetch_assoc($query))
                    {
                        $data[] = $row;
                    }
                    return $data;
                }
                else if ($type == 1)
                {
                    // Lấy một hàng dữ liệu gán vào biến
                    $data = mysqli_fetch_assoc($query);
                    return $data;
                }
            }       
        }
    }
 
    // Hàm lấy ID cao nhất
    public function insert_id()
    {
        if ($this->cn)
        {
            $count = mysqli_insert_id($this->cn);
            if ($count == '0')
            {
                $count = '1';
            }
            else
            {
                $count = $count;
            }
            return $count;
        }
    }
 
    // Hàm charset cho database
    public function set_char($uni)
    {
        if ($this->cn)
        {
            mysqli_set_charset($this->cn, $uni);
        }
    }
	public function db_escape($str){
		return strip_tags($str);
	}
}
 // kết nối database
$db = new DB();
$db->connect();
$db->set_char('utf8');
$now = date("Y-m-d");
$tongdon = $db->num_rows("SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `username` ='$username'"); 
$tongdonrefund = $db->num_rows("SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `username` ='$username' AND `status` = 'refund'"); 
$tongdonthanhcong = $db->num_rows("SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `username` ='$username' AND `status` = 'success'"); 
$tongdondangchay = $db->num_rows("SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `username` ='$username' AND `status` = 'inprogess'");
$tongdonloi = $db->num_rows("SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `username` ='$username' AND `status` = 'error'");
$tongdonxuly = $db->num_rows("SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `username` ='$username' AND `status` = 'pending'");

$tongnaptien1 = $db->fetch_row("SELECT SUM(sotien) FROM `historynaptien` WHERE `webdinhdanh` = '$domain' AND `username`='$username'");
$tongnaptien2 = $db->fetch_row("SELECT SUM(thucnhan) FROM `historynapcard` WHERE `webdinhdanh` = '$domain' AND `username`='$username' AND `status` = 'success'");
$tongnaptien3 = $db->fetch_row("SELECT SUM(coin) FROM `history` WHERE `webdinhdanh` = '$domain' AND `username`='$username' AND  `type` = 'Cộng Tiền'");
$tongnap = $tongnaptien1 + $tongnaptien2 + $tongnaptien3;
$tongdung = $db->fetch_row("SELECT SUM(cashtru) FROM `function` WHERE `webdinhdanh` = '$domain' AND `username`='$username'");
$tonghoan = $db->fetch_row("SELECT SUM(coin) FROM `history` WHERE `webdinhdanh` = '$domain' AND `username`='$username' AND `type` = 'Hoàn Tiền'");
// admin 
$tongthanhvien = $db->num_rows("SELECT * FROM `accounts` WHERE `webdinhdanh` = '$domain'"); 
$donclone = $db->num_rows("SELECT * FROM `historybuyclone` WHERE `webdinhdanh` = '$domain'");
$clonecon = $db->num_rows("SELECT * FROM `sanpham` WHERE `webdinhdanh` = '$domain' AND `status` = 'active'");
$clonedaban = $db->num_rows("SELECT * FROM `sanpham` WHERE `webdinhdanh` = '$domain' AND `status` = 'pay'");
$soduthanhvien = $db->fetch_row("SELECT SUM(cash) FROM `accounts` WHERE `webdinhdanh` = '$domain'");
$tongnap1 = $db->fetch_row("SELECT SUM(thucnhan) FROM `historynapcard` WHERE `webdinhdanh` = '$domain'  AND `status`='success'");
$tongnap2 = $db->fetch_row("SELECT SUM(sotien) FROM `historynaptien` WHERE `webdinhdanh` = '$domain'");
$tongnap3 = $db->fetch_row("SELECT SUM(coin) FROM `history` WHERE `webdinhdanh` = '$domain' AND `type` = 'Cộng Tiền'");
$tongnapa = $tongnap1 + $tongnap2 + $tongnap3;
$tongdung1 = $db->fetch_row("SELECT SUM(cashtru) FROM `function` WHERE `webdinhdanh` = '$domain'");
$tongthanhvienmoi = $db->num_rows("SELECT * FROM `accounts` WHERE `webdinhdanh` = '$domain' AND `date` > '$now 00:00:00'"); 

$tongnap1moi = $db->fetch_row("SELECT SUM(thucnhan) FROM `historynapcard` WHERE `webdinhdanh` = '$domain' AND `status`='success' AND `date` > '$now 00:00:00'");
$tongnap2moi = $db->fetch_row("SELECT SUM(sotien) FROM `historynaptien` WHERE `webdinhdanh` = '$domain' AND `date` > '$now 00:00:00'");
$tienngayclone = $db->fetch_row("SELECT SUM(cash) FROM `historybuyclone` WHERE  `date` > '$now 00:00:00'");
$tienbanclone = $db->fetch_row("SELECT SUM(cash) FROM `historybuyclone`");

$tongnapamoi = $tongnap1moi + $tongnap2moi;
$tongdung1moi = $db->fetch_row("SELECT SUM(cashtru) FROM `function` WHERE `webdinhdanh` = '$domain' AND `date` > '$now 00:00:00'");
$expmoi = $db->fetch_row("SELECT SUM(exp) FROM `function` WHERE `webdinhdanh` = '$domain' AND `date` > '$now 00:00:00' AND `status` !='refund'");
$tongdon1 = $db->num_rows("SELECT * FROM `function` WHERE `webdinhdanh` = '$domain'"); 
$tongdon1a = $db->num_rows("SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `status` !='pending'"); 
$tongdon1b = $db->num_rows("SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `status` ='pending'"); 
$refund = $db->num_rows("SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `status` ='refund'"); 
$tiendon = $db->fetch_row("SELECT SUM(cashtru) FROM `function` WHERE `webdinhdanh` = '$domain'");
$tiendon1 = $db->fetch_row("SELECT SUM(cashtru) FROM `function` WHERE `webdinhdanh` = '$domain'  AND `status` ='error'");
$tiendon2 = $db->fetch_row("SELECT SUM(cashtru) FROM `function` WHERE `webdinhdanh` = '$domain'  AND `status` ='refund'");
$tiendon3 = $db->fetch_row("SELECT SUM(exp) FROM `function` WHERE `webdinhdanh` = '$domain'  AND `status` !='refund'");
$sodontay = $db->num_rows("SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `status` ='pending' AND `area` ='dontay'"); 
$hotrochuad = $db->num_rows("SELECT * FROM `support` WHERE `webdinhdanh` = '$domain' AND `status` ='pending'"); 
$a = $db->num_rows("SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `status` ='success' AND `area` !='dontay'"); 
$b = $db->num_rows("SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `status` ='error'  AND `area` !='dontay'"); 
$c = $db->num_rows("SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `status` ='pending'  AND `area` !='dontay'"); 
$d = $db->num_rows("SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `status` ='inprogess'  AND `area` !='dontay'"); 
$e = $db->num_rows("SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `status` ='refund'  AND `area` !='dontay'"); 
$f = $db->num_rows("SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `status` ='partial'  AND `area` !='dontay'"); 
$a1 = $db->num_rows("SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `status` ='success' AND `area` ='dontay'"); 
$b1 = $db->num_rows("SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `status` ='error'  AND `area` ='dontay'"); 
$c1 = $db->num_rows("SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `status` ='pending'  AND `area` ='dontay'"); 
$d1 = $db->num_rows("SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `status` ='inprogess'  AND `area` ='dontay'"); 
$e1 = $db->num_rows("SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `status` ='refund'  AND `area` ='dontay'"); 
?>
