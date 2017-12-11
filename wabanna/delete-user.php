<?PHP
require_once("./include/config.php");

$fgmembersite->LogOut();

$fgmembersite->Delete_User();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        echo $_SESSION['name_of_user'];
        echo '<br>';
        echo 'Your account has been deleted';
        ?>
    </body>
</html>
