<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
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
 ?>
<?php
        
	$query = "SELECT week_number, week FROM weeks ";

	$result = mysqli_query($connection, $query);
         
        if (!$result) {

          die("Database query failed. $query");

        }
        
       
 ?>
<select name="week">
<?php
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value=\"{$row['week']}\">";
        echo $row['week'];
        echo "</option>";
    }
?>
</select>
 

    </body>
</html>
