<?php
	$data = array();
	$db_name= 'test';
	$table_name= 'domain_4';
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
					id int primary key not null AUTO_INCREMENT,
					domain varchar(250) not null,
					name varchar(10),
					nickname varchar(10),
					dateadded datetime,
					datelastmodify TIMESTAMP,
					description varchar(250),
					ip varchar(15),
					ftpaddress varchar(15),
					ftpusr varchar(20),
					ftppwd varchar(20)
				)default charset utf8";
		if(mysql_query($sql,$con)){
			echo $table_name."创建成功！";
		}else{
			echo $table_name."创建失败！";}
		
	}else{
		echo "[".$table_name."] 表已存在！";
	}

?>