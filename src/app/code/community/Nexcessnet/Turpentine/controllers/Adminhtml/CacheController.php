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

require_once Mage::getModuleDir('controllers', 'Mage_Adminhtml').DS.'CacheController.php';

class Nexcessnet_Turpentine_Adminhtml_CacheController extends Mage_Adminhtml_CacheController
{

    /**
     * Mass action for cache enabeling
     */
    public function massEnableAction()
    {
        $types = $this->getRequest()->getParam('types');
        $allTypes = Mage::app()->useCache();

        $updatedTypes = 0;
        foreach ($types as $code) {
            if (empty($allTypes[$code])) {
                $allTypes[$code] = 1;
                $updatedTypes++;
            }
        }
        if ($updatedTypes > 0) {
            // disable FPC when Varnish cache is enabled:
            if ($allTypes['turpentine_pages'] == 1 || $allTypes['turpentine_esi_blocks'] == 1)
            {
                $allTypes['full_page'] = 0;
        Mage::getSingleton('core/session')->addSuccess(Mage::helper('adminhtml')->__("Full page cache has been disabled since Varnish cache is enabled."));
            } else if ($allTypes['full_page'] == 1) {
            Mage::getSingleton('core/session')->addSuccess(Mage::helper('adminhtml')->__("Turpentine cache has been disabled since Full Page cache is enabled."));
        }
            // disable FPC when Varnish cache is enabled.
            Mage::app()->saveUseCache($allTypes);
            $this->_getSession()->addSuccess(Mage::helper('adminhtml')->__("%s cache type(s) enabled.", $updatedTypes));
        }
        $this->_redirect('*/*');
    }

}