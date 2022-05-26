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

class Nexcessnet_Turpentine_Model_Session extends Mage_Core_Model_Session_Abstract {
    protected $_namespace = 'turpentine';

    public function __construct($data = array()) {
        $sessionName = isset($data['name']) ? $data['name'] : null;
        $this->init($this->_namespace, $sessionName);
        Mage::dispatchEvent(
            sprintf('%s_session_init', $this->_namespace),
            array(sprintf('%s_session', $this->_namespace) => $this) );
    }

    /**
     * Save the messages for a given block to the session
     *
     * @param  string $blockName
     * @param  array $messages
     * @return null
     */
    public function saveMessages($blockName, $messages) {
        $allMessages = $this->getMessages();
        $allMessages[$blockName] = array_merge(
            $this->loadMessages($blockName), $messages );
        $this->setMessages($allMessages);
    }

    /**
     * Retrieve the messages for a given messages block
     *
     * @param  string $blockName
     * @return array
     */
    public function loadMessages($blockName) {
        $messages = $this->getMessages();
        if (is_array(@$messages[$blockName])) {
            return $messages[$blockName];
        } else {
            return array();
        }
    }

    /**
     * Clear the messages stored for a block
     *
     * @param  string $blockName
     * @return null
     */
    public function clearMessages($blockName) {
        $messages = $this->getMessages();
        unset($messages[$blockName]);
        $this->setMessages($messages);
    }

    /**
     * Retrieve the stored messages
     *
     * @return array
     */
    public function getMessages($clear = false) {
        $messages = $this->getData('messages');
        if ( ! is_array($messages)) {
            $messages = array();
        }
        return $messages;
    }

    /**
     * Store messages
     *
     * @param array $messages
     */
    public function setMessages($messages) {
        $this->setData('messages', $messages);
    }
}