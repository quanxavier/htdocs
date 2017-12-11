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
            $Camper = $_SESSION['Camper'];
            $name = explode(" ", $Camper);
            $Firstname = $name[0];
            $Lastname = $name[2];
           
       $qry = "SELECT * FROM camper_info left join parent_guardian_info on camper_info.camper_id = parent_guardian_info.camper_id where FirstName = '$Firstname' and LastName = '$Lastname'";
       $result = mysqli_query($connection, $qry);
         
        if (!$result) {
            
        }   
      $row = mysqli_fetch_assoc( $result ); 
      $_SESSION['camper_id'] = $row['camper_id'];
      
      $qry1 = "SELECT * FROM camper_info left join roommate on camper_info.camper_id = roommate.camper_id where FirstName = '$Firstname' and LastName = '$Lastname'";
       $result1 = mysqli_query($connection, $qry1);
         
        if (!$result1) {
            
        }   
      $row1 = mysqli_fetch_assoc( $result1 ); 
      

 if(isset($_POST['submitted']))
{  $_SESSION['FirstName'] = $_POST['FirstName'];
    if(!$fgmembersite->Update_Camper())
   {
      
   }
  
}

 
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>Camper Information</title>
    <link rel="STYLESHEET" type="text/css" href="style/camper_info.css" />
    <script src='scripts/jquery-1.7.2.min.js' type='text/javascript'></script>
      <script src='scripts/jquery-ui-1.8.18.custom.min.js' type='text/javascript'></script>
      <script src='scripts/globalize.js' type='text/javascript'></script>
      <script src='scripts/jquery-ui-1.8.21.custom.date.min.js' type='text/javascript'></script>
      <script src='scripts/moment.js' type='text/javascript'></script>
      <script src='scripts/sfm_calendar.js' type='text/javascript'></script>
      <script src='scripts/jquery.sim.number.js' type='text/javascript'></script>
      <script src='scripts/jquery.sim.utils.js' type='text/javascript'></script>
      <script src='scripts/sfm_validatorv7.js' type='text/javascript'></script>
      <link rel='stylesheet' type='text/css' href='style/jquery-ui-1.8.16.css'/>   
</head>
<body id='sfm_fg_membersite_body'>

<!-- Form Code Start -->
<div id='fg_membersite'>
    <form id='campinfo' method='post' accept-charset='UTF-8'>
<fieldset >
<legend></legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>

<div class='short_explanation'></div>



<div id='fg_membersite_errorloc' class='error_strings' style='width:1209px;text-align:left'></div>
         <div id='fg_membersite_outer_div' class='form_outer_div' style='width:1209px;height:1478px'>
         <div style='position:relative' id='fg_membersite_inner_div'>
<div id='label_container'>
                  <div id='label'>2016 Residential Registration Form<br />Ages 7-16</div>
               </div>
               <div id='Image1_container'>
                  <img class='sfm_image_in_form' src='images/CampWabannaLogo_sized.png' width='346' height='103' alt=''/>
               </div>
               <div id='Image_container'>
                  <img class='sfm_image_in_form' src='images/photo1236 (1).jpg' width='223' height='140' alt=''/>
               </div>
               <div id='heading_container' class='form_subheading'>
                  <h2 id='heading' class='form_subheading'>Camper Information</h2>
               </div>


<div id='label4_container' class='sfm_form_label'>
                  <label id='label4' for='FirstName'>First Name</label>
               </div>
 <div id='FirstName_container'>
                  <input type='text' name='FirstName' value='<?php echo $row['FirstName']?>'id='FirstName' size='20' class='sfm_textbox'/>
               </div>              

<div id='label5_container' class='sfm_form_label'>
                  <label id='label5' for='LastName'>Last Name</label>
               </div>
               
<div id='LastName_container'>
                  <input type='text' name='LastName' value='<?php echo $row['LastName']?>'id='LastName' size='20' class='sfm_textbox'/>
               </div>               

<div id='label2_container' class='sfm_form_label'>
                  <label id='label2' for='Address'>Address</label>
               </div>
               <div id='Address_container'>
                  <input type='text' name='Address' value='<?php echo $row['Address']?>'id='Address' size='20' class='sfm_textbox'/>
              
