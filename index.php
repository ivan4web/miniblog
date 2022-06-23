<?if(!isset($_config)){include("inc/config.inc.php");}?><html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /><meta name="format-detection" content="telephone=no"><meta name="viewport" content="width=device-width, initial-scale=1.0" /><link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet"> 
<script src="/js/jq.js"  type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<title><?=$tit?></title>
<style>
html, body{background: #fff;padding:0;margin:0;
font-family: 'Roboto', sans-serif;height:100%;font-size: 15px;}
*{outline: none;}
.badaboom{
display: flex;
flex-direction: column;
min-height: 100%;
}
.bigbadaboom {
flex: 1 0 auto;
}
.smallbadaboom {
flex: 0 0 auto;
}
a{
text-decoration:none;
color: #1a0dab;
}
a:hover{
text-decoration:underline;
color: #1022C9;}
.mbg{width: 98%; margin: 0 auto; max-width: 1080px;}
.mwh{padding: 20px; padding-left: 20px;padding-right: 20px;border: 1px solid #ccc; border-radius:2px;background-color: #fff;color: #414141;}
.fl{float: left;}
.fr{float: right;}
.cb{clear: both;}
.overlay{
	width: 100%;
    height: 100%;
    z-index: 999;
	background-image: url('/ranok.jpg');
	background-size: cover;
	background-position: bottom right;
}
.regs{background-image: url('/lito.jpg');}
button,html input[type="button"],input[type="reset"],input[type="submit"]{outline:none;
-webkit-appearance:button;cursor:pointer}
input[type="text"],input[type="password"], select, textarea{
	font-size: 13px; color: #000;
box-shadow: 0 2px 4px rgba(100, 100, 100, 0.1) inset;
box-sizing:border-box;padding:10px;
border: 1px solid #ccc;
border-radius: 2px;
}

input[type="text"]:focus,input[type="password"]:focus, select:focus, textarea:focus{
box-shadow: 0 2px 4px rgba(100, 100, 100, 0.1);
border: 1px solid #507299;
}

a.btn, .btn, input[type="submit"], input[type="button"]{
	padding: 10px;
	background: #507299;
	border: 0;
	text-align:center;
	color: #fff;
	border: 1px solid #48698f;
	border-radius: 2px;
	text-decoration:none;
}
a:hover.btn, .btn:hover, input[type="submit"]:hover, input[type="button"]:hover{background-color: #305279;border: 1px solid #507299;text-decoration:none;color: #fff;}
a.rm{display: block;font-size: 13px;padding-top: 5px;}
a.mn{display: block;padding: 6px;border-bottom: 1px solid #ccc;padding-left: 15px; padding-right: 15px;}
.fl20{width: 20%;text-align:center;}
.fl80{width: 80%;}
.blogimg{max-width: 90%; max-height: 180px;margin: 0 auto;}
@media screen and (max-width: 800px) {
	.fl20, .fl80{width: 100%;text-align:center;}
	.blogimg{max-width: 100%; max-height: auto;}
	.noimg{display: none;}
}
a:hover.op{opacity: 0.6;}
</style>
<?if(isset($_SESSION['userid'])){?>
<script>$(document).click( function(event){
		 event.stopPropagation();
      if( $(event.target).closest("section").length  || $(event.target).closest("article").length) 
        return;
      $("section").fadeOut("fast");
      event.stopPropagation();
});
</script>
<?}?>
</head>
<body class="<?=$bodyclass?>">
<div class="badaboom"><div class="bigbadaboom" style="">
<div class="mbg">
<?if($bodyclass == ''){?>
<div style="padding-top: 5px; padding-bottom: 5px;border-bottom: 0px solid #ccc;">
<div class="fl" style="font-weight: 400;font-size: 19px;"><a href="<?=$langlnk?>/" style="text-decoration:none;color: #000">Мій міни-блоґ<span style="font-size: 13px;opacity: 0.7;padding-left: 4px;">для мульті-авторів</a></div>
<div class="fr"><?

if(!isset($_SESSION['userid'])){?><a href="/createpost/" class="rm">Cтворити пост</a><?}else{?>
<div class="fl" style="position: relative">
<article><a href="javascript:void(0)" onclick="$('#miu').slideDown('fast');" style="display:block;padding: 5px;"><img src="/i/mnu.png" style="height: 15px;"></a>
		<section id="miu" style="white-space: nowrap; box-shadow: 0 3px 12px rgba(0,0,0,0.1);position: absolute;top: 30px; right: 0;border: 1px solid #ccc; border-top: 0;display: none;z-index: 99;background: #fff;">
		<a href="/createpost/"  class="mn">Створити пост</a>
		<a href="/myposts/"  class="mn">Мої пости</a>
		
		<a href="/logout/" style="color: #aa0000" class="mn">Вихід</a>
		</section>
		</article>
		</div>
<?}
?></div>
<div class="cb"></div>
</div>
	<div style="height: 3px;margin-bottom: 0px;border-radius: 2px 2px 0 0;background: #329fff;"></div>
	<div style="height: 3px;margin-bottom: 0px;border-radius: 0 0 2px 2px;background: #f7de00;"></div>
<?}?>
<?include($p);?>
</div>
</div>
<div class="smallbadabooms" ><?if($bodyclass == ''){?><div class="mbg">
	<div style="height: 3px;margin-bottom: 0px;border-radius: 2px 2px 0 0;background: #329fff;"></div>
	<div style="height: 3px;margin-bottom: 0px;border-radius: 0 0 2px 2px;background: #f7de00;"></div>
	<div style="padding: 10px;text-align:Center;font-size: 12px;opacity: 0.7;">&copy; <?=Date('Y')?> &mdash;  Ukranians</div>
</div><?}?>
</div>
</div>
</body>
</html>