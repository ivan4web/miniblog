<?
if(isset($myblog)){
	if(isset($_GET['onm'])){
	$r = @mysqli_query($_connect, "SELECT id FROM img WHERE id_blog = '".$id_blog."' AND id = '".(int)$_GET['onm']."' LIMIT 1");
	if(@mysqli_num_rows($r) == 1){
		@mysqli_query($_connect, "UPDATE img SET onm = '0' WHERE id_blog = '".$id_blog."'");
		@mysqli_query($_connect, "UPDATE img SET onm = '1' WHERE id_blog = '".$id_blog."' AND id = '".(int)$_GET['onm']."' LIMIT 1");
	}
	}
	if(isset($_GET['killimg']) && is_numeric($_GET['killimg'])){
	$rimg = @mysqli_query($_connect, "SELECT filename FROM img WHERE id_blog = '".$id_blog."' AND id = '".(int)$_GET['killimg']."' LIMIT 1");
	if(@mysqli_num_rows($rimg) == 1){
		$zimg = @mysqli_fetch_row($rimg);
		@unlink("img/".$zimg[0]);
		@mysqli_query($_connect, "DELETE FROM img WHERE id_blog = '".$id_blog."' AND id = '".(int)$_GET['killimg']."' LIMIT 1");
		
	}
	}
	if(isset($_GET['killtag']) && is_numeric($_GET['killtag'])){
	$rimg = @mysqli_query($_connect, "SELECT id FROM blog_tags WHERE id_blog = '".$id_blog."' AND id = '".(int)$_GET['killtag']."' LIMIT 1");
	if(@mysqli_num_rows($rimg) == 1){
		@mysqli_query($_connect, "DELETE FROM blog_tags WHERE id_blog = '".$id_blog."' AND id = '".(int)$_GET['killtag']."' LIMIT 1");
	}
	}
	if(isset($_GET['kill']) && is_numeric($_GET['kill'])){
		$rimg = @mysqli_query($_connect, "SELECT id FROM blog_tags WHERE id_blog = '".$id_blog."'");
		while($zimg = @mysqli_fetch_row($rimg)){@mysqli_query($_connect, "DELETE FROM blog_tags WHERE id_blog = '".$id_blog."'");}
		$rimg = @mysqli_query($_connect, "SELECT filename, id FROM img WHERE id_blog = '".$id_blog."' ");
	while($zimg = @mysqli_fetch_row($rimg)){
		@unlink("img/".$zimg[0]);
		@mysqli_query($_connect, "DELETE FROM img WHERE id_blog = '".$id_blog."' AND id = '".(int)$zimg[1]."' LIMIT 1");
	}
		@mysqli_Query($_connect, "DELETE FROM blog WHERE id = '".$id_blog."' AND id_user = '".$_SESSION['userid']."' LIMIT 1");
	?>
	<script>document.location.href='/?author=<?=$_SESSION['userid']?>';</script>
	<?exit();}
}
if(isset($editok)){
?>
<div style="background: #eeffe9; padding: 12px; border-radius: 1px;text-align:center;"><b style="color: Green">Збережено</b> <a href="/<?=str_to_latin($title)?>-<?=$id_blog?>/">дивитись пост</a></div>
<?}
if(isset($_SESSION['newlogin'])){?>
<div style="background: #eeffe9; padding: 12px; border-radius: 1px;text-align:center;"><b style="color: Green">Дякуємо за реєстрацію.</b> Тепер ви можете створювати публікації</div>
<?unset($_SESSION['newlogin']);}

