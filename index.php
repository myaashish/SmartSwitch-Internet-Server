<!---
Author: Aashish Parmar (parmaraashish3@gmail.com)

This file registers micro controller of the switches to server used in order to send switch control
using internet.
--->

<?php
    $host = 'localhost';
    $dbx = mysql_connect("localhost","$user","$pass");
    mysql_select_db("$db_name",$db);
    $er = 'failed';

    $pinum=$_REQUEST['pinum'];
    $ipaddr=$_SERVER['REMOTE_ADDR'];

    $exec=mysql_query("insert into mkc values('$pinum', '$ipaddr') on duplicate key update val='$ipaddr'", $dbx);
    while($row=mysql_fetch_array($exec))
    {
        $er = 'done';
    }
    print($er);
    mysql_close($dbx);
?>
