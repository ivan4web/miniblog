<?
if(isset($_SESSION['userid']) && isset($_GET['edit']) && isset($_POST['myblog'])){
	$r = @mysqli_query($_connect, "SELECT id FROM blog WHERE id = '".(int)$_POST['myblog']."' AND id_user = '".$_SESSION['userid']."' LIMIT 1");
	if(@mysqli_num_rows($r) == 1){$myblog = 1;$id_blog = (int)$_POST['myblog'];}
}
$title = strip_all($_POST['title']);
$txt = strip_all($_POST['txt']);
$tags = strip_all($_POST['tags']);

if(mb_strlen($title, 'utf-8') < 10){$err = 1; $err1 = 1;}
if(mb_strlen($txt, 'utf-8') < 20){$err = 1; $err2 = 1;}
if(!isset($err)){
	if(!isset($myblog)){
	@mysqli_query($_connect, "INSERT INTO blog (id_user, title, txt, submit_date, update_date) VALUES('".$_SESSION['userid']."', '".$title."', '".$txt."', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
	$id_blog = @mysqli_insert_id($_connect);
	$_SESSION['newblog'] = $id_blog;
	}else{
		@mysqli_query($_connect, "UPDATE blog SET title = '".$title."', txt = '".$txt."', update_date = CURRENT_TIMESTAMP WHERE id_user = '".$_SESSION['userid']."' AND id = '".$id_blog."' LIMIT 1");
		$editok = 1;
	}
	
	if($tags != ''){$ex = explode(",", $tags);
		for($i = 0; $i < count($ex); $i++){
			$tag = strip_all($ex[$i]);
			if($tag != ''){
				$r = @mysqli_query($_connect, "SELECT id FROM tags WHERE name = '".$tag."' LIMIT 1");
				if(@mysqli_num_rows($r) == 0){@mysqli_query($_connect, "INSERT INTO tags(name) VALUES('".$tag."')"); $id_tag = @mysqli_insert_id($_connect);}else{$zn = @mysqli_fetch_row($r); $id_tag = $zn[0];}
				@mysqli_query($_connect, "INSERT INTO blog_tags (id_blog, id_tag) VALUES('".$id_blog."', '".$id_tag."')");
			}
		}
	}
	$path = "img/";
	@include("inc/image_resize.php");
	for($i = 0; $i < count($_FILES['mimg']['name']); $i++){
		$tmp = $_FILES['mimg']['tmp_name'][$i];
		$type = $_FILES['mimg']['type'][$i];
		$fname = $_FILES['mimg']['name'][$i];
		$size = $_FILES['mimg']['size'][$i];
		$t = explode("/", $type);
		if($t[0] == 'image'){
			$e = explode(".", $fname);
			for($j = 0; $j < count($e); $j++){$ext = $e[$j];}
			$filename = md5(time().$fname.$ext).".".$ext;
			copy($tmp, $path.$filename);
			$size = @getimagesize($path.$filename);
    		$w   = $size[0]; 
			$h  = $size[1]; 
			if($w > 950){
				$w_per = (95000/$w);
				$h = $w_per * $h/100;
				@img_resize($path.$filename, $path.$filename, 950, $h);
			}
			/*
			//якщо треба квадрат - ріжемо
			$size = @getimagesize($path.$filename);
			$w   = $size[0]; 
			$h  = $size[1];
			if($w != $h){
				@ResizeImg2($path.$filename, $path.$filename, $w, $w2, 0);
			}
			*/
			@mysqli_query($_connect, "INSERT INTO img (id_blog, filename) VALUES('".$id_blog."', '".$filename."')");				
		}
}
if(!isset($myblog)){
header("location: /".str_to_latin($title)."-".$id_blog."/");
exit();
}
}

?>