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
         function AddCamperInfo()
    {
         if($_FILES['image']['size'] > 1048576){
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
             
        //camper_info variables
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
        $zip = $_POST['Zip'];
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
        
        //parent_gardian variables
        $fnfath = $_POST['first_name_f'];
        $fnfath = $this->SanitizeForSQL($fnfath);
        $lnfath = $_POST['last_name_f'];
        $lnfath = $this->SanitizeForSQL($lnfath);
        $emfath = $_POST['email_f'];
        $emfath = $this->SanitizeForSQL($emfath);
        $hpfath = $_POST['home_phone_f'];
        $hpfath = $this->SanitizeForSQL($hpfath);
        $wpfath = $_POST['work_phone_f'];
        $wpfath = $this->SanitizeForSQL($wpfath);
        $cpfath = $_POST['cell_phone_f'];
        $cpfath = $this->SanitizeForSQL($cpfath);
        $adfath = $_POST['address_f'];
        $adfath = $this->SanitizeForSQL($adfath);
        $ctfath = $_POST['city_f'];
        $ctfath = $this->SanitizeForSQL($ctfath);
        $stfath = $_POST['state_f'];
        $stfath = $this->SanitizeForSQL($stfath);
        $zpfath = $_POST['zip_f'];
        $zpfath = $this->SanitizeForSQL($zpfath);
        $fnmoth = $_POST['first_name_m'];
        $fnmoth = $this->SanitizeForSQL($fnmoth);
        $lnmoth = $_POST['last_name_m'];
        $lnmoth = $this->SanitizeForSQL($lnmoth);
        $emmoth = $_POST['email_m'];
        $emmoth = $this->SanitizeForSQL($emmoth);
        $hpmoth = $_POST['home_phone_m'];
        $hpmoth = $this->SanitizeForSQL($hpmoth);
        $wpmoth = $_POST['work_phone_m'];
        $wpmoth = $this->SanitizeForSQL($wpmoth);
        $cpmoth = $_POST['cell_phone_m'];
        $cpmoth = $this->SanitizeForSQL($cpmoth);
        $admoth = $_POST['address_m'];
        $admoth = $this->SanitizeForSQL($admoth);
        $ctmoth = $_POST['city_m'];
        $ctmoth = $this->SanitizeForSQL($ctmoth);
        $stmoth = $_POST['state_m'];
        $stmoth = $this->SanitizeForSQL($stmoth);
        $zpmoth = $_POST['zip_m'];
        $zpmoth = $this->SanitizeForSQL($zpmoth);
        
        //Roommate Variables
        $rm1 = $_POST['roommate_1'];
        $rm1 = $this->SanitizeForSQL($rm1);
        $rm2 = $_POST['roommate_2'];
        $rm2 = $this->SanitizeForSQL($rm2);
        
        //health_form variables
        $fnec1 = $_POST['FirstName_e_contact_1'];
        $fnec1 = $this->SanitizeForSQL($fnec1);
        $lnec1 = $_POST['LastName_e_contact_1'];
        $lnec1 = $this->SanitizeForSQL($lnec1);
        $reec1 = $_POST['Relationship_1'];
        $reec1 = $this->SanitizeForSQL($reec1);
        $phec1 = $_POST['Phone_e_contact_1'];
        $phec1 = $this->SanitizeForSQL($phec1);
        $fnec2 = $_POST['FirstName_e_contact_2'];
        $fnec2 = $this->SanitizeForSQL($fnec2);
        $lnec2 = $_POST['LastName_e_contact_2'];
        $lnec2 = $this->SanitizeForSQL($lnec2);
        $reec2 = $_POST['Relationship_2'];
        $reec2 = $this->SanitizeForSQL($reec2);
        $phec2 = $_POST['Phone_e_contact_2'];
        $phec2 = $this->SanitizeForSQL($phec2);
        $af = $_POST['allergy_food_yes_no'];
        $af = $this->SanitizeForSQL($af);
        $am = $_POST['allergy_medicine_yes_no'];
        $am = $this->SanitizeForSQL($am);
        $aeyn = $_POST['allergy_enviornment_yes_no'];
        $aeyn = $this->SanitizeForSQL($aeyn);
        $ao = $_POST['allergy_other_yes_no'];
        $ao = $this->SanitizeForSQL($ao);
        $ca = $_POST['comments_allergies'];
        $ca = $this->SanitizeForSQL($ca);
        $iyn = $_POST['Immun_yes_no'];
        $iyn = $this->SanitizeForSQL($iyn);
        $mtf = $_POST['Meds_at_camp_true_false'];
        $mtf = $this->SanitizeForSQL($mtf);
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
        $tyn = $_POST['Tylenol_yes_no'];
        $tyn = $this->SanitizeForSQL($tyn);
        $peyn = $_POST['Sudafed_PE_yes_no'];
        $peyn = $this->SanitizeForSQL($peyn);
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
        $ibyn = $_POST['Ibuprofen_yes_no'];
        $ibyn = $this->SanitizeForSQL($ibyn);
        $sudyn = $_POST['Sudafed_yes_no'];
        $sudyn = $this->SanitizeForSQL($sudyn);
        $robyn = $_POST['Robitussin_yes_no'];
        $robyn = $this->SanitizeForSQL($robyn);
        $rdmyn = $_POST['Rob_DM_yes_no'];
        $rdmyn = $this->SanitizeForSQL($rdmyn);
        $cdyn = $_POST['cough_drops_yes_no'];
        $cdyn = $this->SanitizeForSQL($cdyn);
        $alyn = $_POST['aloe_yes_no'];
        $alyn = $this->SanitizeForSQL($alyn);
        $pepyn = $_POST['Pepto_yes_no'];
        $pepyn = $this->SanitizeForSQL($pepyn);
        $poyn = $_POST['passed_out_yes_no'];
        $poyn = $this->SanitizeForSQL($poyn);
        $rdyn = $_POST['recent_disease_yes_no'];
        $rdyn = $this->SanitizeForSQL($rdyn);
        $riyn = $_POST['recent_injury_yes_no'];
        $riyn = $this->SanitizeForSQL($riyn);
        $bpyn = $_POST['breathing_problem_yes_no'];
        $bpyn = $this->SanitizeForSQL($bpyn);
        $diayn = $_POST['diabetes_yes_no'];
        $diayn = $this->SanitizeForSQL($diayn);
        $sezyn = $_POST['seizures_yes_no'];
        $sezyn = $this->SanitizeForSQL($sezyn);
        $skiyn = $_POST['skin_problems_yes_no'];
        $skiyn = $this->SanitizeForSQL($skiyn);
        $sleyn = $_POST['sleep_problems_yes_no'];
        $sleyn = $this->SanitizeForSQL($sleyn);
        $dihyn = $_POST['diarrhea_constipation_yes_no'];
        $dihyn = $this->SanitizeForSQL($dihyn);
        $glayn = $_POST['glasses_yes_no'];
        $glayn = $this->SanitizeForSQL($glayn);
        $hh = $_POST['health_history_Yes_explain'];
        $hh = $this->SanitizeForSQL($hh);
        $add = $_POST['ADD_ADHD_yes_no'];
        $add = $this->SanitizeForSQL($add);
        $emyn = $_POST['emotional_yes_no'];
        $emyn = $this->SanitizeForSQL($emyn);
        $miyn = $_POST['mental_illness_yes_no'];
        $miyn = $this->SanitizeForSQL($miyn);
        $mencom = $_POST['Mental_comments'];
        $mencom = $this->SanitizeForSQL($mencom);
        
        //consent_form variables
        
        $ins = $_POST['Insurance_Company'];
        $ins = $this->SanitizeForSQL($ins);
        $pol = $_POST['Policy_Number'];
        $pol = $this->SanitizeForSQL($pol);
        
        //week-photo variables
        
        $imagedata = $_FILES['image']['tmp_name'];
        $_SESSION['image'] = filesize($_FILES['image']['tmp_name']);
         
         $file = filesize($_FILES['image']['tmp_name']);
            if ($file > 1048576){
                $this->HandleError("File size exceeds maximum limit of 1mb");
                 return false;
                }  
        $week = $_POST['week'];
        $week = $this->SanitizeForSQL($week);
        $imagedata = $_FILES['image']['tmp_name'];
        $imagedata = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $imageProperties = getimageSize($_FILES['image']['tmp_name']);       
        
       $query = "Select camper_id from camper_info where FirstName = '$firstName' and LastName = '$lastName'";
       $result1 = mysqli_query($connection, $query);
       $rw = mysqli_fetch_assoc($result1);
       $idcamp = $rw['camper_id'];
       if (is_numeric($idcamp)){
           $this->RedirectToURL("error_name.html");
       }  else {
           
       
        
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
        
        $qry2 = "SELECT camper_id FROM camper_info where FirstName = '$firstName' and LastName = '$lastName'";
        $result = mysqli_query($connection, $qry2);
         
        if (!$result) {
            
        }   
      $row = mysqli_fetch_assoc( $result );
      $_SESSION['camper_id'] = $row['camper_id'];
      
      $array = $_POST;
      $_SESSION['post'] = $array; 
      
         
        $qry1 = 'insert into parent_guardian_info (
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
           
                "' . $fnfath . '",
                "' . $lnfath . '",
                "' . $emfath . '",        
                "' . $hpfath . '",
                "' . $wpfath . '",
                "' . $cpfath . '",  
                "' . $adfath . '",
                "' . $ctfath . '",
                "' . $stfath . '", 
                "' . $zpfath . '",
                "' . $fnmoth . '",
                "' . $lnmoth . '",
                "' . $emmoth . '",        
                "' . $hpmoth . '",
                "' . $wpmoth . '",
                "' . $cpmoth . '",  
                "' . $admoth . '",
                "' . $ctmoth . '",
                "' . $stmoth . '", 
                "' . $zpmoth . '",     
                "' . $_SESSION['camper_id'] . '"
                )'; 
        
         
         if(!mysqli_query( $connection, $qry1))
        {
             header("Location: Form_submit_error.html");
            return false;
        } 
        
         $qry2 = 'insert into roommate (
                roommate_1,
                roommate_2,
                camper_id
                )
                values
                (
           
                "' . $rm1 . '",
                "' . $rm2 . '",    
                "' . $_SESSION['camper_id'] . '"
                )'; 
        
         
         if(!mysqli_query( $connection, $qry2))
        {
             header("Location: Form_submit_error.html");
            return false;
        } 
        
        $qry3 = 'insert into health_form (
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
           
                "' . $fnec1 . '",
                "' . $lnec1 . '",    
                "' . $reec1 . '",
                "' . $phec1 . '", 
                "' . $fnec2 . '",
                "' . $lnec2 . '",    
                "' . $reec2 . '",
                "' . $phec2 . '", 
                "' . $af . '",
                "' . $am . '",    
                "' . $aeyn . '",
                "' . $ao . '", 
                "' . $ca . '",
                "' . $iyn . '",    
                "' . $mtf . '",
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
                "' . $tyn . '",
                "' . $peyn . '",    
                "' . $amyn . '",
                "' . $benyn . '", 
                "' . $tsyn . '",
                "' . $calyn . '",    
                "' . $laxyn . '",
                "' . $ibyn . '",
                "' . $sudyn . '",    
                "' . $robyn . '",
                "' . $rdmyn . '", 
                "' . $cdyn . '",
                "' . $alyn . '",    
                "' . $pepyn . '",
                "' . $poyn . '",
                "' . $rdyn . '",    
                "' . $riyn . '",
                "' . $bpyn . '", 
                "' . $diayn . '",
                "' . $sezyn . '",    
                "' . $skiyn . '",
                "' . $sleyn . '",
                "' . $dihyn . '",    
                "' . $glayn . '",
                "' . $hh . '", 
                "' . $add . '",
                "' . $emyn . '",    
                "' . $miyn . '",   
                "' . $mencom . '",     
                "' . $_SESSION['camper_id'] . '"
                )'; 
        
         
         if(!mysqli_query( $connection, $qry3))
        {
             header("Location: Form_submit_error.html");
            return false;
        } 
        
          $qry4 = 'insert into consent_form (
                Insurance_Company,
                Policy_Number,
                confirm_code,
                camper_id
                )
                values
                (
           
                "' . $ins . '",
                "' . $pol . '",
                "' . 'yes' . '",    
                "' . $_SESSION['camper_id'] . '"
                )'; 
        
         
         if(!mysqli_query( $connection, $qry4))
        {
             header("Location: Form_submit_error.html");
            return false;
        } 
        
        $qry5 = 'insert into week_photo (
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
        
         
         if(!mysqli_query( $connection, $qry5))
        {
             header("Location: Form_submit_error.html");
            return false;
        } 
        
        
        
        if(isset($_POST['submitted']))
            {
   
            header("Location: Weeks_Available.php");
    
            }
       }     
    }
    function AddWeek(){
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
             $week = $_POST['week'];
             $week = $this->SanitizeForSQL($week);
             $_SESSION ['week'] = $week;
             $agegroup = $_SESSION['agegroup'];
             
             $qry = "UPDATE week_photo set week = '$week' where camper_id = '$id'";
                    
            $result = mysqli_query($connection, $qry);
            
            $qry1 = "Update $agegroup Set counter=counter+1 Where week='$week'"; 
            $result1 = mysqli_query($connection, $qry1);
            if (!$result1) {
            
        } 
           
         $this->RedirectToURL("userhome.php");
    
            
    }
    
    function CheckWeek(){
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
         $qry = "Select week from week_photo where camper_id = '$id'";
         $result = mysqli_query($connection, $qry);
         $row = mysqli_fetch_assoc($result);
         if(empty($row['week'])){
             return TRUE;
         }  else {
         return FALSE;    
         }
       
    }
    
    function UpdatePhoto(){
        $array = $_POST;
      $_SESSION['post'] = $array; 
      $_SESSION['camper_id'] = $_POST['camper_id'];
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
        $imagedata = $_FILES['image']['tmp_name'];
        $_SESSION['image'] = filesize($_FILES['image']['tmp_name']);
         
         $file = filesize($_FILES['image']['tmp_name']);
            if ($file > 1048576){
                $this->HandleError("File size exceeds maximum limit of 1mb");
                 return false;
                }  
        
            $id = $_SESSION['camper_id'];
         
        $imagedata = $_FILES['image']['tmp_name'];
        $imagedata = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $imageProperties = getimageSize($_FILES['image']['tmp_name']);  
        
        if (!empty($imagedata)){
                
            $qry = "UPDATE week_photo set imageType = '$imageProperties', imagedata = '$imagedata' where camper_id = '$id'";
            $result = mysqli_query($connection, $qry);
            if (!$result) {
            $this->RedirectToURL("File_size_error.php");
        } 
                     }
    }

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
            $this->HandleError("Please specify your email address!");
            return false;
        }

        $user_rec = array();

        if(false === $this->GetUserFromEmail($_POST['email'], $user_rec))
        {
            $this->HandleError("Please register to use this system!");
            return false;
        }

        if( strncasecmp( $user_rec['confirmcode'], "y", 1 ) )
        {
          $this->SendUserConfirmationEmail($user_rec);
          $this->HandleError("You must confirm your registration before resetting your password! Please check your email for a registration confirmation message!");
          return false;
        }

        if(false === $this->SendResetPasswordLink($user_rec))
        {
          $this->HandleError("System error sending email! Please contact the site administrator!");
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

        $from ="camphum@$host";
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
        $admin_email = 'camphelpingup@gmail.com';
        
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($admin_email);
        
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
        $validator->addValidation("name","req","Please fill in Name");
        $validator->addValidation("email","email","The input for Email should be a valid email value");
        $validator->addValidation("email","req","Please fill in Email");
        $validator->addValidation("username","req","Please fill in UserName");
        $validator->addValidation("password","req","Please fill in Password");

        
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
        $formvars['name'] = $this->Sanitize($_POST['name']);
        $formvars['email'] = $this->Sanitize($_POST['email']);
        $formvars['phone_number'] = $this->Sanitize($_POST['phone_number']);
        $formvars['username'] = $this->Sanitize($_POST['username']);
        $formvars['password'] = $this->Sanitize($_POST['password']);
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
        $admin_email = 'camphelpingup@gmail.com';
        
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($admin_email);
        
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
        if(!$this->IsFieldUnique($formvars,'email'))
        {
            $this->HandleError("This email is already registered");
            return false;
        }
        
        if(!$this->IsFieldUnique($formvars,'username'))
        {
            $this->HandleError("This UserName is already used. Please try another username");
            return false;
        }        
        if(!$this->InsertIntoDB($formvars))
        {
            $this->HandleError("Inserting to Database failed!");
            return false;
        }
        return true;
    }
    
    function IsFieldUnique($formvars,$fieldname)
    {
        $field_val = $this->SanitizeForSQL($formvars[$fieldname]);
        $qry = "select username from $this->tablename where $fieldname='".$field_val."'";
        $result = mysql_query($qry,$this->connection);   
        if($result && mysql_num_rows($result) > 0)
        {
            return false;
        }
        return true;
    }
    function IsFieldUniqueName($formvars,$fieldname,$fieldname1)
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
        $result = mysql_query("SHOW COLUMNS FROM $this->tablename");   
        if(!$result || mysql_num_rows($result) <= 0)
        {
            return $this->CreateTable();
        }
        return true;
    }
    
    function CreateTable()
    {
        $qry = "Create Table $this->tablename (".
                "id_user INT NOT NULL AUTO_INCREMENT ,".
                "name VARCHAR( 128 ) NOT NULL ,".
                "email VARCHAR( 100 ) NOT NULL ,".
                "phone_number VARCHAR( 16 ) NOT NULL ,".
                "username VARCHAR( 100 ) NOT NULL ,".
                "password VARCHAR( 64 ) NOT NULL ,".
                "confirmcode VARCHAR(64) ,".
                "PRIMARY KEY ( id_user )".
                ")";
                
        if(!mysql_query($qry,$this->connection))
        {
            $this->HandleDBError("Error creating the table \nquery was\n $qry");
            return false;
        }
        $qry = "Create Table jr_girls(".
                "week VARCHAR( 200 ) NOT NULL ,".
                "week_number INT (11) NOT NULL ,".
                "counter INT (11) DEFAULT '0' ".
                ")";
                
        if(!mysql_query($qry,$this->connection))
        {
            $this->HandleDBError("Error creating the table \nquery was\n $qry");
            return false;
            
        }
        
        $array = array('June 18-23 (Sun-Fri)' => '1' ,
            'June 25-30 (Sun-Fri)' =>'2',
            'July 2-7 (Sun-Fri)'=> '3',
            'July 9-14 (Sun-Fri)' => '4',
            'July 16-21 (Sun-Fri)' => '5',
            'July 23-38 (Sun-Fri)' => '6',
            'July 30-Aug 6 (Sun-Fri)' => '7'
            );
        foreach($array as $key=>$value)
        {
            $insert_qry = "insert into jr_girls (Week, week_number) values ('$key', '$value')";
        
        if(!mysql_query( $insert_qry ,$this->connection))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$insert_qry");
            return false;
        }   
        }
        $qry = "Create Table jr_boys(".
                "week VARCHAR( 200 ) NOT NULL ,".
                "week_number INT (11) NOT NULL ,".
                "counter INT (11) DEFAULT '0' ".
                ")";
                
        if(!mysql_query($qry,$this->connection))
        {
            $this->HandleDBError("Error creating the table \nquery was\n $qry");
            return false;
            
        }
        
        $array = array('June 18-23 (Sun-Fri)' => '1' ,
            'June 25-30 (Sun-Fri)' =>'2',
            'July 2-7 (Sun-Fri)'=> '3',
            'July 9-14 (Sun-Fri)' => '4',
            'July 16-21 (Sun-Fri)' => '5',
            'July 23-38 (Sun-Fri)' => '6',
            'July 30-Aug 6 (Sun-Fri)' => '7'
            );
        foreach($array as $key=>$value)
        {
            $insert_qry = "insert into jr_boys (Week, week_number) values ('$key', '$value')";
        
        if(!mysql_query( $insert_qry ,$this->connection))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$insert_qry");
            return false;
        }   
        }
        
        $qry = "Create Table sr_girls(".
                "week VARCHAR( 200 ) NOT NULL ,".
                "week_number INT (11) NOT NULL ,".
                "counter INT (11) DEFAULT '0' ".
                ")";
                
        if(!mysql_query($qry,$this->connection))
        {
            $this->HandleDBError("Error creating the table \nquery was\n $qry");
            return false;
            
        }
        
        $array = array('June 18-23 (Sun-Fri)' => '1' ,
            'June 25-30 (Sun-Fri)' =>'2',
            'July 2-7 (Sun-Fri)'=> '3',
            'July 9-14 (Sun-Fri)' => '4',
            'July 16-21 (Sun-Fri)' => '5',
            'July 23-38 (Sun-Fri)' => '6',
            'July 30-Aug 6 (Sun-Fri)' => '7'
            );
        foreach($array as $key=>$value)
        {
            $insert_qry = "insert into sr_girls (Week, week_number) values ('$key', '$value')";
        
        if(!mysql_query( $insert_qry ,$this->connection))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$insert_qry");
            return false;
        }   
        }
        $qry = "Create Table sr_boys(".
                "week VARCHAR( 200 ) NOT NULL ,".
                "week_number INT (11) NOT NULL ,".
                "counter INT (11) DEFAULT '0' ".
                ")";
                
        if(!mysql_query($qry,$this->connection))
        {
            $this->HandleDBError("Error creating the table \nquery was\n $qry");
            return false;
            
        }
        
        $array = array('June 18-23 (Sun-Fri)' => '1' ,
            'June 25-30 (Sun-Fri)' =>'2',
            'July 2-7 (Sun-Fri)'=> '3',
            'July 9-14 (Sun-Fri)' => '4',
            'July 16-21 (Sun-Fri)' => '5',
            'July 23-38 (Sun-Fri)' => '6',
            'July 30-Aug 6 (Sun-Fri)' => '7'
            );
        foreach($array as $key=>$value)
        {
            $insert_qry = "insert into sr_boys (Week, week_number) values ('$key', '$value')";
        
        if(!mysql_query( $insert_qry ,$this->connection))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$insert_qry");
            return false;
        }   
        }
        
        $qry = "Create Table camper_info (".
                "camper_id INT(11) NOT NULL AUTO_INCREMENT ,".
                "FirstName VARCHAR( 200 ) NOT NULL ,".
                "LastName VARCHAR( 200 ) NOT NULL ,".
                "Address VARCHAR( 200 ) NOT NULL ,".
                "City VARCHAR( 100 ) NOT NULL ,".
                "state VARCHAR( 100 ) NOT NULL ,".
		"zip VARCHAR( 100 ) NOT NULL ,".
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
        if(!mysql_query($qry,$this->connection))
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
    
        $confirmcode = $this->MakeConfirmationMd5($formvars['email']);
        
        $formvars['confirmcode'] = $confirmcode;
        
        $insert_query = 'insert into '.$this->tablename.'(
                name,
                email,
                phone_number,
                username,
                password,
                confirmcode
                )
                values
                (
                "' . $this->SanitizeForSQL($formvars['name']) . '",
                "' . $this->SanitizeForSQL($formvars['email']) . '",
                "' . $this->SanitizeForSQL($formvars['phone_number']) . '",
                "' . $this->SanitizeForSQL($formvars['username']) . '",
                "' . md5($formvars['password']) . '",
                "' . $confirmcode . '"
                )';      
        if(!mysql_query( $insert_query ,$this->connection))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
            return false;
        }        
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