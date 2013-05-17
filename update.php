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


<?php
		mysql_query("SET NAMES utf8"); 
		$result = mysql_query('SELECT * FROM `'.$table_name.'` WHERE `id` = \'' . $_GET['id']. '\'');
						
		while($row = mysql_fetch_array($result)){
			 echo '<form action="update.php" method="get">
			 			<input type="hidden" name="id" id="id" value="'.$row['id'].'"/>
						域名：<input type="text" name="domain"  id="domain" value="'.$row['domain'].'"/></br>
						名字：<input type="text" name="name" id="name" value="'. $row['name'].'"/></br>
						昵称：<input type="text" name="nickname"  id="nickname" value="'.$row['nickname'].'"/></br>
						备注：<input type="text" name="description" id="description" value="'.$row['description'].'"/></br>
						ip：<input type="text" name="ip" id="ip" value="'.$row['ip'].'"/></br>
						ftp地址：<input type="text" name="ftpaddress" id="ftpaddress" value="'.$row['ftpaddress'].'"/></br>
						ftp用户名：<input type="text" name="ftpusr" id="ftpusr" value="'.$row['ftpusr'].'"/></br>
						ftp密码：<input type="text" name="ftppwd" id="ftppwd" value="'.$row['ftppwd'].'"/></br>
						<input type="submit" value="保存修改"  name="submit"/>
						<a href="db.php">返回</a>';
						
			echo '</form>';		
			
		}


		if(isset($_GET['submit'])){
			$sql="UPDATE `".$table_name."` SET `domain`='$_GET[domain]',`name`='$_GET[name]',`nickname`='$_GET[nickname]',`description`='$_GET[description]',`ip`='$_GET[ip]',`ftpaddress`='$_GET[ftpaddress]',`ftpusr`='$_GET[ftpusr]',`ftppwd`='$_GET[ftppwd]' WHERE `id`=$_GET[id]";
			mysql_query("SET NAMES utf8"); 
			if(mysql_query($sql,$con))
			{
				echo "修改成功";
			}else{
				echo "修改不成功";}
		}
		

?>