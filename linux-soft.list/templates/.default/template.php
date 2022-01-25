<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$APPLICATION->SetTitle('LinuxSoft');
?>

<?php
// echo "<pre>";
// print_r($arResult);
// echo "</pre>";
// ?>

<?php if (!empty($arResult['ITEMS'])): ?>
<link rel="stylesheet" href="<?=CSS_URL?>">
<div class="linux-soft">
    <div class="full-wrapper">
        <div class="linux-soft__grid">
            <hr>
            <?php foreach ($arResult['ITEMS'] as $arItem) : ?>
            <a href="/linux-soft/<?=$arItem['CODE']?>/">
                <div class="linux-soft__item">
                    <div class="linux-soft__title-block">
                        <p class="linux-soft_img"><img src="<?=$arItem['SRC_MIN']?>" alt=""></p>
                        <h3 class="linux-soft__title"><?=$arItem['NAME']?></h3>
                    </div>
                    <div class="linux-soft__logo-block">
                        <div class="linux-soft__logo"><?=$arItem['PREVIEW_TEXT']?></div>
                    </div>
                    <hr>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>
