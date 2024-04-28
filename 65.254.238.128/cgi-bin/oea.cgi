#!/usr/local/bin/perl
$version = "2.5";

$mailprog = '/usr/sbin/sendmail';


#$recipient = "oea2001\@hotmail.com";
#$recipient1 = "tamimah\@omantel.net.om";
#$recipient = "chairman\@oea-oman.org";
$recipient = "webtec\@omantel.net.om";
#$recipient1 = "secretary\@oea-oman.org";
$recipient1 = "info\@oea-oman.org";
$from = "info\@oea-oman.org";
@required = ('email','name','ValidAtor');

$homepage = "http://oea-oman.org";

$subject = "[ O E A ] Omani Economic Association ";

$thanksmessage = "";

$font = "arial,helvetica,verdana";

$header = "

<HTML>
<HEAD>
<meta http-equiv=Content-Language content=ar-om>
<meta http-equiv=Content-Type content=text/html; charset=windows-1256>
<title>&#1575;&#1604;&#1580;&#1605;&#1593;&#1610;&#1577; &#1575;&#1604;&#1573;&#1602;&#1578;&#1589;&#1575;&#1583;&#1610;&#1577; &#1575;&#1604;&#1593;&#1605;&#1575;&#1606;&#1610;&#1577;</title>
<style fprolloverstyle>A:hover {color: #FF0000;}
</style>
</HEAD>
<BODY BGCOLOR=#FFFFD9 TEXT=#FFFFD9 LINK=#FF0000 VLINK=#FFFFD9 ALINK=#707070>
<center><table border=0 cellpadding=4 cellspacing=2 width=80%>
<tr>
<td bgcolor=#FF0000>
<center><table border=0 cellpadding=4 cellspacing=0 width=100%>
<tr>
<td bgcolor=#318C39>

";

$footer = "

</td>
</tr>
</table></center>
</td>
</tr>
</table></center>
</BODY>
</HTML>

";

$reply = "1";

$rsub = "Thanks from [ O E A ] Omani Economic Association ";

$rmes = "Thank you for submitting your Membership form.";

$show = "1";

$referer = "1";



# interprets data sent by form
##############################
print "Content-type:text/html\n\n";

read(STDIN, $buffer, $ENV{'CONTENT_LENGTH'});
@pairs = split(/&/, $buffer);
foreach $pair (@pairs) {
($name, $value) = split(/=/, $pair);
   $value =~ tr/+/ /;
   $value =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
$FORM{$name} = $value;

}


# checks for required fields
# the HTML below will be printed 
# if a field wasn't filled out
#################################
foreach $check(@required) {
        unless ($FORM{$check}) {

print <<EndHTML
$header
<p>&nbsp;&nbsp;<font size="3" face="$font"><b><i>!!MISSING FIELD!!</i></b></font></p>
<p><font size="2" face="$font">Sorry, but one of the required fields wasn't filled out. Please click the back button and fill in the <b>$check</b> field.</p>
<br><center><input type=button value= back onclick = "javascript:history.go(-1)">
<p>If you feel that this message was in error, you can email the webmaster at <a href="mailto:$recipient">$recipient</a>.</p>
<p><b>Thank You!</b></p>
<BR><BR>
$footer
EndHTML
;
exit;
        }
}

# print email
################
open (MAIL, "|$mailprog -t") or &denice("Can't access $mailprog!\n");
print MAIL "To: $recipient\n";
print MAIL "FROM: $from\n";
print MAIL "Reply-to:$FORM{'email'}\n";
print MAIL "Subject: $subject\n\n";
print MAIL "Omani Economic Association\n";

print MAIL "\n";
print MAIL "Membership Form\n";
print MAIL "------------------\n";
print MAIL "\n";
print MAIL "1.  Full Name		:	$FORM{'name'}  $FORM{'sname'}  $FORM{'tname'}  $FORM{'tribe'}\n";
print MAIL "2.  Date of Birth	:	$FORM{'dob'}\n";
print MAIL "3.  Nationality		:	$FORM{'nat'}\n";
print MAIL "4.  Qualification	:	$FORM{'qua'}\n";
print MAIL "5.  Profession		:	$FORM{'pro'}\n";
print MAIL "6.  Specialisation	:	$FORM{'special'}\n";
print MAIL "7.  Reason. Spec	:	$FORM{'spec_res'}\n";
print MAIL "8.  Off. Address	:	$FORM{'ofa'}\n";
print MAIL "9.  Residence		:	$FORM{'res'}\n";
print MAIL "10.  Off. Telephone	:	$FORM{'oft'}\n";
print MAIL "11.  Fax No. 		:	$FORM{'fax'}\n";
print MAIL "12.  GSM     		:	$FORM{'gsm'}\n";
print MAIL "13.  Email   		:	$FORM{'email'}\n";
print MAIL "14.  Postal Address	:	$FORM{'poa'}\n";
print MAIL "أقر بأنه لم يحكم على في جناية أو جنحة مخلة بالشرف والأمانة وبأن\n";
print MAIL "لدي الرغبة في العمل في خدمة الجمعية و تحقيق أهدافها و أتعهد بإحترام نظامها\n";
print MAIL "   \n";


if ($referer eq "1") {print MAIL "HTTP Referer = $ENV{'HTTP_REFERER'}";}
close(MAIL);

open (MAIL, "|$mailprog -t") or &denice("Can't access $mailprog!\n");
print MAIL "To: $recipient1\n";
print MAIL "FROM: $from\n";
print MAIL "Reply-to:$FORM{'email'}\n";
print MAIL "Subject: $subject\n\n";
print MAIL "Omani Economic Association\n";

print MAIL "\n";
print MAIL "Membership Form\n";
print MAIL "------------------\n";
print MAIL "\n";
print MAIL "1.  Full Name		:	$FORM{'name'}  $FORM{'sname'}  $FORM{'tname'}  $FORM{'tribe'}\n";
print MAIL "2.  Date of Birth	:	$FORM{'dob'}\n";
print MAIL "3.  Nationality		:	$FORM{'nat'}\n";
print MAIL "4.  Qualification	:	$FORM{'qua'}\n";
print MAIL "5.  Profession		:	$FORM{'pro'}\n";
print MAIL "6.  Specialisation	:	$FORM{'special'}\n";
print MAIL "7.  Reason. Spec	:	$FORM{'spec_res'}\n";
print MAIL "8.  Off. Address	:	$FORM{'ofa'}\n";
print MAIL "9.  Residence		:	$FORM{'res'}\n";
print MAIL "10.  Off. Telephone	:	$FORM{'oft'}\n";
print MAIL "11.  Fax No. 		:	$FORM{'fax'}\n";
print MAIL "12.  GSM     		:	$FORM{'gsm'}\n";
print MAIL "13.  Email   		:	$FORM{'email'}\n";
print MAIL "14.  Postal Address	:	$FORM{'poa'}\n";
print MAIL "أقر بأنه لم يحكم على في جناية أو جنحة مخلة بالشرف والأمانة وبأن\n";
print MAIL "لدي الرغبة في العمل في خدمة الجمعية و تحقيق أهدافها و أتعهد بإحترام نظامها\n";

print MAIL "   \n";


if ($referer eq "1") {print MAIL "HTTP Referer = $ENV{'HTTP_REFERER'}";}
close(MAIL);

# prints reply email if wanted
##############################
if ($reply eq "1") {
open (MAIL, "|$mailprog -t") or &denice("Can't access $mailprog!\n");
print MAIL "To: $FORM{'email'}\n";
print MAIL "from: $from\n";
print MAIL "Subject: $rsub\n";
print MAIL "$rmes\n";
if ($show eq"1"){
print MAIL "Omani Economic Association\n";

print MAIL "\n";
print MAIL "Membership Form\n";
print MAIL "------------------\n";
print MAIL "\n";
print MAIL "1.  Full Name		:	$FORM{'name'}  $FORM{'sname'}  $FORM{'tname'}  $FORM{'tribe'}\n";
print MAIL "2.  Date of Birth	:	$FORM{'dob'}\n";
print MAIL "3.  Nationality		:	$FORM{'nat'}\n";
print MAIL "4.  Qualification	:	$FORM{'qua'}\n";
print MAIL "5.  Profession		:	$FORM{'pro'}\n";
print MAIL "6.  Specialisation	:	$FORM{'special'}\n";
print MAIL "7.  Reason. Spec	:	$FORM{'spec_res'}\n";
print MAIL "8.  Off. Address	:	$FORM{'ofa'}\n";
print MAIL "9.  Residence		:	$FORM{'res'}\n";
print MAIL "10.  Off. Telephone	:	$FORM{'oft'}\n";
print MAIL "11.  Fax No. 		:	$FORM{'fax'}\n";
print MAIL "12.  GSM     		:	$FORM{'gsm'}\n";
print MAIL "13.  Email   		:	$FORM{'email'}\n";
print MAIL "14.  Postal Address	:	$FORM{'poa'}\n";
print MAIL "أقر بأنه لم يحكم على في جناية أو جنحة مخلة بالشرف والأمانة وبأن\n";
print MAIL "لدي الرغبة في العمل في خدمة الجمعية و تحقيق أهدافها و أتعهد بإحترام نظامها\n";
}
print MAIL "\n:::::::::::\n";
print MAIL "----------------------------------------------------------\n";
print MAIL "v i s i t  : http://www.directory-oman.com\n";
print MAIL " Oman's Premium Online Directory Service\n";
close(MAIL);

}

# prints thank you HTML page
############################
print <<EndHTML
$header
<p>&nbsp;&nbsp;<font size="3" face="$font"><center><b>!! Thank You and Good Luck!!</b></font>
<p><font size="2" face="$font">$thanksmessage</p>
EndHTML
;

# prints out variables to page if wanted
########################################
print "<font size=3 face=$font><b><i>Here Your Submit Details:</i></b></font><BR><BR>";
print "<font size=2 face=$font>";
print "<table width=100%><tr>";
##foreach $key (keys(%FORM)) {
##print "$key = $FORM{$key}<BR><br>";}
print  "<tr><td width=30% align=right> Full Name	</td><td><b>:</b></td><td>$FORM{'name'}  $FORM{'sname'}  $FORM{'tname'}  $FORM{'tribe'}</td>";
print  "<tr><td width=30% align=right> Date of Birth	</td><td><b>:</b></td><td>$FORM{'dob'}</td></tr>";
print  "<tr><td width=30% align=right> Nationality	</td><td><b>:</b></td><td>$FORM{'nat'}</td></tr>";
print  "<tr><td width=30% align=right> Qualification	</td><td><b>:</b></td><td>$FORM{'qua'}</td></tr>";
print  "<tr><td width=30% align=right> Profession	</td><td><b>:</b></td><td>$FORM{'pro'}</td></tr>";
print  "<tr><td width=30% align=right> Specialization	</td><td><b>:</b></td><td>$FORM{'special'}</td></tr>";
print  "<tr><td width=30% align=right> Reasons for joining if the applicant is specialised in a field related to economics.</td><td><b>:</b></td><td>$FORM{'spec_res'}</td></tr>";
print  "<tr><td width=30% align=right> Off. Address	</td><td><b>:</b></td><td>$FORM{'ofa'}</td></tr>";
print  "<tr><td width=30% align=right> Residence	</td><td><b>:</b></td><td>$FORM{'res'}</td></tr>";
print  "<tr><td width=30% align=right> Off. Telephone	</td><td><b>:</b></td><td>$FORM{'oft'}</td></tr>";
print  "<tr><td width=30% align=right> Fax No. 		</td><td><b>:</b></td><td>$FORM{'fax'}</td></tr>";
print  "<tr><td width=30% align=right> GSM     		</td><td><b>:</b></td><td>$FORM{'gsm'}</td></tr>";
print  "<tr><td width=30% align=right> Email   		</td><td><b>:</b></td><td>$FORM{'email'}</td></tr>";
print  "<tr><td width=30% align=right> Postal Address	</td><td><b>:</b></td><td>$FORM{'poa'}</td></tr>";
print  "</table>";
if ($reply eq "1") {
print "<font size=2 face=$font><b>";
print "You have also been emailed with the above information to the address you submitted.";
print "</b></font></center>";
}

# finishes page
###############
print <<EndHTML
<font color="#FFFFD9" size="2" face="$font">
<p><center></center></p>
<font color="#FFFFD9" size="3" face="$font">

<p>
<a href="$homepage"><b>Click here to return to our homepage.<b></a></font></p>
<p align=\"center\">
 -- Omani Economic Association -- <BR> 
<a href=\"http://oea-oman.org\">
O E A </a></b></p></font>

$footer
EndHTML
;


# Bad MailProg Message
######################
sub dience {
 ($errmsg) = @_;
 print "<h2>ERROR</h2>\n";
 print "$errmsg<p>\n";
 print "</body></html>\n";
 exit;
}