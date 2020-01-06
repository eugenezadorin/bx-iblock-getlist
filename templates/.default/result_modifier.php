<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

// если нужна постраничка
// @link https://dev.1c-bitrix.ru/api_help/main/reference/cdbresult/getpagenavstringex.php
$arResult['NAV_STRING'] = $arResult['NAV_RESULT']->GetPageNavStringEx($navComponentObject, 'Страницы', '.default');
