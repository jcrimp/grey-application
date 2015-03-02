<?php
/*
* config.php -
* a file to store data
* and configuration info
*/

include 'credentials.php';

define('DEBUG',TRUE); #we want to see all errors

define('THIS_PAGE',basename($_SERVER['PHP_SELF']));

$nav1["index.php"] = "Home Page";
$nav1["template.php"] = "Template";
$nav1["order.php"] = "Order A Website";
$nav1["contact.php"] = "Contact Us";
$nav1["a7ec.php"] = "Recaptcha Form";
$nav1["database1.php"] = "Database 1";


//echo THIS_PAGE;

switch(THIS_PAGE)
{
	case "index.php":
		$title = "My Home Page";
		$banner = "Home Page Banner";
		$slogan = "Home Page Slogan";
		break;
		
	case "template.php":
		$title = "My Title";
		$banner = "My Banner";
		$slogan = "My Slogan";
		break;
	
	case "about.php":
		$title = "My About Page";
		$banner = "About Page Banner";
		$slogan = "About Page Slogan";
		break;
		
	case "order.php":
		$title = "My Order Page";
		$banner = "Order Page Banner";
		$slogan = "Order Page Slogan";
		break;
		
	case "contact.php":
		$title = "My Contact Page";
		$banner = "Contact Page Banner";
		$slogan = "Contact Page Slogan";
		break;
	
	default:
		$title = THIS_PAGE;
		$banner = "Default Banner";
		$slogan = "Default Slogan";		
}

function makeLinks($linkArray)
{
    $myReturn = '';
    foreach($linkArray as $url => $text)//here the array is broken into url (the key/index of array) and text
    {
	    if(THIS_PAGE == $url)
	    {//current page
			$myReturn .= '<li class="current"><a href="' . $url . '">' . $text . '</a></li>';     
		}
		else
		{
			$myReturn .= '<li><a href="' . $url . '">' . $text . '</a></li>';  
		}
          
    }    
    return $myReturn;    
}

//used for order.php to build a better email
function process_post()
{//loop through POST vars and return a single string
    $myReturn = ''; //set to initial empty value

    foreach($_POST as $varName=> $value)
    {#loop POST vars to create JS array on the current page - include email
         $strippedVarName = str_replace("_"," ",$varName);#remove underscores
        if(is_array($_POST[$varName]))
         {#checkboxes are arrays, and we need to collapse the array to comma separated string!
             $myReturn .= $strippedVarName . ": " . implode(",",$_POST[$varName]) . PHP_EOL;
         }else{//not an array, create line
             $myReturn .= $strippedVarName . ": " . $value . PHP_EOL;
         }
    }
    return $myReturn;
}

function myerror($myFile, $myLine, $errorMsg)
{
    if(defined('DEBUG') && DEBUG)
    {
       echo "Error in file: <b>" . $myFile . "</b> on line: <b>" . $myLine . "</b><br />";
       echo "Error Message: <b>" . $errorMsg . "</b><br />";
       die();
    }else{
		echo "I'm sorry, we have encountered an error.  Would you like to buy some socks?";
		die();
    }
}