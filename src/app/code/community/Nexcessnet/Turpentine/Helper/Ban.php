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

class Nexcessnet_Turpentine_Helper_Ban extends Mage_Core_Helper_Abstract {
    /**
     * Get the regex for banning a product page from the cache, including
     * any parent products for configurable/group products
     *
     * @param  Mage_Catalog_Model_Product $product
     * @return string
     */
    public function getProductBanRegex($product) {
        $urlPatterns = [];
        foreach ($this->getParentProducts($product) as $parentProduct) {
            if ($parentProduct->getUrlKey()) {
                $urlPatterns[] = $parentProduct->getUrlKey();
            }
        }
        if ($product->getUrlKey()) {
            $urlPatterns[] = $product->getUrlKey();
        }
        if (empty($urlPatterns)) {
            $urlPatterns[] = "##_NEVER_MATCH_##";
        }
        $pattern = sprintf('(?:%s)', implode('|', $urlPatterns));
        return $pattern;
    }

    /**
     * Get parent products of a configurable or group product
     *
     * @param  Mage_Catalog_Model_Product $childProduct
     * @return array
     */
    public function getParentProducts($childProduct) {
        $parentProducts = [];
        foreach (['configurable', 'grouped'] as $pType) {
            foreach (Mage::getModel('catalog/product_type_'.$pType)
                    ->getParentIdsByChild($childProduct->getId()) as $parentId) {
                $parentProducts[] = Mage::getModel('catalog/product')
                    ->load($parentId);
            }
        }
        return $parentProducts;
    }
}