<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
//$APPLICATION->SetTitle("Список элементов Linux Soft");
?>
<?php

CONST CSS_URL = '/local/components/linux-soft/templates/.default/style.sass/style.css';

?>
<?$APPLICATION->IncludeComponent(
	"custom:linux-soft",
	'',
	[],
	false
);?>

<?php require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>

