<?php 

switch($_GET['type'])
{

case "subscribe" :
storeAddress();
break;

case "contact" :
storecontact();
break;

default :
break;

}



function storeAddress() { 
//echo $_POST['email'];
  $message = "&nbsp;"; 
  // Check for an email address in the query string 
  if( !isset($_POST['email']) ){ 
    // No email address provided 
	$message = "An invalid email address was provided"; 
	
  }else { 
    // Get email address from the query string 
    $address = $_POST['email']; 
	
    // Validate Address 
   /* if(!preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@ 
    [a-z0-9-]+(.[a-z0-9-]+)*$/i", $address)) { 
      $message = "<strong>Error</strong>: An invalid email address was provided.";
		echo $message;
	  
    }
    else */
	
	//{ 
      // Connect to database 
      $con = mysqli_connect("localhost","generationatech_bams", "bamsbams@45"); 
      mysqli_select_db($con,"generationatech_oaksoft"); 
      // Insert email address into mailinglist table  
      $result = mysqli_query($con,"INSERT INTO mailinglist SET email='" . $address . "'"); 
      if(mysqli_error($con)){ 
        $message = "<strong>Error</strong>: There was an error storing your email address."; 
		echo $message;
      } 
      else { 
        $message = "Thanks for subscribing to our News Letter!"; 
		echo $message;
      } 
    //}
   }
	// return $message;
	}   

	
	

function storecontact() { 
//echo $_POST['email'];
  $message = "&nbsp;"; 
  // Check for an email address in the query string 
  if( !isset($_POST['name'])&&!isset($_POST['email'])&&!isset($_POST['budget'])&&!isset($_POST['description']) ){ 
    // No email address provided 
	$message = "An invalid email address was provided"; 
	
  }else { 
    // Get email address from the query string 
$name=  $_POST['name'];
$email=$_POST['email'];
$budget=$_POST['budget'];
$description=$_POST['description']; 
	
    // Validate Address 
   /* if(!preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@ 
    [a-z0-9-]+(.[a-z0-9-]+)*$/i", $address)) { 
      $message = "<strong>Error</strong>: An invalid email address was provided.";
		echo $message;
	  
    }
    else */
	
	//{ 
      // Connect to database 
      $con = mysqli_connect("localhost","generationatech_bams", "bamsbams@45"); 
      mysqli_select_db($con,"generationatech_oaksoft"); 
      // Insert email address into mailinglist table  
      $result = mysqli_query($con,"INSERT INTO projects SET cus_name='" . $name . "',cust_email='" . $email . "',pro_desc='" . $description . "' ,budget='" . $budget . "' "); 
      if(mysqli_error($con)){ 
        $message = "<strong>Error</strong>: There was an error storing your project address."; 
		echo $message;
      } 
      else { 
        $message = "Thanks for your Effort about your project we shall soon get back to you!"; 
		echo $message;
      } 
    //}
   }
	// return $message;
	}   

function sendemail($subject1,$message1) { 

$to      = 'bamwinealbert@gmail.com';
$to      = 'oaksofto@gmail.com';
$subject = $subject1;
$message = $message1;
$headers = 'From: bamwinealbert@gmail' . "\r\n" .
    'Reply-To: bamwinealbert@gmail' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();



mail($to, $subject, $message, $headers);
}	


?>