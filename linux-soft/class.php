<?php

use Bitrix\Iblock\Component\Tools;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * «LinuxSoft» комплексный компонент
 *
 * Class LinuxSoft
 */
class LinuxSoft extends CBitrixComponent
{
    /**
     * Параметры
     *
     * @var array
     */
    public $variables = [];
    
    /**
     * @return mixed|void|null
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public function executeComponent(): void
    {
        $page = $this->getSefPage();

        // 404 если не найден роут
        if ($page === false) {
            Tools::process404('', true, true, true);
        }
        
        $this->includeComponentTemplate($page);
    }
    
    /**
     * Получает страницу запроса
     *
     * @return bool|int|string
     */
    private function getSefPage()
    {
        return CComponentEngine::ParseComponentPath(
            '/',
            [
                'list'   => 'linux-soft/',
                'detail' => 'linux-soft/#ELEMENT_CODE#/',
            ],
            $this->variables
        );
    }
}