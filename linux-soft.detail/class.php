<?php

use Bitrix\Iblock\Component\Tools;
use Bitrix\Iblock\IblockTable;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\ORM\Objectify\EntityObject;
use Bitrix\Main\SystemException;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * «Кафедры» элемент детально
 *
 * Class DepartmentsDetail
 */
class LinuxSoftDetail extends CBitrixComponent
{
    private $code;
    
    public function executeComponent(): void
    {
        $this->setElementCode();
        $this->setResult();
        $this->includeComponentTemplate();
    }
    
    private function setElementCode()
    {
        $this->code = $this->__parent->variables['ELEMENT_CODE'] ?? '';
        
        if (empty($this->code)) {
            Tools::process404('', true, true, true);
        }
    }
    
    private function setResult()
    {
        try {
            $elemObj        = $this->getElementObj();
            $this->arResult = $this->processFields($elemObj);
        } catch (ObjectPropertyException | ArgumentException | SystemException | Exception $e) {
            Tools::process404($e->getMessage(), true, true, true);
        }
    }
    
    /**
     * Получает объект элемента по символьному коду
     * @return \Bitrix\Main\ORM\Objectify\EntityObject
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     * @throws \Exception
     */
    private function getElementObj(): EntityObject
    {
        $entity = IblockTable::compileEntity('LinuxSoft');
        
        $obj = $entity->getDataClass()::query()
            ->addSelect('ID')
            ->addSelect('NAME')
            ->addSelect('PREVIEW_TEXT')
            ->addSelect('LOGOTIP.FILE')
            ->where('CODE', $this->code)
            ->exec()
            ->fetchObject();
        
        if (!$obj) {
            throw new Exception('Wrong query');
        }
        
        return $obj;
    }
    
    /**
     * Обработка полей элемента
     * @param \Bitrix\Main\ORM\Objectify\EntityObject $element
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\SystemException
     */
    private function processFields(EntityObject $element): array
    {
        $arItem = $element->collectValues();
        
        foreach ($arItem as $name => &$field) {
            if (!is_object($field)) {
                continue;
            }
            /** @var $field EntityObject */
            $field = $field->collectValues();
            
            if (isset($field['ITEM']) && is_object($field['ITEM'])) {
                /** @var $item EntityObject */
                $item = &$field['ITEM'];
                $item = $item->collectValues();
                unset($item);
            }

        }
        unset($field);
        
        return $arItem;
    }
}