</div>
<div id='label3_container' class='sfm_form_label'>
                  <label id='label3' for='City'>City</label>
               </div>
               <div id='label6_container' class='sfm_form_label'>
                  <label id='label6' for='State'>State</label>
               </div>
               <div id='City_container'>
                  <input type='text' name='City' value='<?php echo $row['City']?>' id='City' size='20' class='sfm_textbox'/>
               </div>
               <div id='zip_container'>
                  <input type='text' name='zip' value='<?php echo $row['zip']?>' id='zip' size='20' class='sfm_textbox'/>
               </div>
               <div id='label7_container' class='sfm_form_label'>
                  <label id='label7' for='Zip'>Zip</label>
               </div>
               <div id='label12_container' class='sfm_form_label'>
                  <label id='label12' for='county'>County</label>
               </div>
               <div id='state_container'>
                  <select name='state' id='state' size='1'>
                      <?php
        echo "<option value=\"{$row['state']}\">";
        echo $row['state'];
        echo "</option>";
    
?>  
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
                     <option value='New_Hampshire'>New Hampshire</option>
                     <option value='New_Jersey'>New Jersey</option>
                     <option value='New_Mexico'>New Mexico</option>
                     <option value='New_York'>New York</option>
                     <option value='North_Carolina'>North Carolina</option>
                     <option value='North_Dakota'>North Dakota</option>
                     <option value='Ohio'>Ohio</option>
                     <option value='Oklahoma'>Oklahoma</option>
                     <option value='Oregon'>Oregon</option>
                     <option value='Pennsylvania'>Pennsylvania</option>
                     <option value='Rhode_Island'>Rhode Island</option>
                     <option value='South_Carolina'>South Carolina</option>
                     <option value='South_Dakota'>South Dakota</option>
                     <option value='Tennessee'>Tennessee</option>
                     <option value='Texas'>Texas</option>
                     <option value='Utah'>Utah</option>
                     <option value='Vermont'>Vermont</option>
                     <option value='Virginia'>Virginia</option>
                     <option value='Washington'>Washington</option>
                     <option value='Virginia'>West</option>
                     <option value='Wisconsin'>Wisconsin</option>
                     <option value='Wyoming'>Wyoming</option>
                     
                  </select>
               </div>
               <div id='county_container'>
                  <input type='text' name='county' value='<?php echo $row['county']?>' id='county' size='20' class='sfm_textbox'/>
               </div>
               <div id='comment_container'><textarea name='comment' id='comment' class='sfm_textarea'></textarea></div>

