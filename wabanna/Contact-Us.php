<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<head>
	<title>Contact us</title>
<!-- define some style elements-->

<link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
	
<!-- a helper script for vaidating the form-->
<script language="JavaScript" src="scripts/gen_validatorv31.js" type="text/javascript"></script>
</head>	
</head>

<body>
    <div id='fg_membersite'>   

<form method="POST" name="contactform" action="contact-form-handler.php"> 
  <fieldset >
<legend>Contact Us</legend>  
<p>
<label for='name'>Your Name:</label> <br>
<input type="text" name="name">
</p>
<p>
<label for='email'>Email Address:</label> <br>
<input type="text" name="email"> <br>
</p>
<p>
<label for='message'>Message:</label> <br>
<textarea name="message"></textarea>
</p>
<input type="submit" value="Submit"><br>
</form>
</div>
<script language="JavaScript">
// Code for validating the form
// Visit http://www.javascript-coder.com/html-form/javascript-form-validation.phtml
// for details
var frmvalidator  = new Validator("contactform");
frmvalidator.addValidation("name","req","Please provide your name"); 
frmvalidator.addValidation("email","req","Please provide your email"); 
frmvalidator.addValidation("email","email","Please enter a valid email address"); 
</script>
<!--
Sample code from:
http://www.html-form-guide.com/contact-form/php-email-contact-form.html
-->


</body>
</html>