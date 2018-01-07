<?php
if(isset($_POST['email'])) {
 
    // EDIT THE LINE BELOW AS REQUIRED
    $email_to = "brigzzy@gmail.com";
//    $email_to = "brigzzy@brigzzy.org";

    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
	echo "<footer><p><a href='reportabug.html'>Click here to report a bug</a></p></footer>";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['spell_name']) ||
        !isset($_POST['spell_level']) ||
        !isset($_POST['spell_description']) ||
        !isset($_POST['name']) ||
        !isset($_POST['duration'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
     
 
    $spell_name = $_POST['spell_name']; // required
    $spell_level = $_POST['spell_level']; // required
    $spell_description = $_POST['spell_description']; // required
    $mc = $_POST['mc']; // required
    $range = $_POST['range']; // required
    $duration = $_POST['duration']; // required
    $targeteddefence = $_POST['targeteddefence']; // required
    $email = $_POST['email']; // required
    $name = $_POST['name']; // required
    $target = $_POST['target']; // required
    $casttime = $_POST['casttime']; // required
    $tt = $_POST['tt']; // required
    $correspondence = isset($_POST['Correspondence']) ? $_POST['Correspondence'] : ''; // required
    $entropy = isset($_POST['Entropy']) ? $_POST['Entropy'] : ''; // required
    $force = isset($_POST['Force']) ? $_POST['Force'] : '';
    $life = isset($_POST['Life']) ? $_POST['Life'] : '';
    $matter = isset($_POST['Matter']) ? $_POST['Matter'] : '';
    $mind = isset($_POST['Mind']) ? $_POST['Mind'] : '';
    $prime = isset($_POST['Prime']) ? $_POST['Prime'] : '';
    $spirit = isset($_POST['Spirit']) ? $_POST['Spirit'] : '';
    $time = isset($_POST['Time']) ? $_POST['Time'] : '';

    $email_subject = "New Spell Submission - ".$spell_name;
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$name)) {
    $error_message .= 'The name you entered does not appear to be valid.<br />';
  }
 
  if(strlen($spell_description) < 2) {
    $error_message .= 'The spell description you entered does not appear to be valid.<br />';
  }

  if(strlen($range) < 2) {
    $error_message .= 'The spell range you entered does not appear to be valid.<br />';
  }

  if(strlen($target) < 2) {
    $error_message .= 'The spell target you entered does not appear to be valid.<br />';
  }

  if(strlen($correspondence . $entropy . $force . $life . $matter . $mind . $prime . $spirit . $time) < 2) {
    $error_message .= 'You need to specify at least one spell school.<br />';
  }

  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.<br><br>";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Player Name: ".clean_string($name)."<br><br>";
    $email_message .= "Spell Name: ".clean_string($spell_name)."<br>";
    $email_message .= "Spell Level: ".clean_string($spell_level)."<br>";
    $email_message .= "Spell Schools: ".clean_string($correspondence.$entropy.$force.$life.$matter.$mind.$prime.$spirit.$time)."<br>";
    $email_message .= "Spell Description: ".clean_string($spell_description)."<br>";
if (isset($mc) && !empty($mc)) {
    $email_message .= "Material Components: ".clean_string($mc)."<br>";
}else{
    $email_message .= "Material Components: None<br>";
}
    $email_message .= "Spell Range: ".clean_string($range)."<br>";
    $email_message .= "Spell Target: ".clean_string($target)."<br>";
if (isset($duration) && !empty($duration)) {
    $email_message .= "Duration: ".clean_string($duration)."<br>";
}else{
    $email_message .= "Spell Duration: Not applicable<br>";
}
    $email_message .= "Cast Time: ".clean_string($casttime)."<br>";
    $email_message .= "Targeted Defence: ".clean_string($targeteddefence)."<br>";
    $email_message .= "Travel Time: ".clean_string($tt)."<br>";

if (isset($email) && !empty($email)) {
    $email_message .= "<br>".clean_string($name)." Has requested a notification when the spell is added.  <a href=mailto:".$email."?Subject=".$spell_name."&body=Your%20spell%20has%20been%20added!>Click here</a> to send it."."<br><br>If you are planning on making changes to this spell, reply to this email with the changes.";
}

// create email headers

$thing = 'From: '.$email."\r\n";

if (isset($email) && !empty($email)) {
$thing = 
'From: '.$email."\r\n".
'CC: '.$email."\r\n";
}

$headers = $thing;
$headers .= 
'Reply-To: '.$email."\r\n" .
'X-Mailer: PHP/' . phpversion()."\r\n" .
'MIME-Version: 1.0'."\r\n" .
'Content-type: text/html; charset=iso-8859-1';
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
 
<h1>Spell Submitted!</h1></br>
<a href=/>Click here to go back and submit another one</a></br>
<?php //echo $headers; ?>

<footer>
  <p><a href="reportabug.html">Click here to report a bug</a></p>
</footer>

 
<?php
 
}
?>
