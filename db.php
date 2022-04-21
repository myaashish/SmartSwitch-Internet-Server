<!---
Author: Aashish Parmar (parmaraashish3@gmail.com)

This file returns status of switches with their status, names of a given micro-controller based on their
identification number.
--->

<?php
    $host = 'localhost';
    $dbx = mysql_connect("localhost","$user","$pass");
    if($dbx)
    {
        $mydb=mysql_select_db("$db_name",$db);
        if($mydb)
        {
            $pinum=$_REQUEST['pinum'];
            echo $pinum;
            $exec=mysql_query("select num, name, state from number where pinum='$pinum'", $dbx);
            while($row=mysql_fetch_array($exec))
            {
                $flag[]=$row;
            }
            print(json_encode($flag));
        }
        else
        {
            print ("Fetching Failed");
        }
        mysql_close($dbx);
    }
?>
