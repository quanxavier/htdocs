<?PHP
require_once("./include/membersite_config.php");


if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("home.html");
} 
if(!$fgmembersite->CheckWeek()){
    $fgmembersite->RedirectToURL("userhome.php");
}
if(isset($_POST['Submit']))
{ 
       //$fgmembersite->RedirectToURL("index.php");
   if(!$fgmembersite->AddWeek())
   {
      
   }
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
                    <h1 class="site_title"><a href="Weeks_Available.php">Weeks_Available</a></h1>
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
                    
		</ul>
		
                <img src="./images/photo1236 (1).jpg">
		
		
		<footer>
			<hr />
			<p><strong>Copyright &copy; 2015 Helping Up Mission</strong></p>
			<p>Visit Us at <a href="http://www.helpingupmission.org">Helping Up Mission</a></p>
		</footer>
	</aside><!-- end of sidebar -->
	
	<section id="main" class="column">
		<?PHP
$dbhost = "localhost";
        $dbuser ="root";
        $dbpass = "M!ssi0nh3lp";
        $dbname = "wabanna";
        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
            If(mysqli_connect_errno()) {
                die("Database connection failed: " .
                mysqli_connect_error() .
                " (" . mysqli_connect_errno() . ")"
            );
            }
            $id = $_SESSION['camper_id'];
            $query = "SELECT * FROM camper_info where camper_id = '$id' ";

	$result = mysqli_query($connection, $query);
         
        if (!$result) {

          die("Database query failed. $query");

        }
        $row = mysqli_fetch_assoc( $result );
                $Age = $row['Age'];
                $Gender = $row['Gender'];
 ?>
		<h4 class="alert_info">Choose a week for your child <?php echo $row['FirstName'] . " " . $row['LastName'] ?></h4>
		
<?php 
    if($row['Gender'] == 'female' && $Age <= '11' && $Age >= '7' ) {
            $agegroup = 'jr_girls';
            $counter = '5';
            $_SESSION['agegroup'] = $agegroup;
         
	$query1 = "SELECT week_number, week FROM $agegroup where counter < $counter";

	$result10 = mysqli_query($connection, $query1);
         
        if (!$result10) {

          die("Database query failed. $query1");

        }
?>
                <article class="module width_week">
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
          
          
    }
   elseif ($row['Gender'] == 'male' && $Age <= '11' && $Age >= '7') {
            $agegroup = 'jr_boys';
            $counter = '5';
            $_SESSION['agegroup'] = $agegroup;
            
            $query = "SELECT week_number, week FROM $agegroup where counter < $counter";

	$result10 = mysqli_query($connection, $query);
         
        if (!$result10) {

          die("Database query failed. $query");

        }
        
        ?>
      </tbody>
    </table>               
                    
				<div class="clear"></div> 
			</div>
		</article>
                
                		<article class="module width_week">
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
    }

    elseif ($row['Gender'] == 'female' && $Age <= '16' && $Age >= '12') {
            $agegroup = 'sr_girls';
            $counter = '6';
            $_SESSION['agegroup'] = $agegroup;
            
            $query = "SELECT week_number, week FROM $agegroup where counter < $counter";

	$result10 = mysqli_query($connection, $query);
         
        if (!$result10) {

          die("Database query failed. $query");

        }
        
        ?>
      </tbody>
    </table>               
                    
				<div class="clear"></div> 
			</div>
		</article>
                
     <article class="module width_week">
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
    }
    elseif($row['Gender'] == 'male' && $Age <= '16' && $Age >= '12' ) {
            $agegroup = 'sr_boys';
            $counter = '5';
            $_SESSION['agegroup'] = $agegroup;
         
    $query = "SELECT week_number, week FROM $agegroup where counter < $counter";

	$result10 = mysqli_query($connection, $query);
         
        if (!$result10) {

          die("Database query failed. $query");

        }
        ?>
      </tbody>
    </table>               
                    
				<div class="clear"></div> 
			</div>
		</article>           
                
     <article class="module width_week">
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
    }
        ?>
      </tbody>
    </table>               
                    
				<div class="clear"></div> 
			</div>
		</article>           
   <article class="module width_week">
                    <header><h3>
                           Choose a week from the drop down menu. 
                          </h3>
                        
                    </header>
       <form id="week" method="post" >  
       <input type='hidden' name='submit' id='submit' value='1'/>
           
              <div class="module_content" style="position: relative; top: 20 px; left: 0px;">              
                  <select name='week' >
   
<?php
      while ($row = mysqli_fetch_assoc($result10)) {
        echo "<option value=\"{$row['week']}\">";
        echo $row['week'];
        echo "</option>";
    }
    
?>
   
    
</select>
        
         
           <div style="position: relative; top: 10px;">
    <?php
    
               $q = "Select imageType, imagedata from week_photo where camper_id = '$id'";                 
               $q1 = "Select * from camper_info where camper_id = '$id'";

	$rslt = mysqli_query($connection, $q);
         
        if (!$rslt) {

          die("Database query failed. $q");

        }
        
        
        $rslt1 = mysqli_query($connection, $q1);
         
        if (!$rslt1) {

          die("Database query failed. $q1");

        }
        $r = mysqli_fetch_assoc( $rslt );
        $r1 = mysqli_fetch_assoc( $rslt1 );
              
             echo '<img src="data:image/jpg;base64,'.base64_encode( $r['imagedata'] ).'" width="275px"/>';
             echo "<br>";
             echo $r1['FirstName'] . " " . $r1['LastName'];
             echo "<br>";
            
          
          
          
          
        ?>   
               <input type='submit' name='Submit' value='submit' id='Submit'/>
               <style>
                   input[type=submit] {
                     padding:5px 15px; 
                     background:#ccc; 
                     border:0 none;
                     cursor:pointer;
                    -webkit-border-radius: 5px;
                    border-radius: 5px; 
                                       }
               </style>
            </div>                    
                                
                        </div>
       
       
       </form>    

   </article>
                    
                          
                
                <!-- end of stats article -->
		
		
                            
                            
                            
                            <!-- end of #tab2 -->    

		
	</section>

</body>

</html>