<style>
a.page, a:hover.page, .p_a, .pn, a:visited.page{display: block;float: left;text-align:Center;min-width: 31px;font-size: 17px; color: #444; text-decoration:none; padding: 8px;padding-left: 4px;padding-right: 4px; border-radius: 100%;margin-right: 10px;}.p_a{background: #329fff; color: #fff;}a:hover.page{ background: #f6f6f6;border-left: 0;text-decoration: none; color: #000;}.npn, .npn a{color: #777 !important;text-decoration:none !important; font-size: 11px !important;}.npn{color: #aaa;}.npn a:hover{color: Red !important;}.fl{float: left;}.cb{clar: both;}.fr{float: right;}</style><?
if ($len>($mess)){
	
$lnk = $_SERVER['REQUEST_URI'];
$lnk = str_replace("?p=".$_GET['p'], "", $lnk);
$lnk = str_replace("&p=".$_GET['p'], "", $lnk);
$lnk2 = $lnk;
$ln = explode("&p", $lnk);

if(count($ln) > 1){$lnk = $ln[0];}else $lnk = "?";
if($lnk == '/' || $lnk == '') $lnk =  "?";

$urs = explode("?", $_SERVER['REQUEST_URI']);

if(count($urs) <= 1){ $gt2 = 1;}
$lnk = $_SERVER['REQUEST_URI'];
$lnk = str_replace("?p=".$_GET['p'], "", $lnk);
$lnk = str_replace("&p=".$_GET['p'], "", $lnk);
$lnk2 = $lnk;
$ln = explode("&p", $lnk);
if(isset($gt2)){
	if(count($ln) > 1){$lnk = $ln[0];}else $lnk = "?";
}
if($lnk == '/' || $lnk == '' || substr($lnk, -4) == 'html' || substr($lnk, -3) == 'htm' || substr($lnk, -3) == 'php') $lnk =  "?";
if($lnk != '/' && substr($lnk, -1) == '/') $lnk = "?";
if ($p == 0) $start_ = $mess; else $start_=$_GET['p']+$mess;
$pages_n = $start_/$mess;

?>
<div style="<?if(!isset($nopadding)){?>display: table;margin: 0 auto;margin-bottom:20px;padding-top: 20px;<?}?>">
<div style="float: left;"><?if($p != 0){?><a href="<?if($lnk != "?") echo $lnk;  else {if($p-$mess == 0) echo $lnk2;}?><?if($p-$mess != 0){if($lnk != '?'){?>&amp;<?}else{?>?<?}?>p=<?=$p-$mess?><?}?>" class="page" style=""><?}else{?><font class="pn"  style="color: #aaa; border-left: 0px solid #ccc; border-radius: 4px 0 0 4px;opacity: 0.5;"><?}?>&laquo;<?if(!isset($mob)){?><?}?><?if($p != 0){?></a><?}else{?></font><?}?></div><div style="float: left"><?
if(!isset($stranic) || !is_numeric($stranic) || $stranic < 2) $stranic = 6;
if($p > 950 && $stranic > 10){$stranic = 9;}

if($stranic%2 == 0){$stranic -= 1;}

$j = -1;
for ($i = $p/$mess-($p/$mess%$stranic); $i < $golova; $i++)
{
$j++;
if ($pages_n == ($i+1)) {$class = "_a";$nolnk = 1;} else {$nolnk = 0; $class = "";}
if($i!=0 && $j == 0){
?><a rel="nofollow" href="<?=$lnk?><?if($lnk != '?'){?>&amp;<?}?>p=<?=(($i*$mess)-($mess*(floor($stranic/2))))-$mess?>" <?if(!isset($_adminus)){?>onclick="loadall()"<?}?> class="page"><b>...</b></a><?
}
if($nolnk == 0){
?><a rel="nofollow"  href="<?if($lnk != "?") echo $lnk; else {echo $lnk2; if($i+1 > 1){echo "?";}}?><?if(($i+1) != 1){?><?if($lnk != '?'){?>&amp;<?}?>p=<?=($i*$mess)?><?}?>" class="page<?=$class?>" <?if(!isset($_adminus)){?>onclick="loadall()"<?}?>><?}else{?><span class="p_a"><?}?><?=($i+1)?><?if($nolnk == 0){?></a><?}else{?></span><?}?><?
if(($i+1)%$stranic == 0) {
	if(!isset($dopage)) $dopage = round($stranic/2);
	
	for($ked = $dopage; $ked > 1; $ked--){
		
		$newstr = ($i+$ked)*$mess;
		if(($newstr/$stranic) > ($len/$stranic)){
			
			$newstr = ($i+($ked-1))*$mess;
		}else{break;}
		
	}
	/*
?><a rel="nofollow"  href="<?=$lnk?><?if($lnk != '?'){?>&amp;<?}?>p=<?=$newstr?>" <?if(!isset($_adminus)){?>onclick="loadall()"<?}?> class="page"><b>...</b></a><?*/
$nox = 1;
break;
}
}
if($hvost != 0 && !isset($nox)){
if ($pages_n == ($golova+1)) {$class = "_a";$nolnk = 1;} else {$nolnk = 0; $class = "";}
if($j == -1){/*
?><a rel="nofollow"  href="<?=$lnk?><?if($lnk != '?'){?>&amp;<?}?>p=<?=($p-($mess*$stranic))?>" <?if(!isset($_adminus)){?>onclick="loadall()"<?}?> class="page">...</a><?*/}
if($nolnk == 0){?><a rel="nofollow"  href="<?=$lnk?><?if($lnk != '?'){?>&amp;<?}?>p=<?=($i*$mess)?>" <?if(!isset($_adminus)){?>onclick="loadall()"<?}?> class="page<?=$class?>"><?}else{?><span class="p_a"><?}?><?=($golova+1)?><?if($nolnk == 0){?></a><?}else{?></span><?}?><? 
}
?></div><div class="fl" style="float: left;"><?if($p+$mess < $len){?><a <?if(!isset($_adminus)){?>onclick="loadall()"<?}?>  href="<?=$lnk?><?if($lnk != '?'){?>&amp;<?}?>p=<?=$p+$mess?>" class="page" style=""><?}else{?><span class="pn" style="color: #aaa;opacity: 0.5; border-right: 0px solid #ccc; border-radius:  0 4px 4px 0;"><?}?><?if(!isset($mob)){?><?}?>&raquo;<?if($p+$mess < $len){?></a><?}else{?></span><?
}
?></div><div class="cb"></div></div>
<?
}
// FINISH PAGES
?>



