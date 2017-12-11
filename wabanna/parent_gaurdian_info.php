<?PHP
require_once("./include/pg_config.php");
if(!$fgmembersite->CheckLogin())
    {
        $fgmembersite->RedirectToURL("login.php");
        exit;
    
    }
if(isset($_POST['submitted']))
{
   if($fgmembersite->AddCamperInfo())
   {
      
   }
    
}
echo $_SESSION['name'];
echo $_SESSION['camper_id'];
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>Camper Information</title>
    <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
    <link rel="STYLESHEET" type="text/css" href="style/pwdwidget.css" />
    <script src="scripts/pwdwidget.js" type="text/javascript"></script>      
</head>
<body>

<!-- Form Code Start -->
<div id='fg_membersite'>
    <form id='campinfo' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Camper Information</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>

<div class='short_explanation'>* required fields</div>
<input type='text'  class='spmhidip' name='<?php echo $fgmembersite->GetSpamTrapInputName(); ?>' />

<div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>

<div class='container'>
    <label for='fa_name' >Fathers Name*:</label><br/>
    <input type='text' name='fa_name' id='fa_name'  maxlength="128" /><br/>
    <span id='camperinformation_fa_name_errorloc' class='error'></span>
</div>

<div class='container'>
    <label for='fa_email' >Email Address*:</label><br/>
     <input type='text' name='fa_email' id='fa_email' value='<?php echo $fgmembersite->SafeDisplay('fa_email') ?>' maxlength="50" /><br/>
    <span id='camperinformation_fa_email_errorloc' class='error'></span>
</div>



<div class='container'>
    <label for='fa_address' >Address*:</label><br/>
    <input type='text' name='fa_address' id='fa_address' maxlength="128" /><br/>
    <span id='camperinformation_fa_address_errorloc' class='error'></span>
</div>


<div class='container'>
    <label for='fa_city' >City*:</label><br/>
    <input type='text' name='fa_city' id='fa_city' maxlength="60" /><br/>
    <span id='camperinformation_fa_city_errorloc' class='error'></span>
</div>


<div class='container'>
    <label for='fa_state' >State*:</label><br/>
    <select name="fa_state">
	<option value="AL">Alabama</option>
	<option value="AK">Alaska</option>
	<option value="AZ">Arizona</option>
	<option value="AR">Arkansas</option>
	<option value="CA">California</option>
	<option value="CO">Colorado</option>
	<option value="CT">Connecticut</option>
	<option value="DE">Delaware</option>
	<option value="DC">District Of Columbia</option>
	<option value="FL">Florida</option>
	<option value="GA">Georgia</option>
	<option value="HI">Hawaii</option>
	<option value="ID">Idaho</option>
	<option value="IL">Illinois</option>
	<option value="IN">Indiana</option>
	<option value="IA">Iowa</option>
	<option value="KS">Kansas</option>
	<option value="KY">Kentucky</option>
	<option value="LA">Louisiana</option>
	<option value="ME">Maine</option>
	<option value="MD">Maryland</option>
	<option value="MA">Massachusetts</option>
	<option value="MI">Michigan</option>
	<option value="MN">Minnesota</option>
	<option value="MS">Mississippi</option>
	<option value="MO">Missouri</option>
	<option value="MT">Montana</option>
	<option value="NE">Nebraska</option>
	<option value="NV">Nevada</option>
	<option value="NH">New Hampshire</option>
	<option value="NJ">New Jersey</option>
	<option value="NM">New Mexico</option>
	<option value="NY">New York</option>
	<option value="NC">North Carolina</option>
	<option value="ND">North Dakota</option>
	<option value="OH">Ohio</option>
	<option value="OK">Oklahoma</option>
	<option value="OR">Oregon</option>
	<option value="PA">Pennsylvania</option>
	<option value="RI">Rhode Island</option>
	<option value="SC">South Carolina</option>
	<option value="SD">South Dakota</option>
	<option value="TN">Tennessee</option>
	<option value="TX">Texas</option>
	<option value="UT">Utah</option>
	<option value="VT">Vermont</option>
	<option value="VA">Virginia</option>
	<option value="WA">Washington</option>
	<option value="WV">West Virginia</option>
	<option value="WI">Wisconsin</option>
	<option value="WY">Wyoming</option>
</select>				
</div>


<div class='container'>
    <label for='fa_zip' >Zipcode*:</label><br/>
    <input type='text' name='fa_zip' id='fa_zip' maxlength="10" /><br/>
    <span id='camperinformation_fa_zip_errorloc' class='error'></span>
</div>


<div class='container'>
    <label for='fa_phone_home' >Home Phone #*:</label><br/>
    <input type='text' name='fa_phone_home' id='fa_phone_home' maxlength="100" /><br/>
    <span id='camperinformation_fa_phone_home_errorloc' class='error'></span>
</div>


<div class='container'>
    <label for='fa_phone_work' >Work Phone #*:</label><br/>
    <input type='text' name='fa_phone_work' id='fa_phone_work' maxlength="100" /><br/>
    <span id='camperinformation_fa_phone_work_errorloc' class='error'></span>
</div>


