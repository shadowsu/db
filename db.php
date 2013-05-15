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
	$data = array();
	$db_name= 'test';
	$table_name= 'domain';
	$con = mysql_connect("localhost","root","");
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}

	echo "MySQL服务器连接成功！<br/>";
	
	$result = mysql_query('show databases;');
	While($row = mysql_fetch_assoc($result)){ 
	      $data[] = $row['Database']; /*将所有的数据库名赋值给data数组*/
	}
	
	if (in_array(strtolower($db_name), $data)){
		echo '[',$db_name,'] 数据库已存在<br/>';
	}else{ 
		if (mysql_query("CREATE DATABASE ".$db_name,$con)){
		  echo "Database ". $db_name." created";
		}else{
		  echo "Error creating database".$db_name.": " . mysql_error();}
	
	}
	
	mysql_select_db($db_name,$con);
	
	if(!mysql_query("select * from ".$table_name,$con)){
		$sql = "CREATE TABLE ".$table_name." (
					id primary key not null AUTO_INCREMENT,
					domain varchar(250) not null unique,
					name varchar(10),
					nickame varchar(10),
					dateadded datetime(),
					datelastmodify TIMESTAMP (14),
					description varchar(250),
					ip varchar(15),
					ftpaddress varchar(15),
					ftpusr varchar(20),
					ftppwd varchar(20)
				)";
		mysql_query($sql,$con);
		echo $table_name."创建成功！";
		
	}else{
		echo "[".$table_name."] 表已存在！";
	}

?>
<hr />

<?php 
	$domain = isset($_GET['domain'])?$_GET['domain']:null;
	$name = isset($_GET['name'])?$_GET['name']:null;
	$nickname = isset($_GET['nickname'])?$_GET['nickname']:null;
	$dateadded = isset($_GET['dateadded'])?$_GET['dateadded']:null;
	$datelastmodify = isset($_GET['datelastmodify'])?$_GET['datelastmodify']:null;
	$discription = isset($_GET['discription'])?$_GET['discription']:null;
	$ip = isset($_GET['ip'])?$_GET['ip']:null;
	$ftpaddress = isset($_GET['ftpaddress'])?$_GET['ftpaddress']:null;
	$ftpusr = isset($_GET['ftpusr'])?$_GET['ftpusr']:null;
	$ftppwd = isset($_GET['ftppwd'])?$_GET['ftppwd']:null;
?>

<form action="db.php" method="get">
	域名：<input type="text" name="domain"  id="domain"/><br />
    名字：<input type="text" name="name" id="name" /><br />
    昵称：<input type="text" name="nickname"  id="nickname"/><br />
    <input type="hidden" name="dateadded"  id="dateadded" class="hidden"/><br />
    <input type="hidden" name="datelastmodify" id="datelastmodify" class="hidden"/><br />
    备注：<input type="text" name="description" id="description" /><br />
    ip：<input type="text" name="ip" id="ip" /><br />
    ftp地址：<input type="text" name="ftpaddress" id="ftpaddress" /><br />
    ftp用户名：<input type="text" name="ftpusr" id="ftpusr" /><br />
    ftp密码：<input type="text" name="ftppwd" id="ftppwd" /><br />
    <input type="submit" value="添加记录" />
</form>

<?php
	if(isset($_GET['submit'])){
		$sql="INSERT INTO domain (domain, name, nickname, dateadded, datelastmodify, description, ip, ftpaddress, ftpusr, ftppwd )
		VALUES
		('$_GET[domain]','$_GET[name]','$_GET[nickname]','$_GET[dateadded]','$_GET[datelastmodify]','$_GET[description]','$_GET[ip]','$_GET[ftpaddress]','$_GET[ftpusr]','$_GET[ftppwd]')";
		mysql_query("set names 'GB2312'");
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

<hr />
<table>
<tr>
	<td>id</td>
	<td>域名</td>
    <td>用户名</td>
    <td>昵称</td>
    <td>添加日期</td>
    <td>最后修改日期</td>
    <td>备注</td>
    <td>ip</td>
    <td>ftp地址</td>
    <td>ftp用户名</td>
    <td>密码</td>
    <td>-编辑-</td>
    <td>-删除-</td>
</tr>
<tr>
	<td></td>
	<td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td><input type="button" name="modify" value="修改" /></td>
    <td><input type="button" name="delete" value="删除" /></td>
</tr>
</table>



</body>
</html>
