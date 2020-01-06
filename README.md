# machaon:iblock.getlist

Компонент-обертка над `CIBlockElement::GetList()`. Пригодится, когда нужно вывести небольшую мелочь, а тянуть для этого `bitrix:news.list` не хочется.

Удобно для вывода баннеров, отзывов, списков, и тому подобной функциональности.

Компонент не предполагает настройку через визуальный редактор, всё делается на уровне кода.

    <?
    $APPLICATION->IncludeComponent('machaon:iblock.getlist', 'banners', [
        'SORT' => ['sort' => 'asc', 'id' => 'desc'],
        'FILTER' => ['IBLOCK_ID' => 1, 'ACTIVE' => 'Y'],
        'GROUP_BY' => false,
        'NAV_PARAMS' => ['nTopCount' => 10],
        'SELECT' => ['ID', 'NAME', 'PREVIEW_TEXT', 'PREVIEW_PICTURE', 'PROPERTY_URL']
    ]);
    ?>

## Установка

Если файл `composer.json` расположен в корне проекта, то достаточно одной команды:

    composer require machaon/iblock.getlist

Если же файл размещен в другом месте, например в `/local/composer.json`, то нужно предварительно прописать в нем путь к ядру Битрикс:

    "extra": {
        "bitrix-dir": "../bitrix"
    }

## Почему папка bitrix, а не local?

Потому что компонент считается вендорным, и его логичнее будет разместить в ядре, а ядро целиком поместить в `.gitignore`.