<div id='label8_container' class='sfm_form_label'>
                  <label id='label8' for='DOB'>Date of Birth</label>
               </div>
               <div id='label9_container' class='sfm_form_label'>
                  <label id='label9' for='Age'>Age</label>
               </div>
               <div class='DOB_container' id='DOB_container'>
                  <input type='text'value='<?php echo $row['DOB']?>' name='DOB' id='DOB'/>
                  <input type='text' name='sfm_DOB_parsed' id='sfm_DOB_parsed' tabindex='-1' style='display:none'/>
                    <div id='DOB_image_container'>
                     <img id='DOB_image' class='sfm_datepicker_icon' src='images/date-picker.gif' width='20' height='20' alt='Click here to open the date picker'/>
                     </div>
                  
               </div>
               <div id='Age_container'>
                  <input type='text' name='Age' value='<?php echo $row['Age']?>' id='Age' size='20' class='sfm_textbox'/>
               </div>
               <div id='label10_container' class='sfm_form_label'>
                  <label id='label10' for='Grade'>Current Grade</label>
               </div>
               <div id='Grade_container'>
                  <input type='text' name='Grade'value='<?php echo $row['Grade']?>' id='Grade'/>
                  <input type='text' name='sfm_Grade_parsed' id='sfm_Grade_parsed' tabindex='-1' style='display:none'/>
               </div>
               <div id='label1_container' class='sfm_form_label'>
                  <label id='label1'>Gender</label>
               </div>
               <div id='label11_container' class='sfm_form_label'>
                  <label id='label11'>Is this your first summer with us?</label>
               </div>
               <div class='element_label' id='Gender_0_container'><input type='radio' name='Gender' id='Gender_radio_0' value='male'<?php echo ($row['Gender'] == 'male') ? 'checked="checked"' : ''; ?>/><label for='Gender_radio_0' class='element_label' id='Gender_radio_0_label'>Male</label></div>
               <div class='element_label' id='Gender_1_container'><input type='radio' name='Gender' id='Gender_radio_1' value='female'<?php echo ($row['Gender'] == 'female') ? 'checked="checked"' : ''; ?> tabindex='1'/><label for='Gender_radio_1' class='element_label' id='Gender_radio_1_label'>Female</label></div>
               <div id='label19_container' class='sfm_form_label'>
                  <label id='label19' for='comment'>How did you hear about us?</label>
               </div>
               <div class='element_label' id='yes_no_0_container'><input type='radio' name='yes_no' id='yes_no_radio_0' value='yes'<?php echo ($row['yes_no'] == 'yes') ? 'checked="checked"' : ''; ?>/><label for='yes_no_radio_0' class='element_label' id='yes_no_radio_0_label'>Yes</label></div>
               <div class='element_label' id='yes_no_1_container'><input type='radio' name='yes_no' id='yes_no_radio_1' value='no'<?php echo ($row['yes_no'] == 'no') ? 'checked="checked"' : ''; ?> tabindex='1'/><label for='yes_no_radio_1' class='element_label' id='yes_no_radio_1_label'>No</label></div>
               <div id='box_element'></div>
               
                              <div id='box_element'></div>-
               <div id='heading1_container' class='form_subheading'>
                  <h2 id='heading1' class='form_subheading'>Parent/Gaurdian information</h2>
               </div>
               <div id='label13_container' class='sfm_form_label'>
                  <label id='label13' for='first_name_f'>Father's First Name</label>
               </div>
               <div id='label14_container' class='sfm_form_label'>
                  <label id='label14' for='last_name_f'>Father's Last Name</label>
               </div>
               <div id='first_name_f_container'>
                  <input type='text' name='first_name_f' value='<?php echo $row['first_name_f']?>' id='first_name_f' size='20' class='sfm_textbox'/>
               </div>
               <div id='label21_container' class='sfm_form_label'>
                  <label id='label21' for='email_f'>Father's email address</label>
               </div>
               <div id='last_name_f_container'>
                  <input type='text' name='last_name_f'value='<?php echo $row['last_name_f']?>' id='last_name_f' size='20' class='sfm_textbox'/>
               </div>
               <div id='email_f_container'>
                  <input type='text' name='email_f' value='<?php echo $row['email_f']?>'id='email_f' size='20' class='sfm_textbox'/>
               </div>
               <div id='label15_container' class='sfm_form_label'>
                  <label id='label15' for='home_phone_f'>Home Phone</label>
               </div>
               <div id='label16_container' class='sfm_form_label'>
                  <label id='label16' for='work_phone_f'>Work Phone</label>
               </div>
               <div id='label17_container' class='sfm_form_label'>
                  <label id='label17' for='cell_phone_f'>Cell Phone</label>
               </div>
               <div id='home_phone_f_container'>
                  <input type='text' name='home_phone_f' value='<?php echo $row['home_phone_f']?>'id='home_phone_f' size='20' class='sfm_textbox'/>
               </div>
               <div id='work_phone_f_container'>
                  <input type='text' name='work_phone_f' value='<?php echo $row['work_phone_f']?>'id='work_phone_f' size='20' class='sfm_textbox'/>
               </div>
               <div id='cell_phone_f_container'>
                  <input type='text' name='cell_phone_f' value='<?php echo $row['cell_phone_f']?>' id='cell_phone_f' size='20' class='sfm_textbox'/>
               </div>
               <div id='label22_container' class='sfm_form_label'>
                  <label id='label22' for='confirm_email_f'>Confirm email</label>
               </div>
               <div id='confirm_email_f_container'>
                  <input type='text' name='confirm_email_f' value='<?php echo $row['email_f']?>' id='confirm_email_f' size='20' class='sfm_textbox'/>
               </div>
               <div id='label18_container' class='sfm_form_label'>
                  <label id='label18' for='address_f'>Address</label>
               </div>
               <div id='address_f_container'>
                  <input type='text' name='address_f' value='<?php echo $row['address_f']?>' id='address_f' size='20' class='sfm_textbox'/>
               </div>
               <div id='label23_container' class='sfm_form_label'>
                  <label id='label23' for='city_f'>City</label>
               </div>
               <div id='label24_container' class='sfm_form_label'>
                  <label id='label24'>State</label>
               </div>
               <div id='label25_container' class='sfm_form_label'>
                  <label id='label25' for='zip_f'>Zip</label>
               </div>
               <div id='label26_container' class='sfm_form_label'>
                  <label id='label26' for='county_f'>County</label>
               </div>
               <div id='city_f_container'>
                  <input type='text' name='city_f' value='<?php echo $row['city_f']?>'id='city_f' size='20' class='sfm_textbox'/>
               </div>
               <div id='state_f_container'>
                  <select name='state_f' id='state_f' size='1'>
                     <?php
        echo "<option value=\"{$row['state_f']}\">";
        echo $row['state_f'];
        echo "</option>";
    
