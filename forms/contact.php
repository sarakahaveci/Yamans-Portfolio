<?php
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);
 /*
 Tested working with PHP5.4 and above (including PHP 7 )
 
  */
 require_once './vendor/autoload.php';
 
 use FormGuide\Handlx\FormHandler;
 
 
 $pp = new FormHandler(); 
 
 $validator = $pp->getValidator();
 $validator->fields(['name','email'])->areRequired()->maxLength(50);
 $validator->field('email')->isEmail();
 $validator->field('comments')->maxLength(6000);
 
 
 
 
 $pp->sendEmailTo('yaman.kahveci993@gmail.com'); // ← Your email here
 
 echo $pp->process($_POST);

  // Replace contact@example.com with your real receiving email address
  $receiving_email_address = 'yaman.kahveci993@gmail.com';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->subject = $_POST['subject'];

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  
  $contact->smtp = array(
    'host' => 'yaman.kahveci993@gmail.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
  );

  $contact->add_message( $_POST['name'], 'From');
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message( $_POST['message'], 'Message', 10);

  echo $contact->send();
?>
