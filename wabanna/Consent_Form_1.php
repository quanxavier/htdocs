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
            
            $qry = "SELECT * FROM camper_info where camper_id = '$id'";
            $result = mysqli_query($connection, $qry);
         
        if (!$result) {
            
        }   
            $row = mysqli_fetch_assoc($result); 
            
            $qry = "SELECT * FROM parent_guardian_info where camper_id = '$id'";
            $result = mysqli_query($connection, $qry);
         
        if (!$result) {
            
        }   
            $row1 = mysqli_fetch_assoc($result); 
            
           $qry = "SELECT * FROM consent_form where camper_id = '$id'";
            $result = mysqli_query($connection, $qry);
         
        if (!$result) {
            
        }   
            $row2 = mysqli_fetch_assoc($result);   


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns='http://www.w3.org/1999/xhtml'>
   <head >
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title >Form Page: Consent_Form</title>
      <meta name='generator' content='Simfatic Forms 4.0.12.416'/>
      <script src='scripts/jquery-1.7.2.min.js' type='text/javascript'></script>
      <script src='scripts/jquery.sim.utils.js' type='text/javascript'></script>
      <script src='scripts/sfm_validatorv7.js' type='text/javascript'></script>
      <link rel='stylesheet' type='text/css' href='style/Consent_Form.css'/>
   </head>
   <body id='sfm_Consent_Form_body'>
      <form id='Consent_Form' class='sfm_form' method='post' action='' accept-charset='UTF-8'>
         <div id='Consent_Form_errorloc' class='error_strings' style='width:1000px;text-align:left'></div>
         <div id='Consent_Form_outer_div' class='form_outer_div' style='width:1000px;height:1201px'>
            <div style='position:relative' id='Consent_Form_inner_div'>
               <input type='hidden' name='submitted' id='submitted' value='1'/>
               <div id='Image1_container'>
                  <img class='sfm_image_in_form' src='images/CampWabannaLogo_sized.png' width='270' height='81' alt=''/>
               </div>
               <div id='label_container'>
                  <div id='label'>Please read the consent form and agree to the terms and conditions. <br />Note: Don't forget to fill in your Health Insurance information</div>
               </div>
               <div id='Image_container'>
                  <img class='sfm_image_in_form' src='images/photo1236 (1).jpg' width='190' height='119' alt=''/>
               </div>
               <div id='Textbox_container'>
                   <input type='text' name='Textbox' value ='<?php echo $row1['first_name_f'] . " " . $row1['last_name_f'] . " " . "and"  . " " . $row1['first_name_m'] . " " . $row1['last_name_m']?>' readonly id='Textbox' size='20' class='sfm_textbox'/>
               </div>
               <div id='label2_container' class='sfm_form_label'>
                  <label id='label2'>Company</label>
               </div>
               <div id='label3_container' class='sfm_form_label'>
                  <label id='label3'>Policy Number</label>
               </div>
               <div id='Insurance_Company_container'>
                  <input type='text' name='Insurance_Company'value ='<?php echo $row2['Insurance_Company']?>' id='Insurance_Company' size='20' class='sfm_textbox'/>
               </div>
               <div id='Policy_Number_container'>
                  <input type='text' name='Policy_Number' value ='<?php echo $row2['Policy_Number']?>'id='Policy_Number' size='20' class='sfm_textbox'/>
               </div>
               <div id='Textbox3_container'>
                   <input type='text' name='Textbox3'value ='<?php echo $row['FirstName'] . " " . $row['LastName']?>' readonly id='Textbox3' size='20' class='sfm_textbox'/>
               </div>
               <div class='element_label' id='i_agree_container'><input type='checkbox' name='i_agree' id='i_agree' value='on'/><label for='i_agree' class='element_label' id='i_agree_label'>I Agree to the Terms and Conditions</label></div>
               <div id='Submit_container' class='loading_div'>
                  <input type='submit' name='Continue' value='Continue' id='Continue'/>
               </div>