?>  
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
                     <option value='New_Hampshire'>New Hampshire</option>
                     <option value='New_Jersey'>New Jersey</option>
                     <option value='New_Mexico'>New Mexico</option>
                     <option value='New_York'>New York</option>
                     <option value='North_Carolina'>North Carolina</option>
                     <option value='North_Dakota'>North Dakota</option>
                     <option value='Ohio'>Ohio</option>
                     <option value='Oklahoma'>Oklahoma</option>
                     <option value='Oregon'>Oregon</option>
                     <option value='Pennsylvania'>Pennsylvania</option>
                     <option value='Rhode_Island'>Rhode Island</option>
                     <option value='South_Carolina'>South Carolina</option>
                     <option value='South_Dakota'>South Dakota</option>
                     <option value='Tennessee'>Tennessee</option>
                     <option value='Texas'>Texas</option>
                     <option value='Utah'>Utah</option>
                     <option value='Vermont'>Vermont</option>
                     <option value='Virginia'>Virginia</option>
                     <option value='Washington'>Washington</option>
                     <option value='Virginia'>West</option>
                     <option value='Wisconsin'>Wisconsin</option>
                     <option value='Wyoming'>Wyoming</option>
                  </select>
               </div>
               <div id='zip_f_container'>
                  <input type='text' name='zip_f' value='<?php echo $row['zip_f']?>'id='zip_f' size='20' class='sfm_textbox'/>
               </div>
               <div id='county_f_container'>
                  <input type='text' name='county_f'value='<?php echo $row['county_f']?>' id='county_f' size='20' class='sfm_textbox'/>
               </div>
               <div id='horiz_line'></div>
               <div id='label20_container' class='sfm_form_label'>
                  <label id='label20' for='first_name_m'>Mother's First Name</label>
               </div>
               <div id='first_name_m_container'>
                  <input type='text' name='first_name_m' value='<?php echo $row['first_name_m']?>' id='first_name_m' size='20' class='sfm_textbox'/>
               </div>
               <div id='label27_container' class='sfm_form_label'>
                  <label id='label27' for='last_name_m'>Mother's Last Name</label>
               </div>
               <div id='label28_container' class='sfm_form_label'>
                  <label id='label28' for='email_m'>Mother's email address</label>
               </div>
               <div id='last_name_m_container'>
                  <input type='text' name='last_name_m'value='<?php echo $row['last_name_m']?>' id='last_name_m' size='20' class='sfm_textbox'/>
               </div>
               <div id='email_m_container'>
                  <input type='text' name='email_m' value='<?php echo $row['email_m']?>'id='email_m' size='20' class='sfm_textbox'/>
               </div>
               <div id='label30_container' class='sfm_form_label'>
                  <label id='label30' for='home_phone_m'>Home Phone</label>
               </div>
               <div id='label31_container' class='sfm_form_label'>
                  <label id='label31' for='work_phone_m'>Work Phone</label>
               </div>
               <div id='label32_container' class='sfm_form_label'>
                  <label id='label32' for='cell_phone_m'>Cell Phone</label>
               </div>
               <div id='home_phone_m_container'>
                  <input type='text' name='home_phone_m'value='<?php echo $row['home_phone_m']?>' id='home_phone_m' size='20' class='sfm_textbox'/>
               </div>
               <div id='work_phone_m_container'>
                  <input type='text' name='work_phone_m' value='<?php echo $row['work_phone_m']?>'id='work_phone_m' size='20' class='sfm_textbox'/>
               </div>
               <div id='cell_phone_m_container'>
                  <input type='text' name='cell_phone_m' value='<?php echo $row['cell_phone_m']?>'id='cell_phone_m' size='20' class='sfm_textbox'/>
               </div>
               <div id='label29_container' class='sfm_form_label'>
                  <label id='label29' for='confirm_email_m'>Confirm email</label>
               </div>
               <div id='confirm_email_m_container'>
                  <input type='text' name='confirm_email_m'value='<?php echo $row['email_m']?>' id='confirm_email_m' size='20' class='sfm_textbox'/>
               </div>
               <div id='label33_container' class='sfm_form_label'>
                  <label id='label33' for='address_m'>Address</label>
               </div>
               <div id='address_m_container'>
                  <input type='text' name='address_m'value='<?php echo $row['address_m']?>' id='address_m' size='20' class='sfm_textbox'/>
               </div>
               <div id='label37_container' class='sfm_form_label'>
                  <label id='label37' for='county_m'>County</label>
               </div>
               <div id='label35_container' class='sfm_form_label'>
                  <label id='label35' for='state_m'>State</label>
               </div>
               <div id='label34_container' class='sfm_form_label'>
                  <label id='label34' for='city_m'>City</label>
               </div>
               <div id='label36_container' class='sfm_form_label'>
                  <label id='label36' for='zip_m'>Zip</label>
               </div>
               <div id='city_m_container'>
                  <input type='text' name='city_m' value='<?php echo $row['city_m']?>'id='city_m' size='20' class='sfm_textbox'/>
               </div>
               <div id='state_m_container'>
                  <select name='state_m' id='state_m' size='1'>
                     <?php
        echo "<option value=\"{$row['state_m']}\">";
        echo $row['state_m'];
        echo "</option>";
    
