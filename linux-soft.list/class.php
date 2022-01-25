<?php

use Bitrix\Iblock\IblockTable;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

class LinuxSoftList extends CBitrixComponent
{
    public function executeComponent(): void
    {
        try {
            $this->arResult['ITEMS'] = $this->getElementArray();
        } catch (ObjectPropertyException | SystemException | ArgumentException $exception) {
        }
        $this->includeComponentTemplate();
    }
    
    private function getElementArray(): array
    {
        $entity = IblockTable::compileEntity('LinuxSoft');
        
        $result = $entity->getDataClass()::query()
            ->addSelect('ID')
            ->addSelect('NAME')
            ->addSelect('CODE')
            ->addSelect('PREVIEW_TEXT')
            ->addSelect('LOGOTIP.FILE')
            //->addSelect('*')
            ->setOrder('SORT')
            ->fetchCollection();
        
        $resultArray = [];
        foreach ($result as $item) {
            $file        = $item->get('LOGOTIP')->get('FILE');
            $renderImage = CFile::ResizeImageGet(
                $file->collectValues(),
                [
                    'width'  => 100,
                    'height' => 50,
                ],
                BX_RESIZE_IMAGE_PROPORTIONAL,
                true
            );
            
            //  dd($file);
            
            $filePath      = '/upload/' . $file->getSubdir() . '/' . $file->getFileName();
            $resultArray[] = [
                'NAME'         => $item->get('NAME'),
                'SRC'          => $filePath,
                'PREVIEW_TEXT' => $item->get('PREVIEW_TEXT'),
                'SRC_MIN'      => $renderImage['src'],
                'CODE' => $item->get('CODE'),
            ];
            
        }
        
        if (!$result) {
            $result = [];
        }
        return $resultArray;
    }
    
    
}