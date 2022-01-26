<?php
	$path = "";
	include_once "base.php";
?>
<!DOCTYPE html PUBLIC>
<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Рентген</title>	
        <head>
            <LINK href="/css/styles.css" type=text/css rel=stylesheet />
	    <LINK href="css/menu.css" type=text/css rel=stylesheet />
	    <script type="text/javascript" src="/js/jquery/jquery.js"></script>
	    <LINK rel="stylesheet" type="text/css" href="/css/jquery/jquery-ui.min.css" />
	    <script type="text/javascript" src="/js/jquery/jquery-ui.min.js"></script>

<?if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login'])) {
    $login = $_SESSION['Login'];
    require "sub/functions.php";
    $level = GetLvlByLogin($login);
    
    if($level>3){
?>
	    <script type="text/javascript" src="/js/jquery/jquery.arcticmodal-0.3.min.js"></script>
            <LINK rel="stylesheet" type="text/css" href="/css/jquery.arcticmodal-0.3.css" />
	    <script type="text/javascript" src="/js/date.format.js"></script>	
	    <LINK rel="stylesheet" type="text/css" href="/date/jquery.datetimepicker.css" />
	    <script type="text/javascript" src="/date/jquery.datetimepicker.js"></script>
	    
	    <script type="text/javascript" src="/js/jquery.cookie.js"></script>
	    <script type="text/javascript" src="/date/jparams.js"></script>

	    <LINK href="/css/modal-add-form.css" type=text/css rel=stylesheet />
	    <LINK href="/css/modal-edit-form.css" type=text/css rel=stylesheet />
	    
	    <script type="text/javascript" src="/js/modal-add.js"></script>
	    <script type="text/javascript" src="/js/modal-edit-form.js"></script>
		<LINK href="/css/colorbox/colorbox2.css" type=text/css rel=stylesheet />
	<script type="text/javascript" src="/js/colorbox/jquery.colorbox.js"></script><script type="text/javascript" src="/js/colorbox/jquery.colorbox-ru.js"></script><script type="text/javascript" src="/js/colorbox/jparams.js"></script>
		<script type="text/javascript" src="/js/params.js"></script>

<?}
}?>
</head>

<?if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login'])) {
    //$login = $_SESSION['Login'];
?>

<div class="p_right">
    Здравствуйте, <b><?=$_SESSION['Username']?></b>.<a href="/logout.php">Выход</a>
    </div>
<?}?>
    <div class="header"><div class="header_logo">ЛОГО</div> <div class="header_title">СТОМАТОЛОГИЧЕСКАЯ ПОЛИКЛИНИКА</div></div>
    <div style="clear:both;"></div>
<div class="main">