?>  
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
                     <option value='New_Hampshire'>New Hampshire</option>
                     <option value='New_Jersey'>New Jersey</option>
                     <option value='New_Mexico'>New Mexico</option>
                     <option value='New_York'>New York</option>
                     <option value='North_Carolina'>North Carolina</option>
                     <option value='North_Dakota'>North Dakota</option>
                     <option value='Ohio'>Ohio</option>
                     <option value='Oklahoma'>Oklahoma</option>
                     <option value='Oregon'>Oregon</option>
                     <option value='Pennsylvania'>Pennsylvania</option>
                     <option value='Rhode_Island'>Rhode Island</option>
                     <option value='South_Carolina'>South Carolina</option>
                     <option value='South_Dakota'>South Dakota</option>
                     <option value='Tennessee'>Tennessee</option>
                     <option value='Texas'>Texas</option>
                     <option value='Utah'>Utah</option>
                     <option value='Vermont'>Vermont</option>
                     <option value='Virginia'>Virginia</option>
                     <option value='Washington'>Washington</option>
                     <option value='Virginia'>West</option>
                     <option value='Wisconsin'>Wisconsin</option>
                     <option value='Wyoming'>Wyoming</option>
                  </select>
               </div>
               <div id='zip_m_container'>
                  <input type='text' name='zip_m' value='<?php echo $row['zip_m']?>'id='zip_m' size='20' class='sfm_textbox'/>
               </div>
               <div id='county_m_container'>
                  <input type='text' name='county_m'value='<?php echo $row['county_m']?>' id='county_m' size='20' class='sfm_textbox'/>
               </div>
               <div id='box_element1'></div>
               <div id='heading2_container' class='form_subheading'>
                  <h2 id='heading2' class='form_subheading'>Roommate Request</h2>
               </div>
               <div id='label38_container'>
                  <div id='label38'>Camper may request two roommates only if the meet these criteria:<br />1. They are the same gender and NO MORE than 12 months apart (except for 11&12 yr olds. See note below*)<br />2. The requested roommate must also request your camper</div>
               </div>
               <div id='horiz_line1'></div>
               <div id='label39_container' class='sfm_form_label'>
                  <label id='label39' for='roommate_1'>Roommate Request 1:</label>
               </div>
               <div id='roommate_1_container'>
                  <input type='text' name='roommate_1'value='<?php echo $row1['roommate_1']?> 'id='roommate_1' size='20' class='sfm_textbox'/>
               </div>
               <div id='label40_container' class='sfm_form_label'>
                  <label id='label40' for='roommate_2'>Roommate Request 2:</label>
               </div>
               <div id='roommate_2_container'>
                  <input type='text' name='roommate_2' value='<?php echo $row1['roommate_2']?>'id='roommate_2' size='20' class='sfm_textbox'/>
               </div>
               <div id='horiz_line2'></div>
               <div id='label41_container'>
                  <div id='label41'>Every effort will be made to accommodate roommate request but we cannot guarantee them.</div>
               </div>
               <div id='horiz_line3'></div>
               <div id='label42_container'>
                  <div id='label42'>*Please note</div>
               </div>
               <div id='label43_container'>
                  <div id='label43'>7-11 yr.olds are in the Junior Program; 12-16 yr. olds are in the Senior Program-these age groups will each be housed in separate dormitory facilities. Age for program placement is determined by the date your camper session begins.</div>
               </div>
