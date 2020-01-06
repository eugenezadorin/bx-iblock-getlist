<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
if (!empty($arResult['ITEMS'])):
?>
<section class="news-list">
    <?foreach ($arResult['ITEMS'] as $item):
        $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item['IBLOCK_ID'], 'ELEMENT_EDIT'));
        $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => 'Вы уверены? Операция необратима'));
    ?>
        <div class="news-item" id="<?=$this->GetEditAreaId($item['ID']);?>">
            <a href="<?=$item['DETAIL_PAGE_URL'];?>" class="news-item__name"><?=$item['NAME'];?></a>
            <p class="news-item__description"><?=$item['PREVIEW_TEXT'];?></p>
            <p class="news-item__author"><?=$item['PROPERTIES']['AUTHOR']['VALUE'];?></p>
        </div>
    <?endforeach;?>
    <?if (!empty($arResult['NAV_STRING'])):?>
        <div class="news-list__pagination"><?=$arResult['NAV_STRING'];?></div>
    <?endif;?>
</section>
<?endif;?>