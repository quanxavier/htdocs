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

           $name = explode("|", $_SESSION['Camper']);
           $Firstname = $name[0];
           $Lastname = $name[1];
           
           $id = $_SESSION['camper_id']; 

           $qry = "SELECT * FROM week_photo WHERE camper_id = '$id' "; 
           $result = mysqli_query($connection, $qry);
           $row = mysqli_fetch_assoc( $result ); 
           $week = $row['week'];
           $_SESSION['week'] = $week; 
            
       $qry = "SELECT * FROM camper_info left join parent_guardian_info on camper_info.camper_id = parent_guardian_info.camper_id where FirstName = '$Firstname' and LastName = '$Lastname'";
       $result = mysqli_query($connection, $qry);
         
        if (!$result) {
            
        }   
      $row = mysqli_fetch_assoc( $result ); 
      $_SESSION['camper_id'] = $row['camper_id'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns='http://www.w3.org/1999/xhtml'>
   <head >
       <h2><?php echo $fgmembersite->GetErrorMessage();?></h2>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title >Form Page: camp_week</title>
      <meta name='generator' content='Simfatic Forms 4.0.12.416'/>
      <script src='scripts/jquery-1.7.2.min.js' type='text/javascript'></script>
      <script src='scripts/jquery.sim.utils.js' type='text/javascript'></script>
      <script src='scripts/sfm_validatorv7.js' type='text/javascript'></script>
      <link rel='stylesheet' type='text/css' href='style/camp_week.css'/>


<style>
#myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
    margin: auto;
    display: block;
    max-height: 75%;
    max-width: 60%;
}

/* Caption of Modal Image */
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}

/* Add Animation */
.modal-content, #caption {    
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}

@keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}

/* The Close Button */
.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
}
</style>


   </head>
   <body id='sfm_camp_week_body'>

      <form id='camp_week' class='sfm_form' enctype='multipart/form-data' method='post' action='' accept-charset='UTF-8'>
         <div id='camp_week_errorloc' class='error_strings' style='width:1487px;text-align:left'></div>
         <div id='camp_week_outer_div' class='form_outer_div' style='width:1487px;height:906px'>
            <div style='position:relative' id='camp_week_inner_div'>
               <input type='hidden' name='submitted' id='submitted' value='1'/>
               <div id='heading_container' class='form_subheading'>
                  <h2 id='heading' class='form_subheading'>Camp Weeks<br /><font color="red"><?PHP echo "($Firstname $Lastname)";?></font><br /></h2>
               </div>
               <div id='Image_container'>
                  <img class='sfm_image_in_form' src='images/CampWabannaLogo_sized.png' width='250' height='75' alt=''/>
               </div>
               <div id='Image1_container'>
                  <img class='sfm_image_in_form' src='images/photo1236 (1).jpg' width='147' height='91' alt=''/>
               </div>
               <div id='label4_container'>
                  <div id='label4'>Please select the desired week and upload a photo.<br />Note: All fields must be filled in order to process form.</div>
               </div>
               <div id='label_container' class='sfm_form_label'>
                  <label id='label' for='Week'>Week<br /></label>
               </div>
               <div id='label1_container' class='sfm_form_label'>
                  <label id='label1' for='Photo'>Photo</label>
               </div>
               

               <div id='Week_container'>
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
        $id = $_SESSION['camper_id'];
        $qry = "SELECT * FROM camper_info where camper_id = $id";
        $result = mysqli_query($connection, $qry);
        $row = mysqli_fetch_assoc($result);
        $Age = $row['Age'];
        $Gender = $row['Gender'];
        
        if($row['Gender'] == 'male' && $Age <= '16' && $Age >= '12' ) {
            $agegroup = 'sr_boys';
            $counter = '5';
            $_SESSION['agegroup'] = $agegroup;
        } elseif ($row['Gender'] == 'male' && $Age <= '11' && $Age >= '7') {
            $agegroup = 'jr_boys';
            $counter = '5';
            $_SESSION['agegroup'] = $agegroup;
        }elseif ($row['Gender'] == 'female' && $Age <= '11' && $Age >= '7') {
            $agegroup = 'jr_girls';
            $counter = '5';
            $_SESSION['agegroup'] = $agegroup;
        }elseif ($row['Gender'] == 'female' && $Age <= '16' && $Age >= '12') {
            $agegroup = 'sr_girls';
            $counter = '6';
            $_SESSION['agegroup'] = $agegroup;
        }else {
            header("Location: Age_Error.php");
        }
	$query = "SELECT week_number, week FROM $agegroup where counter < $counter";
	$query = "SELECT week FROM week_photo where camper_id = $id";

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
 
                  </select>
               </div>
               <div id='Photo_container'>
                   
                  
                <?php
                $id = $_SESSION['camper_id']; 
                $qry = "SELECT * FROM week_photo WHERE camper_id = '$id' "; 
                $result = mysqli_query($connection, $qry);
                $row = mysqli_fetch_assoc( $result ); 
                ?>
                   
                   <input type="hidden" name="MAX_FILE_SIZE" value="9999999999" />
                   <input type='file'  name='image' id='image' /> 
                   
               </div>
               <div id ='image_display'>

                  <?php echo '<img id="myImg" src="data:image/jpg;base64,'.base64_encode( $row['imagedata'] ).'" width="100%" ';?> <?php echo "alt=\"<h1><font color=red>$Firstname&nbsp;&nbsp;$Lastname</font></h1>\"/>" ?>

