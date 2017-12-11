<?php
require_once("./include/membersite_config.php");
if(isset($_POST['submitted']))
{
   if(!$fgmembersite->UpdatePhoto())
   {
      
   }
  
}
print_r($_SESSION);
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
            
   $query = "select FirstName, LastName, camper_id from camper_info order by LastName;
";
$result = mysqli_query($connection, $query);

If (!$result){
    die("Datbase query failed. $query");
}  

?>
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title >Form Page: Registration_Form</title>
      <meta name='generator' content='Simfatic Forms 4.0.12.416'/>
      <script src='scripts/jquery-1.7.2.min.js' type='text/javascript'></script>
      <script src='scripts/jquery-ui-1.8.18.custom.min.js' type='text/javascript'></script>
      <script src='scripts/globalize.js' type='text/javascript'></script>
      <script src='scripts/jquery.sim.FormCalc.js' type='text/javascript'></script>
      <script src='scripts/jquery-ui-1.8.21.custom.date.min.js' type='text/javascript'></script>
      <script src='scripts/moment.js' type='text/javascript'></script>
      <script src='scripts/sfm_calendar.js' type='text/javascript'></script>
      <script src='scripts/jquery.sim.utils.js' type='text/javascript'></script>
      <script src='scripts/sfm_validatorv7.js' type='text/javascript'></script>
      <link rel='stylesheet' type='text/css' href='style/jquery-ui-1.8.16.css'/>
      <link rel='stylesheet' type='text/css' href='style/Registration_Form.css'/>
   </head>
<form method="get">
   <select name='camper_id' id='camper_id' size='1' onchange='this.form.submit()'>
                        <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value=\"{$row['camper_id']}\">";
                                echo strtoupper($row['FirstName']) . "  " . strtoupper($row['LastName']) ;
                                 echo "</option>";
                        }       
                        ?>
                     </select> 
    
    
</form>

