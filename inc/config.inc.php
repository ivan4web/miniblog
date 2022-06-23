<?session_start();
$_connect = @mysqli_connect("HOST", "DB_LOGIN", "DB_PASS", "DB"); 
@mysqli_query($_connect, "set names utf8"); 
//$unix_time = time()+60*60*24*14; 
$_config = 1;
if(!isset($_SESSION['userid'])){
	if(isset($_POST['wecheck_login']) && $_POST['wecheck_login'] == $_SESSION['ischeck']){
		unset($_SESSION['ischeck']);
		include("inc/check_login.php");
	}
	if(isset($_POST['wecheck_reg']) && $_POST['wecheck_reg'] == $_SESSION['ischeck']){
		unset($_SESSION['ischeck']);
		include("inc/check_reg.php");
	}
}else{
	if(isset($_POST['wecheck_post']) && $_POST['wecheck_post'] == $_SESSION['ischeck']){
		unset($_SESSION['ischeck']);
		
		include("inc/check_post.php");
	}
}
$ip = getenv('HTTP_CLIENT_IP')?:getenv('HTTP_X_FORWARDED_FOR')?:getenv('HTTP_X_FORWARDED')?:getenv('HTTP_X_REAL_IP')?:getenv('HTTP_FORWARDED_FOR')?:getenv('HTTP_FORWARDED')?:getenv('REMOTE_ADDR');
function strip_all($a){
$a = str_replace('"', "″", $a);
$a = str_replace("'", "′", $a);
return trim(strip_tags($a));
}
$tit = "🇺🇦 MiniBlog for Test";
$mo = Array("", 'Січня','Лютого','Березня','Квітня','Травня','Червня','Липня','Серпня','Вересня','Жовтня','Листопада','Грудня');
function show_dat($a, $b){
$year = substr($a, 0, 4);
$month = substr($a, 5, 2);
$day = substr($a, 8, 2);
$min = substr($a, 11, 8);
$omin = substr($a, 11, 5);
$sc = substr($a, -2);
global $mo;
if($b < 3){
	if(Date('Y-m-d') == $year."-".$month."-".$day){
		if($b == 0) $dd = "сьогодні о ".$omin; else $dd = "сьогодні, ".$day." ".$mo[$month*1];
	}else{
		$ystrd = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-1, date("Y")));
		if($ystrd == $year."-".$month."-".$day) {
			if($b == 0) $dd = "вчора о ".$omin; else  $dd = "вчора, ".$day." ".$mo[$month*1];
		}else{
			$dd = $day." ".$mo[$month*1]." ".$year;
		}
	}
}
$do = strlen($dd);
if(substr($dd, 0, 1) == "0") $dd = substr($dd, 1, $do);
return($dd);
}

if(count($_GET) > 0){
	$to404 = 1;
}

