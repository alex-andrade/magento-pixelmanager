<?php
/**
 * MM_PixelManager
 *
 * @category    MM
 * @package     MM_PixelManager
 * @copyright   Copyright (c) 2016 MM. (http://blog.meumagento.com.br)
 */
class MM_PixelManager_Block_Core_Text_List extends Mage_Core_Block_Text_List
{


    /**
     * @return mixed|string
     * @throws Mage_Core_Exception
     */
    protected function _toHtml()
    {
        $this->setText('');
        $action = Mage::app()->getFrontController()->getAction()->getFullActionName();
        if (MM_PixelManager_Helper_Data::PLACE_AFTER_BODY_START == $this->getNameInLayout()) {
            foreach (Mage::helper('mm_pixelmanager')->getAfterBodyStartPixels($action) as $_pixel) {
                /* @var $_pixel MM_PixelManager_Model_Pixel */
                $this->addText($_pixel->getToHtmlPixel() . PHP_EOL);
            }

        }

        foreach ($this->getSortedChildren() as $name) {
            $block = $this->getLayout()->getBlock($name);
            if (!$block) {
                Mage::throwException(Mage::helper('core')->__('Invalid block: %s', $name));
            }
            $this->addText($block->toHtml());
        }

        if (MM_PixelManager_Helper_Data::PLACE_BEFORE_BODY_END == $this->getNameInLayout()) {
            foreach (Mage::helper('mm_pixelmanager')->getBeforeBodyEndPixels($action) as $_pixel) {
                /* @var $_pixel MM_PixelManager_Model_Pixel */
                $this->addText($_pixel->getToHtmlPixel() . PHP_EOL);
            }

        }

        return Mage_Core_Block_Text::_toHtml();
    }

}