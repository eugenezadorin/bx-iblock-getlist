<?php

namespace Machaon\Components;

use \Bitrix\Main\Loader;
use \CBitrixComponent;
use \CIBlock;
use \CIBlockElement;
use \CDBResult;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * Компонент-обертка над CIBlockElement::GetList
 * Пригодится, когда нужно вывести небольшую мелочь, а тянуть для этого news.list не хочется.
 */
class IblockGetListComponent extends CBitrixComponent
{
    const DEFAULT_CACHE_TIME = 3600;

    public function executeComponent()
    {
        Loader::includeModule('iblock');

        $cacheTime = isset($this->arParams['CACHE_TIME']) ? intval($this->arParams['CACHE_TIME']) : $this::DEFAULT_CACHE_TIME;
        $sort = isset($this->arParams['SORT']) ? $this->arParams['SORT'] : ['sort' => 'asc'];
        $filter = isset($this->arParams['FILTER']) ? $this->arParams['FILTER'] : [];
        $groupBy = isset($this->arParams['GROUP_BY']) ? $this->arParams['GROUP_BY'] : false;
        $nav = isset($this->arParams['NAV_PARAMS']) ? $this->arParams['NAV_PARAMS'] : false;
        $select = isset($this->arParams['SELECT']) ? $this->arParams['SELECT'] : [];

        if ($this->startResultCache($cacheTime, [CDBResult::GetNavParams($nav)])) {
            $rows = CIBlockElement::GetList($sort, $filter, $groupBy, $nav, $select);
            $this->arResult['NAV_RESULT'] = $rows;
            while ($row = $rows->GetNextElement()) {
                $fields = $row->GetFields();
                $fields['PROPERTIES'] = $row->GetProperties();

                $buttons = CIBlock::GetPanelButtons($fields['IBLOCK_ID'], $fields['ID']);

                $fields['EDIT_LINK'] = $buttons['edit']['edit_element']['ACTION_URL'];
                $fields['DELETE_LINK'] = $buttons['edit']['delete_element']['ACTION_URL'];

                $this->arResult['ITEMS'][] = $fields;
            }
            $this->includeComponentTemplate();
        }
    }
}
