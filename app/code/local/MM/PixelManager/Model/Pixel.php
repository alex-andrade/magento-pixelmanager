<?php
/**
 * MM_PixelManager
 *
 * @category    MM
 * @package     MM_PixelManager
 * @copyright   Copyright (c) 2016 MM. (http://blog.meumagento.com.br)
 */

/**
 * Class MM_PixelManager_Model_Pixel
 *
 * @method String getPixel()
 *
 * @category    MM
 * @package     MM_PixelManager
 * @copyright   Copyright (c) 2016 MM. (http://blog.meumagento.com.br)
 */
class MM_PixelManager_Model_Pixel extends Mage_Core_Model_Abstract
{

    protected $_vars_allowed_object_names = array('order', 'customer', 'category', 'product');
    protected $_vars_allowed_object_data = array();
    protected $_object;
    const DELIMITER = 'delimiter';

    protected function _construct()
    {
        $this->_init('mm_pixelmanager/pixel');
    }

    /**
     * Replace vars
     *
     * @return string
     */
    private function _replaceVariables($content){

        preg_match_all('/\{\{\s*var\s+(' . implode('|',$this->_vars_allowed_object_names) . ')\.([a-z0-9_]+)\s*\}\}/', $content, $occurences);

        $a_full_text_vars   = $occurences[0];
        $a_objects          = $occurences[1];
        $a_object_data      = $occurences[2];

        if(!empty($a_full_text_vars)){
            foreach($a_full_text_vars as $key => $full_text_vars){
                $object = $this->_getObjectByType($a_objects[$key]);

                $var_data = $object === false ? '' : $object->getDataUsingMethod($a_object_data[$key]);

                $content = str_replace($full_text_vars, $var_data, $content);
            }
        }

        return $content;
    }

    /**
     * Get object by type
     *
     * @return $object | false
     */
    private function _getObjectByType($type){
        $object = false;

        if(!isset($this->_vars_allowed_object_data[$type])){
            switch($type){
                case $this->_vars_allowed_object_names[0] : // order
                    $orderId = Mage::getSingleton('checkout/session')->getLastOrderId();
                    if ($orderId) {
                        $object = Mage::getModel('sales/order')->load($orderId);
                        if (!$object->getId()) {
                            $object = false;
                        }
                    }
                    break;
                case $this->_vars_allowed_object_names[1] : // customer
                    $object = Mage::getSingleton('customer/session')->getCustomer();
                    if (!$object->getId()) {
                        $object = false;
                    }
                    break;
                case $this->_vars_allowed_object_names[2] : // category
                    $object = Mage::registry('current_category');
                    if (!$object || !$object->getId()) {
                        $object = false;
                    }
                    break;
                case $this->_vars_allowed_object_names[3] : // product
                    $object = Mage::registry('current_product');
                    if (!$object || !$object->getId()) {
                        $object = false;
                    }
                    break;
                default: $object = false; break;
            }

            $this->_vars_allowed_object_data[$type] = $object;
        }
        return $this->_vars_allowed_object_data[$type];
    }

    public function getToHtmlPixel()
    {
        return $this->_replaceLoopVariables($this->_replaceVariables($this->getPixel()));
    }

    /**
     * Replace loop vars
     *
     * @return string
     */
    private function _replaceLoopVariables($text = "")
    {
        preg_match_all('/\{\{loop\s+('. implode('|',$this->_vars_allowed_object_names) . ')\.([a-z0-9_]*)\s('. self::DELIMITER .'=.*?)\}\}(.*?)\{\{pool\}\}/s', $text, $occurences);

        $full_text_to_replace = $occurences[0][0];
        $object_to_load = $occurences[1][0];
        $method_to_iterate = $occurences[2][0];
        $delimiter = str_replace(self::DELIMITER .'=', '', $occurences[3][0]);
        $loop_text_to_replace = $occurences[4][0];

        if (!$object_to_load || !$method_to_iterate)
            return $text;

        $this->_object = $this->_getObjectByType($object_to_load);
        if (!$this->_object)
            return $text;

        $objectArrayData = $this->_object->getDataUsingMethod($method_to_iterate);

        if (!is_array($objectArrayData))
            return $text;

        preg_match_all('/\{\{item\s+([a-z0-9_]*)\}\}/s', $loop_text_to_replace, $attributes);

        $attributesList = $attributes[1];
        $attributes_text_to_replace = $attributes[0];

        $loopText = array();

        foreach ($objectArrayData as $objectData) {
            $subText = $loop_text_to_replace;
            foreach ($attributesList as $k => $attribute) {
                $data = $objectData->getDataUsingMethod($attribute);
                $subText = str_replace($attributes_text_to_replace[$k], $data, $subText);
            }
            $loopText[] = $subText;
        }

        $replaceText = implode($delimiter, $loopText);

        return str_replace($full_text_to_replace, $replaceText, $text);

    }
}