<?php
                if ($_GET){
                    $camperid = $_GET['camper_id'];
                    $_SESSION['camper_id'] = $camperid;
       
                    $query = "select * from camper_info where camper_id = '$camperid';
                    ";
      

                    $result = mysqli_query($connection, $query);
         
                    if (!$result) {

                    die("Database query failed. $query");

                    }
                    $row = mysqli_fetch_assoc($result);
        
        
                    }
                ?>   

  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns='http://www.w3.org/1999/xhtml'>
   <head >
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title >Form Page: Registration_Form</title>
      <meta name='generator' content='Simfatic Forms 4.0.12.416'/>
      <script src='scripts/jquery-1.7.2.min.js' type='text/javascript'></script>
      <script src='scripts/jquery-ui-1.8.18.custom.min.js' type='text/javascript'></script>
      <script src='scripts/globalize.js' type='text/javascript'></script>
      <script src='scripts/jquery.sim.FormCalc.js' type='text/javascript'></script>
      <script src='scripts/jquery-ui-1.8.21.custom.date.min.js' type='text/javascript'></script>
      <script src='scripts/moment.js' type='text/javascript'></script>
      <script src='scripts/sfm_calendar.js' type='text/javascript'></script>
      <script src='scripts/jquery.sim.utils.js' type='text/javascript'></script>
      <script src='scripts/sfm_validatorv7.js' type='text/javascript'></script>
      <link rel='stylesheet' type='text/css' href='style/jquery-ui-1.8.16.css'/>
      <link rel='stylesheet' type='text/css' href='style/Registration_Form.css'/>
   </head>
   <body id='sfm_Registration_Form_body'>
      <form id='Registration_Form' class='sfm_form' enctype='multipart/form-data' method='post' action='' accept-charset='UTF-8'>
         <div id='Registration_Form_errorloc' class='error_strings' style='width:850px;text-align:left'></div>
         <div id='Registration_Form_outer_div' class='form_outer_div' style='width:850px;height:3442px'>
            <div style='position:relative' id='Registration_Form_inner_div'>
               <input type='hidden' name='submitted' id='submitted' value='1'/>
               
               <!--
               NOTE!!!!!   value in next line is date for calculating age at camp from DOB field.  Change for current year
               -->
               <input type='text' name='camper_id' value='<?php echo $row['camper_id']?>'>
               <input type='hidden' id='enddate' value='08/04/2017'/><br/>
               <div id='heading_container' class='form_subheading'>
                  <h2 id='heading' class='form_subheading'>2017 Residential Registration Form<br />Ages 7-16<br /></h2>
               </div>
               <div id='Image_container'>
                  <img class='sfm_image_in_form' src='images/photo1236 (1).jpg' width='164' height='102' alt=''/>
               </div>
               <div id='Image1_container'>
                  <img class='sfm_image_in_form' src='images/CampWabannaLogo_sized-2.png' width='280' height='84' alt=''/>
               </div>
               <div id='heading1_container' class='form_subheading'>
                  <h2 id='heading1' class='form_subheading'>Camper Information<br /></h2>
               </div>
               <div id='label_container' class='sfm_form_label'>
                  <label id='label' for='FirstName'>First Name</label>
               </div>
               <div id='label1_container' class='sfm_form_label'>
                  <label id='label1' for='LastName'>Last Name</label>
               </div>
               <div id='label14_container' class='sfm_form_label'>
                  <label id='label14' for='Image2'>Image</label>
                  
               </div>
               <div id='FirstName_container'>
                  <input type='text' name='FirstName' id='FirstName' size='20' class='sfm_textbox'/>
               </div>
               <div id='LastName_container'>
                  <input type='text' name='LastName' id='LastName' size='20' class='sfm_textbox'/>
               </div>
               
               <div id='Image2_container'>
                   <input type='file'  name='image' id='image' class="UpoloadFileSize" /> 
                  <img id="myImg" src="#" alt="file size must not exceed 1mb"  width="175" height="200"/>

                  <script>
                     $(document).ready(function () {

                        $('.UpoloadFileSize').bind('change', function () {                
                             if ((this.files[0].size / 1024000) > 1.0) { //greater than 1.0 MB
                                 $(this).val('');
                                 alert('Size exceeded !!');
                                                                        }
                                                                          });

                                                    });

                  </script>
                  
               </div>
               <div id='label2_container' class='sfm_form_label'>
                  <label id='label2' for='Address'>Address</label>
               </div>
               <div id='Address_container'>
                  <input type='text' name='Address' id='Address' size='20' class='sfm_textbox'/>
               </div>
               <div id='label5_container' class='sfm_form_label'>
                  <label id='label5'>State</label>
               </div>
               <div id='label3_container' class='sfm_form_label'>
                  <label id='label3' for='City'>City</label>
               </div>
               <div id='City_container'>
                  <input type='text' name='City' id='City' size='20' class='sfm_textbox'/>
               </div>
               <div id='state_container'>
                  <select name='state' id='state' size='1'>
                     <option value='Select'>Select</option>
                     <option value='Alabama'>Alabama</option>
                     <option value='Alaska'>Alaska</option>
                     <option value='Arizona'>Arizona</option>
                     <option value='Arkansas'>Arkansas</option>
                     <option value='California'>California</option>
                     <option value='Colorado'>Colorado</option>
                     <option value='Connecticut'>Connecticut</option>
                     <option value='Delaware'>Delaware</option>
                     <option value='Florida'>Florida</option>
                     <option value='Georgia'>Georgia</option>
                     <option value='Hawaii'>Hawaii</option>
                     <option value='Idaho'>Idaho</option>
                     <option value='Illinois'>Illinois</option>
                     <option value='Indiana'>Indiana</option>
                     <option value='Iowa'>Iowa</option>
                     <option value='Kansas'>Kansas</option>
                     <option value='Kentucky'>Kentucky</option>
                     <option value='Louisiana'>Louisiana</option>
                     <option value='Maine'>Maine</option>
                     <option value='Maryland'>Maryland</option>
                     <option value='Massachusetts'>Massachusetts</option>
                     <option value='Michigan'>Michigan</option>
                     <option value='Minnesota'>Minnesota</option>
                     <option value='Mississippi'>Mississippi</option>
                     <option value='Missouri'>Missouri</option>
                     <option value='Montana'>Montana</option>
                     <option value='Nebraska'>Nebraska</option>
                     <option value='Nevada'>Nevada</option>
                     <option value='New Hampshire'>New Hampshire</option>
                     <option value='New Jersey'>New Jersey</option>
                     <option value='New Mexico'>New Mexico</option>
                     <option value='New York'>New York</option>
                     <option value='North Carolina'>North Carolina</option>
                     <option value='North Dakota'>North Dakota</option>
                     <option value='Ohio'>Ohio</option>
                     <option value='Oklahoma'>Oklahoma</option>
                     <option value='Oregon'>Oregon</option>
                     <option value='Pennsylvania'>Pennsylvania</option>
                     <option value='Rhode Island'>Rhode Island</option>
                     <option value='South Carolina'>South Carolina</option>
                     <option value='South Dakota'>South Dakota</option>
                     <option value='Tennessee'>Tennessee</option>
                     <option value='Texas'>Texas</option>
                     <option value='Utah'>Utah</option>
                     <option value='Vermont'>Vermont</option>
                     <option value='Virginia'>Virginia</option>
                     <option value='Washington'>Washington</option>
                     <option value='West Virginia'>West Virginia</option>
                     <option value='Wisconsin'>Wisconsin</option>
                     <option value='Wyoming'>Wyoming</option>
                  </select>
               </div>
               <div id='label6_container' class='sfm_form_label'>
                  <label id='label6' for='Zip'>Zip</label>
               </div>
               <div id='label7_container' class='sfm_form_label'>
                  <label id='label7'>County</label>
               </div>
               <div id='Zip_container'>
                  <input type='text' name='Zip' id='Zip' size='20' class='sfm_textbox'/>
               </div>
               <div id='county_container'>
                  <input type='text' name='county' id='county' size='20' class='sfm_textbox'/>
               </div>
               <div id='label8_container' class='sfm_form_label'>
                  <label id='label8'>Date of Birth</label>
               </div>
               <div id='label9_container' class='sfm_form_label'>
                  <label id='label9' for='Age'>Age</label>
               </div>
               <div id='label10_container' class='sfm_form_label'>
                  <label id='label10'>Grade</label>
               </div>
               <div class='sfm_element_container' id='Age_container'>
                   <input type='text' name='Age' id='Age' readonly/>
                  <input type='text' name='sfm_Age_parsed' id='sfm_Age_parsed' style='display:none'/>
               </div>
               <div class='sfm_element_container' id='DOB_container'>
                   <input type='text' name='DOB' id='DOB' onchange='javascript:calc()' readonly/>
                  <input type='text' name='sfm_DOB_parsed' id='sfm_DOB_parsed' tabindex='-1' style='display:none'/>
                  <div id='DOB_image_container'>
                     <img id='DOB_image' class='sfm_datepicker_icon' src='images/date-picker.gif' width='20' height='20' alt='Click here to open the date picker'/>
                  </div>
               </div>
               <div id='Grade_container'>
                  <input type='text' name='Grade' id='Grade' size='20' class='sfm_textbox'/>
               </div>
               <div id='label11_container' class='sfm_form_label'>
                  <label id='label11'>Gender</label>
               </div>
               <div class='element_label' id='Gender_0_container'><input type='radio' name='Gender' id='Gender_radio_0' value='male'/><label for='Gender_radio_0' class='element_label' id='Gender_radio_0_label'>Male</label></div>
               <div class='element_label' id='Gender_1_container'><input type='radio' name='Gender' id='Gender_radio_1' value='female' tabindex='1'/><label for='Gender_radio_1' class='element_label' id='Gender_radio_1_label'>Female</label></div>
               <div id='label12_container' class='sfm_form_label'>
                  <label id='label12'>First Summer with Us?</label>
               </div>
               <div class='element_label' id='yes_no_0_container'><input type='radio' name='yes_no' id='yes_no_radio_0' value='yes'/><label for='yes_no_radio_0' class='element_label' id='yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='yes_no_1_container'><input type='radio' name='yes_no' id='yes_no_radio_1' value='no' tabindex='1'/><label for='yes_no_radio_1' class='element_label' id='yes_no_radio_1_label'>No</label></div>
               <div id='label13_container' class='sfm_form_label'>
                  <label id='label13' for='comment'>How did you hear about us?<br /></label>
               </div>
               <div id='comment_container'><textarea name='comment' id='comment' cols='50' rows='8' class='sfm_textarea'></textarea></div>
               <div id='box_element'></div>
               <div id='heading2_container' class='form_subheading'>
                  <h2 id='heading2' class='form_subheading'>Parent/Gaurdian Information<br /></h2>
               </div>
               <div id='label15_container' class='sfm_form_label'>
                  <label id='label15' for='first_name_f'>Father's First Name</label>
               </div>
               <div id='label16_container' class='sfm_form_label'>
                  <label id='label16' for='last_name_f'>Father's Last Name</label>
               </div>
               <div id='label17_container' class='sfm_form_label'>
                  <label id='label17'>Email</label>
               </div>
               <div id='first_name_f_container'>
                  <input type='text' name='first_name_f' id='first_name_f' size='20' class='sfm_textbox'/>
               </div>
               <div id='last_name_f_container'>
                  <input type='text' name='last_name_f' id='last_name_f' size='20' class='sfm_textbox'/>
               </div>
               <div id='email_f_container'>
                  <input type='text' name='email_f' id='email_f' size='20' class='sfm_textbox'/>
               </div>
               <div id='label19_container' class='sfm_form_label'>
                  <label id='label19'>Home Phone<br /></label>
               </div>
               <div id='label25_container' class='sfm_form_label'>
                  <label id='label25'>Zip</label>
               </div>
               <div id='label20_container' class='sfm_form_label'>
                  <label id='label20'>Work Phone<br /></label>
               </div>
               <div id='label21_container' class='sfm_form_label'>
                  <label id='label21'>Cell Phone<br /></label>
               </div>
               <div id='home_phone_f_container'>
                  <input type='text' name='home_phone_f' id='home_phone_f' size='20' class='sfm_textbox'/>
               </div>
               <div id='work_phone_f_container'>
                  <input type='text' name='work_phone_f' id='work_phone_f' size='20' class='sfm_textbox'/>
               </div>
               <div id='cell_phone_f_container'>
                  <input type='text' name='cell_phone_f' id='cell_phone_f' size='20' class='sfm_textbox'/>
               </div>
               <div id='zip_f_container'>
                  <input type='text' name='zip_f' id='zip_f' size='20' class='sfm_textbox'/>
               </div>
               <div id='label22_container' class='sfm_form_label'>
                  <label id='label22'>Address</label>
               </div>
               <div id='label23_container' class='sfm_form_label'>
                  <label id='label23'>City</label>
               </div>
               <div id='label24_container' class='sfm_form_label'>
                  <label id='label24'>State</label>
               </div>
               <div id='address_f_container'>
                  <input type='text' name='address_f' id='address_f' size='20' class='sfm_textbox'/>
               </div>
               <div id='city_f_container'>
                  <input type='text' name='city_f' id='city_f' size='20' class='sfm_textbox'/>
               </div>
               <div id='state_f_container'>
                  <select name='state_f' id='state_f' size='1'>
                     <option value='Select'>Select</option>
                     <option value='Alabama'>Alabama</option>
                     <option value='Alaska'>Alaska</option>
                     <option value='Arizona'>Arizona</option>
                     <option value='Arkansas'>Arkansas</option>
                     <option value='California'>California</option>
                     <option value='Colorado'>Colorado</option>
                     <option value='Connecticut'>Connecticut</option>
                     <option value='Delaware'>Delaware</option>
                     <option value='Florida'>Florida</option>
                     <option value='Georgia'>Georgia</option>
                     <option value='Hawaii'>Hawaii</option>
                     <option value='Idaho'>Idaho</option>
                     <option value='Illinois'>Illinois</option>
                     <option value='Indiana'>Indiana</option>
                     <option value='Iowa'>Iowa</option>
                     <option value='Kansas'>Kansas</option>
                     <option value='Kentucky'>Kentucky</option>
                     <option value='Louisiana'>Louisiana</option>
                     <option value='Maine'>Maine</option>
                     <option value='Maryland'>Maryland</option>
                     <option value='Massachusetts'>Massachusetts</option>
                     <option value='Michigan'>Michigan</option>
                     <option value='Minnesota'>Minnesota</option>
                     <option value='Mississippi'>Mississippi</option>
                     <option value='Missouri'>Missouri</option>
                     <option value='Montana'>Montana</option>
                     <option value='Nebraska'>Nebraska</option>
                     <option value='Nevada'>Nevada</option>
                     <option value='New Hampshire'>New Hampshire</option>
                     <option value='New Jersey'>New Jersey</option>
                     <option value='New Mexico'>New Mexico</option>
                     <option value='New York'>New York</option>
                     <option value='North Carolina'>North Carolina</option>
                     <option value='North Dakota'>North Dakota</option>
                     <option value='Ohio'>Ohio</option>
                     <option value='Oklahoma'>Oklahoma</option>
                     <option value='Oregon'>Oregon</option>
                     <option value='Pennsylvania'>Pennsylvania</option>
                     <option value='Rhode Island'>Rhode Island</option>
                     <option value='South Carolina'>South Carolina</option>
                     <option value='South Dakota'>South Dakota</option>
                     <option value='Tennessee'>Tennessee</option>
                     <option value='Texas'>Texas</option>
                     <option value='Utah'>Utah</option>
                     <option value='Vermont'>Vermont</option>
                     <option value='Virginia'>Virginia</option>
                     <option value='Washington'>Washington</option>
                     <option value='West Virginia'>West Virginia</option>
                     <option value='Wisconsin'>Wisconsin</option>
                     <option value='Wyoming'>Wyoming</option>
                  </select>
               </div>
               <div id='horiz_line'></div>
               <div id='label26_container' class='sfm_form_label'>
                  <label id='label26' for='first_name_m'>Mother's First Name</label>
               </div>
               <div id='label27_container' class='sfm_form_label'>
                  <label id='label27' for='last_name_m'>Mother's Last Name</label>
               </div>
               <div id='label28_container' class='sfm_form_label'>
                  <label id='label28'>Email</label>
               </div>
               <div id='first_name_m_container'>
                  <input type='text' name='first_name_m' id='first_name_m' size='20' class='sfm_textbox'/>
               </div>
               <div id='last_name_m_container'>
                  <input type='text' name='last_name_m' id='last_name_m' size='20' class='sfm_textbox'/>
               </div>
               <div id='email_m_container'>
                  <input type='text' name='email_m' id='email_m' size='20' class='sfm_textbox'/>
               </div>
               <div id='label30_container' class='sfm_form_label'>
                  <label id='label30'>Home Phone<br /></label>
               </div>
               <div id='label36_container' class='sfm_form_label'>
                  <label id='label36'>Zip</label>
               </div>
               <div id='label31_container' class='sfm_form_label'>
                  <label id='label31'>Work Phone<br /></label>
               </div>
               <div id='label32_container' class='sfm_form_label'>
                  <label id='label32'>Cell Phone<br /></label>
               </div>
               <div id='home_phone_m_container'>
                  <input type='text' name='home_phone_m' id='home_phone_m' size='20' class='sfm_textbox'/>
               </div>
               <div id='work_phone_m_container'>
                  <input type='text' name='work_phone_m' id='work_phone_m' size='20' class='sfm_textbox'/>
               </div>
               <div id='cell_phone_m_container'>
                  <input type='text' name='cell_phone_m' id='cell_phone_m' size='20' class='sfm_textbox'/>
               </div>
               <div id='zip_m_container'>
                  <input type='text' name='zip_m' id='zip_m' size='20' class='sfm_textbox'/>
               </div>
               <div id='label33_container' class='sfm_form_label'>
                  <label id='label33'>Address</label>
               </div>
               <div id='label34_container' class='sfm_form_label'>
                  <label id='label34'>City</label>
               </div>
               <div id='label35_container' class='sfm_form_label'>
                  <label id='label35'>State</label>
               </div>
               <div id='address_m_container'>
                  <input type='text' name='address_m' id='address_m' size='20' class='sfm_textbox'/>
               </div>
               <div id='city_m_container'>
                  <input type='text' name='city_m' id='city_m' size='20' class='sfm_textbox'/>
               </div>
               <div id='state_m_container'>
                  <select name='state_m' id='state_m' size='1'>
                     <option value='Select'>Select</option>
                     <option value='Alabama'>Alabama</option>
                     <option value='Alaska'>Alaska</option>
                     <option value='Arizona'>Arizona</option>
                     <option value='Arkansas'>Arkansas</option>
                     <option value='California'>California</option>
                     <option value='Colorado'>Colorado</option>
                     <option value='Connecticut'>Connecticut</option>
                     <option value='Delaware'>Delaware</option>
                     <option value='Florida'>Florida</option>
                     <option value='Georgia'>Georgia</option>
                     <option value='Hawaii'>Hawaii</option>
                     <option value='Idaho'>Idaho</option>
                     <option value='Illinois'>Illinois</option>
                     <option value='Indiana'>Indiana</option>
                     <option value='Iowa'>Iowa</option>
                     <option value='Kansas'>Kansas</option>
                     <option value='Kentucky'>Kentucky</option>
                     <option value='Louisiana'>Louisiana</option>
                     <option value='Maine'>Maine</option>
                     <option value='Maryland'>Maryland</option>
                     <option value='Massachusetts'>Massachusetts</option>
                     <option value='Michigan'>Michigan</option>
                     <option value='Minnesota'>Minnesota</option>
                     <option value='Mississippi'>Mississippi</option>
                     <option value='Missouri'>Missouri</option>
                     <option value='Montana'>Montana</option>
                     <option value='Nebraska'>Nebraska</option>
                     <option value='Nevada'>Nevada</option>
                     <option value='New Hampshire'>New Hampshire</option>
                     <option value='New Jersey'>New Jersey</option>
                     <option value='New Mexico'>New Mexico</option>
                     <option value='New York'>New York</option>
                     <option value='North Carolina'>North Carolina</option>
                     <option value='North Dakota'>North Dakota</option>
                     <option value='Ohio'>Ohio</option>
                     <option value='Oklahoma'>Oklahoma</option>
                     <option value='Oregon'>Oregon</option>
                     <option value='Pennsylvania'>Pennsylvania</option>
                     <option value='Rhode Island'>Rhode Island</option>
                     <option value='South Carolina'>South Carolina</option>
                     <option value='South Dakota'>South Dakota</option>
                     <option value='Tennessee'>Tennessee</option>
                     <option value='Texas'>Texas</option>
                     <option value='Utah'>Utah</option>
                     <option value='Vermont'>Vermont</option>
                     <option value='Virginia'>Virginia</option>
                     <option value='Washington'>Washington</option>
                     <option value='West Virginia'>West Virginia</option>
                     <option value='Wisconsin'>Wisconsin</option>
                     <option value='Wyoming'>Wyoming</option>
                  </select>
               </div>
               <div id='box_element1'></div>
               <div id='heading3_container' class='form_subheading'>
                  <h2 id='heading3' class='form_subheading'>Additional Contacts</h2>
               </div>
               <div id='label37_container' class='sfm_form_label'>
                  <label id='label37'>First Name</label>
               </div>
               <div id='label38_container' class='sfm_form_label'>
                  <label id='label38'>Last Name</label>
               </div>
               <div id='label39_container' class='sfm_form_label'>
                  <label id='label39'>Relation</label>
               </div>
               <div id='label40_container' class='sfm_form_label'>
                  <label id='label40'>Phone</label>
               </div>
               <div id='FirstName_e_contact_1_container'>
                  <input type='text' name='FirstName_e_contact_1' id='FirstName_e_contact_1' size='20' class='sfm_textbox'/>
               </div>
               <div id='LastName_e_contact_1_container'>
                  <input type='text' name='LastName_e_contact_1' id='LastName_e_contact_1' size='20' class='sfm_textbox'/>
               </div>
               <div id='Relationship_1_container'>
                  <input type='text' name='Relationship_1' id='Relationship_1' size='20' class='sfm_textbox'/>
               </div>
               <div id='Phone_e_contact_1_container'>
                  <input type='text' name='Phone_e_contact_1' id='Phone_e_contact_1' size='20' class='sfm_textbox'/>
               </div>
               <div id='label41_container' class='sfm_form_label'>
                  <label id='label41'>First Name</label>
               </div>
               <div id='label42_container' class='sfm_form_label'>
                  <label id='label42'>Last Name</label>
               </div>
               <div id='label43_container' class='sfm_form_label'>
                  <label id='label43'>Relation</label>
               </div>
               <div id='label44_container' class='sfm_form_label'>
                  <label id='label44'>Phone</label>
               </div>
               <div id='FirstName_e_contact_2_container'>
                  <input type='text' name='FirstName_e_contact_2' id='FirstName_e_contact_2' size='20' class='sfm_textbox'/>
               </div>
               <div id='LastName_e_contact_2_container'>
                  <input type='text' name='LastName_e_contact_2' id='LastName_e_contact_2' size='20' class='sfm_textbox'/>
               </div>
               <div id='Relationship_2_container'>
                  <input type='text' name='Relationship_2' id='Relationship_2' size='20' class='sfm_textbox'/>
               </div>
               <div id='Phone_e_contact_2_container'>
                  <input type='text' name='Phone_e_contact_2' id='Phone_e_contact_2' size='20' class='sfm_textbox'/>
               </div>
               <div id='box_element2'></div>
               <div id='heading4_container' class='form_subheading'>
                  <h2 id='heading4' class='form_subheading'>Roommate Request</h2>
               </div>
               <div id='label4_container'>
                  <div id='label4'>     Camper may request two roomates only if they meet these criteria:</div>
               </div>
               <div id='label45_container'>
                  <div id='label45'>      1) They are the same gender and NO MORE than 12 months apart (except for 11 & 12 yr olds. See note below*)</div>
               </div>
               <div id='label46_container'>
                  <div id='label46'>      2) The requested roommate must also request your camper<br /></div>
               </div>
               <div id='label47_container' class='sfm_form_label'>
                  <label id='label47'>Roommate Request 1<br /></label>
               </div>
               <div id='label48_container' class='sfm_form_label'>
                  <label id='label48'>Roommate Request 2<br /></label>
               </div>
               <div id='roommate_1_container'>
                  <input type='text' name='roommate_1' id='roommate_1' size='20' class='sfm_textbox'/>
               </div>
               <div id='roommate_2_container'>
                  <input type='text' name='roommate_2' id='roommate_2' size='20' class='sfm_textbox'/>
               </div>
               <div id='label49_container'>
                  <div id='label49'>          Every effort will be made to accommodate roomate request but we cannot guarantee them.</div>
               </div>
               <div id='label50_container'>
                  <div id='label50'>*Please note: 7-11 yr. olds are in the Junior Program; 12-16 yr. olds are in the Senior Program - these age groups will each be housed in separate dormitory facilities. Program placement is determined by the age the campers are when session begins.</div>
               </div>
               <div id='box_element3'></div>
               <div id='label51_container' class='sfm_form_label'>
                  <label id='label51'>Has your Camper been fully immunized? Note: If you check no, you understand and accept the risk to your child.</label>
               </div>
               <div class='element_label' id='Immun_yes_no_0_container'><input type='radio' name='Immun_yes_no' id='Immun_yes_no_radio_0' value='yes'/><label for='Immun_yes_no_radio_0' class='element_label' id='Immun_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='Immun_yes_no_1_container'><input type='radio' name='Immun_yes_no' id='Immun_yes_no_radio_1' value='no' tabindex='1'/><label for='Immun_yes_no_radio_1' class='element_label' id='Immun_yes_no_radio_1_label'>No</label></div>
               <div id='label52_container' class='sfm_form_label'>
                  <label id='label52'>Is Camper allergic to Food?</label>
               </div>
               <div id='heading5_container' class='form_subheading'>
                  <h2 id='heading5' class='form_subheading'>Allergies</h2>
               </div>
               <div id='label53_container' class='sfm_form_label'>
                  <label id='label53'>Is Camper allergic to Medicine?<br /></label>
               </div>
               <div class='element_label' id='allergy_food_yes_no_0_container'><input type='radio' name='allergy_food_yes_no' id='allergy_food_yes_no_radio_0' value='yes'/><label for='allergy_food_yes_no_radio_0' class='element_label' id='allergy_food_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='allergy_food_yes_no_1_container'><input type='radio' name='allergy_food_yes_no' id='allergy_food_yes_no_radio_1' value='no' tabindex='1'/><label for='allergy_food_yes_no_radio_1' class='element_label' id='allergy_food_yes_no_radio_1_label'>No</label></div>
               <div class='element_label' id='allergy_medicine_yes_no_0_container'><input type='radio' name='allergy_medicine_yes_no' id='allergy_medicine_yes_no_radio_0' value='yes'/><label for='allergy_medicine_yes_no_radio_0' class='element_label' id='allergy_medicine_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='allergy_medicine_yes_no_1_container'><input type='radio' name='allergy_medicine_yes_no' id='allergy_medicine_yes_no_radio_1' value='no' tabindex='1'/><label for='allergy_medicine_yes_no_radio_1' class='element_label' id='allergy_medicine_yes_no_radio_1_label'>No</label></div>
               <div id='label54_container' class='sfm_form_label'>
                  <label id='label54'>Is Camper allergic to the environment (insect stings, hay fever, etc?<br /></label>
               </div>
               <div id='label55_container' class='sfm_form_label'>
                  <label id='label55'>Does the camper have other allergies?<br /></label>
               </div>
               <div class='element_label' id='allergy_other_yes_no_0_container'><input type='radio' name='allergy_other_yes_no' id='allergy_other_yes_no_radio_0' value='yes'/><label for='allergy_other_yes_no_radio_0' class='element_label' id='allergy_other_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='allergy_other_yes_no_1_container'><input type='radio' name='allergy_other_yes_no' id='allergy_other_yes_no_radio_1' value='no' tabindex='1'/><label for='allergy_other_yes_no_radio_1' class='element_label' id='allergy_other_yes_no_radio_1_label'>No</label></div>
               <div class='element_label' id='allergy_enviornment_yes_no_0_container'><input type='radio' name='allergy_enviornment_yes_no' id='allergy_enviornment_yes_no_radio_0' value='yes'/><label for='allergy_enviornment_yes_no_radio_0' class='element_label' id='allergy_enviornment_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='allergy_enviornment_yes_no_1_container'><input type='radio' name='allergy_enviornment_yes_no' id='allergy_enviornment_yes_no_radio_1' value='no' tabindex='1'/><label for='allergy_enviornment_yes_no_radio_1' class='element_label' id='allergy_enviornment_yes_no_radio_1_label'>No</label></div>
               <div id='label56_container' class='sfm_form_label'>
                  <label id='label56'>Please describe what the camper is allergic to and the reaction seen.</label>
               </div>
               <div id='comments_allergies_container'><textarea name='comments_allergies' id='comments_allergies' cols='50' rows='8' class='sfm_textarea'></textarea></div>
               <div id='box_element4'></div>
               <div id='heading6_container' class='form_subheading'>
                  <h2 id='heading6' class='form_subheading'>Medication</h2>
               </div>
               <div id='label57_container'>
                  <div id='label57'>The following non-prescription medications may be stocked in the camp Health Center and are used on an as needed basis to manage illness and injury. Answer "Yes" or "No" to the following.</div>
               </div>
               <div id='label58_container'>
                  <div id='label58'>Can the camper be given:</div>
               </div>
               <div class='element_label' id='Tylenol_yes_no_0_container'><input type='radio' name='Tylenol_yes_no' id='Tylenol_yes_no_radio_0' value='yes'/><label for='Tylenol_yes_no_radio_0' class='element_label' id='Tylenol_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='Tylenol_yes_no_1_container'><input type='radio' name='Tylenol_yes_no' id='Tylenol_yes_no_radio_1' value='no' tabindex='1'/><label for='Tylenol_yes_no_radio_1' class='element_label' id='Tylenol_yes_no_radio_1_label'>No</label></div>
               <div class='element_label' id='Ibuprofen_yes_no_0_container'><input type='radio' name='Ibuprofen_yes_no' id='Ibuprofen_yes_no_radio_0' value='yes'/><label for='Ibuprofen_yes_no_radio_0' class='element_label' id='Ibuprofen_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='Ibuprofen_yes_no_1_container'><input type='radio' name='Ibuprofen_yes_no' id='Ibuprofen_yes_no_radio_1' value='no' tabindex='1'/><label for='Ibuprofen_yes_no_radio_1' class='element_label' id='Ibuprofen_yes_no_radio_1_label'>No</label></div>
               <div id='label59_container' class='sfm_form_label'>
                  <label id='label59'>Acetaminophen (Tylenol)?</label>
               </div>
               <div id='label66_container' class='sfm_form_label'>
                  <label id='label66'>Ibuprofen (Advil, Motrin)?</label>
               </div>
               <div class='element_label' id='Sudafed_PE_yes_no_0_container'><input type='radio' name='Sudafed_PE_yes_no' id='Sudafed_PE_yes_no_radio_0' value='yes'/><label for='Sudafed_PE_yes_no_radio_0' class='element_label' id='Sudafed_PE_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='Sudafed_PE_yes_no_1_container'><input type='radio' name='Sudafed_PE_yes_no' id='Sudafed_PE_yes_no_radio_1' value='no' tabindex='1'/><label for='Sudafed_PE_yes_no_radio_1' class='element_label' id='Sudafed_PE_yes_no_radio_1_label'>No</label></div>
               <div class='element_label' id='Sudafed_yes_no_0_container'><input type='radio' name='Sudafed_yes_no' id='Sudafed_yes_no_radio_0' value='yes'/><label for='Sudafed_yes_no_radio_0' class='element_label' id='Sudafed_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='Sudafed_yes_no_1_container'><input type='radio' name='Sudafed_yes_no' id='Sudafed_yes_no_radio_1' value='no' tabindex='1'/><label for='Sudafed_yes_no_radio_1' class='element_label' id='Sudafed_yes_no_radio_1_label'>No</label></div>
               <div id='label60_container' class='sfm_form_label'>
                  <label id='label60'>Phenylephrine decongestant (SudafedPE)?</label>
               </div>
               <div id='label67_container' class='sfm_form_label'>
                  <label id='label67'>Pseudoephedrine decongestant (Sudafed) ?</label>
               </div>
               <div class='element_label' id='allergy_med_yes_no_0_container'><input type='radio' name='allergy_med_yes_no' id='allergy_med_yes_no_radio_0' value='yes'/><label for='allergy_med_yes_no_radio_0' class='element_label' id='allergy_med_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='allergy_med_yes_no_1_container'><input type='radio' name='allergy_med_yes_no' id='allergy_med_yes_no_radio_1' value='no' tabindex='1'/><label for='allergy_med_yes_no_radio_1' class='element_label' id='allergy_med_yes_no_radio_1_label'>No</label></div>
               <div class='element_label' id='Robitussin_yes_no_0_container'><input type='radio' name='Robitussin_yes_no' id='Robitussin_yes_no_radio_0' value='yes'/><label for='Robitussin_yes_no_radio_0' class='element_label' id='Robitussin_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='Robitussin_yes_no_1_container'><input type='radio' name='Robitussin_yes_no' id='Robitussin_yes_no_radio_1' value='no' tabindex='1'/><label for='Robitussin_yes_no_radio_1' class='element_label' id='Robitussin_yes_no_radio_1_label'>No</label></div>
               <div id='label61_container' class='sfm_form_label'>
                  <label id='label61'>Antihistamine/allergy medicine ?</label>
               </div>
               <div id='label68_container' class='sfm_form_label'>
                  <label id='label68'>Guaifenesin cough syrup (Robitussin) ?</label>
               </div>
               <div class='element_label' id='Rob_DM_yes_no_0_container'><input type='radio' name='Rob_DM_yes_no' id='Rob_DM_yes_no_radio_0' value='yes'/><label for='Rob_DM_yes_no_radio_0' class='element_label' id='Rob_DM_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='Rob_DM_yes_no_1_container'><input type='radio' name='Rob_DM_yes_no' id='Rob_DM_yes_no_radio_1' value='no' tabindex='1'/><label for='Rob_DM_yes_no_radio_1' class='element_label' id='Rob_DM_yes_no_radio_1_label'>No</label></div>
               <div class='element_label' id='Benadryl_yes_no_0_container'><input type='radio' name='Benadryl_yes_no' id='Benadryl_yes_no_radio_0' value='yes'/><label for='Benadryl_yes_no_radio_0' class='element_label' id='Benadryl_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='Benadryl_yes_no_1_container'><input type='radio' name='Benadryl_yes_no' id='Benadryl_yes_no_radio_1' value='no' tabindex='1'/><label for='Benadryl_yes_no_radio_1' class='element_label' id='Benadryl_yes_no_radio_1_label'>No</label></div>
               <div id='label62_container' class='sfm_form_label'>
                  <label id='label62'>Diphenhydramine /allergy medicine (Benadryl) ?</label>
               </div>
               <div id='label69_container' class='sfm_form_label'>
                  <label id='label69'>Dextromethorphan cough syrup (Robitussin DM) ?</label>
               </div>
               <div class='element_label' id='Throat_spray_yes_no_0_container'><input type='radio' name='Throat_spray_yes_no' id='Throat_spray_yes_no_radio_0' value='yes'/><label for='Throat_spray_yes_no_radio_0' class='element_label' id='Throat_spray_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='Throat_spray_yes_no_1_container'><input type='radio' name='Throat_spray_yes_no' id='Throat_spray_yes_no_radio_1' value='no' tabindex='1'/><label for='Throat_spray_yes_no_radio_1' class='element_label' id='Throat_spray_yes_no_radio_1_label'>No</label></div>
               <div class='element_label' id='cough_drops_yes_no_0_container'><input type='radio' name='cough_drops_yes_no' id='cough_drops_yes_no_radio_0' value='yes'/><label for='cough_drops_yes_no_radio_0' class='element_label' id='cough_drops_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='cough_drops_yes_no_1_container'><input type='radio' name='cough_drops_yes_no' id='cough_drops_yes_no_radio_1' value='no' tabindex='1'/><label for='cough_drops_yes_no_radio_1' class='element_label' id='cough_drops_yes_no_radio_1_label'>No</label></div>
               <div id='label63_container' class='sfm_form_label'>
                  <label id='label63'>Sore throat spray?</label>
               </div>
               <div id='label70_container' class='sfm_form_label'>
                  <label id='label70'>Generic cough drops ?</label>
               </div>
               <div class='element_label' id='Calamine_yes_no_0_container'><input type='radio' name='Calamine_yes_no' id='Calamine_yes_no_radio_0' value='yes'/><label for='Calamine_yes_no_radio_0' class='element_label' id='Calamine_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='Calamine_yes_no_1_container'><input type='radio' name='Calamine_yes_no' id='Calamine_yes_no_radio_1' value='no' tabindex='1'/><label for='Calamine_yes_no_radio_1' class='element_label' id='Calamine_yes_no_radio_1_label'>No</label></div>
               <div class='element_label' id='aloe_yes_no_0_container'><input type='radio' name='aloe_yes_no' id='aloe_yes_no_radio_0' value='yes'/><label for='aloe_yes_no_radio_0' class='element_label' id='aloe_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='aloe_yes_no_1_container'><input type='radio' name='aloe_yes_no' id='aloe_yes_no_radio_1' value='no' tabindex='1'/><label for='aloe_yes_no_radio_1' class='element_label' id='aloe_yes_no_radio_1_label'>No</label></div>
               <div id='label64_container' class='sfm_form_label'>
                  <label id='label64'>Calamine lotion?</label>
               </div>
               <div id='label71_container' class='sfm_form_label'>
                  <label id='label71'>Aloe ?</label>
               </div>
               <div class='element_label' id='Laxatives_yes_no_0_container'><input type='radio' name='Laxatives_yes_no' id='Laxatives_yes_no_radio_0' value='yes'/><label for='Laxatives_yes_no_radio_0' class='element_label' id='Laxatives_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='Laxatives_yes_no_1_container'><input type='radio' name='Laxatives_yes_no' id='Laxatives_yes_no_radio_1' value='no' tabindex='1'/><label for='Laxatives_yes_no_radio_1' class='element_label' id='Laxatives_yes_no_radio_1_label'>No</label></div>
               <div id='label72_container' class='sfm_form_label'>
                  <label id='label72'>Kaopectate, Pepto-Bismol ?</label>
               </div>
               <div class='element_label' id='Pepto_yes_no_0_container'><input type='radio' name='Pepto_yes_no' id='Pepto_yes_no_radio_0' value='yes'/><label for='Pepto_yes_no_radio_0' class='element_label' id='Pepto_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='Pepto_yes_no_1_container'><input type='radio' name='Pepto_yes_no' id='Pepto_yes_no_radio_1' value='no' tabindex='1'/><label for='Pepto_yes_no_radio_1' class='element_label' id='Pepto_yes_no_radio_1_label'>No</label></div>
               <div id='label65_container' class='sfm_form_label'>
                  <label id='label65'>Laxatives for constipation (Ex-Lax) ?</label>
               </div>
               <div id='vert_line'></div>
               <div id='horiz_line1'></div>
               <div class='element_label' id='Meds_at_camp_true_false_0_container'><input type='radio' name='Meds_at_camp_true_false' id='Meds_at_camp_true_false_radio_0' value='true'/><label for='Meds_at_camp_true_false_radio_0' class='element_label' id='Meds_at_camp_true_false_radio_0_label'>This camper will take the following medications while at camp</label></div>
               <div class='element_label' id='Meds_at_camp_true_false_1_container'><input type='radio' name='Meds_at_camp_true_false' id='Meds_at_camp_true_false_radio_1' value='false' tabindex='1'/><label for='Meds_at_camp_true_false_radio_1' class='element_label' id='Meds_at_camp_true_false_radio_1_label'>This camper will not take any daily medications while attending camp</label></div>
               <div id='label73_container'>
                  <div id='label73'>"Medication" is any substance a person takes to maintain and/or improve their health. This includes vitamins & natural remedies. Please review camp instructions about required packaging/containers. Maryland requires original pharmacy containers with labels which show the camper’s name and how the medication should be given. Provide enough of each medication to last the entire time the camper will be at camp.</div>
               </div>
               <div id='label74_container'>
                  <div id='label74'>Medication Name</div>
               </div>
               <div id='label75_container'>
                  <div id='label75'>Date Started<br /></div>
               </div>
               <div id='label76_container'>
                  <div id='label76'>Reason for Taking<br /></div>
               </div>
               <div id='label77_container'>
                  <div id='label77'>When is it given?</div>
               </div>
               <div id='label78_container'>
                  <div id='label78'>Dose Amount</div>
               </div>
               <div id='label79_container'>
                  <div id='label79'>How is it given?<br /></div>
               </div>
               <div class='sfm_element_container' id='med_date_1_container'>
                  <input type='text' name='med_date_1' id='med_date_1'/>
                  <input type='text' name='sfm_med_date_1_parsed' id='sfm_med_date_1_parsed' tabindex='-1' style='display:none'/>
                  <div id='med_date_1_image_container'>
                     <img id='med_date_1_image' class='sfm_datepicker_icon' src='images/date-picker.gif' width='20' height='20' alt='Click here to open the date picker'/>
                  </div>
               </div>
               <div id='med_name_1_container'><textarea name='med_name_1' id='med_name_1' cols='50' rows='8' class='sfm_textarea'></textarea></div>
               <div id='med_reason_1_container'><textarea name='med_reason_1' id='med_reason_1' cols='50' rows='8' class='sfm_textarea'></textarea></div>
               <div id='med_time_1_container'><textarea name='med_time_1' id='med_time_1' cols='50' rows='8' class='sfm_textarea'></textarea></div>
               <div id='med_amount_1_container'><textarea name='med_amount_1' id='med_amount_1' cols='50' rows='8' class='sfm_textarea'></textarea></div>
               <div id='med_how_1_container'><textarea name='med_how_1' id='med_how_1' cols='50' rows='8' class='sfm_textarea'></textarea></div>
               <div class='sfm_element_container' id='med_date_2_container'>
                  <input type='text' name='med_date_2' id='med_date_2'/>
                  <input type='text' name='sfm_med_date_2_parsed' id='sfm_med_date_2_parsed' tabindex='-1' style='display:none'/>
                  <div id='med_date_2_image_container'>
                     <img id='med_date_2_image' class='sfm_datepicker_icon' src='images/date-picker.gif' width='20' height='20' alt='Click here to open the date picker'/>
                  </div>
               </div>
               <div id='med_name_2_container'><textarea name='med_name_2' id='med_name_2' cols='50' rows='8' class='sfm_textarea'></textarea></div>
               <div id='med_reason_2_container'><textarea name='med_reason_2' id='med_reason_2' cols='50' rows='8' class='sfm_textarea'></textarea></div>
               <div id='med_time_2_container'><textarea name='med_time_2' id='med_time_2' cols='50' rows='8' class='sfm_textarea'></textarea></div>
               <div id='med_amount_2_container'><textarea name='med_amount_2' id='med_amount_2' cols='50' rows='8' class='sfm_textarea'></textarea></div>
               <div id='med_how_2_container'><textarea name='med_how_2' id='med_how_2' cols='50' rows='8' class='sfm_textarea'></textarea></div>
               <div class='sfm_element_container' id='med_date_3_container'>
                  <input type='text' name='med_date_3' id='med_date_3'/>
                  <input type='text' name='sfm_med_date_3_parsed' id='sfm_med_date_3_parsed' tabindex='-1' style='display:none'/>
                  <div id='med_date_3_image_container'>
                     <img id='med_date_3_image' class='sfm_datepicker_icon' src='images/date-picker.gif' width='20' height='20' alt='Click here to open the date picker'/>
                  </div>
               </div>
               <div id='med_name_3_container'><textarea name='med_name_3' id='med_name_3' cols='50' rows='8' class='sfm_textarea'></textarea></div>
               <div id='med_reason_3_container'><textarea name='med_reason_3' id='med_reason_3' cols='50' rows='8' class='sfm_textarea'></textarea></div>
               <div id='med_time_3_container'><textarea name='med_time_3' id='med_time_3' cols='50' rows='8' class='sfm_textarea'></textarea></div>
               <div id='med_amount_3_container'><textarea name='med_amount_3' id='med_amount_3' cols='50' rows='8' class='sfm_textarea'></textarea></div>
               <div id='med_how_3_container'><textarea name='med_how_3' id='med_how_3' cols='50' rows='8' class='sfm_textarea'></textarea></div>
               <div id='horiz_line2'></div>
               <div id='label80_container'>
                  <div id='label80'>General Health History: Check "Yes" or "No for each statement. Explain "Yes" answers in the box provided</div>
               </div>
               <div id='label81_container'>
                  <div id='label81'>Has/Does the camper:<br /></div>
               </div>
               <div id='label82_container' class='sfm_form_label'>
                  <label id='label82'>Passed out/had chest pain during exercise?</label>
               </div>
               <div class='element_label' id='passed_out_yes_no_0_container'><input type='radio' name='passed_out_yes_no' id='passed_out_yes_no_radio_0' value='yes'/><label for='passed_out_yes_no_radio_0' class='element_label' id='passed_out_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='passed_out_yes_no_1_container'><input type='radio' name='passed_out_yes_no' id='passed_out_yes_no_radio_1' value='no' tabindex='1'/><label for='passed_out_yes_no_radio_1' class='element_label' id='passed_out_yes_no_radio_1_label'>No</label></div>
               <div id='label87_container' class='sfm_form_label'>
                  <label id='label87'>Had seizures?</label>
               </div>
               <div class='element_label' id='seizures_yes_no_0_container'><input type='radio' name='seizures_yes_no' id='seizures_yes_no_radio_0' value='yes'/><label for='seizures_yes_no_radio_0' class='element_label' id='seizures_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='seizures_yes_no_1_container'><input type='radio' name='seizures_yes_no' id='seizures_yes_no_radio_1' value='no' tabindex='1'/><label for='seizures_yes_no_radio_1' class='element_label' id='seizures_yes_no_radio_1_label'>No</label></div>
               <div class='element_label' id='recent_disease_yes_no_0_container'><input type='radio' name='recent_disease_yes_no' id='recent_disease_yes_no_radio_0' value='yes'/><label for='recent_disease_yes_no_radio_0' class='element_label' id='recent_disease_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='recent_disease_yes_no_1_container'><input type='radio' name='recent_disease_yes_no' id='recent_disease_yes_no_radio_1' value='no' tabindex='1'/><label for='recent_disease_yes_no_radio_1' class='element_label' id='recent_disease_yes_no_radio_1_label'>No</label></div>
               <div class='element_label' id='skin_problems_yes_no_0_container'><input type='radio' name='skin_problems_yes_no' id='skin_problems_yes_no_radio_0' value='yes'/><label for='skin_problems_yes_no_radio_0' class='element_label' id='skin_problems_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='skin_problems_yes_no_1_container'><input type='radio' name='skin_problems_yes_no' id='skin_problems_yes_no_radio_1' value='no' tabindex='1'/><label for='skin_problems_yes_no_radio_1' class='element_label' id='skin_problems_yes_no_radio_1_label'>No</label></div>
               <div id='label83_container' class='sfm_form_label'>
                  <label id='label83'>Had a recent infectious disease?</label>
               </div>
               <div id='label88_container' class='sfm_form_label'>
                  <label id='label88'>Have any skin problems?</label>
               </div>
               <div class='element_label' id='recent_injury_yes_no_0_container'><input type='radio' name='recent_injury_yes_no' id='recent_injury_yes_no_radio_0' value='yes'/><label for='recent_injury_yes_no_radio_0' class='element_label' id='recent_injury_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='recent_injury_yes_no_1_container'><input type='radio' name='recent_injury_yes_no' id='recent_injury_yes_no_radio_1' value='no' tabindex='1'/><label for='recent_injury_yes_no_radio_1' class='element_label' id='recent_injury_yes_no_radio_1_label'>No</label></div>
               <div class='element_label' id='sleep_problems_yes_no_0_container'><input type='radio' name='sleep_problems_yes_no' id='sleep_problems_yes_no_radio_0' value='yes'/><label for='sleep_problems_yes_no_radio_0' class='element_label' id='sleep_problems_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='sleep_problems_yes_no_1_container'><input type='radio' name='sleep_problems_yes_no' id='sleep_problems_yes_no_radio_1' value='no' tabindex='1'/><label for='sleep_problems_yes_no_radio_1' class='element_label' id='sleep_problems_yes_no_radio_1_label'>No</label></div>
               <div id='label84_container' class='sfm_form_label'>
                  <label id='label84'>Had a recent injury?</label>
               </div>
               <div id='label89_container' class='sfm_form_label'>
                  <label id='label89'>Have problems with falling asleep/sleepwalking?</label>
               </div>
               <div class='element_label' id='breathing_problem_yes_no_0_container'><input type='radio' name='breathing_problem_yes_no' id='breathing_problem_yes_no_radio_0' value='yes'/><label for='breathing_problem_yes_no_radio_0' class='element_label' id='breathing_problem_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='breathing_problem_yes_no_1_container'><input type='radio' name='breathing_problem_yes_no' id='breathing_problem_yes_no_radio_1' value='no' tabindex='1'/><label for='breathing_problem_yes_no_radio_1' class='element_label' id='breathing_problem_yes_no_radio_1_label'>No</label></div>
               <div class='element_label' id='diarrhea_constipation_yes_no_0_container'><input type='radio' name='diarrhea_constipation_yes_no' id='diarrhea_constipation_yes_no_radio_0' value='yes'/><label for='diarrhea_constipation_yes_no_radio_0' class='element_label' id='diarrhea_constipation_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='diarrhea_constipation_yes_no_1_container'><input type='radio' name='diarrhea_constipation_yes_no' id='diarrhea_constipation_yes_no_radio_1' value='no' tabindex='1'/><label for='diarrhea_constipation_yes_no_radio_1' class='element_label' id='diarrhea_constipation_yes_no_radio_1_label'>No</label></div>
               <div id='label85_container' class='sfm_form_label'>
                  <label id='label85'>Had a asthma/wheezing/shortness of breath?</label>
               </div>
               <div id='label90_container' class='sfm_form_label'>
                  <label id='label90'>Have problems with diarrhea/constipation?</label>
               </div>
               <div class='element_label' id='diabetes_yes_no_0_container'><input type='radio' name='diabetes_yes_no' id='diabetes_yes_no_radio_0' value='yes'/><label for='diabetes_yes_no_radio_0' class='element_label' id='diabetes_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='diabetes_yes_no_1_container'><input type='radio' name='diabetes_yes_no' id='diabetes_yes_no_radio_1' value='no' tabindex='1'/><label for='diabetes_yes_no_radio_1' class='element_label' id='diabetes_yes_no_radio_1_label'>No</label></div>
               <div class='element_label' id='glasses_yes_no_0_container'><input type='radio' name='glasses_yes_no' id='glasses_yes_no_radio_0' value='yes'/><label for='glasses_yes_no_radio_0' class='element_label' id='glasses_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='glasses_yes_no_1_container'><input type='radio' name='glasses_yes_no' id='glasses_yes_no_radio_1' value='no' tabindex='1'/><label for='glasses_yes_no_radio_1' class='element_label' id='glasses_yes_no_radio_1_label'>No</label></div>
               <div id='label86_container' class='sfm_form_label'>
                  <label id='label86'>Have diabetes?</label>
               </div>
               <div id='label91_container' class='sfm_form_label'>
                  <label id='label91'>Wear glasses, contacts, or protective eyewear?</label>
               </div>
               <div id='vert_line1'></div>
               <div id='horiz_line3'></div>
               <div id='label92_container'>
                  <div id='label92'>Please explain "Yes" answers in the space below</div>
               </div>
               <div id='health_history_Yes_explain_container'><textarea name='health_history_Yes_explain' id='health_history_Yes_explain' cols='50' rows='8' class='sfm_textarea'></textarea></div>
               <div id='horiz_line4'></div>
               <div id='label93_container'>
                  <div id='label93'>Mental, Emotional, and Social Helath: Check "Yes" or "No" for each statement.</div>
               </div>
               <div id='label98_container'>
                  <div id='label98'>Please explain "Yes" answers in the space below<br /></div>
               </div>
               <div id='label94_container'>
                  <div id='label94'>Has the camper:<br /></div>
               </div>
               <div class='element_label' id='ADD_ADHD_yes_no_0_container'><input type='radio' name='ADD_ADHD_yes_no' id='ADD_ADHD_yes_no_radio_0' value='yes'/><label for='ADD_ADHD_yes_no_radio_0' class='element_label' id='ADD_ADHD_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='ADD_ADHD_yes_no_1_container'><input type='radio' name='ADD_ADHD_yes_no' id='ADD_ADHD_yes_no_radio_1' value='no' tabindex='1'/><label for='ADD_ADHD_yes_no_radio_1' class='element_label' id='ADD_ADHD_yes_no_radio_1_label'>No</label></div>
               <div id='label95_container' class='sfm_form_label'>
                  <label id='label95'>Ever been treated for attention deficit disorder (ADD) or attention deficit/hyperactivity disorder (AD?HD)?</label>
               </div>
               <div class='element_label' id='emotional_yes_no_0_container'><input type='radio' name='emotional_yes_no' id='emotional_yes_no_radio_0' value='yes'/><label for='emotional_yes_no_radio_0' class='element_label' id='emotional_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='emotional_yes_no_1_container'><input type='radio' name='emotional_yes_no' id='emotional_yes_no_radio_1' value='no' tabindex='1'/><label for='emotional_yes_no_radio_1' class='element_label' id='emotional_yes_no_radio_1_label'>No</label></div>
               <div id='label96_container' class='sfm_form_label'>
                  <label id='label96'>Ever been treated for emotional or behavioral difficulties or an eating disorder?</label>
               </div>
               <div class='element_label' id='mental_illness_yes_no_0_container'><input type='radio' name='mental_illness_yes_no' id='mental_illness_yes_no_radio_0' value='yes'/><label for='mental_illness_yes_no_radio_0' class='element_label' id='mental_illness_yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='mental_illness_yes_no_1_container'><input type='radio' name='mental_illness_yes_no' id='mental_illness_yes_no_radio_1' value='no' tabindex='1'/><label for='mental_illness_yes_no_radio_1' class='element_label' id='mental_illness_yes_no_radio_1_label'>No</label></div>
               <div id='label97_container' class='sfm_form_label'>
                  <label id='label97'>During the past 12 months, seen a professional to address mental/emotional health concerns?</label>
               </div>
               <div id='Mental_comments_container'><textarea name='Mental_comments' id='Mental_comments' cols='50' rows='8' class='sfm_textarea'></textarea></div>
               <div id='box_element5'></div>
               <div id='heading7_container' class='form_subheading'>
                  <h2 id='heading7' class='form_subheading'>Please read and agree to the terms and conditions.</h2>
               </div>
               <div id='label99_container'>
                  <div id='label99'>WHEREAS, certain circumstances and situations may occur resulting in my child's need for medical/dental care and treatment, and further resulting in my inability to give personal consent for such care and treatment,<br /><br />THEREFORE,<br /><br />1. In consideration of permission for my child to participate in said camp program, I,</div>
               </div>
               <div id='Parents_container'>
                   <input type='text' name='Parents' id='Parents' size='20' class='sfm_textbox' onclick="return fillname()" readonly/>
               </div>
               <div id='label100_container'>
                  <div id='label100'>being of legal age, authorize Camp Wabanna or any agent of Wabanna Bible Conference, Inc. to act in my child's behalf should I be unable to do so and to consent to reasonable medical/dental care and treatment, including but not limited to diagnostic tests, x-ray examination, anesthesia, surgery, or any other procedures which may be deemed necessary for my child's medical well-being for the duration of the camp stay.<br /><br />2. I recognize that this consent is given in advance of any specific diagnosis, treatment, surgery, hospital care, or any other procedure required, but is necessary to provide authorization and specific consent for medical/dental treatment and care in my child's behalf due to the nature and destination of the program.<br /><br />3. Any consent by Camp Wabanna, or any agent of Wabanna Bible Conference, Inc., shall have the same force and effect as if I had personally signed the consent.<br /><br />4. I certify that I have personal health insurance with:</div>
               </div>
               <div id='label101_container' class='sfm_form_label'>
                  <label id='label101'>Company</label>
               </div>
               <div id='label102_container' class='sfm_form_label'>
                  <label id='label102'>Policy Number:<br /></label>
               </div>
               <div id='Insurance_Company_container'>
                  <input type='text' name='Insurance_Company' id='Insurance_Company' size='20' class='sfm_textbox'/>
               </div>
               <div id='Policy_Number_container'>
                  <input type='text' name='Policy_Number' id='Policy_Number' size='20' class='sfm_textbox'/>
               </div>
               <div id='label103_container'>
                  <div id='label103'>with no territorial limitations, which will provide coverage for my child during the duration of said program. I understand that no health plan is provided through Camp<br /><br />Wabanna, and any expenses resulting from medical treatment of<br /></div>
               </div>
               <div id='CamperName_container'>
                   <input type='text' name='CamperName' id='CamperName' size='20' class='sfm_textbox 'onclick="return fillname()" readonly/>
               </div>
               <div id='label104_container'>
                  <div id='label104'>are my sole responsibility. Should Camp Wabanna incur any expenses for the medical treatment of my child, I shall reimburse Camp Wabanna within 30 days of receiving the bill from Camp Wabanna.<br /><br /><br />5. I am aware that serious illness requiring transportation by ambulance can be quite costly and that coverage for this type of service is not covered by any health plan available through Camp Wabanna. I agree that I am responsible for any expenses that may arise from my child's transportation by ambulance or other extraordinary means.<br /><br /><br />6. I hereby release and hold harmless Wabanna Bible Conference, Inc. and their officers, and employees from all liability for bodily personal injury, arising as a result of medical/dental treatment given pursuant to this prior consent.<br /><br />7. By signing below, I acknowledge and accept the risks of physical injury associated with participation in the camp program and field trips. Except for gross negligence on the part of the camp, I accept personal financial responsibility for any bodily or personal injury sustained during the camp program or field trips. Further, I promise to release and hold harmless Wabanna Bible Conference, Inc. and its representatives for any injury related to the activity. I recognize that certain hazards and dangers are inherent in camp events and programs. And particularly but not limited to, swimming, boating, field activities, ropes courses, team courses, tower climbing, water tubing, canoeing. I understand that adventure activities may expose my child to psychologically and physically stressful and challenging situations. I understand, too, that although the program has taken precautions to provide proper organization, supervision, instruction, and equipment for each activity, it is impossible for the program to guarantee absolute safety. I understand that my child shares responsibility for his/her safety and I have instructed my child in the importance of knowing and abiding by the camp rules, regulations, and procedures for his/ her safety of camp participant.<br /><br />8. By signing below, I acknowledge and accept that Camp Wabanna reserves the right to discipline or send home any child for any reason in its sole discretion. General reasons for immediate dismissal include, but are not limited to any of the following: or if a child is defiant, uncooperative, and will not or cannot participate in the normal program. Campers sent home due to behavioral problems are not allowed to return. No refund will be given if a child is sent home for behavioral reasons. If a departure need arises, parents/guardians or emergency contacts will be notified. Upon notification, the parent/guardian will be allowed a maximum time of four hours to remove their child from camp property.<br />9. By signing below, I acknowledge and accept that Camp Wabanna reserves the right to send home any child if a health situation puts another individual in jeopardy, if the camper needs special health attention, if a child has a temperature above 101 degrees, pink eye, ring worm, lice, strep throat, or any infectious situation; Campers sent home due to medical reasons can only return to camp with a doctor’s release and must be able to participate in the normal camp program. No refund will be given if a child is sent home for medical reasons. If a departure need arises, parents/guardians or emergency contacts will be notified. Upon notification, the parent/guardian will be allowed a maximum time of four hours to remove their child from camp property.<br /><br />10. By signing below, I acknowledge and accept Camp Wabanna’s cancellation policy. That cancellation for any reason before June 1st forfeits $150. There are no refunds for cancellation for any reason after June 1st.<br /><br />11. By signing below, I acknowledge and give permission for the use of photographs, or other media, including my son or daughter to be used in camp publicity.<br /><br />If a dispute over this agreement or any claim for damages arises, I agree to resolve the matter through a mutually acceptable arbitration process.<br /><br />I HAVE READ ALL THE AFOREMENTIONED INFORMATION AND I AGREE TO COOPERATE AND ADHERE TO THESE GUIDELINES. TO THE BEST OF MY KNOWLEDGE, THE INFORMATION GIVEN ON THESE TWO PAGES IS COMPLETE AND ACCURATE.</div>
               </div>
               <div class='element_label' id='i_agree_container'><input type='checkbox' name='i_agree' id='i_agree' value='on'/><label for='i_agree' class='element_label' id='i_agree_label'>I Agree to the Terms and Conditions</label></div>
               <div id='Submit_container' class='loading_div'>
                  <input type='submit' name='Submit' value='Submit' id='Submit'/>
               </div>
               <div id='box_element6'></div>
            </div>
         </div>
<div class='sfm_cr_box' style='padding:3px; width:350px;cursor:default'>Proudly powered by: Simfatic Forms <a style='text-decoration:none;' rel='nofollow' href='http://www.simfatic.com'>wysiwyg form builder</a>.</div>
      </form>
      <script type='text/javascript'>
// <![CDATA[
$(function()
{
   //$('form#Registration_Form #Age').formCalc(" age( DOB )",{ mirror:'sfm_Age_parsed'});
   
   new sfm_calendar({input_id:"DOB",image_id:"DOB_image",form_id:"Registration_Form",mirror:"sfm_DOB_parsed",yearRange:"1999:2010"})
   new sfm_calendar({input_id:"med_date_1",image_id:"med_date_1_image",form_id:"Registration_Form",mirror:"sfm_med_date_1_parsed"})
   new sfm_calendar({input_id:"med_date_2",image_id:"med_date_2_image",form_id:"Registration_Form",mirror:"sfm_med_date_2_parsed"})
   new sfm_calendar({input_id:"med_date_3",image_id:"med_date_3_image",form_id:"Registration_Form",mirror:"sfm_med_date_3_parsed"})
   sfm_show_loading_on_formsubmit('Registration_Form','Submit');
});

// ]]>
      </script>
      
       <script>
           function fillname() {
    document.getElementsByName("CamperName")[0].value = document.getElementsByName("FirstName")[0].value;
    var fatherFirstName = document.getElementsByName("first_name_f")[0].value;
    var fatherLastName = document.getElementsByName("last_name_f")[0].value;
    var Father = fatherFirstName + " " + fatherLastName;
    var motherFirstName = document.getElementsByName("first_name_m")[0].value;
    var motherLastName = document.getElementsByName("last_name_m")[0].value;
    var Mother = motherFirstName + " " + motherLastName;
    document.getElementsByName('Parents')[0].value = Father + " and " + Mother;
    return false;
}
       </script>
       <script>
    $(function () {
            $(":file").change(function () {
                if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
             reader.readAsDataURL(this.files[0]);
            }
        });
    });

    function imageIsLoaded(e) {
            $('#myImg').attr('src', e.target.result);
        };
       
       </script>
       <script type="text/javascript" language="javascript">
function calcAge(dtFrom, dtTo)
{
    var a = dtTo.getDate() + (dtTo.getMonth() + (dtTo.getFullYear() - 1700) * 16) * 32;
    var b = dtFrom.getDate() + (dtFrom.getMonth() + (dtFrom.getFullYear() - 1700) * 16) * 32;
    var x = Math.floor((a - b) / 32 / 16);
    return x < 0 ? null : x;
}
function calc()
{
    var dtTo = new Date(document.getElementById('enddate').value);
    var dtFrom = new Date(document.getElementById('DOB').value);
    document.getElementById('Age').value = calcAge(dtFrom, dtTo);
    return false;
}
</script>
   </body>
</html>

