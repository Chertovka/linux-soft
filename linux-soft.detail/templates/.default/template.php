<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

// $APPLICATION->AddChainItem($arResult['NAME']);

?>
<?print_r($arResult['SRC_MIN']);?>
    <div class="linux-soft">
        <div class="full-wrapper">
            <div class="linux-soft__grid">
                <hr>
                    <div class="linux-soft__item">
                        <div class="linux-soft__title-block">
                            <p class="linux-soft_img"><img src="<?=$arResult['SRC_MIN']?>" alt=""></p>
                                <h3 class="linux-soft__title"><?=$arResult['NAME']?></h3>
                        </div>
                        <div class="linux-soft__logo-block">
                            <div class="linux-soft__logo"><?=$arResult['PREVIEW_TEXT']?></div>
                        </div>
                        <hr>
                    </div>
            </div>
        </div>
    </div>
