<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var LinuxSoft $component */


$APPLICATION->IncludeComponent(
    'custom:linux-soft.detail',
    '',
    [],
    $component
);