<?php
               if(isset($_POST['submitted']))
{
   if(!$fgmembersite->Update_Consent_Form())
   {
      
   }
  
}

  
?>
               <div id='label1_container'>
                  <div id='label1'>WHEREAS, certain circumstances and situations may occur resulting in my child's need for medical/dental care and treatment, and further resulting in my inability to give personal consent for such care and treatment,<br /><br />THEREFORE,<br /><br />1.  In consideration of permission for my child to participate in said camp program, I, <br />being of legal age, authorize Camp Wabanna or any agent of Wabanna Bible Conference, Inc. to act in my child's behalf should I be unable to do so and to consent to reasonable medical/dental care and treatment, including but not limited to diagnostic tests, x-ray examination, anesthesia, surgery, or any other procedures which may be deemed necessary for my child's medical well-being for the duration of the camp stay.<br /><br />2.  I recognize that this consent is given in advance of any specific diagnosis, treatment, surgery, hospital care, or any other procedure required, but is necessary to provide authorization and specific consent for medical/dental treatment and care in my child's behalf due to the nature and destination of the program.<br /><br />3.  Any consent by Camp Wabanna, or any agent of Wabanna Bible Conference, Inc., shall have the same force and effect as if I had personally signed the consent.<br /><br />4.  I certify that I have personal health insurance with:<br /><br />with no territorial limitations, which will provide coverage for my child during the duration of said program.  I understand that no health plan is provided through Camp<br /><br />Wabanna, and any expenses resulting from medical treatment of<br /><br />are my sole responsibility.  Should Camp Wabanna incur any expenses for the medical treatment of my child, I shall reimburse Camp Wabanna within 30 days of receiving the bill from Camp Wabanna.<br /><br /><br />5.  I am aware that serious illness requiring transportation by ambulance can be quite costly and that coverage for this type of service is not covered by any health plan available through Camp Wabanna.  I agree that I am responsible for any expenses that may arise from my child's transportation by ambulance or other extraordinary means.<br /><br /><br />6.  I hereby release and hold harmless Wabanna Bible Conference, Inc. and their officers, and employees from all liability for bodily personal injury, arising as a result of medical/dental treatment given pursuant to this prior consent.<br /><br /> 7.  By signing below, I acknowledge and accept the risks of physical injury associated with participation in the camp program and field trips.  Except for gross negligence on the part of the camp, I accept personal financial responsibility for any bodily or personal injury sustained during the camp program or field trips.  Further, I promise to release and hold harmless Wabanna Bible Conference, Inc. and its representatives for any injury related to the activity. I recognize that certain hazards and dangers are inherent in camp events and programs. And particularly but not limited to, swimming, boating, field activities, ropes courses, team courses, tower climbing, water tubing, canoeing. I understand that adventure activities may expose my child to psychologically and physically stressful and challenging situations. I understand, too, that although the program has taken precautions to provide proper organization, supervision, instruction, and equipment for each activity, it is impossible for the program to guarantee absolute safety. I understand that my child shares responsibility for his/her safety and I have instructed my child in the importance of knowing and abiding by the camp rules, regulations, and procedures for his/ her  safety of camp participant.<br /><br /> 8. By signing below, I acknowledge and accept that Camp Wabanna reserves the right to discipline or send home any child for any reason in its sole discretion. General reasons for immediate dismissal include, but are not limited to any of the following: or if a child is defiant, uncooperative, and will not or cannot participate in the normal program. Campers sent home due to behavioral problems are not allowed to return. No refund will be given if a child is sent home for behavioral reasons. If a departure need arises, parents/guardians or emergency contacts will be notified.  Upon notification, the parent/guardian will be allowed a maximum time of four hours to remove their child from camp property.<br />9. By signing below, I acknowledge and accept that Camp Wabanna reserves the right to send home any child if a health situation puts another individual in jeopardy, if the camper needs special health attention, if a child has a temperature above 101 degrees, pink eye, ring worm, lice, strep throat, or any infectious situation; Campers sent home due to medical reasons can only return to camp with a doctor’s release and must be able to participate in the normal camp program. No refund will be given if a child is sent home for medical reasons. If a departure need arises, parents/guardians or emergency contacts will be notified.  Upon notification, the parent/guardian will be allowed a maximum time of four hours to remove their child from camp property. <br /><br />10. By signing below, I acknowledge and accept Camp Wabanna’s cancellation policy. That cancellation for any reason before June 1st forfeits $150. There are no refunds for cancellation for any reason after June 1st. <br /><br />11. By signing below, I acknowledge and give permission for the use of photographs, or other media, including my son or daughter to be used in camp publicity. <br /><br />If a dispute over this agreement or any claim for damages arises, I agree to resolve the matter through a mutually acceptable arbitration process. <br /><br />I HAVE READ ALL THE AFOREMENTIONED INFORMATION AND I AGREE TO COOPERATE AND ADHERE TO THESE GUIDELINES.  TO THE BEST OF MY KNOWLEDGE, THE INFORMATION GIVEN ON THESE TWO PAGES IS COMPLETE AND ACCURATE. <br /></div>
               </div>
            </div>
         </div>
<div class='sfm_cr_box' style='padding:3px; width:350px;cursor:default'>Online form built with <a style='text-decoration:none;' href='http://www.simfatic.com'>Simfatic Forms - database form builder</a>.</div>
      </form>
      <script type='text/javascript'>
// <![CDATA[
$(function(){
   sfm_show_loading_on_formsubmit('Consent_Form','Submit');
});

 ]]>
      </script>
      <script type='text/javascript'>
// <![CDATA[
var Consent_FormValidator = new Validator("Consent_Form");
Consent_FormValidator.addValidation("Insurance_Company",{required:true,message:"Please fill in Insurance_Company"} );
Consent_FormValidator.addValidation("Policy_Number",{required:true,message:"Please fill in Policy_Number"} );
Consent_FormValidator.addValidation("i_agree",{selmin:"1",message:"Can't proceed as you do not agree to the terms & conditions"} );

// ]]>
      </script>
   </body>
</html>

