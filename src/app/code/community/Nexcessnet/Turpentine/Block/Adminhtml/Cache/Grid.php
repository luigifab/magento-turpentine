<?php
/**
 * Nexcess.net Turpentine Extension for Magento
 * Copyright (C) 2012  Nexcess.net L.L.C.
 *
 * This program is free software, you can redistribute it or modify
 * it under the terms of the GNU General Public License (GPL) as published
 * by the free software foundation, either version 2 of the license, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but without any warranty, without even the implied warranty of
 * merchantability or fitness for a particular purpose. See the
 * GNU General Public License (GPL) for more details.
 */

class Nexcessnet_Turpentine_Block_Adminhtml_Cache_Grid extends Mage_Adminhtml_Block_Cache_Grid
{

    /**
     * Prepare grid collection
     */
    protected function _prepareCollection()
    {
        parent::_prepareCollection();
        $collection = $this->getCollection();
        $turpentineEnabled = false;
        $fullPageEnabled = false;
        foreach ($collection as $key=>$item) {
            if ($item->getStatus() == 1 && ($item->getId() == 'turpentine_pages' || $item->getId() == 'turpentine_esi_blocks')) {
                $turpentineEnabled = true;
            }
            if ($item->getStatus() == 1 && $item->getId() == 'full_page') {
                $fullPageEnabled = true;
            }
        }
        if ($turpentineEnabled  && !$fullPageEnabled) {
            $collection->removeItemByKey('full_page');
        }
        if ($fullPageEnabled && !$turpentineEnabled) {
            $collection->removeItemByKey('turpentine_pages');
            $collection->removeItemByKey('turpentine_esi_blocks');
        }
        $this->setCollection($collection);
        return $this;
    }

}