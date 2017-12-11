<?PHP
require_once("./include/config.php");



if(!$fgmembersite->CheckLogin())
    {
        $fgmembersite->RedirectToURL("home.html");
        exit;
    
    }
 $dbhost = "localhost";
        $dbuser ="root";
        $dbpass = "";
        $dbname = "wabanna";
        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
            If(mysqli_connect_errno()) {
                die("Database connection failed: " .
                mysqli_connect_error() .
                " (" . mysqli_connect_errno() . ")"
            );
            }   
    
    
    
$id = $_SESSION['camper_id'];
  $qry = "DELETE FROM camper_info where camper_id = $id ";
   $result = mysqli_query($connection, $qry);
         
        if (!$result) {
            
          die("No one deleted.");

        }     
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
    </head>
    <body>
        <section id="main" class="column">
        <h4 class="alert_error">WARNING!!Camper is not within the Age range</h4>
        <br>
        <h4 class="alert_warning"><a href="userhome.php">Click Here to Return the the Users Page</a></h4><br><br>
        </section>
    </body>
</html>