<div id='box_element2'></div>

 <div id='Continue_container' class='loading_div'>
                  <input type='submit' name='Continue' value='Continue' id='Continue'/>
               </div>
               <div id='Reset_container'>
                  <input type='button' name='Reset' value='Reset' onclick='sfm_clear_form(&#039;form#camper_information&#039;)' id='Reset'/>
               </div>
               <div id='vert_line'></div>
               
               </div>

 </div>
</fieldset>
</form>

        
</div>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->
 <script type='text/javascript'>
// <![CDATA[
$(function()
{
   new sfm_calendar({input_id:"DOB",image_id:"DOB_image",form_id:"campinfo",mirror:"sfm_DOB_parsed",yearRange:"1999:2009"})
   new sfm_number_field('Grade','campinfo',{mirror:'sfm_Grade_parsed'});
   sfm_show_loading_on_formsubmit('campinfo','Continue');
});

// ]]>
      </script>

 <?php
 if(isset($_POST['submitted']))
{   $_SESSION['FirstName'] = $_POST['FirstName'];
    if(!$fgmembersite->Update_Camper())
   {
      
   }
  
}
 ?>
<script type='text/javascript'>
// <![CDATA[
var campinfoValidator = new Validator("campinfo");
campinfoValidator.addValidation("FirstName",{required:true,message:"Please fill in FirstName"} );
campinfoValidator.addValidation("LastName",{required:true,message:"Please fill in LastName"} );
campinfoValidator.addValidation("Address",{required:true,message:"Please fill in Address"} );
campinfoValidator.addValidation("City",{required:true,message:"Please fill in City"} );
campinfoValidator.addValidation("zip",{regexp:"^\\d{5}(-\\d{4})?$",message:"Please enter a valid input for Zip"} );
campinfoValidator.addValidation("zip",{required:true,message:"Please fill in zip"} );
campinfoValidator.addValidation("zip",{numeric:true,message:"The input for zip should be a valid numeric value"} );
campinfoValidator.addValidation("DOB",{required:true,message:"Please fill in DOB"} );
campinfoValidator.addValidation("DOB",{before_date:"FixedDate(2009-6-19)",message:"The date DOB should be before 2009 June 19"} );
campinfoValidator.addValidation("DOB",{after_date:"FixedDate(2000-6-19)",message:"The date DOB should be after 2000 June 19"} );
campinfoValidator.addValidation("Age",{required:true,message:"Please fill in Age"} );
campinfoValidator.addValidation("Age",{numeric:true,message:"The input for Age should be a valid numeric value"} );
campinfoValidator.addValidation("Grade",{numeric:true,message:"The input for  should be a valid numeric value"} );
campinfoValidator.addValidation("Grade",{required:true,message:"Please fill in Grade"} );
campinfoValidator.addValidation("Gender",{selone:true,message:"Please select gender"} );
campinfoValidator.addValidation("yes_no",{selone:true,message:"Please select yes or no"} );
campinfoValidator.addValidation("first_name_f",{required:true,message:"Please fill in first_name_f"} );
campinfoValidator.addValidation("last_name_f",{required:true,message:"Please fill in last_name_f"} );
campinfoValidator.addValidation("email_f",{email:true,message:"The input for Email should be a valid email value"} );
campinfoValidator.addValidation("home_phone_f",{required:true,message:"Please fill in home_phone_f"} );
campinfoValidator.addValidation("work_phone_f",{required:true,message:"Please fill in work_phone_f"} );
campinfoValidator.addValidation("cell_phone_f",{required:true,message:"Please fill in cell_phone_f"} );
campinfoValidator.addValidation("confirm_email_f",{email:true,message:"The input for Email should be a valid email value"} );
campinfoValidator.addValidation("confirm_email_f",{eqelmnt:"email_f",message:"confirm_email_f should be equal to email_f"} );
campinfoValidator.addValidation("zip_f",{regexp:"^\\d{5}(-\\d{4})?$",message:"Please enter a valid input for Zip"} );
campinfoValidator.addValidation("zip_f",{numeric:true,message:"The input for zip_f should be a valid numeric value"} );
campinfoValidator.addValidation("first_name_m",{required:true,message:"Please fill in first_name_m"} );
campinfoValidator.addValidation("last_name_m",{required:true,message:"Please fill in last_name_m"} );
campinfoValidator.addValidation("email_m",{email:true,message:"The input for Email should be a valid email value"} );
campinfoValidator.addValidation("home_phone_m",{required:true,message:"Please fill in home_phone_m"} );
campinfoValidator.addValidation("work_phone_m",{required:true,message:"Please fill in work_phone_m"} );
campinfoValidator.addValidation("cell_phone_m",{required:true,message:"Please fill in cell_phone_m"} );
campinfoValidator.addValidation("confirm_email_m",{email:true,message:"The input for Email should be a valid email value"} );
campinfoValidator.addValidation("confirm_email_m",{eqelmnt:"email_m",message:"confirm_email_m should be equal to email_m"} );
campinfoValidator.addValidation("zip_m",{regexp:"^\\d{5}(-\\d{4})?$",message:"Please enter a valid input for Zip"} );
campinfoValidator.addValidation("zip_m",{numeric:true,message:"The input for zip_m should be a valid numeric value"} );

