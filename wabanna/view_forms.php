<?PHP

require_once("./include/config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("home.html");
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

        $_SESSION['camper_id'] = htmlspecialchars($_GET["l_camper_id"]);

        $id = $_SESSION['camper_id'];

        $qry = "SELECT * FROM camper_info where camper_id = $id";

        $result = mysqli_query($connection, $qry);

        $row = mysqli_fetch_assoc($result);
        $cff = $row['consent_form_confirm'];
        $hff = $row['health_form_confirm'];
        $wpf = $row['health_form_confirm'];

        $_SESSION['Camper'] = trim($row['FirstName']) . "|" . trim($row['LastName']);

?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>View Forms</title>
	
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
                    <h1 class="site_title"><a href="edit_forms.php">Forms Viewer</a></h1>
			<h2 class="section_title">Enrollment Forms</h2>
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
		
		<h4 class="alert_info">Choose the form you want to view for camper&nbsp;<?PHP echo $row['FirstName']; echo " "; echo $row['LastName']?></h4>
		
		
                <article class="module width_weeks">
                    <header><h3>
                           Camper Information Form
                          </h3>
                        
                    </header>
                        
			<div class="module_content">
		    
                    
                   
                            <a href="view_camper_info.php"><img class='' src='images/form1.PNG' width='90%' height="600"  alt=''/></a>

                            
                    
				<div class="clear"></div> 
			</div>
		</article>
                
                		<article class="module width_weeks">
                    <header><h3>
                           Week Photo Form 
                          </h3>
                        
                    </header>
                        
			<div class="module_content">
		    
                    
                   
                            <a href="view_camper_week.php"><img class='' src='images/form2.PNG' width='90%' height="600" alt=''/></a>


                          
                    
				<div class="clear"></div> 
			</div>
		</article>
                
     <article class="module width_weeks">
                    <header><h3>
                           Health Form 
                          </h3>
                        
                    </header>
                        
			<div class="module_content">
		    
                    
                   

                            <a href="view_camper_health.php"><img class='' src='images/form3.PNG' width='90%' height="600" alt=''/></a>

                            
                    
				<div class="clear"></div> 
			</div>
		</article>           
                
     <article class="module width_weeks">
                    <header><h3>
                           Consent Form
                          </h3>
                        
                    </header>
                        
			<div class="module_content">
		    
                    
                   
                            <a href="view_camper_consent.php"><img class='' src='images/form4.PNG' width='90%' height="600" alt=''/></a> 


                            
                    
				<div class="clear"></div> 
			</div>
		</article>           
                
                
                
                <!-- end of stats article -->
		

		
		

		<div class="clear"></div>
		
				<div class="clear"></div>
			</div>
		</article><!-- end of stats article -->	
		
		
		
		
		<div class="spacer"></div>
	</section>


</body>

</html>
