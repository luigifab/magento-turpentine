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

class Nexcessnet_Turpentine_Model_Shim_Mage_Core_Config extends Mage_Core_Model_Config {

    /**
     * Apply a block/helper/model rewrite to the config's rewrite cache. Returns
     * the previous value from the cache
     *
     * @param  string $groupType    rewrite type (helper|model|block)
     * @param  string $group        module part of class spec, "example" in "example/model"
     * @param  string $class        classname part of class spec, "model" in "example/model"
     * @param  string $className    full class name to rewrite to
     * @return string
     */
    public function shim_setClassNameCache($groupType, $group, $class, $className) {
        $config = Mage::getConfig();
        $prevValue = $config->_classNameCache[$groupType][$group][$class] ?? null;
        $config->_classNameCache[$groupType][$group][$class] = $className;
        return $prevValue;
    }

    /**
     * Clears event area cache so that Turpentine can dynamically add new event
     * observers even after the first event was fired.
     *
     * @param $area string The config area to clear (e.g. 'global')
     */
    public function unsetEventAreaCache($area) {
        if (version_compare(Mage::getVersion(), '1.11.0', '>=') // enterprise
            || version_compare(Mage::getVersion(), '1.6.0', '>=')) {
            // community
            unset($this->_eventAreas[$area]);
        }
    }

}