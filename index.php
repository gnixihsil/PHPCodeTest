<?php 
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
    echo '<html xmlns="http://www.w3.org/1999/xhtml">';
    echo '<head>';
    echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
    echo '<title>无标题文档</title>';
    echo '</head>';
    if(version_compare(PHP_VERSION,'5.4.0','<'))
    {
    	echo 'Current PHP version is : '.PHP_VERSION."</br>";
    	die('require PHP > 5.3.0 !');
    }
    echo '<body>';
	$dir = getcwd();
	echo "Path 1 print in INDEX:" . $dir."</br>";
    //phpinfo();
	require_once 'include/PHP_Function_test.php';
	
	chdir(dirname (__FILE__));
	$dir = getcwd();
	echo "Path 2 print in INDEX:" . $dir."</br>";
	//定义常量  
	define("DB_HOST", "localhost");  
	define("DB_USER", "root");  
	define("DB_PASS", "");  
	define("DB_DATABASENAME", "cxphp_db");  
	define("DB_TABLENAME", "cx_users");  
	//数据库表的列名  
	//$dbcolarray = array('aid', 'nickname', 'email','pwd', 'status', 'remark','find_code', 'time');//,  
	$dbcolarray = array('ID', 'user_login', 'user_pass','user_nicename', 'user_email', 'user_url','last_login_ip', 'last_login_time', 'create_time','user_activation_key','user_status','display_name','role_id');//,
	
	//mysqli_connect  
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
	if(!$conn){
		die("connect failed" . mysqli_error());
	}
	mysqli_set_charset($conn,'utf8');
	/*查询服务器所有数据库*/
	//将系统数据库与用户数据库分开，更直观的显示？
	$sql = "show databases";
	$result = mysqli_query($conn,$sql);
	echo "<div align='center'>";
		echo "数据库Server上现有的数据库数目：".$amount = mysqli_num_rows($result);
	echo "</div>";
	$i=1;
	echo '<table align="center" id="Table" border=1 cellpadding=10 cellspacing=2 bordercolor=#ffee33>';
		echo "<th>Seq.</th>"."<th>DataBaseName</th>";
		while($row = mysqli_fetch_array($result))
		{
			echo "<tr>";
			echo "<td>$i</td>"."<td>$row[0]</td>";
		    echo "</tr>";
			$i++;
		}
	echo "</table>";

    $db_selected = mysqli_select_db($conn,DB_DATABASENAME);

	//读取表中纪录条数  
	$sql = sprintf("select count(*) from %s", DB_TABLENAME);  
	$result = mysqli_query($conn,$sql); 
	
	if ($result)
	{  
	    $count = mysqli_fetch_row($result);  
	}  
	else  
	{  
	    die("query failed");  
	}  
	echo "表中有$count[0] 条记录<br />";  
  
$sql = sprintf("select %s from %s", implode(",",$dbcolarray), DB_TABLENAME);
$result = mysqli_query($conn,$sql);
//表格  
echo '<table align="center" id="Table" border=1 cellpadding=10 cellspacing=2 bordercolor=#ffaaoo>';   
//表头  
$thstr = "<th>" . implode("</th><th>", $dbcolarray) . "</th>";  
echo $thstr;  
//表中的内容  
while ($row=mysqli_fetch_array($result, MYSQL_ASSOC))//与$row=mysqli_fetch_assoc($result)等价  ))//
{  
    echo "<tr>";  
    $tdstr = "";  
    foreach ($dbcolarray as $td)  
        $tdstr .= "<td>$row[$td]</td>";  
    echo $tdstr;  
    echo "</tr>";  
}  
echo "</table>";  
mysqli_free_result($result);
mysqli_close($conn);
    echo '</body>';
    echo '</html>';
?>