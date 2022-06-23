<?
$login = strip_all($_POST['ulog']);
$pass = strip_all($_POST['psd']);
if(strlen($login) < 4 || mb_strlen($pass, 'utf-8') < 6){$err = 1;}else{
	$pass = hash('sha256', $pass);
	$r = @mysqli_query($_connect, "SELECT id FROM users WHERE login = '".$login."' AND pass = '".$pass."' LIMIT 1");
	if(@mysqli_num_rows($r) == 0){$err = 1;}else{
		$zn = @mysqli_fetch_row($r);
		$_SESSION['userid'] = $zn[0];
		header("location: /createpost/");
		exit();
	}
}
if(isset($err)){$err_txt = 'Невірний логін або пароль';}
?>