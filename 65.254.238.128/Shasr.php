<?php
// Get all the related keywords from Google Suggest
//$u = "http://google.com/complete/search?output=toolbar";
//$u = $u . "&q=" . $_REQUEST['msg'];
// Using the curl library since dreamhost doesn’t allow fopen

//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, $u);
//curl_setopt($ch, CURLOPT_HEADER, 0);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//$xml = simplexml_load_string(curl_exec($ch));
//curl_close($ch);
// Parse the keywords and echo them out to the IM window
//$result = $xml->xpath('//@data');
//while (list($key, $value) = each($result)) {
//echo $value ."<br>";
//}



if (strtoupper($_REQUEST['msg'])=="SHAS") $u="Its my nick name";
if (strtoupper($_REQUEST['msg'])=="EMAIL") $u="shas@ttct.net"."<br>"."shasoman@yahoo.com";
if (strtoupper($_REQUEST['msg'])=="HOME") $u="Pazhuvil<BR>Thrissur<BR>Kerala<BR>India";
if (strtoupper($_REQUEST['msg'])=="COMPANY") $u="Tamimah Telecom<BR>Oman";
if (strtoupper($_REQUEST['msg'])=="JOB") $u="Project Consultant";
if (strtoupper($_REQUEST['msg'])=="WEBSITE") $u="www.shasfactory.com";
if (strtoupper($_REQUEST['msg'])=="NAME") $u="Shafeeq";
if (strtoupper($_REQUEST['msg'])=="KIDS") $u="Aaquib Shehzad Omar<br>Kenza Inshira";
if (strtoupper($_REQUEST['msg'])=="FAMILY") $u="Jezna";
if (strtoupper($_REQUEST['msg'])=="RAVI") $u="He is my Boss";
if (strtoupper($_REQUEST['msg'])=="KALAM") $u="He is my Friend";

if ($u=="") $u="Try<BR>Shas<br>Email<br>Home<br>Company<br>Job<br>Website<br>Name<br>Kids<br>Family";

echo $u;
/*
if ($_REQUEST['msg']!="")
{
$ur="http://62.231.246.118:120/mm/sms.asp?phoneno=99369401&message=".rawurlencode($_REQUEST['msg'])."&lang=E&strfrom=GtalkChat";
//$handle = fopen($ur, "rb");
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $ur);
curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$tuData = curl_exec($ch);
//curl_setopt($ch, CURLOPT_HEADER, 0);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//$xml = simplexml_load_string(curl_exec($ch));
curl_close($ch);
}*/
?>