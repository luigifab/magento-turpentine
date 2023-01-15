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

class Nexcessnet_Turpentine_Block_Poll_ActivePoll extends Mage_Poll_Block_ActivePoll {

    public function setTemplate($template)
    {
        if (Mage::helper('core')->isModuleEnabled('Mage_Poll') && !Mage::getStoreConfigFlag('advanced/modules_disable_output/Mage_Poll')) {
            $this->_template = $template;
            $this->setPollTemplate('turpentine/ajax.phtml', 'poll');
            $this->setPollTemplate('turpentine/ajax.phtml', 'results');
        }
        return $this;
    }
}