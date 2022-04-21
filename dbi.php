<!---
Author: Aashish Parmar (parmaraashish3@gmail.com)

This file inserts values like switch names and status from the client side for a specific micro-controller
using its identification number.
--->

<?php
	$host='localhost';
	$uname=$user;
	$pwd=$pass;
	$db=$dbms;

	$con=mysql_connect($host,$uname,$pwd);
	mysql_select_db($db,$con);
	$pnum=$_REQUEST['num'];
	$pname=$_REQUEST['name'];
    $pinum=$_REQUEST['pinum'];

	if($r=mysql_query("insert into number values('$pnum', \"'$pname'\", 0, \"'$pinum'\") on duplicate key update name='$pname'",$con))
	{
		print("File changed");
	}
    else
    {
        print("File not changed");
    }
	mysql_close($con);
?>
