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

            $name = explode("|", $_SESSION['Camper'] );
            $Firstname = $name[0];
            $Lastname = $name[1];
           
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
                  <div id='label'>2016 Residential Registration Form<br />Ages 7-16<br /><font color="red"><?PHP echo "($Firstname $Lastname)";?></font><br /></div>
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
</html>