<div class='container'>
    <label for='fa_phone_cell' >Cell Phone #*:</label><br/>
    <input type='text' name='fa_phone_cell' id='fa_phone_cell' maxlength="100" /><br/>
    <span id='camperinformation_fa_phone_cell_errorloc' class='error'></span>
</div>


<div class='container'>
    <label for='mo_name' >Mothers Name*:</label><br/>
    <input type='text' name='mo_name' id='mo_name'  maxlength="128" /><br/>
    <span id='camperinformation_mo_name_errorloc' class='error'></span>
</div>

<div class='container'>
    <label for='mo_email' >Email Address*:</label><br/>
     <input type='text' name='mo_email' id='mo_email' value='<?php echo $fgmembersite->SafeDisplay('mo_email') ?>' maxlength="50" /><br/>
    <span id='camperinformation_mo_email_errorloc' class='error'></span>
</div>



<div class='container'>
    <label for='mo_address' >Address*:</label><br/>
    <input type='text' name='mo_address' id='mo_address' maxlength="128" /><br/>
    <span id='camperinformation_mo_address_errorloc' class='error'></span>
</div>


<div class='container'>
    <label for='mo_city' >City*:</label><br/>
    <input type='text' name='mo_city' id='fa_city' maxlength="60" /><br/>
    <span id='camperinformation_mo_city_errorloc' class='error'></span>
</div>


<div class='container'>
    <label for='mo_state' >State*:</label><br/>
    <select name="mo_state">
	<option value="AL">Alabama</option>
	<option value="AK">Alaska</option>
	<option value="AZ">Arizona</option>
	<option value="AR">Arkansas</option>
	<option value="CA">California</option>
	<option value="CO">Colorado</option>
	<option value="CT">Connecticut</option>
	<option value="DE">Delaware</option>
	<option value="DC">District Of Columbia</option>
	<option value="FL">Florida</option>
	<option value="GA">Georgia</option>
	<option value="HI">Hawaii</option>
	<option value="ID">Idaho</option>
	<option value="IL">Illinois</option>
	<option value="IN">Indiana</option>
	<option value="IA">Iowa</option>
	<option value="KS">Kansas</option>
	<option value="KY">Kentucky</option>
	<option value="LA">Louisiana</option>
	<option value="ME">Maine</option>
	<option value="MD">Maryland</option>
	<option value="MA">Massachusetts</option>
	<option value="MI">Michigan</option>
	<option value="MN">Minnesota</option>
	<option value="MS">Mississippi</option>
	<option value="MO">Missouri</option>
	<option value="MT">Montana</option>
	<option value="NE">Nebraska</option>
	<option value="NV">Nevada</option>
	<option value="NH">New Hampshire</option>
	<option value="NJ">New Jersey</option>
	<option value="NM">New Mexico</option>
	<option value="NY">New York</option>
	<option value="NC">North Carolina</option>
	<option value="ND">North Dakota</option>
	<option value="OH">Ohio</option>
	<option value="OK">Oklahoma</option>
	<option value="OR">Oregon</option>
	<option value="PA">Pennsylvania</option>
	<option value="RI">Rhode Island</option>
	<option value="SC">South Carolina</option>
	<option value="SD">South Dakota</option>
	<option value="TN">Tennessee</option>
	<option value="TX">Texas</option>
	<option value="UT">Utah</option>
	<option value="VT">Vermont</option>
	<option value="VA">Virginia</option>
	<option value="WA">Washington</option>
	<option value="WV">West Virginia</option>
	<option value="WI">Wisconsin</option>
	<option value="WY">Wyoming</option>
</select>				
</div>


<div class='container'>
    <label for='mo_zip' >Zipcode*:</label><br/>
    <input type='text' name='mo_zip' id='mo_zip' maxlength="10" /><br/>
    <span id='camperinformation_mo_zip_errorloc' class='error'></span>
</div>


<div class='container'>
    <label for='mo_phone_home' >Home Phone #*:</label><br/>
    <input type='text' name='mo_phone_home' id='mo_phone_home' maxlength="100" /><br/>
    <span id='camperinformation_mo_phone_home_errorloc' class='error'></span>
</div>


<div class='container'>
    <label for='mo_phone_work' >Work Phone #*:</label><br/>
    <input type='text' name='mo_phone_work' id='mo_phone_work' maxlength="100" /><br/>
    <span id='camperinformation_mo_phone_work_errorloc' class='error'></span>
</div>


<div class='container'>
    <label for='mo_phone_cell' >Cell Phone #*:</label><br/>
    <input type='text' name='mo_phone_cell' id='mo_phone_cell' maxlength="100" /><br/>
    <span id='camperinformation_mo_phone_cell_errorloc' class='error'></span>
</div>


<div class='container'>
    <input type='submit' name='Submit' value='Submit' />
</div>
</fieldset>
</form>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->
 <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
<script type='text/javascript'>
// <![CDATA[

    var frmvalidator  = new Validator("campinfo");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

   frmvalidator.addValidation("name","req","Please provide your username");
    
   frmvalidator.addValidation("address","req","Please provide your address");

// ]]>
</script>
</div>
<!--
Form Code End (see html-form-guide.com for more info.)
-->

</body>
</html>