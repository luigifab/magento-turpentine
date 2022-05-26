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

class Nexcessnet_Turpentine_Block_Catalog_Product_List_Toolbar extends
    Mage_Catalog_Block_Product_List_Toolbar {

    public function _construct() {
        parent::_construct();
        $this->disableParamsMemorizing();
        // Remove params that may have been memorized before this fix was active.
        Mage::getSingleton('catalog/session')->unsSortOrder();
        Mage::getSingleton('catalog/session')->unsSortDirection();
        Mage::getSingleton('catalog/session')->unsDisplayMode();
        Mage::getSingleton('catalog/session')->unsLimitPage();
    }
}