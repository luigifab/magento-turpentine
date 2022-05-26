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

class Nexcessnet_Turpentine_Model_Shim_Mage_Core_Layout extends Mage_Core_Model_Layout {
    /**
     * Generate a full block instead of just it's decendents
     *
     * @param  Mage_Core_Model_Layout_Element $blockNode
     * @return null
     */
    public function shim_generateFullBlock($blockNode) {
        $layout = $this->_shim_getLayout();
        if ( ! ($parent = $blockNode->getParent())) {
            $parent = new Varien_Object();
        }
        $layout->_generateBlock($blockNode, $parent);
        return $layout->generateBlocks($blockNode);
    }

    /**
     * Apply the layout action node for a block
     *
     * @param  Mage_Core_Model_Layout_Element $node
     * @return Mage_Core_Model_Layout
     */
    public function shim_generateAction($node) {
        if ( ! ($parentNode = $node->getParent())) {
            $parentNode = new Varien_Object();
        }
        return $this->_shim_getLayout()->_generateAction($node, $parentNode);
    }

    /**
     * Get the layout singleton
     *
     * @return Mage_Core_Model_Layout
     */
    protected function _shim_getLayout() {
        return Mage::getSingleton('core/layout');
    }
}