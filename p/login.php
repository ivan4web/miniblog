<div class="mwh" style="text-align:center;border-radius: 20px;padding-top: 10px;border: 0 !important;box-shadow: 0 2px 2px rgba(0,0,0,0.3);padding-bottom: 10px;opacity: 0.95;position: absolute;top: 50%; left: 50%; margin-left: -190px;margin-top: -200px; width: 85%;max-width: 380px;"><div style="text-align:center;padding-bottom: 5px;padding-top: 5px;opacity: 0.4;font-size: 16px;letter-spacing: 4px;text-transform: uppercase;"><b>Авторизація</b></div>
<form method="post"><input type="hidden" name="wecheck_login" value="<?=$_SESSION['ischeck']=md5(time()).rand(111,9999)?>">
<div id="erlop" style="text-align:center;color: #dd0000"><?=isset($err_txt)?$err_txt:''?></div>
<div style="height: 5px;"></div>
<input type="text" name="ulog" autocomplete="off"  maxlength="16"  placeholder="Введіть логін" style="width: 100%;padding-left: 17px;border-radius: 20px;outline: none;<?=isset($err)?'border:2px solid Red;':''?>" maxlength="16"   />
<div style="height: 12px;"></div>
<input type="password" autocomplete="off" name="psd"  style="outline: none;width: 100%;padding-left: 17px;border-radius: 20px;<?=isset($err)?'border:2px solid Red;':''?>" maxlength="16"  placeholder="Введіть пароль" />
<div style="padding-top: 12px;font-size: 13px; color: #666;padding-left: 3px;">Немає акаунту? 
<a  href="/reg/">Зареєструватись</a>
</div> 
<div style="height: 12px;"></div>
<input type="submit" class="btn" style="border-radius: 50px;border: 0;width: 150px;" value="Увійти">
<div style="padding-top: 12px;font-size: 13px; ">Або <a href="/" style="color: #000;">на головну</a></div>
</form>
</div>

