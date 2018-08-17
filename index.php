<?php
// Fix Api Whatsapp on Desktops
$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");

$phone = $_GET['phone'];
$text = $_GET['text'];

$browser = getBrowser();
// check if is a mobile
if ($iphone || $android || $palmpre || $ipod || $berry == true)
{
  header('Location: https://api.whatsapp.com/send?phone='.$phone.'&text='.$text);
  //OR
  echo "<script>window.location='https://api.whatsapp.com/send?phone=".$phone."&text=".$text."'</script>";
}

// all others
else {
    switch ($browser['name']) {
        case "IE":
              header('Location: https://api.whatsapp.com/send?phone='.$phone.'&text='.$text);
			  //OR
			  echo "<script>window.location='https://api.whatsapp.com/send?phone=".$phone."&text=".$text."'</script>";
            break;
         case "Chrome":
              header('Location: https://api.whatsapp.com/send?phone='.$phone.'&text='.$text);
			  //OR
			  echo "<script>window.location='https://api.whatsapp.com/send?phone=".$phone."&text=".$text."'</script>";
            break;
         case "Google Chrome":
              header('Location: https://api.whatsapp.com/send?phone='.$phone.'&text='.$text);
			  //OR
			  echo "<script>window.location='https://api.whatsapp.com/send?phone=".$phone."&text=".$text."'</script>";
            break;
        case "Mozilla Firefox" : 
        	 header('Location: https://web.whatsapp.com/send?phone='.$phone.'&text='.$text);
			  //OR
			  echo "<script>window.location='https://web.whatsapp.com/send?phone=".$phone."&text=".$text.	"'</script>";
			  break;
        case "Firefox":
    		  header('Location: https://web.whatsapp.com/send?phone='.$phone.'&text='.$text);
			  //OR
			  echo "<script>window.location='https://web.whatsapp.com/send?phone=".$phone."&text=".$text.	"'</script>";
			  break;
        case "Mozilla":
             header('Location: https://web.whatsapp.com/send?phone='.$phone.'&text='.$text);
			  //OR
			  echo "<script>window.location='https://web.whatsapp.com/send?phone=".$phone."&text=".$text.	"'</script>";
            break;
        case "Netscape":
             header('Location: https://web.whatsapp.com/send?phone='.$phone.'&text='.$text);
			  //OR
			  echo "<script>window.location='https://web.whatsapp.com/send?phone=".$phone."&text=".$text.	"'</script>";
            break;
        case "Safari":
        	 header('Location: https://web.whatsapp.com/send?phone='.$phone.'&text='.$text);
			  //OR
			  echo "<script>window.location='https://web.whatsapp.com/send?phone=".$phone."&text=".$text.	"'</script>";
        	break;
        case "Konqueror":
             header('Location: https://web.whatsapp.com/send?phone='.$phone.'&text='.$text);
			  //OR
			  echo "<script>window.location='https://web.whatsapp.com/send?phone=".$phone."&text=".$text.	"'</script>";
            break;
        case "Opera":
	          header('Location: https://api.whatsapp.com/send?phone='.$phone.'&text='.$text);
			  //OR
			  echo "<script>window.location='https://api.whatsapp.com/send?phone=".$phone."&text=".$text."'</script>";
            break;
        default:
	          header('Location: https://api.whatsapp.com/send?phone='.$phone.'&text='.$text);
			  //OR
			  echo "<script>window.location='https://api.whatsapp.com/send?phone=".$phone."&text=".$text."'</script>";
			  break;
    }
}

function getBrowser() { 
    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
    
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    } 
    elseif(preg_match('/Firefox/i',$u_agent)) 
    { 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
    } 
    elseif(preg_match('/Chrome/i',$u_agent)) 
    { 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 
    } 
    elseif(preg_match('/Safari/i',$u_agent)) 
    { 
        $bname = 'Apple Safari'; 
        $ub = "Safari"; 
    } 
    elseif(preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Opera'; 
        $ub = "Opera"; 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)) 
    { 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
    } 
    
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
    
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
    
    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
    
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
} 
?>