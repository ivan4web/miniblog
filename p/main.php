<?
$wh = "";
if(isset($_GET['author']) && is_numeric($_GET['author']) && (int)$_GET['author'] > 0){
	$wh .= "AND id_user = '".(int)$_GET['author']."'";
	$auth = @mysqli_query($_connect, "SELECT login FROM users WHERE id = '".(int)$_GET['author']."' LIMIT 1");
	$author = @mysqli_fetch_row($auth);
	$filter = 'Автор: <b>'.$author[0].' <a href="/" style="color: Red">x</a></b>';
}
if(isset($_GET['tag'])){
	$tag = strip_all($_GET['tag']);
	if($tag != ''){
	$t = @mysqli_query($_connect, "SELECT bt.id_blog FROM tags t, blog_tags bt WHERE t.id = bt.id_tag AND t.name = '".$tag."'");
	if(@mysqli_num_rows($t) > 0){
		
		$in = '';
		while($tg = @mysqli_fetch_row($t)){
			if($in != '') $in .= ',';
			$in .= $tg[0];
		}
		if($in != ''){$wh .= " AND id IN(".$in.")";
		$filter = 'Тег: <b>'.$tag.' <a href="/" style="color: Red">x</a></b>';}
	}
	}
}
if(isset($filter)){
?>
<div style="padding: 8px;border-bottom: 1px solid #ccc;"><?=$filter?></div>
<?}
$query = "SELECT id, id_user, title, txt, submit_date, update_date FROM blog WHERE id > 0 ".$wh." ORDER BY update_date DESC";
$r = @mysqli_query($_connect, $query);
$len = @mysqli_num_rows($r);
if($len == 0){?><div style="opacity: 0.4;font-size: 37px;padding: 25px;text-align: center;">Нажаль, ще немає публікацій</div><?}else{
if (isset($_GET['p'])&&is_numeric($_GET['p'])&&$_GET['p']>=0) $p = $_GET['p']; else $p = 0;
$mess = 5;
$hvost = $len%$mess;
$golova=($len-$hvost)/$mess;
$end = $p+$mess;
$end=($end>$len)?$len:$end;
$kolvo_r = $len;
$query .= " LIMIT ".$p.", ".$mess;
$r = @mysqli_query($_connect, $query);
while($zn = @mysqli_fetch_assoc($r)){
?>
<div style="padding: 12px; border-bottom: 1px solid #ccc;">
<div class="fl fl20"><?
$img = @mysqli_query($_connect, "SELECT filename FROM img WHERE id_blog = '".$zn['id']."' ORDER BY onm DESC, id LIMIT 1");
if(@mysqli_num_rows($img) == 0){?><div class="noimg" style="width: 90%;padding-top: 40px;padding-bottom: 40px;margin: 0 auto;text-align:center;background:#eee;border:1px solid #ccc;">
без фото</div><?}else{
	$rimg = @mysqli_fetch_row($img);?>
	<a href="/<?=str_to_latin($zn['title'])?>-<?=$zn['id']?>/"><img src="/img/<?=$rimg[0]?>" class="blogimg" style="" alt="<?=$zn['title']?>"/></a>
	<?
}
?>
</div>
<div class="fl fl80" style="position: relative;">
<?if(isset($_SESSION['userid']) && $_SESSION['userid'] == $zn['id_user']){?>
<div style="position: absolute;top: 0; right: 0;"><a href="/<?=str_to_latin($zn['title'])?>-<?=$zn['id']?>/?edit" style="color: #000;font-size: 13px;display: block;padding: 6px;">редагувати</a></div>
<?}?>
<a href="/<?=str_to_latin($zn['title'])?>-<?=$zn['id']?>/" style="font-size: 19px;"><?=$zn['title']?></a>
<div style="padding-top: 5px;padding-bottom: 5px;font-size: 12px;opacity: 0.6;">Створено: <?=show_dat($zn['submit_date'], 0)?>
<?if($zn['update_date'] != $zn['submit_date']){?>, Змінено: <?=show_dat($zn['update_date'], 0)?><?}?>, 
Автор: <?
$auth = @mysqli_query($_connect, "SELECT login FROM users WHERE id = '".$zn['id_user']."' LIMIT 1");
$author = @mysqli_fetch_row($auth);
?>
<a href="/?author=<?=$zn['id_user']?>"><?=$author[0]?></a>
</div>
<?

if (mb_strlen($zn['txt'], 'utf-8') > 150){
$str = $zn['txt']." ";
$length = 150;
do {
substr($str,$length,1);
$length = $length - 1;
}
while (substr($str,$length,1) !== " ");
$s_txt = substr($str,0,$length)." ...";
}else $s_txt = $zn['txt'];
$stxt = eregi_replace("http://", "", $s_txt); 
$stxt = eregi_replace("https://", "", $stxt); 
$stxt = eregi_replace("www.","",$stxt); 
$stxt = eregi_replace("/","",$stxt); 
?><?=$stxt?>
<?
$t = @mysqli_query($_connect, "SELECT t.name FROM tags t, blog_tags bt WHERE t.id = bt.id_tag AND bt.id_blog = '".$zn['id']."' ORDER BY t.name");
if(@mysqli_num_rows($t) > 0){?>
<div style="padding-top: 10px;font-size: 13px;">
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
<div class="cb"></div>
</div>
<?
}
include("inc/pages.php");

}
?>
