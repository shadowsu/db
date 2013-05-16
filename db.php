<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>数据库连接</title>
</head>
<style>
table{
	border:1px solid #CCC;
	text-align:left;}

td{
	border:1px solid #CCC;}
	
.hidden{
	display:none;}
</style>
<body>

<?php 
	include 'conn.php';

	$domain = isset($_GET['domain'])?$_GET['domain']:null;
	$name = isset($_GET['name'])?$_GET['name']:null;
	$nickname = isset($_GET['nickname'])?$_GET['nickname']:null;
	$description = isset($_GET['description'])?$_GET['description']:null;
	$ip = isset($_GET['ip'])?$_GET['ip']:null;
	$ftpaddress = isset($_GET['ftpaddress'])?$_GET['ftpaddress']:null;
	$ftpusr = isset($_GET['ftpusr'])?$_GET['ftpusr']:null;
	$ftppwd = isset($_GET['ftppwd'])?$_GET['ftppwd']:null;
?>
<hr />
<form action="db.php" method="get">
	域名：<input type="text" name="domain"  id="domain" value="<?php echo $domain;?>"/><br />
    名字：<input type="text" name="name" id="name" value="<?php echo $name;?>"/><br />
    昵称：<input type="text" name="nickname"  id="nickname" value="<?php echo $nickname;?>"/><br />
    备注：<input type="text" name="description" id="description" value="<?php echo $description;?>"/><br />
    ip：<input type="text" name="ip" id="ip" value="<?php echo $ip;?>"/><br />
    ftp地址：<input type="text" name="ftpaddress" id="ftpaddress" value="<?php echo $ftpaddress?>"/><br />
    ftp用户名：<input type="text" name="ftpusr" id="ftpusr" value="<?php echo $ftpusr;?>"/><br />
    ftp密码：<input type="text" name="ftppwd" id="ftppwd" value="<?php echo $ftppwd;?>"/><br />
    <input type="submit" value="添加记录"  name="submit"/>
</form>

<?php  //插入记录
	if(isset($_GET['submit'])){
		$sql="INSERT INTO ".$table_name." (domain, name, nickname, dateadded, datelastmodify, description, ip, ftpaddress, ftpusr, ftppwd)
		 VALUES ('$_GET[domain]','$_GET[name]','$_GET[nickname]',now(),CURRENT_TIMESTAMP,'$_GET[description]','$_GET[ip]','$_GET[ftpaddress]','$_GET[ftpusr]','$_GET[ftppwd]')";
		
		mysql_query("SET NAMES 'utf8'");
		if (!mysql_query($sql,$con)){
		  die('Error: ' . mysql_error());
		}
		echo "1 record added";
	}
		
?>
<hr />

<p>
	<input type="button" name="query" value="查询记录" />
    <input type="button" name="delete" value="删除所有" />
</p>

<?php  //查询记录
	$result = mysql_query("SELECT * FROM ".$table_name);
	 echo "<table>
				<tr><td>id</td><td>域名</td><td>用户名</td><td>昵称</td><td>添加日期</td><td>最后修改日期</td><td>备注</td><td>ip</td><td>ftp地址</td><td>ftp用户名</td><td>密码</td><td>-编辑-</td><td>-删除-</td></tr>";
					
	while($row = mysql_fetch_array($result)){
		 echo   "<tr><td>".$row['id'] . "</td><td>" . $row['domain']."</td><td>".$row['name']."</td><td>".$row['nickname']."</td><td>".$row['dateadded']."</td><td>".$row['datelastmodify']."</td><td>".$row['description']."</td><td>".$row['ip']."</td><td>".$row['ftpaddress']."</td><td>".$row['ftpusr']."</td><td>".$row['ftppwd']."</td>";
		 echo  '<td><a href="update.php?id=';?><?php echo $row['id'];?><?php echo '">修改</a></td>
		 		<td><a href="del.php?id=';?><?php echo $row['id'];?><?php echo '">删除</a></td></tr>';
	}
	
	echo "</table>";
?>

</body>
</html>
