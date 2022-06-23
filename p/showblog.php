<div style="padding:8px;margin-bottom: 10px;border-bottom: 1px solid #ccc;"><a href="/" style="font-size: 13px;color: #000;opacity: 0.8;">&laquo; Всі публікації</a></div>
<div style="padding-left: 15px;padding-right: 15px;position: relative;">
<?if(isset($_SESSION['userid']) && $_SESSION['userid'] == $id_user){?>
<div style="position: absolute;top: 0; right: 0;"><a href="/<?=str_to_latin($title)?>-<?=$id_blog?>/?edit" style="color: #000;font-size: 13px;display: block;padding: 6px;">редагувати</a></div>
<?}?>
<h1 style="padding:0;margin:0;font-size: 24px;"><?=$title?></h1>
<div style="padding-top: 5px;padding-bottom: 8px;font-size: 12px;opacity: 0.8;">Створено: <?=show_dat($submit_date, 0)?>
<?if($update_date != $submit_date){?>, Змінено: <?=show_dat($update_date, 0)?><?}?>, 
Автор: <?
$auth = @mysqli_query($_connect, "SELECT login FROM users WHERE id = '".$id_user."' LIMIT 1");
$author = @mysqli_fetch_row($auth);
?>
<a href="/?author=<?=$zn['id_user']?>"><?=$author[0]?></a>
</div>
<?=$txt?>
<?
$img = @mysqli_query($_connect, "SELECT filename FROM img WHERE id_blog = '".$id_blog."' ORDER BY onm DESC, id");
if(@mysqli_num_rows($img) > 0){
	?>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
	<div style="font-size: 21px;padding-top: 5px;margin-top: 15px;border-top: 1px solid #ccc;padding-bottom: 10px;">Фотогалерея</div><?
	while($rimg = @mysqli_fetch_row($img)){?>
	<a  data-fancybox="gallery" href="/img/<?=$rimg[0]?>" class="op"><img src="/img/<?=$rimg[0]?>"  style="height: 60px;margin-right: 10px;" alt="<?=$zn['title']?>"/></a>
	<?}
}
$t = @mysqli_query($_connect, "SELECT t.name FROM tags t, blog_tags bt WHERE t.id = bt.id_tag AND bt.id_blog = '".$zn['id']."' ORDER BY t.name");
if(@mysqli_num_rows($t) > 0){?>
<div style="font-size: 13px;opacity: 0.8;padding-top: 10px;margin-top: 15px;border-top: 1px solid #ccc;padding-bottom: 10px;">

Теги: 
<?$z = 0;
while($tg = @mysqli_fetch_row($t)){
if($z > 0){?>, <?}
?><a href="/?tag=<?=$tg[0]?>"><?=$tg[0]?></a><?
$z++;}?> 
</div>
<?}
?>



</div>
