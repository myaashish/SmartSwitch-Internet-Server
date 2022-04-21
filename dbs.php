<!---
Author: Aashish Parmar (parmaraashish3@gmail.com)

This file returns status of switches for a specific microcontroller to the client tool using its
identification number.
--->

<?php
    $host = 'localhost';
    $dbx = mysql_connect("localhost","$user","$pass");
    mysql_select_db("$db_name",$db);

    $pinum=$_REQUEST['pinum'];
    $numbr=$_REQUEST['numbr'];
    $ipx;
    $port=80;

    $exec=mysql_query("select val from smartswitch where id='$pinum'", $dbx);
    while($row=mysql_fetch_array($exec))
    {
        $ipx = $row[0];
    }

    $sockx=socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
    if($sockx != FALSE)
    {
        $sockt=socket_connect($sockx, $ipx, $port);
        if($sockt == TRUE)
        {
            $socki=socket_send($sockx, $numbr, strlen($numbr), 0);
            if($socki == FALSE)
            {
                print "Message sending failed";
                $errorcode = socket_last_error();
                $errormsg = socket_strerror($errorcode);
                print( $errormsg );
                exit(1);
            }
            else
            {
                print "Message succesfully sent";
            }
        }
        else
        {
            print "Failed to connect";
            exit(1);
        }
    }
    else
    {
        print "Socket creation failed";
        exit(1);
    }

    if($numbr != 0)
    {
        $exec1=mysql_query("update number set state=(state+1)%2 where pinum='$pinum' and num='$numbr'");
    }
    else
    {
        $exec1=mysql_query("update number set state=0 where pinum='$pinum'");
    }
    while($row=mysql_fetch_array($exec))
    {
        print("instruction executed");
    }

    mysql_close($dbx);
?>
