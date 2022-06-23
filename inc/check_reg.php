<?
$err_txt = '';
$login = strip_all($_POST['u_log']);
$pass = strip_all($_POST['psd_reg']);
$email = strip_all($_POST['u_email']);
if (!preg_match("/^[a-zA-Z0-9\s()_-]+$/", $login)) { $err = 1; $err1 = 1; $err_txt = 'Тільки латінськи символи у логіні<br />';}else{
if(strlen($login) < 4){$err = 1;$err1 = 1;$err_txt = 'Дуже короткий логін<br />';}
if(strlen($login) > 12){$err = 1;$err1 = 1;$err_txt = 'Логін до 12 символів<br />';}
if (!eregi("^[a-z0-9\._-]+@[a-z0-9\._-]+\.[a-z]{2,4}\$", $email)) {$err = 1;  $err2 = 1; $err_txt = 'Некоректний email';}
if(mb_strlen($pass, 'utf-8') < 6 || mb_strlen($pass, 'utf-8') > 16){$err = 1;$err_txt .= 'Пароль повинен бути від 6 до 16 символів<br />';}

if(!isset($err)){
	$r = @mysqli_query($_connect, "SELECT id FROM users WHERE login = '".$login."' LIMIT 1");
	if(@mysqli_num_rows($r) == 1){
		$err = 1; $err1 = 1; $err_txt = 'Цей логін вже зареєстровано';
	}else{
	$r = @mysqli_query($_connect, "SELECT id FROM users WHERE email = '".$email."' LIMIT 1");
	if(@mysqli_num_rows($r) == 1){
		$err = 1; $err2 = 1; $err_txt = 'Цей email вже зареєстровано';
	}else{
	$pass = hash('sha256', $pass);
	$r = @mysqli_query($_connect, "INSERT INTO users (login, pass, email, submit_date) VALUES('".$login."', '".$pass."', '".$email."', CURRENT_TIMESTAMP)");
	$_SESSION['newlogin'] = 1;
	$_SESSION['userid'] = @mysqli_insert_id($_connect);
	header("location: /createpost/");
	exit();
	}
}
}
}
?>