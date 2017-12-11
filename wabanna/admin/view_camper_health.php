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
           
       $qry = "SELECT * FROM camper_info left join health_form on camper_info.camper_id = health_form.camper_id where FirstName = '$Firstname' and LastName = '$Lastname'";
       $result = mysqli_query($connection, $qry);
         
        if (!$result) {
            
        }   
      $row = mysqli_fetch_assoc( $result ); 
      $_SESSION['camper_id'] = $row['camper_id'];
      
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns='http://www.w3.org/1999/xhtml'>
   <head >
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title >Form Page: Camp_Health_Form</title>
      <meta name='generator' content='Simfatic Forms 4.0.12.416'/>
      <script src='scripts/jquery-1.7.2.min.js' type='text/javascript'></script>
      <script src='scripts/jquery-ui-1.8.18.custom.min.js' type='text/javascript'></script>
      <script src='scripts/globalize.js' type='text/javascript'></script>
      <script src='scripts/jquery-ui-1.8.21.custom.date.min.js' type='text/javascript'></script>
      <script src='scripts/moment.js' type='text/javascript'></script>
      <script src='scripts/sfm_calendar.js' type='text/javascript'></script>
      <script src='scripts/jquery.sim.utils.js' type='text/javascript'></script>
      <script src='scripts/sfm_validatorv7.js' type='text/javascript'></script>
      <link rel='stylesheet' type='text/css' href='style/jquery-ui-1.8.16.css'/>
      <link rel='stylesheet' type='text/css' href='style/Camp_Health_Form.css'/>
   </head>
   <body id='sfm_Camp_Health_Form_body'>
       <form id='Camp_Health_Form' class='sfm_form' enctype='multipart/form-data' method='post' action='' accept-charset='UTF-8'>
         <div id='Camp_Health_Form_errorloc' class='error_strings' style='width:1400px;text-align:left'></div>
         <div id='Camp_Health_Form_outer_div' class='form_outer_div' style='width:1400px;height:2736px'>
            <div style='position:relative' id='Camp_Health_Form_inner_div'>
               <input type='hidden' name='submitted' id='submitted' value='1'/>
               <div id='label_container'>
                  <div id='label'>Health Consent Form<br /><font color="red"><?PHP echo "($Firstname $Lastname)";?></font><br /></div>
               </div>
               <div id='Image_container'>
                  <img class='sfm_image_in_form' src='images/CampWabannaLogo_sized-2.png' width='261' height='78' alt=''/>
               </div>
               <div id='Image1_container'>
                  <img class='sfm_image_in_form' src='images/photo1236 (1)-2.jpg' width='191' height='120' alt=''/>
               </div>
               <div id='box_element'></div>
               <div id='label1_container'>
                  <div id='label1'>Additional Contact information in event Parent(s)/Guardian(s) cannot be reached<br /></div>
               </div>
               <div id='label2_container' class='sfm_form_label'>
                  <label id='label2' for='FirstName_e_contact'>First Name</label>
               </div>
               <div id='label3_container' class='sfm_form_label'>
                  <label id='label3' for='LastName_e_contact'>Last Name</label>
               </div>
               <div id='label4_container' class='sfm_form_label'>
                  <label id='label4' for='Relationship'>Relationship to Camper</label>
               </div>
               <div id='label5_container' class='sfm_form_label'>
                  <label id='label5' for='Phone_e_contact'>Phone</label>
               </div>
               <div id='label6_container' class='sfm_form_label'>
                  <label id='label6' for='Doctor'>Health-Care Providers: Name of Primary Doctor</label>
               </div>
               <div id='label7_container' class='sfm_form_label'>
                  <label id='label7' for='Phone_Doctor'>Phone</label>
               </div>
               <div id='box_element1'></div>
               <div class='element_label' id='allergy_food_yes_no_0_container'><input type='radio' name='allergy_food_yes_no' id='allergy_food_yes_no_radio_0' value='yes'<?php echo ($row['allergy_food_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?>/><label for='allergy_food_yes_no_radio_0' class='element_label' id='allergy_food_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='allergy_food_yes_no_1_container'><input type='radio' name='allergy_food_yes_no' id='allergy_food_yes_no_radio_1' value='no'<?php echo ($row['allergy_food_yes_no'] == 'no') ? 'checked="checked"' : ''; ?> tabindex='1'/><label for='allergy_food_yes_no_radio_1' class='element_label' id='allergy_food_yes_no_radio_1_label'>No</label></div>
               <div id='label57_container' class='sfm_form_label'>
                  <label id='label57'>Is Camper allergic to Food?</label>
               </div>
               <div id='label58_container'>
                  <div id='label58'>Allergies</div>
               </div>
               <div class='element_label' id='allergy_medicine_yes_no_0_container'><input type='radio' name='allergy_medicine_yes_no' id='allergy_medicine_yes_no_radio_0' value='yes'<?php echo ($row['allergy_medicine_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?>/><label for='allergy_medicine_yes_no_radio_0' class='element_label' id='allergy_medicine_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='allergy_medicine_yes_no_1_container'><input type='radio' name='allergy_medicine_yes_no' id='allergy_medicine_yes_no_radio_1' value='no'<?php echo ($row['allergy_medicine_yes_no'] == 'no') ? 'checked="checked"' : ''; ?> tabindex='1'/><label for='allergy_medicine_yes_no_radio_1' class='element_label' id='allergy_medicine_yes_no_radio_1_label'>No</label></div>
               <div id='label59_container' class='sfm_form_label'>
                  <label id='label59'>Is Camper allergic to Medicine?</label>
               </div>
               <div class='element_label' id='allergy_environment_yes_no_0_container'><input type='radio' name='allergy_environment_yes_no' id='allergy_environment_yes_no_radio_0' value='yes'<?php echo ($row['allergy_environment_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?>/><label for='allergy_environment_yes_no_radio_0' class='element_label' id='allergy_environment_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='allergy_environment_yes_no_1_container'><input type='radio' name='allergy_environment_yes_no' id='allergy_environment_yes_no_radio_1' value='no'<?php echo ($row['allergy_environment_yes_no'] == 'no') ? 'checked="checked"' : ''; ?> tabindex='1'/><label for='allergy_environment_yes_no_radio_1' class='element_label' id='allergy_environment_yes_no_radio_1_label'>No</label></div>
               <div id='label60_container' class='sfm_form_label'>
                  <label id='label60'>Is Camper allergic to the envioronment (insect stings, hay  fever, etc)?<br /></label>
               </div>
               <div class='element_label' id='allergy_other_yes_no_0_container'><input type='radio' name='allergy_other_yes_no' id='allergy_other_yes_no_radio_0' value='no'<?php echo ($row['allergy_other_yes_no'] == 'no') ? 'checked="checked"' : ''; ?>/><label for='allergy_other_yes_no_radio_0' class='element_label' id='allergy_other_yes_no_radio_0_label'>No</label></div>
               <div class='element_label' id='allergy_other_yes_no_1_container'><input type='radio' name='allergy_other_yes_no' id='allergy_other_yes_no_radio_1' value='yes'<?php echo ($row['allergy_other_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?> tabindex='1'/><label for='allergy_other_yes_no_radio_1' class='element_label' id='allergy_other_yes_no_radio_1_label'>Yes</label></div>
               <div id='label61_container' class='sfm_form_label'>
                  <label id='label61'>Does the camper have other allergies?<br /></label>
               </div>
               <div id='label62_container' class='sfm_form_label'>
                  <label id='label62'>Please describe what the camper is allergic to andthe reaction seen.</label>
               </div>
               <div id='comments_allergies_container'><textarea name='comments_allergies' id='comments_allergies' cols='50' rows='8' class='sfm_textarea'><?php echo $row['comments_allergies']?></textarea></div>
               <div id='box_element2'></div>
               <div id='label10_container'>
                  <div id='label10'>Immunization History:</div>
               </div>
               <div id='label12_container'>
                  <div id='label12'>Provide the date for each immunization. Starred (*) immunizations must be current. Copies of immunization forms from health-care providers or state or local government are acceptable. You may upload that information here.</div>
               </div>
               
               <div id='label13_container' class='sfm_form_label'>
                  <label id='label13' for='IMUN_1'>Diptheria, tetanus, pertussis*<br />(DTaP) or (TdaP)<br /></label>
               </div>
               <div id='label14_container' class='sfm_form_label'>
                  <label id='label14' for='IMUN_2'>Tetanus booster*<br />(dT) or (TdaP)<br /></label>
               </div>
               <div id='label15_container' class='sfm_form_label'>
                  <label id='label15' for='IMUN_3'>Mumps, measles, rubella*<br />(MMR)<br /></label>
               </div>
               <div id='label16_container' class='sfm_form_label'>
                  <label id='label16' for='IMUN_4'>Mumps, measles, rubella*<br />(MMR)<br /></label>
               </div>
               <div id='label20_container' class='sfm_form_label'>
                  <label id='label20' for='IMUN_8'>Hepatitis B<br />.<br /></label>
               </div>
               <div id='label17_container' class='sfm_form_label'>
                  <label id='label17' for='IMUN_5'>Polio*<br />(IPV)<br /></label>
               </div>
               <div id='label18_container' class='sfm_form_label'>
                  <label id='label18' for='IMUN_6'>Haemophilus influenzae type B<br />(HIB)<br /></label>
               </div>
               <div id='label19_container' class='sfm_form_label'>
                  <label id='label19' for='IMUN_7'>Pneumococcal<br />(PCV)<br /></label>
               </div>
               <div id='label24_container' class='sfm_form_label'>
                  <label id='label24' for='IMUN_12'>TB Test</label>
               </div>
               <div id='label22_container' class='sfm_form_label'>
                  <label id='label22' for='IMUN_10'>Varicella Had chicken pox<br />(chicken pox)<br /></label>
               </div>
               <div id='label21_container' class='sfm_form_label'>
                  <label id='label21' for='IMUN_9'>Hepatitis A</label>
               </div>
               <div id='label23_container' class='sfm_form_label'>
                  <label id='label23'>Meningococcal meningitis<br />(MCV4)<br /></label>
               </div>
               <div class='element_label' id='Immun_yes_no_0_container'><input type='radio' name='Immun_yes_no' id='Immun_yes_no_radio_0' value='yes'<?php echo ($row['Immun_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?>/><label for='Immun_yes_no_radio_0' class='element_label' id='Immun_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='Immun_yes_no_1_container'><input type='radio' name='Immun_yes_no' id='Immun_yes_no_radio_1' value='no' <?php echo ($row['Immun_yes_no'] == 'no') ? 'checked="checked"' : ''; ?>tabindex='1'/><label for='Immun_yes_no_radio_1' class='element_label' id='Immun_yes_no_radio_1_label'>No</label></div>
               <div id='label25_container' class='sfm_form_label'>
                  <label id='label25'>Has your Camper been fully immunized? Note: If you check no, you understand and accept the risk to your child.</label>
               </div>
               <div id='box_element3'></div>
               <div id='label27_container' class='sfm_form_label'>
                  <label id='label27'>Medication<br /></label>
               </div>
               <div class='element_label' id='Meds_at_camp_true_false_0_container'><input type='radio' name='Meds_at_camp_true_false' id='Meds_at_camp_true_false_radio_0' value='true'<?php echo ($row['Meds_at_camp_true_false'] == 'true') ? 'checked="checked"' : ''; ?>/><label for='Meds_at_camp_true_false_radio_0' class='element_label' id='Meds_at_camp_true_false_radio_0_label'>This camper will take the following daily medications while at camp</label></div>
               <div class='element_label' id='Meds_at_camp_true_false_1_container'><input type='radio' name='Meds_at_camp_true_false' id='Meds_at_camp_true_false_radio_1' value='false'<?php echo ($row['Meds_at_camp_true_false'] == 'false') ? 'checked="checked"' : ''; ?> tabindex='1'/><label for='Meds_at_camp_true_false_radio_1' class='element_label' id='Meds_at_camp_true_false_radio_1_label'>This camper will not take any daily medications while attending camp.</label></div>
               <div id='label26_container'>
                  <div id='label26'>"Medication" is any substance a person takes to maintain and/or improve their health. This includes vitamins & natural remedies. Please review camp instructions about required packaging/containers. Maryland requires original pharmacy containers with labels which show the camper’s name and how the medication should be given. Provide enough of each medication to last the entire time the camper will be at camp.</div>
               </div>
               <div id='label28_container'>
                  <div id='label28'>Name of Medication<br /></div>
               </div>
               <div id='label29_container'>
                  <div id='label29'>Date Started</div>
               </div>
               <div id='label33_container'>
                  <div id='label33'>Reason for taking</div>
               </div>
               <div id='label34_container'>
                  <div id='label34'>When is it given? Example: Bedtime</div>
               </div>
               <div id='label36_container'>
                  <div id='label36'>How is it given</div>
               </div>
               <div id='label35_container'>
                  <div id='label35'>Amount or doses given</div>
               </div>
               <div class='sfm_element_container' id='med_date_1_container'>
                  <input type='text' name='med_date_1'value='<?php echo $row['med_date_1']?>' id='med_date_1'/>
                  <input type='text' name='sfm_med_date_1_parsed' id='sfm_med_date_1_parsed' tabindex='-1' style='display:none'/>
                  <div id='med_date_1_image_container'>
                     <img id='med_date_1_image' class='sfm_datepicker_icon' src='images/date-picker.gif' width='20' height='20' alt='Click here to open the date picker'/>
                  </div>
               </div>
               <div id='med_name_1_container'><textarea name='med_name_1' id='med_name_1' class='sfm_textarea'><?php echo $row['med_name_1']?></textarea></div>
               <div id='label30_container'>
                  <div id='label30'></div>
               </div>
               <div id='med_reason_1_container'><textarea name='med_reason_1' id='med_reason_1' class='sfm_textarea'><?php echo $row['med_reason_1']?></textarea></div>
               <div id='med_time_1_container'><textarea name='med_time_1' id='med_time_1' class='sfm_textarea'><?php echo $row['med_time_1']?></textarea></div>
               <div id='med_amount_1_container'><textarea name='med_amount_1' id='med_amount_1' class='sfm_textarea'><?php echo $row['med_amount_1']?></textarea></div>
               <div id='med_how_1_container'><textarea name='med_how_1' id='med_how_1' class='sfm_textarea'><?php echo $row['med_how_1']?></textarea></div>
               <div class='sfm_element_container' id='med_date_2_container'>
                  <input type='text' name='med_date_2'value='<?php echo $row['med_date_2']?>' id='med_date_2'/>
                  <input type='text' name='sfm_med_date_2_parsed' id='sfm_med_date_2_parsed' tabindex='-1' style='display:none'/>
                  <div id='med_date_2_image_container'>
                     <img id='med_date_2_image' class='sfm_datepicker_icon' src='images/date-picker.gif' width='20' height='20' alt='Click here to open the date picker'/>
                  </div>
               </div>
               <div id='med_name_2_container'><textarea name='med_name_2' id='med_name_2' class='sfm_textarea'><?php echo $row['med_name_2']?></textarea></div>
               <div id='label31_container'>
                  <div id='label31'></div>
               </div>
               <div id='med_reason_2_container'><textarea name='med_reason_2' id='med_reason_2' class='sfm_textarea'><?php echo $row['med_reason_2']?></textarea></div>
               <div id='med_time_2_container'><textarea name='med_time_2' id='med_time_2' class='sfm_textarea'><?php echo $row['med_time_2']?></textarea></div>
               <div id='med_amount_2_container'><textarea name='med_amount_2' id='med_amount_2' class='sfm_textarea'><?php echo $row['med_amount_2']?></textarea></div>
               <div id='med_how_2_container'><textarea name='med_how_2' id='med_how_2' class='sfm_textarea'><?php echo $row['med_how_2']?></textarea></div>
               <div class='sfm_element_container' id='med_date_3_container'>
                  <input type='text' name='med_date_3'value='<?php echo $row['med_date_3']?>' id='med_date_3'/>
                  <input type='text' name='sfm_med_date_3_parsed' id='sfm_med_date_3_parsed' tabindex='-1' style='display:none'/>
                  <div id='med_date_3_image_container'>
                     <img id='med_date_3_image' class='sfm_datepicker_icon' src='images/date-picker.gif' width='20' height='20' alt='Click here to open the date picker'/>
                  </div>
               </div>
               <div id='med_name_3_container'><textarea name='med_name_3' id='med_name_3' class='sfm_textarea'><?php echo $row['med_name_3']?></textarea></div>
               <div id='label32_container'>
                  <div id='label32'></div>
               </div>
               <div id='med_reason_3_container'><textarea name='med_reason_3' id='med_reason_3' class='sfm_textarea'><?php echo $row['med_reason_3']?></textarea></div>
               <div id='med_time_3_container'><textarea name='med_time_3' id='med_time_3' class='sfm_textarea'><?php echo $row['med_time_3']?></textarea></div>
               <div id='med_amount_3_container'><textarea name='med_amount_3' id='med_amount_3' class='sfm_textarea'><?php echo $row['med_amount_3']?></textarea></div>
               <div id='med_how_3_container'><textarea name='med_how_3' id='med_how_3' class='sfm_textarea'><?php echo $row['med_how_3']?></textarea></div>
               <div id='label37_container'>
                  <div id='label37'>The following non-prescription medications may be stocked in the camp Health Center and are used on an as needed basis to manage illness and injury. Answer "Yes" or "No" to the following.</div>
               </div>
               <div id='label63_container'>
                  <div id='label63'>Can the camper be given:</div>
               </div>
               <div class='element_label' id='Ibuprofen_yes_no_0_container'><input type='radio' name='Ibuprofen_yes_no' id='Ibuprofen_yes_no_radio_0' value='no'<?php echo ($row['Ibuprofen_yes_no'] == 'no') ? 'checked="checked"' : ''; ?>/><label for='Ibuprofen_yes_no_radio_0' class='element_label' id='Ibuprofen_yes_no_radio_0_label'>No</label></div>
               <div class='element_label' id='Ibuprofen_yes_no_1_container'><input type='radio' name='Ibuprofen_yes_no' id='Ibuprofen_yes_no_radio_1' value='yes'<?php echo ($row['Ibuprofen_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?> tabindex='1'/><label for='Ibuprofen_yes_no_radio_1' class='element_label' id='Ibuprofen_yes_no_radio_1_label'>Yes</label></div>
               <div class='element_label' id='Tylenol_yes_no_0_container'><input type='radio' name='Tylenol_yes_no' id='Tylenol_yes_no_radio_0' value='yes'<?php echo ($row['Tylenol_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?>/><label for='Tylenol_yes_no_radio_0' class='element_label' id='Tylenol_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='Tylenol_yes_no_1_container'><input type='radio' name='Tylenol_yes_no' id='Tylenol_yes_no_radio_1' value='no'<?php echo ($row['Tylenol_yes_no'] == 'no') ? 'checked="checked"' : ''; ?> tabindex='1'/><label for='Tylenol_yes_no_radio_1' class='element_label' id='Tylenol_yes_no_radio_1_label'>No</label></div>
               <div id='label71_container' class='sfm_form_label'>
                  <label id='label71'>Ibuprofen (Advil, Motrin)?</label>
               </div>
               <div id='label64_container' class='sfm_form_label'>
                  <label id='label64'>Acetaminophen (Tylenol)?</label>
               </div>
               <div class='element_label' id='Sudafed_PE_yes_no_0_container'><input type='radio' name='Sudafed_PE_yes_no' id='Sudafed_PE_yes_no_radio_0' value='no'<?php echo ($row['Sudafed_PE_yes_no'] == 'no') ? 'checked="checked"' : ''; ?>/><label for='Sudafed_PE_yes_no_radio_0' class='element_label' id='Sudafed_PE_yes_no_radio_0_label'>No</label></div>
               <div class='element_label' id='Sudafed_PE_yes_no_1_container'><input type='radio' name='Sudafed_PE_yes_no' id='Sudafed_PE_yes_no_radio_1' value='yes'<?php echo ($row['Sudafed_PE_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?> tabindex='1'/><label for='Sudafed_PE_yes_no_radio_1' class='element_label' id='Sudafed_PE_yes_no_radio_1_label'>Yes</label></div>
               <div class='element_label' id='Sudafed_yes_no_0_container'><input type='radio' name='Sudafed_yes_no' id='Sudafed_yes_no_radio_0' value='no'<?php echo ($row['Sudafed_yes_no'] == 'no') ? 'checked="checked"' : ''; ?>/><label for='Sudafed_yes_no_radio_0' class='element_label' id='Sudafed_yes_no_radio_0_label'>No</label></div>
               <div class='element_label' id='Sudafed_yes_no_1_container'><input type='radio' name='Sudafed_yes_no' id='Sudafed_yes_no_radio_1' value='yes'<?php echo ($row['Sudafed_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?> tabindex='1'/><label for='Sudafed_yes_no_radio_1' class='element_label' id='Sudafed_yes_no_radio_1_label'>Yes</label></div>
               <div id='label65_container' class='sfm_form_label'>
                  <label id='label65'>Phenylephrine decongestant (SudafedPE)?</label>
               </div>
               <div id='label72_container' class='sfm_form_label'>
                  <label id='label72'>Pseudoephedrine decongestant (Sudafed) ?</label>
               </div>
               <div class='element_label' id='allergy_med_yes_no_0_container'><input type='radio' name='allergy_med_yes_no' id='allergy_med_yes_no_radio_0' value='no'<?php echo ($row['allergy_med_yes_no'] == 'no') ? 'checked="checked"' : ''; ?>/><label for='allergy_med_yes_no_radio_0' class='element_label' id='allergy_med_yes_no_radio_0_label'>No</label></div>
               <div class='element_label' id='allergy_med_yes_no_1_container'><input type='radio' name='allergy_med_yes_no' id='allergy_med_yes_no_radio_1' value='yes'<?php echo ($row['allergy_med_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?> tabindex='1'/><label for='allergy_med_yes_no_radio_1' class='element_label' id='allergy_med_yes_no_radio_1_label'>Yes</label></div>
               <div class='element_label' id='Robitussin_yes_no_0_container'><input type='radio' name='Robitussin_yes_no' id='Robitussin_yes_no_radio_0' value='no'<?php echo ($row['Robitussin_yes_no'] == 'no') ? 'checked="checked"' : ''; ?>/><label for='Robitussin_yes_no_radio_0' class='element_label' id='Robitussin_yes_no_radio_0_label'>No</label></div>
               <div class='element_label' id='Robitussin_yes_no_1_container'><input type='radio' name='Robitussin_yes_no' id='Robitussin_yes_no_radio_1' value='yes'<?php echo ($row['Robitussin_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?> tabindex='1'/><label for='Robitussin_yes_no_radio_1' class='element_label' id='Robitussin_yes_no_radio_1_label'>Yes</label></div>
               <div id='label66_container' class='sfm_form_label'>
                  <label id='label66'>Antihistamine/allergy medicine ?</label>
               </div>
               <div id='label73_container' class='sfm_form_label'>
                  <label id='label73'>Guaifenesin cough syrup (Robitussin)  ?</label>
               </div>
               <div class='element_label' id='Benadryl_yes_no_0_container'><input type='radio' name='Benadryl_yes_no' id='Benadryl_yes_no_radio_0' value='no'<?php echo ($row['Benadryl_yes_no'] == 'no') ? 'checked="checked"' : ''; ?>/><label for='Benadryl_yes_no_radio_0' class='element_label' id='Benadryl_yes_no_radio_0_label'>No</label></div>
               <div class='element_label' id='Benadryl_yes_no_1_container'><input type='radio' name='Benadryl_yes_no' id='Benadryl_yes_no_radio_1' value='yes'<?php echo ($row['Benadryl_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?> tabindex='1'/><label for='Benadryl_yes_no_radio_1' class='element_label' id='Benadryl_yes_no_radio_1_label'>Yes</label></div>
               <div class='element_label' id='Rob_DM_yes_no_0_container'><input type='radio' name='Rob_DM_yes_no' id='Rob_DM_yes_no_radio_0' value='no'<?php echo ($row['Rob_DM_yes_no'] == 'no') ? 'checked="checked"' : ''; ?>/><label for='Rob_DM_yes_no_radio_0' class='element_label' id='Rob_DM_yes_no_radio_0_label'>No</label></div>
               <div class='element_label' id='Rob_DM_yes_no_1_container'><input type='radio' name='Rob_DM_yes_no' id='Rob_DM_yes_no_radio_1' value='yes'<?php echo ($row['Rob_DM_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?> tabindex='1'/><label for='Rob_DM_yes_no_radio_1' class='element_label' id='Rob_DM_yes_no_radio_1_label'>Yes</label></div>
               <div id='label67_container' class='sfm_form_label'>
                  <label id='label67'>Diphenhydramine antihistamine/allergy medicine (Benadryl) ?</label>
               </div>
               <div id='label74_container' class='sfm_form_label'>
                  <label id='label74'>Dextromethorphan cough syrup (Robitussin DM) ?</label>
               </div>
               <div class='element_label' id='Throat_spray_yes_no_0_container'><input type='radio' name='Throat_spray_yes_no' id='Throat_spray_yes_no_radio_0' value='no'<?php echo ($row['Throat_spray_yes_no'] == 'no') ? 'checked="checked"' : ''; ?>/><label for='Throat_spray_yes_no_radio_0' class='element_label' id='Throat_spray_yes_no_radio_0_label'>No</label></div>
               <div class='element_label' id='Throat_spray_yes_no_1_container'><input type='radio' name='Throat_spray_yes_no' id='Throat_spray_yes_no_radio_1' value='yes'<?php echo ($row['Throat_spray_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?> tabindex='1'/><label for='Throat_spray_yes_no_radio_1' class='element_label' id='Throat_spray_yes_no_radio_1_label'>Yes</label></div>
               <div class='element_label' id='cough_drops_yes_no_0_container'><input type='radio' name='cough_drops_yes_no' id='cough_drops_yes_no_radio_0' value='no'<?php echo ($row['cough_drops_yes_no'] == 'no') ? 'checked="checked"' : ''; ?>/><label for='cough_drops_yes_no_radio_0' class='element_label' id='cough_drops_yes_no_radio_0_label'>No</label></div>
               <div class='element_label' id='cough_drops_yes_no_1_container'><input type='radio' name='cough_drops_yes_no' id='cough_drops_yes_no_radio_1' value='yes'<?php echo ($row['cough_drops_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?> tabindex='1'/><label for='cough_drops_yes_no_radio_1' class='element_label' id='cough_drops_yes_no_radio_1_label'>Yes</label></div>
               <div id='label68_container' class='sfm_form_label'>
                  <label id='label68'>Sore throat spray?</label>
               </div>
               <div id='label75_container' class='sfm_form_label'>
                  <label id='label75'>Generic cough drops ?</label>
               </div>
               <div class='element_label' id='Calamine_yes_no_0_container'><input type='radio' name='Calamine_yes_no' id='Calamine_yes_no_radio_0' value='no'<?php echo ($row['Calamine_yes_no'] == 'no') ? 'checked="checked"' : ''; ?> /><label for='Calamine_yes_no_radio_0' class='element_label' id='Calamine_yes_no_radio_0_label'>No</label></div>
               <div class='element_label' id='Calamine_yes_no_1_container'><input type='radio' name='Calamine_yes_no' id='Calamine_yes_no_radio_1' value='yes'<?php echo ($row['Calamine_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?> tabindex='1'/><label for='Calamine_yes_no_radio_1' class='element_label' id='Calamine_yes_no_radio_1_label'>Yes</label></div>
               <div class='element_label' id='aloe_yes_no_0_container'><input type='radio' name='aloe_yes_no' id='aloe_yes_no_radio_0' value='no'<?php echo ($row['aloe_yes_no'] == 'no') ? 'checked="checked"' : ''; ?>/><label for='aloe_yes_no_radio_0' class='element_label' id='aloe_yes_no_radio_0_label'>No</label></div>
               <div class='element_label' id='aloe_yes_no_1_container'><input type='radio' name='aloe_yes_no' id='aloe_yes_no_radio_1' value='yes'<?php echo ($row['aloe_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?> tabindex='1'/><label for='aloe_yes_no_radio_1' class='element_label' id='aloe_yes_no_radio_1_label'>Yes</label></div>
               <div id='label69_container' class='sfm_form_label'>
                  <label id='label69'>Calamine lotion?</label>
               </div>
               <div id='label76_container' class='sfm_form_label'>
                  <label id='label76'>Aloe ?</label>
               </div>
               <div class='element_label' id='Laxatives_yes_no_0_container'><input type='radio' name='Laxatives_yes_no' id='Laxatives_yes_no_radio_0' value='no'<?php echo ($row['Laxatives_yes_no'] == 'no') ? 'checked="checked"' : ''; ?>/><label for='Laxatives_yes_no_radio_0' class='element_label' id='Laxatives_yes_no_radio_0_label'>No</label></div>
               <div class='element_label' id='Laxatives_yes_no_1_container'><input type='radio' name='Laxatives_yes_no' id='Laxatives_yes_no_radio_1' value='yes'<?php echo ($row['Laxatives_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?> tabindex='1'/><label for='Laxatives_yes_no_radio_1' class='element_label' id='Laxatives_yes_no_radio_1_label'>Yes</label></div>
               <div class='element_label' id='Pepto_yes_no_0_container'><input type='radio' name='Pepto_yes_no' id='Pepto_yes_no_radio_0' value='no'<?php echo ($row['Pepto_yes_no'] == 'no') ? 'checked="checked"' : ''; ?>/><label for='Pepto_yes_no_radio_0' class='element_label' id='Pepto_yes_no_radio_0_label'>No</label></div>
               <div class='element_label' id='Pepto_yes_no_1_container'><input type='radio' name='Pepto_yes_no' id='Pepto_yes_no_radio_1' value='yes'<?php echo ($row['Pepto_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?> tabindex='1'/><label for='Pepto_yes_no_radio_1' class='element_label' id='Pepto_yes_no_radio_1_label'>Yes</label></div>
               <div id='label70_container' class='sfm_form_label'>
                  <label id='label70'>Laxatives for constipation (Ex-Lax) ?</label>
               </div>
               <div id='label77_container' class='sfm_form_label'>
                  <label id='label77'>Bismuth subsalicylate for diarrhea (Kaopectate, Pepto-Bismol) ?</label>
               </div>
               <div id='box_element4'></div>
               <div id='label39_container'>
                  <div id='label39'>General Health History: Check "Yes" or "Nofor each statement. Explain "Yes" answers in the box provided.</div>
               </div>
               <div id='label40_container'>
                  <div id='label40'>Has/does the camper:</div>
               </div>
               <div id='label38_container' class='sfm_form_label'>
                  <label id='label38'>Passed out/had chest pain during exercise?</label>
               </div>
               <div class='element_label' id='passed_out_yes_no_0_container'><input type='radio' name='passed_out_yes_no' id='passed_out_yes_no_radio_0' value='yes'<?php echo ($row['passed_out_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?>/><label for='passed_out_yes_no_radio_0' class='element_label' id='passed_out_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='passed_out_yes_no_1_container'><input type='radio' name='passed_out_yes_no' id='passed_out_yes_no_radio_1' value='no'<?php echo ($row['passed_out_yes_no'] == 'no') ? 'checked="checked"' : ''; ?> tabindex='1'/><label for='passed_out_yes_no_radio_1' class='element_label' id='passed_out_yes_no_radio_1_label'>No</label></div>
               <div id='label45_container' class='sfm_form_label'>
                  <label id='label45'>Had seizures?</label>
               </div>
               <div class='element_label' id='seizures_yes_no_0_container'><input type='radio' name='seizures_yes_no' id='seizures_yes_no_radio_0' value='yes'<?php echo ($row['seizures_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?>/><label for='seizures_yes_no_radio_0' class='element_label' id='seizures_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='seizures_yes_no_1_container'><input type='radio' name='seizures_yes_no' id='seizures_yes_no_radio_1' value='no'<?php echo ($row['seizures_yes_no'] == 'no') ? 'checked="checked"' : ''; ?> tabindex='1'/><label for='seizures_yes_no_radio_1' class='element_label' id='seizures_yes_no_radio_1_label'>No</label></div>
               <div id='label41_container' class='sfm_form_label'>
                  <label id='label41'>Had a recent infectious disease?</label>
               </div>
               <div id='label46_container' class='sfm_form_label'>
                  <label id='label46'>Have any skin problems?</label>
               </div>
               <div class='element_label' id='skin_problems_yes_no_0_container'><input type='radio' name='skin_problems_yes_no' id='skin_problems_yes_no_radio_0' value='yes'<?php echo ($row['skin_problems_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?>/><label for='skin_problems_yes_no_radio_0' class='element_label' id='skin_problems_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='skin_problems_yes_no_1_container'><input type='radio' name='skin_problems_yes_no' id='skin_problems_yes_no_radio_1' value='no' <?php echo ($row['skin_problems_yes_no'] == 'no') ? 'checked="checked"' : ''; ?>tabindex='1'/><label for='skin_problems_yes_no_radio_1' class='eeizurlement_label' id='skin_problems_yes_no_radio_1_label'>No</label></div>
               <div class='element_label' id='recent_disease_yes_no_0_container'><input type='radio' name='recent_disease_yes_no' id='recent_disease_yes_no_radio_0' value='yes'<?php echo ($row['recent_disease_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?>/><label for='recent_disease_yes_no_radio_0' class='element_label' id='recent_disease_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='recent_disease_yes_no_1_container'><input type='radio' name='recent_disease_yes_no' id='recent_disease_yes_no_radio_1' value='no'<?php echo ($row['recent_disease_yes_no'] == 'no') ? 'checked="checked"' : ''; ?> tabindex='1'/><label for='recent_disease_yes_no_radio_1' class='element_label' id='recent_disease_yes_no_radio_1_label'>No</label></div>
               <div id='label42_container' class='sfm_form_label'>
                  <label id='label42'>Had a recent injury?</label>
               </div>
               <div class='element_label' id='recent_injury_yes_no_0_container'><input type='radio' name='recent_injury_yes_no' id='recent_injury_yes_no_radio_0' value='yes'<?php echo ($row['recent_injury_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?>/><label for='recent_injury_yes_no_radio_0' class='element_label' id='recent_injury_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='recent_injury_yes_no_1_container'><input type='radio' name='recent_injury_yes_no' id='recent_injury_yes_no_radio_1' value='no' <?php echo ($row['recent_injury_yes_no'] == 'no') ? 'checked="checked"' : ''; ?>tabindex='1'/><label for='recent_injury_yes_no_radio_1' class='element_label' id='recent_injury_yes_no_radio_1_label'>No</label></div>
               <div id='label47_container' class='sfm_form_label'>
                  <label id='label47'>Have problems with falling asleep/sleepwalking?</label>
               </div>
               <div class='element_label' id='sleep_problems_yes_no_0_container'><input type='radio' name='sleep_problems_yes_no' id='sleep_problems_yes_no_radio_0' value='no'<?php echo ($row['sleep_problems_yes_no'] == 'no') ? 'checked="checked"' : ''; ?>/><label for='sleep_problems_yes_no_radio_0' class='element_label' id='sleep_problems_yes_no_radio_0_label'>No</label></div>
               <div class='element_label' id='sleep_problems_yes_no_1_container'><input type='radio' name='sleep_problems_yes_no' id='sleep_problems_yes_no_radio_1' value='yes'<?php echo ($row['sleep_problems_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?> tabindex='1'/><label for='sleep_problems_yes_no_radio_1' class='element_label' id='sleep_problems_yes_no_radio_1_label'>Yes</label></div>
               <div id='label43_container' class='sfm_form_label'>
                  <label id='label43'>Had a asthma/wheezing/shortness of breath?</label>
               </div>
               <div class='element_label' id='breathing_problem_yes_no_0_container'><input type='radio' name='breathing_problem_yes_no' id='breathing_problem_yes_no_radio_0' value='yes'<?php echo ($row['breathing_problem_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?>/><label for='breathing_problem_yes_no_radio_0' class='element_label' id='breathing_problem_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='breathing_problem_yes_no_1_container'><input type='radio' name='breathing_problem_yes_no' id='breathing_problem_yes_no_radio_1' value='no' <?php echo ($row['breathing_problem_yes_no'] == 'no') ? 'checked="checked"' : ''; ?>tabindex='1'/><label for='breathing_problem_yes_no_radio_1' class='element_label' id='breathing_problem_yes_no_radio_1_label'>No</label></div>
               <div id='label48_container' class='sfm_form_label'>
                  <label id='label48'>Have problems with diarrhea/constipation?</label>
               </div>
               <div class='element_label' id='diarrhea_constipation_yes_no_0_container'><input type='radio' name='diarrhea_constipation_yes_no' id='diarrhea_constipation_yes_no_radio_0' value='no'<?php echo ($row['diarrhea_constipation_yes_no'] == 'no') ? 'checked="checked"' : ''; ?>/><label for='diarrhea_constipation_yes_no_radio_0' class='element_label' id='diarrhea_constipation_yes_no_radio_0_label'>No</label></div>
               <div class='element_label' id='diarrhea_constipation_yes_no_1_container'><input type='radio' name='diarrhea_constipation_yes_no' id='diarrhea_constipation_yes_no_radio_1' value='yes'<?php echo ($row['diarrhea_constipation_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?> tabindex='1'/><label for='diarrhea_constipation_yes_no_radio_1' class='element_label' id='diarrhea_constipation_yes_no_radio_1_label'>Yes</label></div>
               <div id='label44_container' class='sfm_form_label'>
                  <label id='label44'>Have diabetes?</label>
               </div>
               <div class='element_label' id='diabetes_yes_no_0_container'><input type='radio' name='diabetes_yes_no' id='diabetes_yes_no_radio_0' value='yes'<?php echo ($row['diabetes_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?>/><label for='diabetes_yes_no_radio_0' class='element_label' id='diabetes_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='diabetes_yes_no_1_container'><input type='radio' name='diabetes_yes_no' id='diabetes_yes_no_radio_1' value='no'<?php echo ($row['diabetes_yes_no'] == 'no') ? 'checked="checked"' : ''; ?> tabindex='1'/><label for='diabetes_yes_no_radio_1' class='element_label' id='diabetes_yes_no_radio_1_label'>No</label></div>
               <div id='label49_container' class='sfm_form_label'>
                  <label id='label49'>Wear glasses, contacts, or protective eyewear?</label>
               </div>
               <div class='element_label' id='glasses_yes_no_0_container'><input type='radio' name='glasses_yes_no' id='glasses_yes_no_radio_0' value='no'<?php echo ($row['glasses_yes_no'] == 'no') ? 'checked="checked"' : ''; ?>/><label for='glasses_yes_no_radio_0' class='element_label' id='glasses_yes_no_radio_0_label'>No</label></div>
               <div class='element_label' id='glasses_yes_no_1_container'><input type='radio' name='glasses_yes_no' id='glasses_yes_no_radio_1' value='yes'<?php echo ($row['glasses_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?> tabindex='1'/><label for='glasses_yes_no_radio_1' class='element_label' id='glasses_yes_no_radio_1_label'>Yes</label></div>
               <div id='label53_container'>
                  <div id='label53'>Please explain "Yes" answers in the space bleow.</div>
               </div>
               <div id='health_history_Yes_explain_container'><textarea name='health_history_Yes_explain' id='health_history_Yes_explain' cols='50' rows='8' class='sfm_textarea'><?php echo $row['health_history_Yes_explain']?></textarea></div>
               <div id='box_element5'></div>
               <div id='label50_container'>
                  <div id='label50'>Mental, Emotional, and Social Helath: Check "Yes" or "No" for each statement.</div>
               </div>
               <div id='label51_container'>
                  <div id='label51'>Has the camper:</div>
               </div>
               <div id='label52_container' class='sfm_form_label'>
                  <label id='label52'>Ever been treated for attention deficit disorder (ADD) or attention deficit/hyperactivity disorder (AD?HD)?</label>
               </div>
               <div class='element_label' id='ADD_ADHD_yes_no_0_container'><input type='radio' name='ADD_ADHD_yes_no' id='ADD_ADHD_yes_no_radio_0' value='no'<?php echo ($row['ADD_ADHD_yes_no'] == 'no') ? 'checked="checked"' : ''; ?>/><label for='ADD_ADHD_yes_no_radio_0' class='element_label' id='ADD_ADHD_yes_no_radio_0_label'>No</label></div>
               <div class='element_label' id='ADD_ADHD_yes_no_1_container'><input type='radio' name='ADD_ADHD_yes_no' id='ADD_ADHD_yes_no_radio_1' value='yes'<?php echo ($row['ADD_ADHD_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?> tabindex='1'/><label for='ADD_ADHD_yes_no_radio_1' class='element_label' id='ADD_ADHD_yes_no_radio_1_label'>Yes</label></div>
               <div id='label54_container' class='sfm_form_label'>
                  <label id='label54'>Ever been treated for emotional or behavioral difficulties or an eating disorder?</label>
               </div>
               <div class='element_label' id='emotional_yes_no_0_container'><input type='radio' name='emotional_yes_no' id='emotional_yes_no_radio_0' value='no'<?php echo ($row['emotional_yes_no'] == 'no') ? 'checked="checked"' : ''; ?>/><label for='emotional_yes_no_radio_0' class='element_label' id='emotional_yes_no_radio_0_label'>No</label></div>
               <div class='element_label' id='emotional_yes_no_1_container'><input type='radio' name='emotional_yes_no' id='emotional_yes_no_radio_1' value='yes'<?php echo ($row['emotional_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?> tabindex='1'/><label for='emotional_yes_no_radio_1' class='element_label' id='emotional_yes_no_radio_1_label'>Yes</label></div>
               <div id='label55_container' class='sfm_form_label'>
                  <label id='label55'>During the past 12 months, seen a professional to address mental/emotional health concerns?</label>
               </div>
               <div class='element_label' id='mental_illness_yes_no_0_container'><input type='radio' name='mental_illness_yes_no' id='mental_illness_yes_no_radio_0' value='no'<?php echo ($row['mental_illness_yes_no'] == 'no') ? 'checked="checked"' : ''; ?>/><label for='mental_illness_yes_no_radio_0' class='element_label' id='mental_illness_yes_no_radio_0_label'>No</label></div>
               <div class='element_label' id='mental_illness_yes_no_1_container'><input type='radio' name='mental_illness_yes_no' id='mental_illness_yes_no_radio_1' value='yes'<?php echo ($row['mental_illness_yes_no'] == 'yes') ? 'checked="checked"' : ''; ?> tabindex='1'/><label for='mental_illness_yes_no_radio_1' class='element_label' id='mental_illness_yes_no_radio_1_label'>Yes</label></div>
               <div id='label56_container'>
                  <div id='label56'>Please explain "Yes" answers in the space bleow.</div>
               </div>
               <div id='Mental_comments_container'><textarea name='Mental_comments' id='Mental_comments' cols='50' rows='8' class='sfm_textarea'><?php echo $row['Mental_comments']?></textarea></div>
               <div id='box_element6'></div>
               <div id='FirstName_e_contact_container'>
                  <input type='text' name='FirstName_e_contact'value='<?php echo $row['FirstName_e_contact']?>' id='FirstName_e_contact' size='20' tabindex='1' class='sfm_textbox'/>
               </div>
               <div id='Relationship_container'>
                  <input type='text' name='Relationship'value='<?php echo $row['Relationship']?>' id='Relationship' size='20' tabindex='2' class='sfm_textbox'/>
               </div>
               <div id='Phone_e_contact_container'>
                  <input type='text' name='Phone_e_contact'value='<?php echo $row['Phone_e_contact']?>' id='Phone_e_contact' size='20' tabindex='3' class='sfm_textbox'/>
               </div>
               <div id='LastName_e_contact_container'>
                  <input type='text' name='LastName_e_contact' value='<?php echo $row['LastName_e_contact']?>'id='LastName_e_contact' size='20' tabindex='4' class='sfm_textbox'/>
               </div>
               <div id='Doctor_container'>
                  <input type='text' name='Doctor'value='<?php echo $row['Doctor']?>' id='Doctor' size='20' tabindex='5' class='sfm_textbox'/>
               </div>
               <div id='Phone_Doctor_container'>
                  <input type='text' name='Phone_Doctor' value='<?php echo $row['Phone_Doctor']?>'id='Phone_Doctor' size='20' tabindex='6' class='sfm_textbox'/>
               </div>
               
               <div class='sfm_element_container' id='IMUN_1_container'>
                  <input type='text' name='IMUN_1'value='<?php echo $row['IMUN_1']?>' id='IMUN_1' tabindex='14'/>
                  <input type='text' name='sfm_IMUN_1_parsed' id='sfm_IMUN_1_parsed' tabindex='-1' style='display:none'/>
                  <div id='IMUN_1_image_container'>
                     <img id='IMUN_1_image' class='sfm_datepicker_icon' src='images/date-picker.gif' width='20' height='20' alt='Click here to open the date picker'/>
                  </div>
               </div>
               <div class='sfm_element_container' id='IMUN_2_container'>
                  <input type='text' name='IMUN_2'value='<?php echo $row['IMUN_2']?>' id='IMUN_2' tabindex='15'/>
                  <input type='text' name='sfm_IMUN_2_parsed' id='sfm_IMUN_2_parsed' tabindex='-1' style='display:none'/>
                  <div id='IMUN_2_image_container'>
                     <img id='IMUN_2_image' class='sfm_datepicker_icon' src='images/date-picker.gif' width='20' height='20' alt='Click here to open the date picker'/>
                  </div>
               </div>
               <div class='sfm_element_container' id='IMUN_3_container'>
                  <input type='text' name='IMUN_3'value='<?php echo $row['IMUN_3']?>' id='IMUN_3' tabindex='16'/>
                  <input type='text' name='sfm_IMUN_3_parsed' id='sfm_IMUN_3_parsed' tabindex='-1' style='display:none'/>
                  <div id='IMUN_3_image_container'>
                     <img id='IMUN_3_image' class='sfm_datepicker_icon' src='images/date-picker.gif' width='20' height='20' alt='Click here to open the date picker'/>
                  </div>
               </div>
               <div class='sfm_element_container' id='IMUN_4_container'>
                  <input type='text' name='IMUN_4'value='<?php echo $row['IMUN_4']?>' id='IMUN_4' tabindex='17'/>
                  <input type='text' name='sfm_IMUN_4_parsed' id='sfm_IMUN_4_parsed' tabindex='-1' style='display:none'/>
                  <div id='IMUN_4_image_container'>
                     <img id='IMUN_4_image' class='sfm_datepicker_icon' src='images/date-picker.gif' width='20' height='20' alt='Click here to open the date picker'/>
                  </div>
               </div>
               <div class='sfm_element_container' id='IMUN_5_container'>
                  <input type='text' name='IMUN_5'value='<?php echo $row['IMUN_5']?>' id='IMUN_5' tabindex='18'/>
                  <input type='text' name='sfm_IMUN_5_parsed' id='sfm_IMUN_5_parsed' tabindex='-1' style='display:none'/>
                  <div id='IMUN_5_image_container'>
                     <img id='IMUN_5_image' class='sfm_datepicker_icon' src='images/date-picker.gif' width='20' height='20' alt='Click here to open the date picker'/>
                  </div>
               </div>
               <div class='sfm_element_container' id='IMUN_6_container'>
                  <input type='text' name='IMUN_6'value='<?php echo $row['IMUN_6']?>' id='IMUN_6' tabindex='19'/>
                  <input type='text' name='sfm_IMUN_6_parsed' id='sfm_IMUN_6_parsed' tabindex='-1' style='display:none'/>
                  <div id='IMUN_6_image_container'>
                     <img id='IMUN_6_image' class='sfm_datepicker_icon' src='images/date-picker.gif' width='20' height='20' alt='Click here to open the date picker'/>
                  </div>
               </div>
               <div class='sfm_element_container' id='IMUN_7_container'>
                  <input type='text' name='IMUN_7' value='<?php echo $row['IMUN_7']?>'id='IMUN_7' tabindex='20'/>
                  <input type='text' name='sfm_IMUN_7_parsed' id='sfm_IMUN_7_parsed' tabindex='-1' style='display:none'/>
                  <div id='IMUN_7_image_container'>
                     <img id='IMUN_7_image' class='sfm_datepicker_icon' src='images/date-picker.gif' width='20' height='20' alt='Click here to open the date picker'/>
                  </div>
               </div>
               <div class='sfm_element_container' id='IMUN_8_container'>
                  <input type='text' name='IMUN_8' value='<?php echo $row['IMUN_8']?>'id='IMUN_8' tabindex='21'/>
                  <input type='text' name='sfm_IMUN_8_parsed' id='sfm_IMUN_8_parsed' tabindex='-1' style='display:none'/>
                  <div id='IMUN_8_image_container'>
                     <img id='IMUN_8_image' class='sfm_datepicker_icon' src='images/date-picker.gif' width='20' height='20' alt='Click here to open the date picker'/>
                  </div>
               </div>
               <div class='sfm_element_container' id='IMUN_9_container'>
                  <input type='text' name='IMUN_9'value='<?php echo $row['IMUN_9']?>' id='IMUN_9' tabindex='22'/>
                  <input type='text' name='sfm_IMUN_9_parsed' id='sfm_IMUN_9_parsed' tabindex='-1' style='display:none'/>
                  <div id='IMUN_9_image_container'>
                     <img id='IMUN_9_image' class='sfm_datepicker_icon' src='images/date-picker.gif' width='20' height='20' alt='Click here to open the date picker'/>
                  </div>
               </div>
               <div class='sfm_element_container' id='IMUN_10_container'>
                  <input type='text' name='IMUN_10'value='<?php echo $row['IMUN_10']?>' id='IMUN_10' tabindex='23'/>
                  <input type='text' name='sfm_IMUN_10_parsed' id='sfm_IMUN_10_parsed' tabindex='-1' style='display:none'/>
                  <div id='IMUN_10_image_container'>
                     <img id='IMUN_10_image' class='sfm_datepicker_icon' src='images/date-picker.gif' width='20' height='20' alt='Click here to open the date picker'/>
                  </div>
               </div>
               <div class='sfm_element_container' id='IMUN_11_container'>
                  <input type='text' name='IMUN_11'value='<?php echo $row['IMUN_11']?>' id='IMUN_11' tabindex='24'/>
                  <input type='text' name='sfm_IMUN_11_parsed' id='sfm_IMUN_11_parsed' tabindex='-1' style='display:none'/>
                  <div id='IMUN_11_image_container'>
                     <img id='IMUN_11_image' class='sfm_datepicker_icon' src='images/date-picker.gif' width='20' height='20' alt='Click here to open the date picker'/>
                  </div>
               </div>
               <div class='sfm_element_container' id='IMUN_12_container'>
                  <input type='text' name='IMUN_12'value='<?php echo $row['IMUN_12']?>' id='IMUN_12' tabindex='25'/>
                  <input type='text' name='sfm_IMUN_12_parsed' id='sfm_IMUN_12_parsed' tabindex='-1' style='display:none'/>
                  <div id='IMUN_12_image_container'>
                     <img id='IMUN_12_image' class='sfm_datepicker_icon' src='images/date-picker.gif' width='20' height='20' alt='Click here to open the date picker'/>
                  </div>
               </div>
               <div class='element_label' id='Positive_container'><input type='checkbox' name='Positive' id='Positive' value='on' tabindex='26'/><label for='Positive' class='element_label' id='Positive_label'>Positive</label></div>
               <div class='element_label' id='Negative_container'><input type='checkbox' name='Negative' id='Negative' value='on' tabindex='27'/><label for='Negative' class='element_label' id='Negative_label'>Negative</label></div>
            </div>
         </div>
<div class='sfm_cr_box' style='padding:3px; width:350px;cursor:default'>Built with <a style='text-decoration:none;' href='http://www.simfatic.com'>Simfatic Forms</a> form creator software (Reg version does not add this line).</div>
      </form>
      <script type='text/javascript'>
// <![CDATA[
$(function()
{
   new sfm_calendar({input_id:"med_date_1",image_id:"med_date_1_image",form_id:"Camp_Health_Form",mirror:"sfm_med_date_1_parsed"})
   new sfm_calendar({input_id:"med_date_2",image_id:"med_date_2_image",form_id:"Camp_Health_Form",mirror:"sfm_med_date_2_parsed"})
   new sfm_calendar({input_id:"med_date_3",image_id:"med_date_3_image",form_id:"Camp_Health_Form",mirror:"sfm_med_date_3_parsed"})
   new sfm_calendar({input_id:"IMUN_1",image_id:"IMUN_1_image",form_id:"Camp_Health_Form",mirror:"sfm_IMUN_1_parsed"})
   new sfm_calendar({input_id:"IMUN_2",image_id:"IMUN_2_image",form_id:"Camp_Health_Form",mirror:"sfm_IMUN_2_parsed"})
   new sfm_calendar({input_id:"IMUN_3",image_id:"IMUN_3_image",form_id:"Camp_Health_Form",mirror:"sfm_IMUN_3_parsed"})
   new sfm_calendar({input_id:"IMUN_4",image_id:"IMUN_4_image",form_id:"Camp_Health_Form",mirror:"sfm_IMUN_4_parsed"})
   new sfm_calendar({input_id:"IMUN_5",image_id:"IMUN_5_image",form_id:"Camp_Health_Form",mirror:"sfm_IMUN_5_parsed"})
   new sfm_calendar({input_id:"IMUN_6",image_id:"IMUN_6_image",form_id:"Camp_Health_Form",mirror:"sfm_IMUN_6_parsed"})
   new sfm_calendar({input_id:"IMUN_7",image_id:"IMUN_7_image",form_id:"Camp_Health_Form",mirror:"sfm_IMUN_7_parsed"})
   new sfm_calendar({input_id:"IMUN_8",image_id:"IMUN_8_image",form_id:"Camp_Health_Form",mirror:"sfm_IMUN_8_parsed"})
   new sfm_calendar({input_id:"IMUN_9",image_id:"IMUN_9_image",form_id:"Camp_Health_Form",mirror:"sfm_IMUN_9_parsed"})
   new sfm_calendar({input_id:"IMUN_10",image_id:"IMUN_10_image",form_id:"Camp_Health_Form",mirror:"sfm_IMUN_10_parsed"})
   new sfm_calendar({input_id:"IMUN_11",image_id:"IMUN_11_image",form_id:"Camp_Health_Form",mirror:"sfm_IMUN_11_parsed"})
   new sfm_calendar({input_id:"IMUN_12",image_id:"IMUN_12_image",form_id:"Camp_Health_Form",mirror:"sfm_IMUN_12_parsed"})
});

// ]]>
      </script>
      <script type='text/javascript'>
// <![CDATA[
var Camp_Health_FormValidator = new Validator("Camp_Health_Form");
Camp_Health_FormValidator.addValidation("IMUN_1",{required:true,message:"Date field cannont be blank! Enter none if none."} );
Camp_Health_FormValidator.addValidation("IMUN_2",{required:true,message:"Date field cannont be blank! Enter none if none."} );
Camp_Health_FormValidator.addValidation("IMUN_3",{required:true,message:"Date field cannont be blank! Enter none if none."} );
Camp_Health_FormValidator.addValidation("IMUN_4",{required:true,message:"Date field cannont be blank! Enter none if none."} );
Camp_Health_FormValidator.addValidation("IMUN_5",{required:true,message:"Date field cannont be blank! Enter none if none."} );
Camp_Health_FormValidator.addValidation("IMUN_6",{required:true,message:"Date field cannont be blank! Enter none if none."} );
Camp_Health_FormValidator.addValidation("IMUN_7",{required:true,message:"Date field cannont be blank! Enter none if none."} );
Camp_Health_FormValidator.addValidation("IMUN_8",{required:true,message:"Date field cannont be blank! Enter none if none."} );
Camp_Health_FormValidator.addValidation("IMUN_9",{required:true,message:"Date field cannont be blank! Enter none if none."} );
Camp_Health_FormValidator.addValidation("IMUN_10",{required:true,message:"Date field cannont be blank! Enter none if none."} );
Camp_Health_FormValidator.addValidation("IMUN_11",{required:true,message:"Date field cannont be blank! Enter none if none."} );
Camp_Health_FormValidator.addValidation("IMUN_12",{required:true,message:"Date field cannont be blank! Enter none if none."} );
Camp_Health_FormValidator.addValidation("allergy_food_yes_no",{selone:true,message:"Please select an option for allergy_food"} );
Camp_Health_FormValidator.addValidation("allergy_medicine_yes_no",{selone:true,message:"Please select an option for allergy_medicine"} );
Camp_Health_FormValidator.addValidation("allergy_environment_yes_no",{selone:true,message:"Please select an option for allergy_environment"} );
Camp_Health_FormValidator.addValidation("allergy_other_yes_no",{selone:true,message:"Please select an option for allergy_other"} );
Camp_Health_FormValidator.addValidation("comments_allergies",{maxlen:"5120",message:"The length of the input for Comments should not exceed 5120"} );
Camp_Health_FormValidator.addValidation("Immun_yes_no",{selone:true,message:"Please select an option for Immun_yes_no"} );
Camp_Health_FormValidator.addValidation("Meds_at_camp_true_false",{selone:true,message:"Please select an option for Meds_at_camp"} );
Camp_Health_FormValidator.addValidation("Ibuprofen_yes_no",{selone:true,message:"Please select an option for Ibuprofen_yes_no"} );
Camp_Health_FormValidator.addValidation("Tylenol_yes_no",{selone:true,message:"Please select an option for Tylenol_yes_no"} );
Camp_Health_FormValidator.addValidation("Sudafed_PE_yes_no",{selone:true,message:"Please select an option for Sudafed_PE_yes_no"} );
Camp_Health_FormValidator.addValidation("Sudafed_yes_no",{selone:true,message:"Please select an option for Sudafed_yes_no"} );
Camp_Health_FormValidator.addValidation("allergy_med_yes_no",{selone:true,message:"Please select an option for allergy_med_yes_no"} );
Camp_Health_FormValidator.addValidation("Robitussin_yes_no",{selone:true,message:"Please select an option for Robitussin_yes_no"} );
Camp_Health_FormValidator.addValidation("Benadryl_yes_no",{selone:true,message:"Please select an option for Benadryl_yes_no"} );
Camp_Health_FormValidator.addValidation("Rob_DM_yes_no",{selone:true,message:"Please select an option for Rob_DM_yes_no"} );
Camp_Health_FormValidator.addValidation("Throat_spray_yes_no",{selone:true,message:"Please select an option for Throat_spray_yes_no"} );
Camp_Health_FormValidator.addValidation("cough_drops_yes_no",{selone:true,message:"Please select an option for cough_drops_yes_no"} );
Camp_Health_FormValidator.addValidation("Calamine_yes_no",{selone:true,message:"Please select an option for Calamine_yes_no"} );
Camp_Health_FormValidator.addValidation("aloe_yes_no",{selone:true,message:"Please select an option for aloe_yes_no"} );
Camp_Health_FormValidator.addValidation("Laxatives_yes_no",{selone:true,message:"Please select an option for Laxatives_yes_no"} );
Camp_Health_FormValidator.addValidation("Pepto_yes_no",{selone:true,message:"Please select an option for Pepto_yes_no"} );
Camp_Health_FormValidator.addValidation("passed_out_yes_no",{selone:true,message:"Please select an option for passed_out"} );
Camp_Health_FormValidator.addValidation("seizures_yes_no",{selone:true,message:"Please select an option for seizures"} );
Camp_Health_FormValidator.addValidation("skin_problems_yes_no",{selone:true,message:"Please select an option for skin_problems"} );
Camp_Health_FormValidator.addValidation("recent_disease_yes_no",{selone:true,message:"Please select an option for recent_disease"} );
Camp_Health_FormValidator.addValidation("recent_injury_yes_no",{selone:true,message:"Please select an option for recent_injury"} );
Camp_Health_FormValidator.addValidation("sleep_problems_yes_no",{selone:true,message:"Please select an option for sleep_problems"} );
Camp_Health_FormValidator.addValidation("breathing_problem_yes_no",{selone:true,message:"Please select an option for breathing_problem"} );
Camp_Health_FormValidator.addValidation("diarrhea_constipation_yes_no",{selone:true,message:"Please select an option for diarrhea_constipation"} );
Camp_Health_FormValidator.addValidation("diabetes_yes_no",{selone:true,message:"Please select an option for diabetes"} );
Camp_Health_FormValidator.addValidation("glasses_yes_no",{selone:true,message:"Please select an option for glasses"} );
Camp_Health_FormValidator.addValidation("health_history_Yes_explain",{maxlen:"5120",message:"The length of the input for Comments should not exceed 5120"} );
Camp_Health_FormValidator.addValidation("ADD_ADHD_yes_no",{selone:true,message:"Please select an option for ADD_ADHD"} );
Camp_Health_FormValidator.addValidation("emotional_yes_no",{selone:true,message:"Please select an option for emotional"} );
Camp_Health_FormValidator.addValidation("mental_illness_yes_no",{selone:true,message:"Please select an option for mental_illness"} );
Camp_Health_FormValidator.addValidation("Mental_comments",{maxlen:"5120",message:"The length of the input for Comments should not exceed 5120"} );
Camp_Health_FormValidator.addValidation("FirstName_e_contact",{required:true,message:"Please fill in FirstName_e_contact"} );
Camp_Health_FormValidator.addValidation("Relationship",{required:true,message:"Please fill in Relationship"} );
Camp_Health_FormValidator.addValidation("Phone_e_contact",{required:true,message:"Please fill in Phone_e_contact"} );
Camp_Health_FormValidator.addValidation("LastName_e_contact",{required:true,message:"Please fill in LastName_e_contact"} );
Camp_Health_FormValidator.addValidation("Doctor",{required:true,message:"Please fill in Doctor"} );
Camp_Health_FormValidator.addValidation("Phone_Doctor",{required:true,message:"Please fill in Phone_Doctor"} );

// ]]>
      </script>
   </body>
</html>
