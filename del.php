<?php
  include 'conn.php';


	if (isset($_GET['id'])){
		if(mysql_query('DELETE FROM '.$table_name.' WHERE `id` = \'' . $_GET['id'] . '\'',$con)){
			echo "删除成功";
		}
	}
?>
<a href="db.php">返回</a>
