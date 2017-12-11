<?PHP
require_once("./include/config.php");
if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("/home.html");
} 



if(isset($_POST['submit']))
{ $fgmembersite->Get_Camper_Info();
   
    $fgmembersite->RedirectToURL("edit_forms.php");
   
    
}
?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>Dashboard Panel</title>
	
	<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="js/hideshow.js" type="text/javascript"></script>
	<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.equalHeight.js"></script>
	<script type="text/javascript">
	$(document).ready(function() 
    	{ 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>

</head>

<body>

	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="userhome.php">Admin Page</a></h1>
			<h2 class="section_title">Camp Information</h2>
			<div class="btn_view_site"><a href="logout.php">Logout</a></div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
                        
			<p><?PHP echo $_SESSION['name_of_user'] ?></p>
                        
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="#"></a><div class="breadcrumb_divider"></div> <a class="current"></a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<aside id="sidebar" class="column">
		
		<hr/>
		<h3>Menu</h3>
		<ul class="toggle">
                    <li class="icn_add_user"><a href="change-pwd.php">Change Password</a></li>
                    <li class="icn_view_users"><a href="reset-pwd-req.php">Reset Password</a></li>
                    <li class="icn_profile"><a href="logout.php">Logout</a></li>
		
		</ul>
		
                <img src="./images/photo1236 (1).jpg">
		
		
		<footer>
			<hr />
			<p><strong>Copyright &copy; 2015 Helping Up Mission</strong></p>
			<p>Visit Us at <a href="http://www.helpingupmission.org">Helping Up Mission</a></p>
		</footer>
	</aside><!-- end of sidebar -->
	
	<section id="main" class="column">
		
		<h4 class="alert_info">Welcome to the Admin Page.  Use the side bar menu to choose a selection.</h4>
		
		
                <article class="module width_weeks">
                    <header><h3>
                           Jr. Girls (7-11 yrs) 5 spots each week! 
                          </h3>
                        
                    </header>
                        
			<div class="module_content">
		    
                    
                   

<?PHP
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
        
	$query = "SELECT * FROM jr_girls";

	$result = mysqli_query($connection, $query);
         
        if (!$result) {

          die("Database query failed. $query");

        }
        
       
 ?>
                            <table border="1" style= "background-color: #ffcccc; color: #000; width: 100%; margin: 0 auto; float: left; text-align: center;" >
      <thead>
        <tr>
          <th>Dates</th>
          <th>Week Number</th>
          <th>Total used</th>
        </tr>
      </thead>
      <tbody>
        <?php
          while( $row = mysqli_fetch_assoc( $result ) ){
            echo
            "<tr>
              <td>{$row['week']}</td>
              <td>{$row['week_number']}</td>
              <td>{$row['counter']}</td>
            </tr>";
          }
        ?>
      </tbody>
    </table>               
                    
				<div class="clear"></div> 
			</div>
		</article>
                
                		<article class="module width_weeks">
                    <header><h3>
                           Jr. Boys (7-11 yrs) 5 spots each week! 
                          </h3>
                        
                    </header>
                        
			<div class="module_content">
		    
                    
                   


<?php
        
	$query = "SELECT * FROM jr_boys";

	$result = mysqli_query($connection, $query);
         
        if (!$result) {

          die("Database query failed. $query");

        }
        
       
 ?>
                            <table border="1" style= "background-color: #99ccff; color: #000; width: 100%; margin: 0 auto; float: left; text-align: center;" >
      <thead>
        <tr>
          <th>Dates</th>
          <th>Week Number</th>
          <th>Total used</th>
        </tr>
      </thead>
      <tbody>
        <?php
          while( $row = mysqli_fetch_assoc( $result ) ){
            echo
            "<tr>
              <td>{$row['week']}</td>
              <td>{$row['week_number']}</td>
              <td>{$row['counter']}</td>
            </tr>";
          }
        ?>
      </tbody>
    </table>               
                    
				<div class="clear"></div> 
			</div>
		</article>
                
     <article class="module width_weeks">
                    <header><h3>
                           Sr. Girls (12-16 yrs) 6 spots each week! 
                          </h3>
                        
                    </header>
                        
			<div class="module_content">
		    
                    
                   


<?php
        
	$query = "SELECT * FROM sr_girls";

	$result = mysqli_query($connection, $query);
         
        if (!$result) {

          die("Database query failed. $query");

        }
        
       
 ?>
                            <table border="1" style= "background-color: #ffcccc; color: #000; width: 100%; margin: 0 auto; float: left; text-align: center;" >
      <thead>
        <tr>
          <th>Dates</th>
          <th>Week Number</th>
          <th>Total used</th>
        </tr>
      </thead>
      <tbody>
        <?php
          while( $row = mysqli_fetch_assoc( $result ) ){
            echo
            "<tr>
              <td>{$row['week']}</td>
              <td>{$row['week_number']}</td>
              <td>{$row['counter']}</td>
            </tr>";
          }
        ?>
      </tbody>
    </table>               
                    
				<div class="clear"></div> 
			</div>
		</article>           
                
     <article class="module width_weeks">
                    <header><h3>
                           Sr. Boys (12-16 yrs) 5 spots each week! 
                          </h3>
                        
                    </header>
                        
			<div class="module_content">
		    
                    
                   


<?php
        
	$query = "SELECT * FROM sr_boys";

	$result = mysqli_query($connection, $query);
         
        if (!$result) {

          die("Database query failed. $query");

        }
        
       
 ?>
                            <table border="1" style= "background-color: #99ccff; color: #000; width: 100%; margin: 0 auto; float: left; text-align: center;" >
      <thead>
        <tr>
          <th>Dates</th>
          <th>Week Number</th>
          <th>Total used</th>
        </tr>
      </thead>
      <tbody>
        <?php
          while( $row = mysqli_fetch_assoc( $result ) ){
            echo
            "<tr>
              <td>{$row['week']}</td>
              <td>{$row['week_number']}</td>
              <td>{$row['counter']}</td>
            </tr>";
          }
        ?>
      </tbody>
    </table>               
                    
				<div class="clear"></div> 
			</div>
		</article>           
                
                
                
                <!-- end of stats article -->
		
		<article class="module width_full">


<?php

        $id = $_SESSION['id_of_user'];

        $query = "SELECT *, camper_info.camper_id AS l_camper_id FROM camper_info left join week_photo on camper_info.camper_id = week_photo.camper_id left join consent_form on camper_info.camper_id = consent_form.camper_id order by lastname asc";

        $query = "SELECT *, camper_info.camper_id AS l_camper_id FROM camper_info left join week_photo on camper_info.camper_id = week_photo.camper_id left join consent_form on camper_info.camper_id = consent_form.camper_id left join jr_girls on week_photo.week = jr_girls.week where week_number > 0 order by lastname asc";

        $result = mysqli_query($connection, $query);

        if (!$result) {

          die("No Campers enrolled.");

        }
        
       
 ?>

                <header><h3 class="">All  enrollments (total:&nbsp;<?PHP echo $result->num_rows;?>)</h3></header>


		<div class="tab_container">
			<div id="tab1" class="tab_content">
                            <table border="1" style= "background-color: #ccffff; color: #000; width: 100%; margin: 0 auto; float: left; text-align: center;" >
      <thead>
        <tr>
          <th>Last Name</th>
          <th>First Name</th>
          <th>Date of Birth</th>
          <th>Age</th>
          <th>Grade</th>
          <th>Gender</th>
          <th>Week</th>
          <th>Health Form</th>
          <th>Consent Form</th>
        </tr>
      </thead>
      <tbody>
        <?php
          while( $row = mysqli_fetch_assoc( $result ) ){
            echo
            "<tr>
              <td><a href=\"view_forms.php?l_camper_id={$row['l_camper_id']}\" style=\"color:darkblue\">{$row['LastName']}</a></td>
              <td><a href=\"view_forms.php?l_camper_id={$row['l_camper_id']}\" style=\"color:darkblue\">{$row['FirstName']}</a></td>
              <td>{$row['DOB']}</td>
              <td>{$row['Age']}</td>  
              <td>{$row['Grade']}</td>    
              <td>{$row['Gender']}</td>
              <td>{$row['week']}</td>
              <td>{$row['health_form_confirm']}</td>
              <td>{$row['consent_form_confirm']}</td>    
            </tr>";
            
          }
          
        ?>
      </tbody>
    </table> 
          
			</div><!-- end of #tab1 -->
                        
</select>
   </div>                        
  
                            
                        </div>
                            
		</div><!-- end of .tab_container -->
		
		</article><!-- end of content manager article -->
		
		

		<div class="clear"></div>
		
				<div class="clear"></div>
			</div>
		</article><!-- end of stats article -->	
		
		
		
		
		<div class="spacer"></div>
	</section>


</body>

</html>
