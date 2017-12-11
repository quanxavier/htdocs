<?PHP
require_once("./include/procedures.php");

$fgmembersite = new FGMembersite();

//Provide your site name here
$fgmembersite->SetWebsiteName('HUM-CampWabanna');

//Provide the email address where you want to get notifications
$fgmembersite->SetAdminEmail('camphelpingup@gmail.com');

//Provide your database login details here:
//hostname, user name, password, database name and table name
//note that the script will create the table (for example, fgusers in this case)
//by itself on submitting register.php for the first time

$fgmembersite->InitDb(/*hostname*/'localhost',
                      /*username*/'root',
                      /*password*/'M!ssi0nh3lp',
                      /*database name*/'wabanna',
				 /*table name*/'camper_info');
//For better security. Get a random string from this link: http://tinyurl.com/randstr
// and put it here
$fgmembersite->SetRandomKey('qSRcVS6DrTzrPvr');
?>