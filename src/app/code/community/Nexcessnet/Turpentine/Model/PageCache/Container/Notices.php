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

class Nexcessnet_Turpentine_Model_PageCache_Container_Notices
    extends Enterprise_PageCache_Model_Container_Abstract {

    /**
     * Generate placeholder content before application was initialized and apply to page content if possible
     *
     * @param string $content
     * @return boolean
     */
    public function applyWithoutApp(&$content) {
        return false;
    }

    /**
     * Render block content
     *
     * @return string
     */
    protected function _renderBlock() {
        $block = new Nexcessnet_Turpentine_Block_Notices();
        $block->setTemplate('turpentine/notices.phtml');

        return $block->toHtml();
    }
}
