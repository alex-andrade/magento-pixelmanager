<?php
/**
 * MM_PixelManager
 *
 * @category    MM
 * @package     MM_PixelManager
 * @copyright   Copyright (c) 2016 MM. (http://blog.meumagento.com.br)
 */
class MM_PixelManager_Block_Page_Html_Footer extends Mage_Page_Block_Html_Footer
{

    /**
     * Render block HTML
     *
     * @return string
     */
    protected function _toHtml()
    {
        $html = parent::_toHtml();
        $action = Mage::app()->getFrontController()->getAction()->getFullActionName();
        $html .= "<!-- START MM_PixelManager -->". PHP_EOL;

        foreach (Mage::helper('mm_pixelmanager')->getFooterPixels($action) as $_pixel) {
            /* @var $_pixel MM_PixelManager_Model_Pixel */
            $html .= $_pixel->getToHtmlPixel() . PHP_EOL;
        }

        $html .= "<!-- END MM_PixelManager-->". PHP_EOL;

        return $html;
    }

}