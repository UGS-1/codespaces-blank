<?php

if (strlen($_GET["PH"])==8 && strlen($_GET["MSG"])>0)
{
 $to = "shas@ttct.net";
 $subject = "From SMS: ".$_GET["PH"] ;
 $body = $_GET["MSG"];
 $headers = "From: shas@ttct.net\r\n" .
     "X-Mailer: php";
		if (mail($to, $subject, $body, $headers)) 
			{
			   echo("OK");
			}
			else
				{
				echo("MAIL ERROR");
				}
}
else
{
	echo "ERROR";
}
?>