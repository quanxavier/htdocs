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
           $qry = "SELECT * FROM camper_info left join week_photo on camper_info.camper_id = week_photo.camper_id left join parent_guardian_info on camper_info.camper_id = parent_guardian_info.camper_id"; 
           $result = mysqli_query($connection, $qry);
          
          
           
        ?>
         <table border="1" style= "background-color: #ccffff; color: #000; width: 100%; margin: 0 auto; float: left; text-align: center;" >
      <thead>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Date of Birth</th>
          <th>Age</th>
          <th>Grade</th>
          <th>Gender</th>
          <th>Week</th>
          <th>Health Form</th>
          <th>Consent Form</th>
          <th>Photo</th>
          <th>Father</th>
          <th>Home Phone</th>
          <th>Work Phone</th>
          <th>Cell Phone</th>
          <th>Mother</th>
          <th>Home Phone</th>
          <th>Work Phone</th>
          <th>Cell Phone</th>
          
        </tr>
      </thead>
      <tbody>
        <?php
          while( $row = mysqli_fetch_assoc( $result ) ){
            echo
            "<tr>
              <td>{$row['FirstName']}</td>
              <td>{$row['LastName']}</td>
              <td>{$row['DOB']}</td>
              <td>{$row['Age']}</td>  
              <td>{$row['Grade']}</td>    
              <td>{$row['Gender']}</td>
              <td>{$row['week']}</td>
              <td>{$row['health_form_confirm']}</td>
              <td>{$row['consent_form_confirm']}</td>   
              <td>{$row['week_photo_confirm']}</td> 
              <td>{$row['first_name_f']} {$row['last_name_f']}</td>
              <td>{$row['home_phone_f']}</td>
              <td>{$row['work_phone_f']}</td>
              <td>{$row['cell_phone_f']}</td>  
              <td>{$row['first_name_m']} {$row['last_name_m']}</td>   
              <td>{$row['home_phone_m']}</td>
              <td>{$row['work_phone_m']}</td>
              <td>{$row['cell_phone_m']}</td>
            </tr>";
            
          }
          
          ?>
      </tbody>    
    </body>
</html>
