<?PHP
/*
    Registration/Login script from HTML Form Guide
    V1.0

    This program is free software published under the
    terms of the GNU Lesser General Public License.
    http://www.gnu.org/copyleft/lesser.html
    

This program is distributed in the hope that it will
be useful - WITHOUT ANY WARRANTY; without even the
implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE.

For updates, please visit:
http://www.html-form-guide.com/php-form/php-registration-form.html
http://www.html-form-guide.com/php-form/php-login-form.html

*/
require_once("class.phpmailer.php");
require_once("formvalidator.php");

class FGMembersite
{
    var $admin_email;
    var $from_address;
    var $name;
    var $username;
    var $pwd;
    var $database;
    var $tablename;
    var $connection;
    var $rand_key;
    
    var $error_message;
    
    //-----Initialization -------
    function FGMembersite()
    {
        $this->sitename = 'YourWebsiteName.com';
        $this->rand_key = '0iQx5oBk66oVZep';
    }
    
    function InitDB($host,$uname,$pwd,$database,$tablename)
    {
        $this->db_host  = $host;
        $this->username = $uname;
        $this->pwd  = $pwd;
        $this->database  = $database;
        $this->tablename = $tablename;
        
    }
    
    
    function SetAdminEmail($email)
    {
        $this->admin_email = $email;
    }
    
    function SetWebsiteName($sitename)
    {
        $this->sitename = $sitename;
    }
    
    function SetRandomKey($key)
    {
        $this->rand_key = $key;
    }
    
    //-------Main Operations ----------------------
    function RegisterUser()
    {
        if(!isset($_POST['submitted']))
        {
           return false;
        }
        
        $formvars = array();
        
        if(!$this->ValidateRegistrationSubmission())
        {
            return false;
        }
        
        $this->CollectRegistrationSubmission($formvars);
        
        if(!$this->SaveToDatabase($formvars))
        {
            return false;
        }
        
        if(!$this->SendUserConfirmationEmail($formvars))
        {
            return false;
        }

        $this->SendAdminIntimationEmail($formvars);
        
        return true;
    }

    function ConfirmUser()
    {
        if(empty($_GET['code'])||strlen($_GET['code'])<=10)
        {
            $this->HandleError("Please provide the confirm code");
            return false;
        }
        $user_rec = array();
        if(!$this->UpdateDBRecForConfirmation($user_rec))
        {
            return false;
        }
        
        $this->SendUserWelcomeEmail($user_rec);
        
        $this->SendAdminIntimationOnRegComplete($user_rec);
        
        return true;
    }    
    
    function Login()
    {
        if(empty($_POST['username']))
        {
            $this->HandleError("UserName is empty!");
            return false;
        }
        
        if(empty($_POST['password']))
        {
            $this->HandleError("Password is empty!");
            return false;
        }
        
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        
        if(!isset($_SESSION)){ session_start(); }
        if(!$this->CheckLoginInDB($username,$password))
        {
            return false;
        }
        
        $_SESSION[$this->GetLoginSessionVar()] = $username;
        
        return true;
    }
    
    function CheckLogin()
    {
         if(!isset($_SESSION)){ session_start(); }

         $sessionvar = $this->GetLoginSessionVar();
         
         if(empty($_SESSION[$sessionvar]))
         {
            return false;
         }
         return true;
    }
    
    function UserFullName()
    {
        return isset($_SESSION['name_of_user'])?$_SESSION['name_of_user']:'';
    }
    
    function UserEmail()
    {
        return isset($_SESSION['email_of_user'])?$_SESSION['email_of_user']:'';
    }
    
    function LogOut()
    {
        session_start();
        
        $sessionvar = $this->GetLoginSessionVar();
        
        $_SESSION[$sessionvar]=NULL;
        
        unset($_SESSION[$sessionvar]);
    }
    
    function EmailResetPasswordLink()
    {
        if(empty($_POST['email']))
        {
            $this->HandleError("Email is empty!");
            return false;
        }
        $user_rec = array();
        if(false === $this->GetUserFromEmail($_POST['email'], $user_rec))
        {
            return false;
        }
        if(false === $this->SendResetPasswordLink($user_rec))
        {
            return false;
        }
        return true;
    }
    
    function ResetPassword()
    {
        if(empty($_GET['email']))
        {
            $this->HandleError("Email is empty!");
            return false;
        }
        if(empty($_GET['code']))
        {
            $this->HandleError("reset code is empty!");
            return false;
        }
        $email = trim($_GET['email']);
        $code = trim($_GET['code']);
        
        if($this->GetResetPasswordCode($email) != $code)
        {
            $this->HandleError("Bad reset code!");
            return false;
        }
        
        $user_rec = array();
        if(!$this->GetUserFromEmail($email,$user_rec))
        {
            return false;
        }
        
        $new_password = $this->ResetUserPasswordInDB($user_rec);
        if(false === $new_password || empty($new_password))
        {
            $this->HandleError("Error updating new password");
            return false;
        }
        
        if(false == $this->SendNewPassword($user_rec,$new_password))
        {
            $this->HandleError("Error sending new password");
            return false;
        }
        return true;
    }
    