function str_to_latin($str) {
    $str = trim($str);
	$rus_arr = array ('а','б','в','г','д','е','ё',
                     'ж','з','и','й','к','л','м',
                     'н','о','п','р','с','т','у',
                     'ф','х','ц','ч','ш','щ','ъ',
                     'ы','ь','э','ю','я','А','Б',
                     'В','Г','Д','Е','Ё','Ж','З',
                     'И','Й','К','Л','М','Н','О',
                     'П','Р','С','Т','У','Ф','Х',
                     'Ц','Ч','Ш','Щ','Ъ','Ы','Ь',
                     'Э','Ю','Я', '%',  '"', '*', '″', '№', ':', ';', '@', '!', '~', '#', '^', '(',')', '|',
					 'Ā', 'ā', 'Č', 'č', 'Ē', 'ē', 'Ģ', 'ģ', 'Ī', 'ī', 'Ķ', 'ķ', 'Ļ', 'ļ', 'Ņ', 'ņ', 'Š', 'š', 'Ū', 'ū', 'Ž', 'ž',
					 'Ą', 'ą', 'Ę', 'ę',  'Ė', 'ė', 'Į', 'į', 'Š', 'š', 'Ų', 'ų', 'Ґ', 'ґ', 'Є', 'є', 'І', 'і', 'Ї', 'ї'
                      );

    $lat_arr = array ('a','b','v','h','d','e','yo',
                     'zh','z','y','i','k','l','m',
                     'n','o','p','r','s','t','u',
                     'f','kh','ts','ch','sh','shch','',
                     'i','','e','iu','ia','A','B',
                     'V','H','D','E','Yo','Zh','z',
                     'Y','Y','K','L','M','N','O',
                     'P','R','S','T','U','F','Kh',
                     'Ts','Ch','Sh','Shch','','i',
                     '','e','Yu','Ya', '',  '', '', '', '', '', '', '', '', '', '', '', '','', '',
					 'a', 'a', 'c', 'c', 'e', 'e', 'g', 'g', 'i', 'i', 'k', 'k', 'l', 'l', 'n', 'n', 's', 's', 'u', 'u', 'z', 'z',
					 'a', 'a', 'e', 'e',  'e', 'e', 'i', 'i', 's', 's', 'u', 'u', 'G', 'g', 'Ye', 'ie', 'I', 'i', 'Yi', 'i'
                      );
		$str = str_replace ($rus_arr, $lat_arr, $str);			  

		$str = str_replace('#034;', "", $str);
	$str = str_replace('"', "", $str);
	$str = str_replace("\,", " ", $str);
	$str = str_replace("\.", " ", $str);
	$str = str_replace("\^", "", $str);
	$str = str_replace("\&", "", $str);
	$str = str_replace("\#", "", $str);
	$str = str_replace("\)", "", $str);
	$str = str_replace("\(", "", $str);
	$str = str_replace("\@", "", $str);
	$str = str_replace("\!", "", $str);
	$str = str_replace("\/", "", $str);
	$str = str_replace("\+", "", $str);
	$str = str_replace("\?", "", $str);
	$str = str_replace("…", "", $str);
	$str = str_replace(":", "", $str);
	$str = str_replace("'", "", $str);
	$str = str_replace("  ", " ", $str);
	$str = str_replace("_", "-", $str);
	$str = str_replace(" ", "-", $str);
	$str = str_replace("--", "-", $str);
	$str = str_replace("--", "-", $str);
	$str = str_replace("“", "", $str);
	$str = str_replace("”", "", $str);
	
	$ln = strlen($str);
	if(substr($str, -1) == '-'){$str = substr($str, 0, ($len-1));}
	$str = strtolower($str);
    return $str;		  
}


$p = "p/main.php";
$bodyclass = '';
if(isset($_GET['val'])){
	$to404 = 1;
	$val = strip_all($_GET['val']);
	$ex = explode("-", $val);
	for($i = 0; $i < count($ex); $i++){$id_blog = $ex[$i];}
	if(is_numeric($id_blog)){
		$r = @mysqli_query($_connect, "SELECT id, id_user, title, txt, submit_date, update_date FROM blog WHERE id = '".$id_blog."' LIMIT 1");
		if(@mysqli_num_rows($r) == 1){
			unset($to404);
			$zn = @mysqli_fetch_assoc($r);
			$id_blog = $zn['id'];
			$title = $zn['title'];
			$txt = $zn['txt'];
			$txt = str_replace("\n", "<br />", $txt);
			$submit_date = $zn['submit_date'];
			$update_date = $zn['update_date'];
			$id_user = $zn['id_user'];
			$tit = "🇺🇦 ".$title;
			if(isset($_SESSION['userid']) && $_SESSION['userid'] == $id_user){$myblog = 1;}
			if(isset($myblog) && isset($_GET['edit'])){$p = "p/createpost.php";}else{
				$p = "p/showblog.php";
			}
			
		}else{unset($id_blog);}
	}
	
	if($val == 'createpost'){
		unset($to404);
		if(!isset($_SESSION['userid'])){
		$bodyclass = 'overlay';
		$p = "p/login.php";
		$tit = "🇺🇦 Авторизація";
		}else{
			$tit = "🇺🇦 Створення публікациії";
			$p = "p/createpost.php";
		}
	}
	if($val == 'myposts' && isset($_SESSION['userid'])){
		$_GET['author'] = $_SESSION['userid'];
		unset($to404);
	}
	if($val == 'reg' && !isset($_SESSION['userid'])){
		unset($to404);
		$tit = "🇺🇦 Реєстрація";
		$bodyclass = 'overlay regs';
		$no404 = 1;$p = "p/reg.php";
	}
	if($val == 'logout'){unset($to404);
//$unix_time = time()+60*60*24*14; 
session_destroy();
header("location: /");
exit();
}
	
}



if(isset($to404)){

	include("404.php");
	exit();
}
?>