if(!isset($myblog)){$zn['title'] = $zn['txt'] = '';}
?>
<form method="post" enctype="multipart/form-data"<?if(isset($myblog)){?> action="?edit"<?}?>><?if(isset($myblog)){?><input type="hidden" name="myblog" value="<?=$id_blog?>"><?}?><input type="hidden" name="wecheck_post" value="<?=$_SESSION['ischeck']=md5(time()).rand(111,9999)?>">
<div style="padding: 15px;">
Назва публікації: * <?if(isset($err1)){?><span style="color: red;font-size: 13px;">Пуста або коротка назва  (мін. 10 симв.)</span> <?}?>
<div style="height: 5px;"></div>
<input type="text" style="width: 100%; max-width: 600px;<?=isset($err1)?'border: 2px solid Red;':''?>" name="title" value="<?=isset($_POST['title'])?$_POST['title']:$zn['title']?>"/>
<div style="height: 15px;"></div>
Публікація: * <span style="font-size: 12px;opacity: 0.6;">(може бути вбудований html редактор)</span>
<?if(isset($err2)){?><div style="color: red;font-size: 13px;">Пуста або коротка публікація (мін. 20 симв.)</div><?}?>
<div style="height: 5px;"></div>
<textarea name="txt" style="width: 100%;height: 120px;<?=isset($err2)?'border: 2px solid Red;':''?>"><?=isset($_POST['txt']) && !isset($myblog)?$_POST['txt']:$zn['txt']?></textarea>
<div style="height: 15px;"></div>
Фото: <span style="font-size: 12px;opacity: 0.6;">(до 5Мб, бажано квадратні)</span>
<div style="height: 5px;"></div>
<?if(isset($myblog)){
$img = @mysqli_query($_connect, "SELECT filename, id, onm FROM img WHERE id_blog = '".$id_blog."' ORDER BY onm DESC, id");
if(@mysqli_num_rows($img) > 0){
	?>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<?$z = 0;
	while($rimg = @mysqli_fetch_row($img)){?>
	<div class="fl" style="margin-bottom: 10px;margin-right: 10px;padding:5px;border: 1px solid #ccc;border-radius: 1px;text-align:center;"><a  data-fancybox="gallery" href="/img/<?=$rimg[0]?>" class="op"><img src="/img/<?=$rimg[0]?>"  style="height: 60px;margin-right: 10px;" alt=""/></a>
	<div style="margin-top: 4px;padding: 6px;background: #eee;font-size: 12px;border-top: 1px solid #ccc">
	<?if($rimg[2] == 1 || $z == 0){?><span style="color: green;font-weight: bold;">обкладинка</span><?}else{?><a href="/<?=str_to_latin($title)?>-<?=$id_blog?>/?edit&onm=<?=$rimg[1]?>">на обкладинку</a><?}?>
	<div style="height: 4px;"></div>
	<a href="/<?=str_to_latin($title)?>-<?=$id_blog?>/?edit&killimg=<?=$rimg[1]?>" style="color: Red">видалити</a> 
	</div></div>
	<?$z++;}
	?>
	<div class="cb"></div>
	
	<?
}
}?>
<input type="file" name="mimg[]"  multiple style="width: 90%;border: 1px solid #ccc !important;padding: 12px !important;cursor: pointer;max-width: 300px;" value="">
<div style="height: 15px;"></div>
Теги: <span style="font-size: 12px;opacity: 0.6;">(через кому)</span>
<div style="height: 5px;"></div>
<?if(isset($myblog)){
$t = @mysqli_query($_connect, "SELECT t.name, bt.id FROM tags t, blog_tags bt WHERE t.id = bt.id_tag AND bt.id_blog = '".$id_blog."' ORDER BY t.name");
if(@mysqli_num_rows($t) > 0){?>
<div style="font-size: 13px;">
<?$z = 0;
while($tg = @mysqli_fetch_row($t)){
if($z > 0){?>, <?}
?><?=$tg[0]?> <a href="/<?=str_to_latin($title)?>-<?=$id_blog?>/?edit&killtag=<?=$tg[1]?>" style="color: Red">x</a><?
$z++;}?>
 
</div><div style="height: 5px;"></div>
<?}
}?>
<input type="text" style="width: 100%; max-width: 600px;" name="tags" value="<?=isset($_POST['tags']) && !isset($myblog)?$_POST['tags']:''?>"/>
<div style="height: 15px;"></div>
<input type="submit" class="btn" style="border-radius: 50px;border: 0;width: 150px;" value="<?=isset($myblog)?'Редагувати':'Створити пост'?>">
<?if(isset($myblog)){?>&nbsp; &nbsp; <a href="javascript:void(0)" onclick="if(confirm('Справді видалити пост?')){document.location.href='/<?=str_to_latin($title)?>-<?=$id_blog?>/?edit&kill=<?=$id_blog?>'}" style="color: red">видалити пост</a><?}?>
</div>
</form>