<!-- The Modal -->
<div id="myModal" class="modal">
  <span class="close">×</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>

<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    modalImg.alt = this.alt;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}
</script>




               </div>
               <div id='box_element'></div>
               <div id='label2_container'>
                  <div id='label2'>Please Review and accept below</div>
               </div>
               <div id='label3_container'>
                  <div id='label3'>-Campers are not allowed to bring alcohol, cigarettes, drugs, weapons, fireworks, cell phones, or electronic devices (except cameras). Camp Wabanna reserves the right to search any campers belongings and confiscate these items.<br />~All medications brought by the camper (prescription or over-the-counter) must be given to the camp nurse or appointed staff member at the time of check in. The camp nurse station stocks the most common medicines such as Tylenol and cold remedies, so it is unnecessary to bring them. All medications must be in the original container and include a Camp Wabanna medication card which includes clear and current directions.<br />~ I understand that it is the policy of Camp Wabanna not to release a camper to anyone other than the person designated at the beginning of camp. I recognize that certain hazards and dangers are inherent in camp events and programs. And particularly but not limited to, swimming, boating, field activities, ropes courses, team courses, tower climbing, water tubing, canoeing. I understand that adventure activities may expose my child to psychologically and physically stressful and challenging situations.<br />~I understand, too, that although the program has taken precautions to provide proper organization, supervision, instruction, and equipment for each activity, it is impossible for the program to guarantee absolute safety. I understand that my child shares responsibility for his/her safety and I have instructed my child in the importance of knowing and abiding by the camp rules, regulations, and procedures for his/ her safety of camp participants. Camp Wabanna reserves the right to discipline or send home any child for any reason in its sole discretion. General reasons for immediate dismissal include, but are not limited to any of the following: if a health situation puts another individual in jeopardy, if the camper needs special health attention, if a child has a temperature above 101 degrees, pink eye, ring worm, lice, strep throat, or any infectious situation; or if a child is defiant, uncooperative, and will not or cannot participate in the normal program. Campers sent home due to behavioral problems are not allowed to return. Campers sent home due to medical reasons can only return to camp with a doctor’s release and must be able to participate in the normal camp program. No refund will be given if a child is sent home for either behavioral or medical reasons.<br />~ If a departure need arises, parents/guardians or emergency contacts will be notified. Upon notification, the parent/guardian will be allowed a maximum time of four hours to remove their child from camp property.<br />~In signing this document, I hereby certify that the above information is correct, and I give permission for the use of photographs, or other media, including my son or daughter to be used in camp publicity.</div>
               </div>
               <div class='element_label' id='i_agree_container'><input type='checkbox' name='i_agree' id='i_agree' value='on'/><label for='i_agree' class='element_label' id='i_agree_label'>I HAVE READ ALL THE AFOREMENTIONED INFORMATION AND I AGREE TO COOPERATE AND ADHERE TO THESE GUIDELINES. TO THE BEST OF MY KNOWLEDGE, THE INFORMATION GIVEN ON THESE PAGES IS COMPLETE AND ACCURATE.</label></div>
            </div>
         </div>
<div class='sfm_cr_box' style='padding:3px; width:350px;cursor:default'>Form powered by: easy web form builder <a style='text-decoration:none;' href='http://www.simfatic.com'>Simfatic Forms</a></div>
      </form>
      <script type='text/javascript'>
// <![CDATA[
$(function()
{
   sfm_show_loading_on_formsubmit('camp_week','Continue');
});

// ]]>
      </script>
      <script type='text/javascript'>
// <![CDATA[
var camp_weekValidator = new Validator("camp_week");
camp_weekValidator.addValidation("Week",{dontselect:"000",message:"Please select an option for Week"} );
camp_weekValidator.addValidation("Photo",{file_extn:"jpg;gif;bmp;png;tiff",message:"Allowed files types are: jpg;gif;bmp;png;tiff"} );
camp_weekValidator.addValidation("Photo",{req_file:true,message:"File upload is required for Photo"} );
camp_weekValidator.addValidation("i_agree",{selmin:"1",message:"Can't proceed as you do not agree to the terms & conditions"} );

// ]]>
      </script>
       
       
   </body>
</html>
