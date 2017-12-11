<?PHP
require_once("./include/config.php");

$fgmembersite->RedirectToURL("home.html");



if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("home.html");
} 
if($fgmembersite->DBLogin())
{ echo'buddy!';

}


setcookie("CampHUMGoodGoogalieMoo","HotDiggityDog", 0);
       
echo "<pre>";

echo "Dear Martin,

     You are a really great guy.  I just wanted you to know that.

Love,

Jesus<br><br>";

echo "<img src=\"jesus.jpg\" alt=\"Smiley face\" height=\"400\" width=\"400\">";

echo "<br><br>P.S. Here a few things that I found while I was hacking your web site:<br><br>";

echo "1. Session ID from call to session_id():<br><br>";

echo session_id();

$id = $_SESSION['camper_id'];

   
              
        $result = mysql_query("Select imageType, imagedata from week_photo where camper_id = '$id'");
        
        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("Sorry Picture not found.");
            return false;
        }
        
         $row = mysql_fetch_assoc($result);
        
//header('Content-type:' . $row['imageType']);
 
echo '<img src="data:image/jpg;base64,'.base64_encode( $row['imagedata'] ).'"/>';

echo "<br><br>";

echo "2. Value of \$_COOKIE (all browser cookies) from print_r(\$_COOKIE):<br><br>";

print_r($_COOKIE);

echo "<br>";

echo "3. Value of \$_SESSION from print_r(\$_SESSION):<br><br>";

print_r($_SESSION);



echo $_SESSION['name'];

echo $_SESSION['id_of_user'];

$i = $_SESSION['camper_id'];

echo $i;

echo "<br>";

echo "You may want to take a look at these links real soon:

http://php.net/manual/en/session.security.php

  and

http://phpsec.org/projects/guide/4.html";

echo "<br><br>";

echo "Peace out...";

echo "</pre>";


?>

<table>
<?php 


    foreach ($_POST as $key => $value) {
        echo "<tr>";
        echo "<td>";
        echo $key;
        echo "</td>";
        echo "<td>";
        echo $value;
        echo "</td>";
        echo "</tr>";
    }

print_r($_POST);
?>
</table>