// ]]>
      </script>



</div>
<!--
Form Code End (see html-form-guide.com for more info.)
-->

</body>
</html><?PHP
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
            $Camper = $_SESSION['Camper'];
            $name = explode(" ", $Camper);
            $Firstname = $name[0];
            $Lastname = $name[2];
           
       $qry = "SELECT * FROM camper_info left join health_form on camper_info.camper_id = health_form.camper_id where FirstName = '$Firstname' and LastName = '$Lastname'";
       $result = mysqli_query($connection, $qry);
         
        if (!$result) {
            
        }   
      $row = mysqli_fetch_assoc( $result ); 
      $_SESSION['camper_id'] = $row['camper_id'];
      
 if(isset($_POST['submitted']))
{  
    if(!$fgmembersite->Update_Health_Form())
   {
      
   }
  
}

 

  
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
                  <div id='label'>Health Consent Form</div>
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
               <div id='Submit_container' class='loading_div'>
                  <input type='submit' name='Submit' value='Submit' id='Submit'/>
               </div>
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
   sfm_show_loading_on_formsubmit('Camp_Health_Form','Submit');
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
           $qry = "SELECT * FROM week_photo WHERE camper_id = '$id' "; 
           $result = mysqli_query($connection, $qry);
           $row = mysqli_fetch_assoc( $result ); 
           $week = $row['week'];
           $_SESSION['week'] = $week; 
            
$Camper = $_SESSION['Camper'];
            $name = explode(" ", $Camper);
            $Firstname = $name[0];
            $Lastname = $name[2];
           
       $qry = "SELECT * FROM camper_info left join parent_guardian_info on camper_info.camper_id = parent_guardian_info.camper_id where FirstName = '$Firstname' and LastName = '$Lastname'";
       $result = mysqli_query($connection, $qry);
         
        if (!$result) {
            
        }   
      $row = mysqli_fetch_assoc( $result ); 
      $_SESSION['camper_id'] = $row['camper_id'];

