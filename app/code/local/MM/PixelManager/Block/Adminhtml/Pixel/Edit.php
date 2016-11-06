<?php
/**
 * MM_PixelManager
 *
 * @category    MM
 * @package     MM_PixelManager
 * @copyright   Copyright (c) 2016 MM. (http://blog.meumagento.com.br)
 */
class MM_PixelManager_Block_Adminhtml_Pixel_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * MM_PixelManager_Block_Adminhtml_Pixel_Edit constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->_blockGroup = 'mm_pixelmanager';
        $this->_controller = 'adminhtml_pixel';

        $this->_updateButton('save', 'label', Mage::helper('mm_pixelmanager')->__('Save Pixel'));
        $this->_updateButton('delete', 'label', Mage::helper('mm_pixelmanager')->__('Delete Pixel'));

    }

    /**
     * @return string
     */
    public function getHeaderText()
    {
        if( Mage::registry('pixel_data') && Mage::registry('pixel_data')->getId() ) {
            return Mage::helper('mm_pixelmanager')->__("Edit pixel '%s'", $this->htmlEscape(Mage::registry('pixel_data')->getName()));
        } else {
            return Mage::helper('mm_pixelmanager')->__('Add Pixel');
        }
    }
}