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

class Nexcessnet_Turpentine_Model_Core_Session extends Mage_Core_Model_Session
{
    public function __construct($data = [])
    {
        $name = isset($data['name']) ? $data['name'] : null;
        $this->init('core', $name);
    }

    /**
     * Retrieve Session Form Key
     *
     * @return string A 16 bit unique key for forms
     */
    public function getFormKey()
    {
        if (Mage::registry('replace_form_key') &&
                ! Mage::app()->getRequest()->getParam('form_key', false)) {
            // flag request for ESI processing
            Mage::register('turpentine_esi_flag', true, true);
            return '{{form_key_esi_placeholder}}';
        } else {
            return parent::getFormKey();
        }
    }

    public function real_getFormKey()
    {
        if ( ! $this->getData('_form_key')) {
            $this->setData('_form_key', Mage::helper('core')->getRandomString(16));
        }
        return $this->getData('_form_key');
    }

    /**
     * Creates new Form key
     */
    public function renewFormKey()
    {
            $this->setData('_form_key', Mage::helper('core')->getRandomString(16));
    }

    /**
     * Validates Form key
     *
     * @param string|null $formKey
     * @return bool
     */
    public function validateFormKey($formKey)
    {
        return ($formKey === $this->getFormKey());
    }
}