if(isset($_POST['submitted']))
{
   
           
   if(!$fgmembersite->Update_Week_Photo())
   {
     
   }
  //echo $fgmembersite->GetErrorMessage();
}

  
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
   </head>
   <body id='sfm_camp_week_body'>
      <form id='camp_week' class='sfm_form' enctype='multipart/form-data' method='post' action='' accept-charset='UTF-8'>
         <div id='camp_week_errorloc' class='error_strings' style='width:1487px;text-align:left'></div>
         <div id='camp_week_outer_div' class='form_outer_div' style='width:1487px;height:906px'>
            <div style='position:relative' id='camp_week_inner_div'>
               <input type='hidden' name='submitted' id='submitted' value='1'/>
               <div id='heading_container' class='form_subheading'>
                  <h2 id='heading' class='form_subheading'>Camp Weeks</h2>
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
                  <label id='label' for='Week'>Weeks available<br /></label>
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
                  <?php echo '<img src="data:image/jpg;base64,'.base64_encode( $row['imagedata'] ).'" width="100%" />';?> 
               </div>
               <div id='box_element'></div>
               <div id='label2_container'>
                  <div id='label2'>Please Review and accept below</div>
               </div>
               <div id='label3_container'>
                  <div id='label3'>-Campers are not allowed to bring alcohol, cigarettes, drugs, weapons, fireworks, cell phones, or electronic devices (except cameras). Camp Wabanna reserves the right to search any campers belongings and confiscate these items.<br />~All medications brought by the camper (prescription or over-the-counter) must be given to the camp nurse or appointed staff member at the time of check in. The camp nurse station stocks the most common medicines such as Tylenol and cold remedies, so it is unnecessary to bring them. All medications must be in the original container and include a Camp Wabanna medication card which includes clear and current directions.<br />~ I understand that it is the policy of Camp Wabanna not to release a camper to anyone other than the person designated at the beginning of camp. I recognize that certain hazards and dangers are inherent in camp events and programs. And particularly but not limited to, swimming, boating, field activities, ropes courses, team courses, tower climbing, water tubing, canoeing. I understand that adventure activities may expose my child to psychologically and physically stressful and challenging situations.<br />~I understand, too, that although the program has taken precautions to provide proper organization, supervision, instruction, and equipment for each activity, it is impossible for the program to guarantee absolute safety. I understand that my child shares responsibility for his/her safety and I have instructed my child in the importance of knowing and abiding by the camp rules, regulations, and procedures for his/ her safety of camp participants. Camp Wabanna reserves the right to discipline or send home any child for any reason in its sole discretion. General reasons for immediate dismissal include, but are not limited to any of the following: if a health situation puts another individual in jeopardy, if the camper needs special health attention, if a child has a temperature above 101 degrees, pink eye, ring worm, lice, strep throat, or any infectious situation; or if a child is defiant, uncooperative, and will not or cannot participate in the normal program. Campers sent home due to behavioral problems are not allowed to return. Campers sent home due to medical reasons can only return to camp with a doctor’s release and must be able to participate in the normal camp program. No refund will be given if a child is sent home for either behavioral or medical reasons.<br />~ If a departure need arises, parents/guardians or emergency contacts will be notified. Upon notification, the parent/guardian will be allowed a maximum time of four hours to remove their child from camp property.<br />~In signing this document, I hereby certify that the above information is correct, and I give permission for the use of photographs, or other media, including my son or daughter to be used in camp publicity.</div>
               </div>
               <div class='element_label' id='i_agree_container'><input type='checkbox' name='i_agree' id='i_agree' value='on'/><label for='i_agree' class='element_label' id='i_agree_label'>I HAVE READ ALL THE AFOREMENTIONED INFORMATION AND I AGREE TO COOPERATE AND ADHERE TO THESE GUIDELINES. TO THE BEST OF MY KNOWLEDGE, THE INFORMATION GIVEN ON THESE PAGES IS COMPLETE AND ACCURATE.</label></div>
               <div id='Continue_container' class='loading_div'>
                  <input type='submit' name='Continue' value='Continue' id='Continue'/>
               </div>
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
