<?php

class rtPlugins_View_Helper_FlashMessenger {

    private
        $_oFlashMessenger,
        $_sMessagesPrefix,
        $_sMessagesPostfix,
        $_sMessagePrefix,
        $_sMessagePostfix;

    public function flashMessenger() {
        $this->_oFlashMessenger = Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger');
        return $this;
    }

    public function __toString() {
        $sOutput = '';

        if ($this->hasMessages()) {
            $sOutput .= $this->_sMessagesPrefix;

            foreach ($this->_oFlashMessenger->getIterator() as $sMessage) {
                $sOutput .= $this->_sMessagePrefix . $sMessage . $this->_sMessagePostfix;
            }

            $sOutput .= $this->_sMessagesPostfix;
        }

        return $sOutput;
    }

    public function setMessagesPrefix($sPrefix) {
        $this->_sMessagesPrefix = $sPrefix;
        return $this;
    }

    public function setMessagesPostfix($sPostfix) {
        $this->_sMessagesPostfix = $sPostfix;
        return $this;
    }

    public function setMessagePrefix($sPrefix) {
        $this->_sMessagePrefix = $sPrefix;
        return $this;
    }

    public function setMessagePostfix($sPostfix) {
        $this->_sMessagePostfix = $sPostfix;
        return $this;
    }

    public function hasMessages() {
        return $this->_oFlashMessenger->hasMessages();
    }

    public function getMessages() {
        return $this->_oFlashMessenger->getMessages();
    }

}

?>