    function ChangePassword()
    {
        if(!$this->CheckLogin())
        {
            $this->HandleError("Not logged in!");
            return false;
        }
        
        if(empty($_POST['oldpwd']))
        {
            $this->HandleError("Old password is empty!");
            return false;
        }
        if(empty($_POST['newpwd']))
        {
            $this->HandleError("New password is empty!");
            return false;
        }
        
        $user_rec = array();
        if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec))
        {
            return false;
        }
        
        $pwd = trim($_POST['oldpwd']);
        
        if($user_rec['password'] != md5($pwd))
        {
            $this->HandleError("The old password does not match!");
            return false;
        }
        $newpwd = trim($_POST['newpwd']);
        
        if(!$this->ChangePasswordInDB($user_rec, $newpwd))
        {
            return false;
        }
        return true;
    }
     function AddCamperInfo()
    {
         
         
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
             
        
        $firstName = $_POST['FirstName'];
        $firstName = $this->SanitizeForSQL($firstName);
        $lastName = $_POST['LastName'];
        $lastName = $this->SanitizeForSQL($lastName);
        $address = $_POST['Address'];
        $address = $this->SanitizeForSQL($address);
        $city = $_POST['City'];
        $city = $this->SanitizeForSQL($city);
        $state = $_POST['state'];
        $state = $this->SanitizeForSQL($state);
        $zip = $_POST['zip'];
        $zip = $this->SanitizeForSQL($zip);
        $county = $_POST['county'];
        $county = $this->SanitizeForSQL($county);
        $comment = $_POST['comment'];
        $comment = $this->SanitizeForSQL($comment); 
        $DOB = $_POST['DOB'];
        $DOB = $this->SanitizeForSQL($DOB);
        $age = $_POST['Age'];
        $age = $this->SanitizeForSQL($age);
        $grade = $_POST['Grade'];
        $grade = $this->SanitizeForSQL($grade);
        $gender = $_POST['Gender'];
        $gender = $this->SanitizeForSQL($gender);
        $yesno = $_POST['yes_no'];
        $yesno = $this->SanitizeForSQL($yesno); 
        
        
        $qry = 'insert into camper_info (
                FirstName,
                LastName,
                Address,
                City,
		state,
		zip,
                county,
                comment,
		DOB,
                Age,
                Grade,
		Gender,
		yes_no,
                id_user
                )
                values
                (
           
                "' . $firstName . '",
                "' . $lastName . '",
                "' . $address . '",        
                "' . $city . '",
                "' . $state . '",
                "' . $zip . '",  
                "' . $county . '",
                "' . $comment . '",
                "' . $DOB . '", 
                "' . $age . '",
                "' . $grade . '",
                "' . $gender . '",     
                "' . $yesno . '",       
                "' . $_SESSION['id_of_user'] . '"
                )'; 
        
         
         if(!mysqli_query( $connection, $qry))
        {
             header("Location: Form_submit_error.html");
            return false;
        } 
        
        if(isset($_POST['submitted']))
            {
   
            header("Location: index.php");
    
            }
    }
    
    function Delete_User()
    {
        $id = $_SESSION['id_of_user'];
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
        $qry = "DELETE FROM users where id_user = '$id' ";
        $result = mysqli_query($connection, $qry);
         
        if (!$result) {
            
          die("You must remove your enrolled campers before your account can be removed!");

        }     
        
    }
    function Get_Camper_Info(){
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
            
           if(empty($_POST['Camper']))
        {
            $this->RedirectToURL("Userhome.php");
            return false;
        }  
            $Camper = $_POST['Camper'];
            $_SESSION['Camper'] = $Camper;
            $name = explode(" ", $Camper);
            $Firstname = $name[0];
            $Lastname = $name[2];
       $qry = "SELECT * FROM camper_info left join parent_guardian_info on camper_info.camper_id = parent_guardian_info.camper_id where FirstName = '$Firstname' and LastName = '$Lastname'";
       $result = mysqli_query($connection, $qry);
         
        if (!$result) {
            
        }   
      $row = mysqli_fetch_assoc( $result );
      $_SESSION['camper_id'] = $row['camper_id'];
      $_SESSION['Camper'] = $Camper;
    }
    function Check_Form_completion(){
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
        $qry = "SELECT * FROM camper_info where camper_id = $id";
        $result = mysqli_query($connection, $qry);
        $row = mysqli_fetch_assoc($result);
        $cff = $row['consent_form_confirm'];
        $hff = $row['health_form_confirm'];
        $wpf = $row['health_form_confirm'];
    if($cff == 'yes' && $hff == 'yes' && $wpf == 'yes' ) {
    return true;
        }else{
          $this->Delete_Camper();  
        }
       
    }
    
    function Update_Week_Photo(){
         $imagedata = $_FILES['image']['tmp_name'];
         $_SESSION['image'] = filesize($_FILES['image']['tmp_name']);
         
         $file = filesize($_FILES['image']['tmp_name']);
       if ($file > 1048576){
    $this->HandleError("File size exceeds maximum limit of 1mb");
    return false;
       }  
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
             $imagedata = $_FILES['image']['tmp_name'];
             $imagedata = addslashes(file_get_contents($_FILES['image']['tmp_name']));
             //$imagedata = mysqli_real_escape_string($imagedata);

            $imageProperties = getimageSize($_FILES['image']['tmp_name']);
            if (!empty($imagedata)){
                
            $qry = "UPDATE week_photo set imageType = '$imageProperties', imagedata = '$imagedata' where camper_id = '$id'";
            $result = mysqli_query($connection, $qry);
            if (!$result) {
            $this->RedirectToURL("File_size_error.php");
        } 
                     }
   
            
           $week = $_SESSION['week']; 
           $agegroup = $_SESSION['agegroup'];
           $qry = "Update $agegroup Set counter=counter-1 Where week='$week'"; 
           $result = mysqli_query($connection, $qry); 
            
            
            $id = $_SESSION['camper_id'];
             $week = $_POST['week'];
             $week = $this->SanitizeForSQL($week);
             
             
             $qry = "UPDATE week_photo set week = '$week' where camper_id = '$id'";
                    
            $result = mysqli_query($connection, $qry);
            $qry = "Update $agegroup Set counter=counter+1 Where week='$week'"; 
            $result = mysqli_query($connection, $qry);
            if (!$result) {
            
        } 
           
            
            if(isset($_POST['submitted']))
            {
   
            $this->RedirectToURL("userhome.php");
    
            }
    }
    
    function Max_file_size()
    {
    if($_FILES['image']['size'] > 1048576){
    $this->HandleError("File size exceeds maximum limit of 1mb");
    return false;
}
    }
    function Update_Consent_Form(){
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
            $InsCo = $_POST['Insurance_Company'];
            $InsCo = $this->SanitizeForSQL($InsCo);
            $Policy = $_POST['Policy_Number'];
            $Policy = $this->SanitizeForSQL($Policy);
            
            $qry = "UPDATE consent_form set Insurance_Company = '$InsCo',"
                    . "Policy_Number = '$Policy' "
                    . "where camper_id = '$id' ";
            
            $result = mysqli_query($connection, $qry);
         
        if (!$result) {
            
        }
        if(isset($_POST['submitted']))
            {
   
            $this->RedirectToURL("userhome.php");
    
            }
            
    }
    
    function Update_Health_Form(){
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
        $fname = $_POST['FirstName_e_contact'];
        $fname = $this->SanitizeForSQL($fname);
        $lname = $_POST['LastName_e_contact'];
        $lname = $this->SanitizeForSQL($lname);
        $rel = $_POST['Relationship'];
        $rel = $this->SanitizeForSQL($rel);
        $ph = $_POST['Phone_e_contact'];
        $ph = $this->SanitizeForSQL($ph);
        $doc = $_POST['Doctor'];
        $doc = $this->SanitizeForSQL($doc);
        $docp = $_POST['Phone_Doctor'];
        $docp = $this->SanitizeForSQL($docp);
        $af = $_POST['allergy_food_yes_no'];
        $af = $this->SanitizeForSQL($af);
        $am = $_POST['allergy_medicine_yes_no'];
        $am = $this->SanitizeForSQL($am);
        $ae = $_POST['allergy_environment_yes_no'];
        $ae = $this->SanitizeForSQL($ae);
        $ao = $_POST['allergy_other_yes_no'];
        $ao = $this->SanitizeForSQL($ao);
        $comall = $_POST['comments_allergies'];
        $comall = $this->SanitizeForSQL($comall);
        $imyn = $_POST['Immun_yes_no'];
        $imyn = $this->SanitizeForSQL($imyn);
        $i1 = $_POST['IMUN_1'];
        $i1 = $this->SanitizeForSQL($i1);
        $i2 = $_POST['IMUN_2'];
        $i2 = $this->SanitizeForSQL($i2);
        $i3 = $_POST['IMUN_3'];
        $i3 = $this->SanitizeForSQL($i3);
        $i4 = $_POST['IMUN_4'];
        $i4 = $this->SanitizeForSQL($i4);
        $i5 = $_POST['IMUN_5'];
        $i5 = $this->SanitizeForSQL($i5);
        $i6 = $_POST['IMUN_6'];
        $i6 = $this->SanitizeForSQL($i6);
        $i7 = $_POST['IMUN_7'];
        $i7 = $this->SanitizeForSQL($i7);
        $i8 = $_POST['IMUN_8'];
        $i8 = $this->SanitizeForSQL($i8);
        $i9 = $_POST['IMUN_9'];
        $i9 = $this->SanitizeForSQL($i9);
        $i10 = $_POST['IMUN_10'];
        $i10 = $this->SanitizeForSQL($i10);
        $i11 = $_POST['IMUN_11'];
        $i11 = $this->SanitizeForSQL($i11);
        $i12 = $_POST['IMUN_12'];
        $i12 = $this->SanitizeForSQL($i12);
        $medtf = $_POST['Meds_at_camp_true_false'];
        $medtf = $this->SanitizeForSQL($medtf);
        $mn1 = $_POST['med_name_1'];
        $mn1 = $this->SanitizeForSQL($mn1);
        $md1 = $_POST['med_date_1'];
        $md1 = $this->SanitizeForSQL($md1);
        $mr1 = $_POST['med_reason_1'];
        $mr1 = $this->SanitizeForSQL($mr1);
        $mt1 = $_POST['med_time_1'];
        $mt1 = $this->SanitizeForSQL($mt1);
        $ma1 = $_POST['med_amount_1'];
        $ma1 = $this->SanitizeForSQL($ma1);
        $mh1 = $_POST['med_how_1'];
        $mh1 = $this->SanitizeForSQL($mh1);
        $mn2 = $_POST['med_name_2'];
        $mn2 = $this->SanitizeForSQL($mn2);
        $md2 = $_POST['med_date_2'];
        $md2 = $this->SanitizeForSQL($md2);
        $mr2 = $_POST['med_reason_2'];
        $mr2 = $this->SanitizeForSQL($mr2);
        $mt2 = $_POST['med_time_2'];
        $mt2 = $this->SanitizeForSQL($mt2);
        $ma2 = $_POST['med_amount_2'];
        $ma2 = $this->SanitizeForSQL($ma2);
        $mh2 = $_POST['med_how_2'];
        $mh2 = $this->SanitizeForSQL($mh2);
        $mn3 = $_POST['med_name_3'];
        $mn3 = $this->SanitizeForSQL($mn3);
        $md3 = $_POST['med_date_3'];
        $md3 = $this->SanitizeForSQL($md3);
        $mr3 = $_POST['med_reason_3'];
        $mr3 = $this->SanitizeForSQL($mr3);
        $mt3 = $_POST['med_time_3'];
        $mt3 = $this->SanitizeForSQL($mt3);
        $ma3 = $_POST['med_amount_3'];
        $ma3 = $this->SanitizeForSQL($ma3);
        $mh3 = $_POST['med_how_3'];
        $mh3 = $this->SanitizeForSQL($mh3);
        $tyl = $_POST['Tylenol_yes_no'];
        $tyl = $this->SanitizeForSQL($tyl);
        $sudpe = $_POST['Sudafed_PE_yes_no'];
        $sudpe = $this->SanitizeForSQL($sudpe);
        $amyn = $_POST['allergy_med_yes_no'];
        $amyn = $this->SanitizeForSQL($amyn);
        $benyn = $_POST['Benadryl_yes_no'];
        $benyn = $this->SanitizeForSQL($benyn);
        $tsyn = $_POST['Throat_spray_yes_no'];
        $tsyn = $this->SanitizeForSQL($tsyn);
        $calyn = $_POST['Calamine_yes_no'];
        $calyn = $this->SanitizeForSQL($calyn);
        $laxyn = $_POST['Laxatives_yes_no'];
        $laxyn = $this->SanitizeForSQL($laxyn);
        $ibuyn = $_POST['Ibuprofen_yes_no'];
        $ibuyn = $this->SanitizeForSQL($ibuyn);
        $sudyn = $_POST['Sudafed_yes_no'];
        $sudyn = $this->SanitizeForSQL($sudyn);
        $robyn = $_POST['Robitussin_yes_no'];
        $robyn = $this->SanitizeForSQL($robyn);
        $robdm = $_POST['Rob_DM_yes_no'];
        $robdm = $this->SanitizeForSQL($robdm);
        $cdyn = $_POST['cough_drops_yes_no'];
        $cdyn = $this->SanitizeForSQL($cdyn);
        $aloyn = $_POST['aloe_yes_no'];
        $aloyn = $this->SanitizeForSQL($aloyn);
        $pepyn = $_POST['Pepto_yes_no'];
        $pepyn = $this->SanitizeForSQL($pepyn);
        $pasyn = $_POST['passed_out_yes_no'];
        $pasyn = $this->SanitizeForSQL($pasyn);
        $rdyn = $_POST['recent_disease_yes_no'];
        $rdyn = $this->SanitizeForSQL($rdyn);
        $riyn = $_POST['recent_injury_yes_no'];
        $riyn = $this->SanitizeForSQL($riyn);
        $bpyn = $_POST['breathing_problem_yes_no'];
        $bpyn = $this->SanitizeForSQL($bpyn);
        $diayn = $_POST['diabetes_yes_no'];
        $diayn = $this->SanitizeForSQL($diayn);
        $seiyn = $_POST['seizures_yes_no'];
        $seiyn = $this->SanitizeForSQL($seiyn);
        $sknyn = $_POST['skin_problems_yes_no'];
        $sknyn = $this->SanitizeForSQL($sknyn);
        $slpyn = $_POST['sleep_problems_yes_no'];
        $slpyn = $this->SanitizeForSQL($slpyn);
        $diayn = $_POST['diarrhea_constipation_yes_no'];
        $diayn = $this->SanitizeForSQL($diayn);
        $glsyn = $_POST['glasses_yes_no'];
        $glsyn = $this->SanitizeForSQL($glsyn);
        $addyn = $_POST['ADD_ADHD_yes_no'];
        $addyn = $this->SanitizeForSQL($addyn);
        $hhyn = $_POST['health_history_Yes_explain'];
        $hhyn = $this->SanitizeForSQL($hhyn);
        $emoyn = $_POST['emotional_yes_no'];
        $emoyn = $this->SanitizeForSQL($emoyn);
        $menyn = $_POST['mental_illness_yes_no'];
        $menyn = $this->SanitizeForSQL($menyn);
        $mencom = $_POST['Mental_comments'];
        $mencom = $this->SanitizeForSQL($mencom);
        
        $qry = "UPDATE health_form set FirstName_e_contact = '$fname',"
                . "LastName_e_contact = '$lname',"
                . "Relationship = '$rel', "
                . "Phone_e_contact = '$ph',"
                . "Doctor = '$doc', "
                . "Phone_Doctor = '$docp', "
                . "allergy_food_yes_no = '$af', "
                . "allergy_medicine_yes_no = '$am', "
                . "allergy_environment_yes_no = '$ae', "
                . "allergy_other_yes_no = '$ao', "
                . "comments_allergies = '$comall', "
                . "Immun_yes_no = '$imyn', "
                . "IMUN_1 = '$i1', "
                . "IMUN_2 = '$i2',"
                . "IMUN_3 = '$i3',"
                . "IMUN_4 = '$i4',"
                . "IMUN_5 = '$i5',"
                . "IMUN_6 = '$i6',"
                . "IMUN_7 = '$i7',"
                . "IMUN_8 = '$i8',"
                . "IMUN_9 = '$i9',"
                . "IMUN_10 = '$i10',"
                . "IMUN_11 = '$i11',"
                . "IMUN_12 = '$i12',"
                . "Meds_at_camp_true_false = '$medtf', "
                . "med_name_1 = '$mn1',"
                . "med_date_1 = '$md1',"
                . "med_reason_1 = '$mr1',"
                . "med_time_1 = '$mt1',"
                . "med_amount_1 = '$ma1',"
                . "med_how_1 = '$mh1',"
                . "med_name_2 = '$mn2',"
                . "med_date_2 = '$md2',"
                . "med_reason_2 = '$mr2',"
                . "med_time_2 = '$mt2',"
                . "med_amount_2 = '$ma2',"
                . "med_how_2 = '$mh2',"
                . "med_name_3 = '$mn3',"
                . "med_date_3 = '$md3',"
                . "med_reason_3 = '$mr3',"
                . "med_time_3 = '$mt3',"
                . "med_amount_3 = '$ma3',"
                . "med_how_3 = '$mh3',"
                . "Tylenol_yes_no = '$tyl', "
                . "Sudafed_PE_yes_no = '$sudpe', "
                . "allergy_med_yes_no = '$amyn',"
                . "Benadryl_yes_no = '$benyn', "
                . "Throat_spray_yes_no = '$tsyn', "
                . "Calamine_yes_no = '$calyn',"
                . "Laxatives_yes_no = '$laxyn', "
                . "Ibuprofen_yes_no = '$ibuyn', "
                . "Sudafed_yes_no = '$sudyn', "
                . "Robitussin_yes_no = '$robyn', "
                . "Rob_DM_yes_no = '$robdm', "
                . "cough_drops_yes_no = '$cdyn', "
                . "aloe_yes_no = '$aloyn', "
                . "Pepto_yes_no = '$pepyn', "
                . "passed_out_yes_no = '$pasyn', "
                . "recent_disease_yes_no = '$rdyn', "
                . "recent_injury_yes_no = '$riyn', "
                . "breathing_problem_yes_no = '$bpyn', "
                . "diabetes_yes_no = '$diayn', "
                . "seizures_yes_no = '$seiyn', "
                . "skin_problems_yes_no = '$sknyn', "
                . "sleep_problems_yes_no = '$slpyn', "
                . "diarrhea_constipation_yes_no = '$diayn',"
                . "glasses_yes_no = '$glsyn', "
                . "ADD_ADHD_yes_no = '$addyn',"
                . "health_history_Yes_explain = '$hhyn', "
                . "emotional_yes_no = '$emoyn', "
                . "mental_illness_yes_no = '$menyn', "
                . "Mental_comments = '$mencom' "
                . " where camper_id='$id'";
            $result = mysqli_query($connection, $qry);
         
        if (!$result) {
            
        }
        if(isset($_POST['submitted']))
            {
   
            $this->RedirectToURL("userhome.php");
    
            }
    }
    function Update_Camper(){
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
            $FirstName = $_POST['FirstName'];
            $LastName = $_POST['LastName'];
            $Address = $_POST['Address'];
            $City = $_POST['City'];
            $state = $_POST['state'];
            $zip = $_POST['zip'];
            $county = $_POST['county'];
            $comment = $_POST['comment'];
            $DOB = $_POST['DOB'];
            $Age = $_POST['Age'];
            $Grade = $_POST['Grade'];
            $Gender = $_POST['Gender'];
            $yes_no = $_POST['yes_no'];
            $qry = "UPDATE camper_info set FirstName='$FirstName', LastName = '$LastName', Address = '$Address', City = '$City', state ='$state', zip = '$zip', county = '$county', comment = '$comment', Grade = '$Grade', yes_no = '$yes_no' where camper_id='$id'";
            $result = mysqli_query($connection, $qry);
         
        if (!$result) {
            
        }
        $id = $_SESSION['camper_id'];
            $first_name_f = $_POST['first_name_f'];
            $last_name_f = $_POST['last_name_f'];
            $email_f = $_POST['email_f'];
            $home_phone_f = $_POST['home_phone_f'];
            $work_phone_f = $_POST['work_phone_f'];
            $cell_phone_f = $_POST['cell_phone_f'];
            $address_f = $_POST['address_f'];
            $city_f = $_POST['city_f'];
            $state_f = $_POST['state_f'];
            $zip_f = $_POST['zip_f'];
            $county_f = $_POST['county_f'];
            $qry = "UPDATE parent_guardian_info set first_name_f='$first_name_f', last_name_f = '$last_name_f', email_f = '$email_f', home_phone_f = '$home_phone_f', work_phone_f ='$work_phone_f', cell_phone_f = '$cell_phone_f', address_f = '$address_f', city_f = '$city_f', state_f = '$state_f', zip_f = '$zip_f', county_f = '$county_f' where camper_id='$id'";
            $result = mysqli_query($connection, $qry);
         
        if (!$result) {
            
        }
        $id = $_SESSION['camper_id'];
            $first_name_m = $_POST['first_name_m'];
            $last_name_m = $_POST['last_name_m'];
            $email_m = $_POST['email_m'];
            $home_phone_m = $_POST['home_phone_m'];
            $work_phone_m = $_POST['work_phone_m'];
            $cell_phone_m = $_POST['cell_phone_m'];
            $address_m = $_POST['address_m'];
            $city_m = $_POST['city_m'];
            $state_m = $_POST['state_m'];
            $zip_m = $_POST['zip_m'];
            $county_m = $_POST['county_m'];
            $qry = "UPDATE parent_guardian_info set first_name_m='$first_name_m', last_name_m = '$last_name_m', email_m = '$email_m', home_phone_m = '$home_phone_m', work_phone_m ='$work_phone_m', cell_phone_m = '$cell_phone_m', address_m = '$address_m', city_m = '$city_m', state_m = '$state_m', zip_m = '$zip_m', county_m = '$county_m' where camper_id='$id'";
            $result = mysqli_query($connection, $qry);
         
        if (!$result) {
            
        }
        $id = $_SESSION['camper_id'];
            $roommate_1 = $_POST['roommate_1'];
            $roommate_2 = $_POST['roommate_2'];
            $qry = "UPDATE roommate set roommate_1 = '$roommate_1', roommate_2 = '$roommate_2' where camper_id='$id'";
            $result = mysqli_query($connection, $qry);
         
        if (!$result) {
            
        }
        
        
        if(isset($_POST['submitted']))
            {
   
            $this->RedirectToURL("userhome.php");
    
            }
    }
    function Delete_Camper()
    {
        
        
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
      
        
   $_SESSION['Camper'] = $_POST['Camper'];
   $Camper = $_SESSION['Camper'];
   $name = explode(" ", $Camper);
   $Firstname = $name[0];
   $Lastname = $name[2];
   
    
   $qry = "SELECT week FROM camper_info left join week_photo on camper_info.camper_id = week_photo.camper_id where FirstName = '$Firstname' and LastName = '$Lastname'";
   $result = mysqli_query($connection, $qry);
         
        if (!$result) {
            
        }   
      $row = mysqli_fetch_assoc( $result );
      $week = $row['week'];
      
       
        $qry = "SELECT * FROM camper_info where FirstName = '$Firstname' and LastName = '$Lastname'";
        $result = mysqli_query($connection, $qry);
        $row = mysqli_fetch_assoc($result);
        $Age = $row['Age'];
        $Gender = $row['Gender'];
$id = $row['camper_id'];
   $qry1 =  "DELETE FROM camper_info where FirstName = '$Firstname' and LastName = '$Lastname'";
    $result = mysqli_query($connection, $qry1);
    if (!$result) {
            
          die("No one deleted.");

        }     


        if($Gender == 'male' && $Age <= '16' && $Age >= '12' ) {
            $agegroup = 'sr_boys';
            $counter = '5';
           
        } elseif ($Gender == 'male' && $Age <= '11' && $Age >= '7') {
            $agegroup = 'jr_boys';
            $counter = '5';
            
        }elseif ($Gender == 'female' && $Age <= '11' && $Age >= '7') {
            $agegroup = 'jr_girls';
            $counter = '5';
            
        }elseif ($Gender == 'female' && $Age <= '16' && $Age >= '12') {
            $agegroup = 'sr_girls';
            $counter = '6';
            
        }else {
            
            $this->RedirectToURL("userhome.php");

        }
   
   $qry = "UPDATE $agegroup set counter=counter-1 where week='$week'";
    $result = mysqli_query($connection, $qry);
         
        if (!$result) {
            
        }   
    
    
   
   
   
        
    }
    function Add_Consent_Form(){
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
        
        $InsCo = $_POST['Insurance_Company'];
        $InsCo = $this->SanitizeForSQL($InsCo);
        $Policy = $_POST['Policy_Number'];
        $Policy = $this->SanitizeForSQL($Policy);
        
        
        
        $qry = 'insert into consent_form (
            Insurance_Company,
            Policy_Number,
            confirm_code,
            camper_id
            )
            values
            (
                "' . $InsCo . '",
                "' . $Policy . '",
                "' . 'yes' . '",                    
                "' . $_SESSION['camper_id'] . '"
                )'; 
        
         
         if(!mysqli_query( $connection, $qry))
        {
             header("Location: Form_submit_error.html");
            return false;
        } 
        
        $id = $_SESSION['camper_id'];
        $qry = "Update camper_info Set consent_form_confirm='yes' Where camper_id  = $id ";
        if(!mysqli_query( $connection, $qry))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$qry");
            return false;
        }
        
        if(isset($_POST['submitted']))
            {
   
            header("Location: camp_week.php");
    
            }
    }
   
    
    
    function Add_Week_Photo()
    {  $imagedata = $_FILES['image']['tmp_name'];
         $_SESSION['image'] = filesize($_FILES['image']['tmp_name']);
         
         $file = filesize($_FILES['image']['tmp_name']);
       if ($file > 1048576){
    $this->HandleError("File size exceeds maximum limit of 1mb");
    return false;
       }  
      if(!isset($_POST['submitted']))
        {
           return false;
        }
        $week = $_POST['week'];
        $week = $this->SanitizeForSQL($week);
        $imagedata = $_FILES['image']['tmp_name'];
        $imagedata = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $imageProperties = getimageSize($_FILES['image']['tmp_name']);
        
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }
        
        $insert_query = 'insert into week_photo (
            week,
            imageType,
            imagedata,
            camper_id
            )
            values
            (
                "' . $week . '",
                "' . $imageProperties['mime'] . '",
                "' . $imagedata . '",                    
                "' . $_SESSION['camper_id'] . '"
                )'; 
        
        if(!mysql_query( $insert_query ,$this->connection))
        {
             header("Location: Form_submit_error.html");
            return false;
        } 
        $agegroup = $_SESSION['agegroup'];
        $qry = "Update $agegroup Set counter=counter+1 Where week='$week'";
        if(!mysql_query( $qry,$this->connection))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$qry");
            return false;
        }
        
        $id = $_SESSION['camper_id'];
        $qry = "Update camper_info Set week_photo_confirm='yes' Where camper_id  = $id ";
        if(!mysql_query( $qry,$this->connection))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$qry");
            return false;
        }
        
        if(isset($_POST['submitted']))
            {
   
            header("Location: userhome.php");
    
            }
            
    }
    
    
    function Add_Health_Form()
    {
      if(!isset($_POST['submitted']))
        {
           return false;
        }
        $fname = $_POST['FirstName_e_contact_1'];
        $fname = $this->SanitizeForSQL($fname);
        $lname = $_POST['LastName_e_contact_1'];
        $lname = $this->SanitizeForSQL($lname);
        $rel = $_POST['Relationship_1'];
        $rel = $this->SanitizeForSQL($rel);
        $ph = $_POST['Phone_e_contact_1'];
        $ph = $this->SanitizeForSQL($ph);
        $fname2 = $_POST['FirstName_e_contact_2'];
        $fname2 = $this->SanitizeForSQL($fname2);
        $lname2 = $_POST['LastName_e_contact_2'];
        $lname2 = $this->SanitizeForSQL($lname2);
        $rel2 = $_POST['Relationship_2'];
        $rel2 = $this->SanitizeForSQL($rel2);
        $ph2 = $_POST['Phone_e_contact_2'];
        $ph2 = $this->SanitizeForSQL($ph2);
        $docp = $this->SanitizeForSQL($docp);
        $af = $_POST['allergy_food_yes_no'];
        $af = $this->SanitizeForSQL($af);
        $am = $_POST['allergy_medicine_yes_no'];
        $am = $this->SanitizeForSQL($am);
        $ae = $_POST['allergy_environment_yes_no'];
        $ae = $this->SanitizeForSQL($ae);
        $ao = $_POST['allergy_other_yes_no'];
        $ao = $this->SanitizeForSQL($ao);
        $comall = $_POST['comments_allergies'];
        $comall = $this->SanitizeForSQL($comall);
        $imyn = $_POST['Immun_yes_no'];
        $imyn = $this->SanitizeForSQL($imyn);
        $medtf = $_POST['Meds_at_camp_true_false'];
        $medtf = $this->SanitizeForSQL($medtf);
        $mn1 = $_POST['med_name_1'];
        $mn1 = $this->SanitizeForSQL($mn1);
        $md1 = $_POST['med_date_1'];
        $md1 = $this->SanitizeForSQL($md1);
        $mr1 = $_POST['med_reason_1'];
        $mr1 = $this->SanitizeForSQL($mr1);
        $mt1 = $_POST['med_time_1'];
        $mt1 = $this->SanitizeForSQL($mt1);
        $ma1 = $_POST['med_amount_1'];
        $ma1 = $this->SanitizeForSQL($ma1);
        $mh1 = $_POST['med_how_1'];
        $mh1 = $this->SanitizeForSQL($mh1);
        $mn2 = $_POST['med_name_2'];
        $mn2 = $this->SanitizeForSQL($mn2);
        $md2 = $_POST['med_date_2'];
        $md2 = $this->SanitizeForSQL($md2);
        $mr2 = $_POST['med_reason_2'];
        $mr2 = $this->SanitizeForSQL($mr2);
        $mt2 = $_POST['med_time_2'];
        $mt2 = $this->SanitizeForSQL($mt2);
        $ma2 = $_POST['med_amount_2'];
        $ma2 = $this->SanitizeForSQL($ma2);
        $mh2 = $_POST['med_how_2'];
        $mh2 = $this->SanitizeForSQL($mh2);
        $mn3 = $_POST['med_name_3'];
        $mn3 = $this->SanitizeForSQL($mn3);
        $md3 = $_POST['med_date_3'];
        $md3 = $this->SanitizeForSQL($md3);
        $mr3 = $_POST['med_reason_3'];
        $mr3 = $this->SanitizeForSQL($mr3);
        $mt3 = $_POST['med_time_3'];
        $mt3 = $this->SanitizeForSQL($mt3);
        $ma3 = $_POST['med_amount_3'];
        $ma3 = $this->SanitizeForSQL($ma3);
        $mh3 = $_POST['med_how_3'];
        $mh3 = $this->SanitizeForSQL($mh3);
        $tyl = $_POST['Tylenol_yes_no'];
        $tyl = $this->SanitizeForSQL($tyl);
        $sudpe = $_POST['Sudafed_PE_yes_no'];
        $sudpe = $this->SanitizeForSQL($sudpe);
        $amyn = $_POST['allergy_med_yes_no'];
        $amyn = $this->SanitizeForSQL($amyn);
        $benyn = $_POST['Benadryl_yes_no'];
        $benyn = $this->SanitizeForSQL($benyn);
        $tsyn = $_POST['Throat_spray_yes_no'];
        $tsyn = $this->SanitizeForSQL($tsyn);
        $calyn = $_POST['Calamine_yes_no'];
        $calyn = $this->SanitizeForSQL($calyn);
        $laxyn = $_POST['Laxatives_yes_no'];
        $laxyn = $this->SanitizeForSQL($laxyn);
        $ibuyn = $_POST['Ibuprofen_yes_no'];
        $ibuyn = $this->SanitizeForSQL($ibuyn);
        $sudyn = $_POST['Sudafed_yes_no'];
        $sudyn = $this->SanitizeForSQL($sudyn);
        $robyn = $_POST['Robitussin_yes_no'];
        $robyn = $this->SanitizeForSQL($robyn);
        $robdm = $_POST['Rob_DM_yes_no'];
        $robdm = $this->SanitizeForSQL($robdm);
        $cdyn = $_POST['cough_drops_yes_no'];
        $cdyn = $this->SanitizeForSQL($cdyn);
        $aloyn = $_POST['aloe_yes_no'];
        $aloyn = $this->SanitizeForSQL($aloyn);
        $pepyn = $_POST['Pepto_yes_no'];
        $pepyn = $this->SanitizeForSQL($pepyn);
        $pasyn = $_POST['passed_out_yes_no'];
        $pasyn = $this->SanitizeForSQL($pasyn);
        $rdyn = $_POST['recent_disease_yes_no'];
        $rdyn = $this->SanitizeForSQL($rdyn);
        $riyn = $_POST['recent_injury_yes_no'];
        $riyn = $this->SanitizeForSQL($riyn);
        $bpyn = $_POST['breathing_problem_yes_no'];
        $bpyn = $this->SanitizeForSQL($bpyn);
        $diayn = $_POST['diabetes_yes_no'];
        $diayn = $this->SanitizeForSQL($diayn);
        $seiyn = $_POST['seizures_yes_no'];
        $seiyn = $this->SanitizeForSQL($seiyn);
        $sknyn = $_POST['skin_problems_yes_no'];
        $sknyn = $this->SanitizeForSQL($sknyn);
        $slpyn = $_POST['sleep_problems_yes_no'];
        $slpyn = $this->SanitizeForSQL($slpyn);
        $diayn = $_POST['diarrhea_constipation_yes_no'];
        $diayn = $this->SanitizeForSQL($diayn);
        $glsyn = $_POST['glasses_yes_no'];
        $glsyn = $this->SanitizeForSQL($glsyn);
        $addyn = $_POST['ADD_ADHD_yes_no'];
        $addyn = $this->SanitizeForSQL($addyn);
        $hhyn = $_POST['health_history_Yes_explain'];
        $hhyn = $this->SanitizeForSQL($hhyn);
        $emoyn = $_POST['emotional_yes_no'];
        $emoyn = $this->SanitizeForSQL($emoyn);
        $menyn = $_POST['mental_illness_yes_no'];
        $menyn = $this->SanitizeForSQL($menyn);
        $mencom = $_POST['Mental_comments'];
        $mencom = $this->SanitizeForSQL($mencom);
        
        
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }
        
        $insert_query = 'insert into health_form (
            FirstName_e_contact_1,
            LastName_e_contact_1,
            Relationship_1,
            Phone_e_contact_1,
            FirstName_e_contact_2,
            LastName_e_contact_2,
            Relationship_2,
            Phone_e_contact_2,
            allergy_food_yes_no,
            allergy_medicine_yes_no,
            allergy_environment_yes_no,
            allergy_other_yes_no,
            comments_allergies,
            Immun_yes_no,
            Meds_at_camp_true_false,
            med_name_1,
            med_date_1,
            med_reason_1,
            med_time_1,
            med_amount_1,
            med_how_1,
            med_name_2,
            med_date_2,
            med_reason_2,
            med_time_2,
            med_amount_2,
            med_how_2,
            med_name_3,
            med_date_3,
            med_reason_3,
            med_time_3,
            med_amount_3,
            med_how_3,
            Tylenol_yes_no,
            Sudafed_PE_yes_no,
            allergy_med_yes_no,
            Benadryl_yes_no,
            Throat_spray_yes_no,
            Calamine_yes_no,
            Laxatives_yes_no,
            Ibuprofen_yes_no,
            Sudafed_yes_no,
            Robitussin_yes_no,
            Rob_DM_yes_no,
            cough_drops_yes_no,
            aloe_yes_no,
            Pepto_yes_no,
            passed_out_yes_no,
            recent_disease_yes_no,
            recent_injury_yes_no,
            breathing_problem_yes_no,
            diabetes_yes_no,
            seizures_yes_no,
            skin_problems_yes_no,
            sleep_problems_yes_no,
            diarrhea_constipation_yes_no,
            glasses_yes_no,
            health_history_Yes_explain,
            ADD_ADHD_yes_no,
            emotional_yes_no,
            mental_illness_yes_no,
            Mental_comments,
            camper_id
            )
            values
            (
                "' . $fname . '",
                "' . $lname . '",
                "' . $rel . '",
                "' . $ph . '", 
                "' . $fname2 . '",
                "' . $lname2 . '",
                "' . $rel2 . '",
                "' . $ph2 . '", 
                "' . $af . '",
                "' . $am . '",
                "' . $ae . '",
                "' . $ao . '",
                "' . $comall . '",
                "' . $imyn . '",   
                "' . $medtf . '",
                "' . $mn1 . '",
                "' . $md1 . '",
                "' . $mr1 . '",
                "' . $mt1 . '", 
                "' . $ma1 . '",
                "' . $mh1 . '",
                "' . $mn2 . '",
                "' . $md2 . '",
                "' . $mr2 . '",
                "' . $mt2 . '", 
                "' . $ma2 . '",
                "' . $mh2 . '",
                "' . $mn3 . '",
                "' . $md3 . '",
                "' . $mr3 . '",
                "' . $mt3 . '", 
                "' . $ma3 . '",
                "' . $mh3 . '",   
                "' . $tyl . '",
                "' . $sudpe . '", 
                "' . $amyn . '",  
                "' . $benyn . '",
                "' . $tsyn . '",  
                "' . $calyn . '",
                "' . $laxyn . '",  
                "' . $ibuyn . '",
                "' . $sudyn . '",  
                "' . $robyn . '",  
                "' . $robdm . '",  
                "' . $cdyn . '",
                "' . $aloyn . '",  
                "' . $pepyn . '",
                "' . $pasyn . '",  
                "' . $rdyn . '",
                "' . $riyn . '",  
                "' . $bpyn . '",
                "' . $diayn . '",   
                "' . $seiyn . '",
                "' . $sknyn . '", 
                "' . $slpyn . '",
                "' . $diayn . '",  
                "' . $glsyn . '",
                "' . $hhyn . '",    
                "' . $addyn . '",     
                "' . $emoyn . '",
                "' . $menyn . '",   
                "' . $mencom . '",    
                "' . $_SESSION['camper_id'] . '"
                )'; 
        
        if(!mysql_query( $insert_query ,$this->connection))
        {
            header("Location: Form_submit_error.html");
            return false;
        } 
        $id = $_SESSION['camper_id'];
      
        
        if(isset($_POST['submitted']))
            {
   
            header("Location: Consent_Form.php");
    
            }
                
   
    }
    
    //-------Public Helper functions -------------
    function GetSelfScript()
    {
        return htmlentities($_SERVER['PHP_SELF']);
    }    
    
    function SafeDisplay($value_name)
    {
        if(empty($_POST[$value_name]))
        {
            return'';
        }
        return htmlentities($_POST[$value_name]);
    }
    
    function RedirectToURL($url)
    {
        header("Location: $url");
        exit;
    }
    
    function GetSpamTrapInputName()
    {
        return 'sp'.md5('KHGdnbvsgst'.$this->rand_key);
    }
    
    function GetErrorMessage()
    {
        if(empty($this->error_message))
        {
            return '';
        }
        $errormsg = nl2br(htmlentities($this->error_message));
        return $errormsg;
    }    
    //-------Private Helper functions-----------
    
    function HandleError($err)
    {
        $this->error_message .= $err."\r\n";
    }
    
    function HandleDBError($err)
    {
        $this->HandleError($err."\r\n mysqlerror:".mysql_error());
    }
    
    function GetFromAddress()
    {
        if(!empty($this->from_address))
        {
            return $this->from_address;
        }

        $host = $_SERVER['SERVER_NAME'];

        $from ="do-not-reply@$host";
        return $from;
    } 
    
    function GetLoginSessionVar()
    {
        $retvar = md5($this->rand_key);
        $retvar = 'usr_'.substr($retvar,0,10);
        return $retvar;
    }
    
    function CheckLoginInDB($username,$password)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }          
        $username = $this->SanitizeForSQL($username);
        $pwdmd5 = md5($password);
        $qry = "Select id_user, name, email from $this->tablename where username='$username' and password='$pwdmd5' and confirmcode='y'";
        
        $result = mysql_query($qry,$this->connection);
        
        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("Error logging in. The username or password does not match");
            return false;
        }
        
        $row = mysql_fetch_assoc($result);
        
        
        $_SESSION['name_of_user']  = $row['name'];
        $_SESSION['email_of_user'] = $row['email'];
        $_SESSION['id_of_user'] = $row['id_user'];
        
        return true;
    }
    function GetCamperImage()
    {      
         if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
            
            $id = $_SESSION['camper_id'];
            
        }   
        $result = mysql_query("Select image from week_photo where camper_id = '$id'");
        
        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("Sorry Picture not found.");
            return false;
        }
        
         $row = mysql_fetch_assoc($result);
         
         $_SESSION['image']  = $row['image'];
        
    }
    function UpdateDBRecForConfirmation(&$user_rec)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   
        $confirmcode = $this->SanitizeForSQL($_GET['code']);
        
        $result = mysql_query("Select name, email from $this->tablename where confirmcode='$confirmcode'",$this->connection);   
        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("Wrong confirm code.");
            return false;
        }
        $row = mysql_fetch_assoc($result);
        $user_rec['name'] = $row['name'];
        $user_rec['email']= $row['email'];
        
        $qry = "Update $this->tablename Set confirmcode='y' Where  confirmcode='$confirmcode'";
        
        if(!mysql_query( $qry ,$this->connection))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$qry");
            return false;
        }      
        return true;
    }
    
    function ResetUserPasswordInDB($user_rec)
    {
        $new_password = substr(md5(uniqid()),0,10);
        
        if(false == $this->ChangePasswordInDB($user_rec,$new_password))
        {
            return false;
        }
        return $new_password;
    }
    
    function ChangePasswordInDB($user_rec, $newpwd)
    {
        $newpwd = $this->SanitizeForSQL($newpwd);
        
        $qry = "Update $this->tablename Set password='".md5($newpwd)."' Where  id_user=".$user_rec['id_user']."";
        
        if(!mysql_query( $qry ,$this->connection))
        {
            $this->HandleDBError("Error updating the password \nquery:$qry");
            return false;
        }     
        return true;
    }
    
    function GetUserFromEmail($email,&$user_rec)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   
        $email = $this->SanitizeForSQL($email);
        
        $result = mysql_query("Select * from $this->tablename where email='$email'",$this->connection);  

        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("There is no user with email: $email");
            return false;
        }
        $user_rec = mysql_fetch_assoc($result);

        
        return true;
    }
    
    function SendUserWelcomeEmail(&$user_rec)
    {
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($user_rec['email'],$user_rec['name']);
        
        $mailer->Subject = "Welcome to ".$this->sitename;

        $mailer->From = $this->GetFromAddress();        
        
        $mailer->Body ="Hello ".$user_rec['name']."\r\n\r\n".
        "Welcome! Your registration  with ".$this->sitename." is completed.\r\n".
        "\r\n".
        "Regards,\r\n".
        "Webmaster\r\n".
        $this->sitename;

        if(!$mailer->Send())
        {
            $this->HandleError("Failed sending user welcome email.");
            return false;
        }
        return true;
    }
    
    function SendAdminIntimationOnRegComplete(&$user_rec)
    {
        if(empty($this->admin_email))
        {
            return false;
        }
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($this->admin_email);
        
        $mailer->Subject = "Registration Completed: ".$user_rec['name'];

        $mailer->From = $this->GetFromAddress();         
        
        $mailer->Body ="A new user registered at ".$this->sitename."\r\n".
        "Name: ".$user_rec['name']."\r\n".
        "Email address: ".$user_rec['email']."\r\n";
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }
    
    function GetResetPasswordCode($email)
    {
       return substr(md5($email.$this->sitename.$this->rand_key),0,10);
    }
    
    function SendResetPasswordLink($user_rec)
    {
        $email = $user_rec['email'];
        
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($email,$user_rec['name']);
        
        $mailer->Subject = "Your reset password request at ".$this->sitename;

        $mailer->From = $this->GetFromAddress();
        
        $link = $this->GetAbsoluteURLFolder().
                '/resetpwd.php?email='.
                urlencode($email).'&code='.
                urlencode($this->GetResetPasswordCode($email));

        $mailer->Body ="Hello ".$user_rec['name']."\r\n\r\n".
        "There was a request to reset your password at ".$this->sitename."\r\n".
        "Please click the link below to complete the request: \r\n".$link."\r\n".
        "Regards,\r\n".
        "Webmaster\r\n".
        $this->sitename;
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }
    
    function SendNewPassword($user_rec, $new_password)
    {
        $email = $user_rec['email'];
        
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($email,$user_rec['name']);
        
        $mailer->Subject = "Your new password for ".$this->sitename;

        $mailer->From = $this->GetFromAddress();
        
        $mailer->Body ="Hello ".$user_rec['name']."\r\n\r\n".
        "Your password is reset successfully. ".
        "Here is your updated login:\r\n".
        "username:".$user_rec['username']."\r\n".
        "password:$new_password\r\n".
        "\r\n".
        "Login here: ".$this->GetAbsoluteURLFolder()."/login.php\r\n".
        "\r\n".
        "Regards,\r\n".
        "Webmaster\r\n".
        $this->sitename;
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }    
    
    function ValidateRegistrationSubmission()
    {
        //This is a hidden input field. Humans won't fill this field.
        if(!empty($_POST[$this->GetSpamTrapInputName()]) )
        {
            //The proper error is not given intentionally
            $this->HandleError("Automated submission prevention: case 2 failed");
            return false;
        }
        
        $validator = new FormValidator();
        $validator->addValidation("FirstName","req","Please fill in FirstName");
        $validator->addValidation("LastName","req","Please fill in LastName");
        $validator->addValidation("Address","req","Please enter an Address");
        $validator->addValidation("City","req","Please enter a City");
        $validator->addValidation("state","req","Please enter a state");
        $validator->addValidation("zip","req","Please enter a zipcode");
        $validator->addValidation("DOB","req","Please enter a Date of Birth");
        $validator->addValidation("Gender","req","Please enter Male or Female");
        $validator->addValidation("yes_no","req","Please answer Yes or No");
        $validator->addValidation("first_name_f","req","Please enter Firstname");
        $validator->addValidation("last_name_f","req","Please enter Lastname");
        $validator->addValidation("home_phone_f","req","Please enter phone number. If you only have one number enter in all fields");
        $validator->addValidation("work_phone_f","req","Please enter phone number. If you only have one number enter in all fields");
        $validator->addValidation("cell_phone_f","req","Please enter phone number. If you only have one number enter in all fields");
        $validator->addValidation("first_name_m","req","Please enter Firstname");
        $validator->addValidation("last_name_m","req","Please enter Lastname");
        $validator->addValidation("home_phone_m","req","Please enter phone number. If you only have one number enter in all fields");
        $validator->addValidation("work_phone_m","req","Please enter phone number. If you only have one number enter in all fields");
        $validator->addValidation("cell_phone_m","req","Please enter phone number. If you only have one number enter in all fields");
        if(!$validator->ValidateForm())
        {
            $error='';
            $error_hash = $validator->GetErrors();
            foreach($error_hash as $inpname => $inp_err)
            {
                $error .= $inpname.':'.$inp_err."\n";
            }
            $this->HandleError($error);
            return false;
        }        
        return true;
    }
    
    function CollectRegistrationSubmission(&$formvars)
    {
        $formvars['FirstName'] = $this->Sanitize($_POST['FirstName']);
        $formvars['LastName'] = $this->Sanitize($_POST['LastName']);
        $formvars['Address'] = $this->Sanitize($_POST['Address']);
        $formvars['City'] = $this->Sanitize($_POST['City']);
        $formvars['state'] = $this->Sanitize($_POST['state']);
        $formvars['zip'] = $this->Sanitize($_POST['zip']);
        $formvars['county'] = $this->Sanitize($_POST['county']);
        $formvars['comment'] = $this->Sanitize($_POST['comment']);
        $formvars['DOB'] = $this->Sanitize($_POST['DOB']);
        $formvars['Age'] = $this->Sanitize($_POST['Age']);
        $formvars['Grade'] = $this->Sanitize($_POST['Grade']);
        $formvars['Gender'] = $this->Sanitize($_POST['Gender']);
        $formvars['yes_no'] = $this->Sanitize($_POST['yes_no']);
        
        $formvars['first_name_f'] = $this->Sanitize($_POST['first_name_f']);
        $formvars['last_name_f'] = $this->Sanitize($_POST['last_name_f']);
        $formvars['email_f'] = $this->Sanitize($_POST['email_f']);
        $formvars['home_phone_f'] = $this->Sanitize($_POST['home_phone_f']);
        $formvars['work_phone_f'] = $this->Sanitize($_POST['work_phone_f']);
        $formvars['cell_phone_f'] = $this->Sanitize($_POST['cell_phone_f']);
        $formvars['address_f'] = $this->Sanitize($_POST['address_f']);
        $formvars['city_f'] = $this->Sanitize($_POST['city_f']);
        $formvars['state_f'] = $this->Sanitize($_POST['state_f']);
        $formvars['zip_f'] = $this->Sanitize($_POST['zip_f']);
        $formvars['county_f'] = $this->Sanitize($_POST['county_f']);
        
        $formvars['first_name_m'] = $this->Sanitize($_POST['first_name_m']);
        $formvars['last_name_m'] = $this->Sanitize($_POST['last_name_m']);
        $formvars['email_m'] = $this->Sanitize($_POST['email_m']);
        $formvars['home_phone_m'] = $this->Sanitize($_POST['home_phone_m']);
        $formvars['work_phone_m'] = $this->Sanitize($_POST['work_phone_m']);
        $formvars['cell_phone_m'] = $this->Sanitize($_POST['cell_phone_m']);
        $formvars['address_m'] = $this->Sanitize($_POST['address_m']);
        $formvars['city_m'] = $this->Sanitize($_POST['city_m']);
        $formvars['state_m'] = $this->Sanitize($_POST['state_m']);
        $formvars['zip_m'] = $this->Sanitize($_POST['zip_m']);
        $formvars['county_m'] = $this->Sanitize($_POST['county_m']);
        
        $formvars['roommate_1'] = $this->Sanitize($_POST['roommate_1']);
        $formvars['roommate_2'] = $this->Sanitize($_POST['roommate_2']);
    }
    
    function SendUserConfirmationEmail(&$formvars)
    {
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($formvars['email'],$formvars['name']);
        
        $mailer->Subject = "Congratulations!!! Your registration with ".$this->sitename;

        $mailer->From = $this->GetFromAddress();        
        
        $confirmcode = $formvars['confirmcode'];
        
        $confirm_url = $this->GetAbsoluteURLFolder().'/confirmreg.php?code='.$confirmcode;
        
        $mailer->Body ="Hello ".$formvars['name']."\r\n\r\n".
        "Thanks for your registration with ".$this->sitename."\r\n".
        "Please click the link below to confirm your registration.\r\n".
        "$confirm_url\r\n".
        "\r\n".
        "Regards,\r\n".
        "Webmaster\r\n".
        $this->sitename;

        if(!$mailer->Send())
        {
            $this->HandleError("Failed sending registration confirmation email.");
            return false;
        }
        return true;
    }
    function GetAbsoluteURLFolder()
    {
        $scriptFolder = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) ? 'https://' : 'http://';
        $scriptFolder .= $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']);
        return $scriptFolder;
    }
    
    function SendAdminIntimationEmail(&$formvars)
    {
        if(empty($this->admin_email))
        {
            return false;
        }
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($this->admin_email);
        
        $mailer->Subject = "New registration: ".$formvars['name'];

        $mailer->From = $this->GetFromAddress();         
        
        $mailer->Body ="A new user registered at ".$this->sitename."\r\n".
        "Name: ".$formvars['name']."\r\n".
        "Email address: ".$formvars['email']."\r\n".
        "UserName: ".$formvars['username'];
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }
    
    function SaveToDatabase(&$formvars)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }
        if(!$this->Ensuretable())
        {
            return false;
        }
        
        if(!$this->IsFieldUnique($formvars,'FirstName','LastName'))
        {
            $this->HandleError("This name is already registered");
            return false;
        }
        
     /*   if(!$this->IsFieldUnique($formvars,'username'))
        {
            $this->HandleError("This UserName is already used. Please try another username");
            return false;
        }*/        
        if(!$this->InsertIntoDB($formvars))
        {
            $this->HandleError("Inserting to Database failed!");
            return false;
        }
        return true;
    }
    
    function IsFieldUnique($formvars,$fieldname,$fieldname1)
    {
        $field_val = $this->SanitizeForSQL($formvars[$fieldname]);
        $field_val1 = $this->SanitizeForSQL($formvars[$fieldname1]);
        $qry = "select FirstName, LastName from $this->tablename where $fieldname='".$field_val."' and $fieldname1='".$field_val1."'" ;
        $result = mysql_query($qry,$this->connection);   
        if($result && mysql_num_rows($result) > 0)
        {
            return false;
        }
        return true;
    }
    
    function DBLogin()
    {

        $this->connection = mysql_connect($this->db_host,$this->username,$this->pwd);

        if(!$this->connection)
        {   
            $this->HandleDBError("Database Login failed! Please make sure that the DB login credentials provided are correct");
            return false;
        }
        if(!mysql_select_db($this->database, $this->connection))
        {
            $this->HandleDBError('Failed to select database: '.$this->database.' Please make sure that the database name provided is correct');
            return false;
        }
        if(!mysql_query("SET NAMES 'UTF8'",$this->connection))
        {
            $this->HandleDBError('Error setting utf8 encoding');
            return false;
        }
        return true;
    }    
    
    function Ensuretable()
    {
        $result = mysql_query("SHOW COLUMNS FROM camper_info");   
        if(!$result || mysql_num_rows($result) <= 0)
        {
            return $this->CreateTable();
        }
        return true;
 
    }
    
    function CreateTable()
    {
       
        $qry = "Create Table camper_info (".
                "camper_id INT(11) NOT NULL AUTO_INCREMENT ,".
                "FirstName VARCHAR( 200 ) NOT NULL ,".
                "LastName VARCHAR( 200 ) NOT NULL ,".
                "Address VARCHAR( 200 ) NOT NULL ,".
                "City VARCHAR( 100 ) NOT NULL ,".
                "state VARCHAR( 100 ) NOT NULL ,".
		"zip DECIMAL(6,0) NOT NULL ,".
                "county VARCHAR( 100 ) NOT NULL ,".
                "comment VARCHAR( 300 ) NOT NULL ,".
		"DOB VARCHAR( 100 ) NOT NULL ," .
                "Age VARCHAR( 100 ) NOT NULL ,".
                "Grade VARCHAR( 100 ) NOT NULL ,".
                "Gender VARCHAR(50) ,".
		"yes_no VARCHAR(10) NOT NULL ," .
		"id_user INT(11) NOT NULL ," .
                "PRIMARY KEY ( camper_id ) , ".
                "FOREIGN KEY ( id_user ) REFERENCES users ( id_user ) ".
                ")";   
        if(!mysql_query($qry,$connection))
        {
            $this->HandleDBError("Error creating the table \nquery was\n $qry");
            return false;
        }
    
        
        $qry = "Create Table parent_guardian_info (".
                "pg_id INT(11) NOT NULL AUTO_INCREMENT ,".
                "first_name_f VARCHAR( 200 ) NOT NULL ,".
                "last_name_f VARCHAR( 200 ) NOT NULL ,".
                "email_f VARCHAR( 100 ) NOT NULL ,".
                "home_phone_f VARCHAR( 100 ) NOT NULL ,".
                "work_phone_f VARCHAR( 100 ) NOT NULL ,".
		"cell_phone_f VARCHAR( 100 ) NOT NULL ,".
                "address_f VARCHAR( 100 ) NOT NULL ,".
                "city_f VARCHAR( 100 ) NOT NULL ,".
		"state_f VARCHAR( 100 ) NOT NULL ," .
                "zip_f VARCHAR( 100 ) NOT NULL ,".
                "first_name_m VARCHAR( 200 ) NOT NULL ,".
                "last_name_m VARCHAR( 200 ) NOT NULL ,".
                "email_m VARCHAR( 100 ) NOT NULL ,".
                "home_phone_m VARCHAR( 100 ) NOT NULL ,".
                "work_phone_m VARCHAR( 100 ) NOT NULL ,".
		"cell_phone_m VARCHAR( 100 ) NOT NULL ,".
                "address_m VARCHAR( 100 ) NOT NULL ,".
                "city_m VARCHAR( 100 ) NOT NULL ,".
		"state_m VARCHAR( 100 ) NOT NULL ," .
                "zip_m VARCHAR( 100 ) NOT NULL ,".
		"camper_id INT(11) NOT NULL ," .
                "PRIMARY KEY ( pg_id ), ".
                "UNIQUE KEY ( camper_id ), ".
                "FOREIGN KEY ( camper_id ) REFERENCES camper_info ( camper_id) ON DELETE CASCADE " .
                ")";
                
        if(!mysql_query($qry,$this->connection))
        {
            $this->HandleDBError("Error creating the table \nquery was\n $qry");
            return false;
        }
        
         $qry = "Create Table roommate (".
                "roommate_id INT(11) NOT NULL AUTO_INCREMENT ,".
                "roommate_1 VARCHAR( 200 ) NOT NULL ,".
                "roommate_2 VARCHAR( 200 ) NOT NULL ,".
		"camper_id INT(11) NOT NULL ," .
                "PRIMARY KEY ( roommate_id ), ".
                "UNIQUE KEY ( camper_id ), ".
                "FOREIGN KEY ( camper_id ) REFERENCES camper_info ( camper_id) ON DELETE CASCADE ".
                ")";
                
        if(!mysql_query($qry,$this->connection))
        {
            $this->HandleDBError("Error creating the table \nquery was\n $qry");
            return false;
                     
        }
        $qry = "Create Table consent_form (".
                "consent_id INT(11) NOT NULL AUTO_INCREMENT ,".
                "Insurance_Company VARCHAR( 200 ) NOT NULL ,".
                "Policy_Number VARCHAR( 200 ) NOT NULL ,".
                "confirm_code VARCHAR( 200 ) NOT NULL ,".
		"camper_id INT(11) NOT NULL ," .
                "PRIMARY KEY ( consent_id ), ".
                "UNIQUE KEY ( camper_id ), ".
                "FOREIGN KEY ( camper_id ) REFERENCES camper_info ( camper_id) ON DELETE CASCADE ".
                ")";
                
        if(!mysql_query($qry,$this->connection))
        {
            $this->HandleDBError("Error creating the table \nquery was\n $qry");
            return false;
                     
        }
         
        
        $qry = "Create Table week_photo ("
                . "week_photo_id INT(11) NOT NULL AUTO_INCREMENT,"
                . "week VARCHAR (200) NOT NULL,"
                . "imageType VARCHAR (25) NOT NULL,"
                . "imagedata LONGBLOB NOT NULL,"
                . "camper_id INT(11) NOT NULL,"
                . "PRIMARY KEY ( week_photo_id ),"
                . "UNIQUE KEY ( camper_id ),"
                . "FOREIGN KEY ( camper_id ) REFERENCES camper_info ( camper_id ) ON DELETE CASCADE "
                . ")";
        if(!mysql_query($qry,$this->connection))
        {
            $this->HandleDBError("Error creating the table \nquery was\n $qry");
            return false;
        }
        
        $qry = "Create Table health_form ("
                . "health_form_id INT(11) NOT NULL AUTO_INCREMENT,"
                . "FirstName_e_contact_1 VARCHAR (200) NOT NULL,"
                . "LastName_e_contact_1 VARCHAR (200) NOT NULL,"
                . "Relationship_1 VARCHAR (200) NOT NULL,"
                . "Phone_e_contact_1 VARCHAR (200) NOT NULL,"
                . "FirstName_e_contact_2 VARCHAR (200) NOT NULL,"
                . "LastName_e_contact_2 VARCHAR (200) NOT NULL,"
                . "Relationship_2 VARCHAR (200) NOT NULL,"
                . "Phone_e_contact_2 VARCHAR (200) NOT NULL,"
                . "allergy_food_yes_no VARCHAR (200) NOT NULL,"
                . "allergy_medicine_yes_no VARCHAR (200) NOT NULL,"
                . "allergy_environment_yes_no VARCHAR (200) NOT NULL,"
                . "allergy_other_yes_no VARCHAR (200) NOT NULL,"
                . "comments_allergies VARCHAR (200) NOT NULL,"
                . "Immun_yes_no VARCHAR (200) NOT NULL,"
                . "Meds_at_camp_true_false VARCHAR (200) NOT NULL,"
                . "med_name_1 VARCHAR (200) NOT NULL,"
                . "med_date_1 VARCHAR (200) NOT NULL,"
                . "med_reason_1 VARCHAR (200) NOT NULL,"
                . "med_time_1 VARCHAR (200) NOT NULL,"
                . "med_amount_1 VARCHAR (200) NOT NULL,"
                . "med_how_1 VARCHAR (200) NOT NULL,"
                . "med_name_2 VARCHAR (200) NOT NULL,"
                . "med_date_2 VARCHAR (200) NOT NULL,"
                . "med_reason_2 VARCHAR (200) NOT NULL,"
                . "med_time_2 VARCHAR (200) NOT NULL,"
                . "med_amount_2 VARCHAR (200) NOT NULL,"
                . "med_how_2 VARCHAR (200) NOT NULL,"
                . "med_name_3 VARCHAR (200) NOT NULL,"
                . "med_date_3 VARCHAR (200) NOT NULL,"
                . "med_reason_3 VARCHAR (200) NOT NULL,"
                . "med_time_3 VARCHAR (200) NOT NULL,"
                . "med_amount_3 VARCHAR (200) NOT NULL,"
                . "med_how_3 VARCHAR (200) NOT NULL,"
                . "Tylenol_yes_no VARCHAR (200) NOT NULL,"
                . "Sudafed_PE_yes_no VARCHAR (200) NOT NULL,"
                . "allergy_med_yes_no VARCHAR (200) NOT NULL,"
                . "Benadryl_yes_no VARCHAR (200) NOT NULL,"
                . "Throat_spray_yes_no VARCHAR (200) NOT NULL,"
                . "Calamine_yes_no VARCHAR (200) NOT NULL,"
                . "Laxatives_yes_no VARCHAR (200) NOT NULL,"
                . "Ibuprofen_yes_no VARCHAR (200) NOT NULL,"
                . "Sudafed_yes_no VARCHAR (200) NOT NULL,"
                . "Robitussin_yes_no VARCHAR (200) NOT NULL,"
                . "Rob_DM_yes_no VARCHAR (200) NOT NULL,"
                . "cough_drops_yes_no VARCHAR (200) NOT NULL,"
                . "aloe_yes_no VARCHAR (200) NOT NULL,"
                . "Pepto_yes_no VARCHAR (200) NOT NULL,"
                . "passed_out_yes_no VARCHAR (200) NOT NULL,"
                . "recent_disease_yes_no VARCHAR (200) NOT NULL,"
                . "recent_injury_yes_no VARCHAR (200) NOT NULL,"
                . "breathing_problem_yes_no VARCHAR (200) NOT NULL,"
                . "diabetes_yes_no VARCHAR (200) NOT NULL,"
                . "seizures_yes_no VARCHAR (200) NOT NULL,"
                . "skin_problems_yes_no VARCHAR (200) NOT NULL,"
                . "sleep_problems_yes_no VARCHAR (200) NOT NULL,"
                . "diarrhea_constipation_yes_no VARCHAR (200) NOT NULL,"
                . "glasses_yes_no VARCHAR (200) NOT NULL,"
                . "health_history_Yes_explain VARCHAR (200) NOT NULL,"
                . "ADD_ADHD_yes_no VARCHAR (200) NOT NULL,"
                . "emotional_yes_no VARCHAR (200) NOT NULL,"
                . "mental_illness_yes_no VARCHAR (200) NOT NULL,"
                . "Mental_comments VARCHAR (200) NOT NULL,"
                . "camper_id INT(11) NOT NULL,"
                . "PRIMARY KEY ( health_form_id ),"
                . "UNIQUE KEY ( camper_id ),"
                . "FOREIGN KEY ( camper_id ) REFERENCES camper_info ( camper_id ) ON DELETE CASCADE "
                . ")";
        if(!mysql_query($qry,$this->connection))
        {
            $this->HandleDBError("Error creating the table \nquery was\n $qry");
            return false;
        }
        
        
        
        
        return true;
    }
    
        function InsertIntoDB(&$formvars)
    {
    
        
        
        $insert_query = 'insert into '.$this->tablename.'(
                FirstName,
                LastName,
                Address,
                City,
		state,
		zip,
                county,
                comment,
		DOB,
                Age,
                Grade,
		Gender,
		yes_no,
                id_user
                )
                values
                (
                "' . $this->SanitizeForSQL($formvars['FirstName']) . '",
                "' . $this->SanitizeForSQL($formvars['LastName']) . '",   
                "' . $this->SanitizeForSQL($formvars['Address']) . '",
		"' . $this->SanitizeForSQL($formvars['City']) . '",
                "' . $this->SanitizeForSQL($formvars['state']) . '",
                "' . $this->SanitizeForSQL($formvars['zip']) . '",
                "' . $this->SanitizeForSQL($formvars['county']) . '",
                "' . $this->SanitizeForSQL($formvars['comment']) . '",  
		"' . $this->SanitizeForSQL($formvars['DOB']) . '",
                "' . $this->SanitizeForSQL($formvars['Age']) . '",
                "' . $this->SanitizeForSQL($formvars['Grade']) . '",
                "' . $this->SanitizeForSQL($formvars['Gender']) . '",
                "' . $this->SanitizeForSQL($formvars['yes_no']) . '",
                "' . $_SESSION['id_of_user'] . '"
                )';      
        if(!mysql_query( $insert_query ,$this->connection))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
            return false;
        }   
      
        $_SESSION['camper_id']  = mysql_insert_id();
        
        $insert_query_pg = 'insert into parent_guardian_info(
                first_name_f,
                last_name_f,
                email_f,
                home_phone_f,
		work_phone_f,
		cell_phone_f,
                address_f,
                city_f,
		state_f,
                zip_f,
                first_name_m,
                last_name_m,
                email_m,
                home_phone_m,
		work_phone_m,
		cell_phone_m,
                address_m,
                city_m,
		state_m,
                zip_m,
                camper_id
                )
                values
                (
                "' . $this->SanitizeForSQL($formvars['first_name_f']) . '",
                "' . $this->SanitizeForSQL($formvars['last_name_f']) . '",   
                "' . $this->SanitizeForSQL($formvars['email_f']) . '",
		"' . $this->SanitizeForSQL($formvars['home_phone_f']) . '",
                "' . $this->SanitizeForSQL($formvars['work_phone_f']) . '",
                "' . $this->SanitizeForSQL($formvars['cell_phone_f']) . '",
                "' . $this->SanitizeForSQL($formvars['address_f']) . '",
                "' . $this->SanitizeForSQL($formvars['city_f']) . '",  
		"' . $this->SanitizeForSQL($formvars['state_f']) . '",
                "' . $this->SanitizeForSQL($formvars['zip_f']) . '",
                "' . $this->SanitizeForSQL($formvars['first_name_m']) . '",
                "' . $this->SanitizeForSQL($formvars['last_name_m']) . '",   
                "' . $this->SanitizeForSQL($formvars['email_m']) . '",
		"' . $this->SanitizeForSQL($formvars['home_phone_m']) . '",
                "' . $this->SanitizeForSQL($formvars['work_phone_m']) . '",
                "' . $this->SanitizeForSQL($formvars['cell_phone_m']) . '",
                "' . $this->SanitizeForSQL($formvars['address_m']) . '",
                "' . $this->SanitizeForSQL($formvars['city_m']) . '",  
		"' . $this->SanitizeForSQL($formvars['state_m']) . '",
                "' . $this->SanitizeForSQL($formvars['zip_m']) . '",
                "' . $_SESSION['camper_id'] . '"
                )';      
        if(!mysql_query( $insert_query_pg ,$this->connection))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$insert_query_pg");
            return false;
        }   
        
        $insert_query_roommate = 'insert into roommate(
                roommate_1,
                roommate_2,
                camper_id
                )
                values
                (
                "' . $this->SanitizeForSQL($formvars['roommate_1']) . '",
                "' . $this->SanitizeForSQL($formvars['roommate_2']) . '",   
                "' . $_SESSION['camper_id'] . '"
                )';      
        if(!mysql_query( $insert_query_roommate ,$this->connection))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$insert_query_roommate");
            return false;
        }   
        $this->Add_Health_Form();
        return true;
        
    }
    function MakeConfirmationMd5($email)
    {
        $randno1 = rand();
        $randno2 = rand();
        return md5($email.$this->rand_key.$randno1.''.$randno2);
    }
    function SanitizeForSQL($str)
    {
        if( function_exists( "mysql_real_escape_string" ) )
        {
              $ret_str = mysql_real_escape_string( $str );
        }
        else
        {
              $ret_str = addslashes( $str );
        }
        return $ret_str;
    }
    
 /*
    Sanitize() function removes any potential threat from the
    data submitted. Prevents email injections or any other hacker attempts.
    if $remove_nl is true, newline chracters are removed from the input.
    */
    function Sanitize($str,$remove_nl=true)
    {
        $str = $this->StripSlashes($str);

        if($remove_nl)
        {
            $injections = array('/(\n+)/i',
                '/(\r+)/i',
                '/(\t+)/i',
                '/(%0A+)/i',
                '/(%0D+)/i',
                '/(%08+)/i',
                '/(%09+)/i'
                );
            $str = preg_replace($injections,'',$str);
        }

        return $str;
    }    
    function StripSlashes($str)
    {
        if(get_magic_quotes_gpc())
        {
            $str = stripslashes($str);
        }
        return $str;
    } 
    
    
}


  

?>