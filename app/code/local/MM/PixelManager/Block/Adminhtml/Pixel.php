<?php
/**
 * MM_PixelManager
 *
 * @category    MM
 * @package     MM_PixelManager
 * @copyright   Copyright (c) 2016 MM. (http://blog.meumagento.com.br)
 */
class MM_PixelManager_Block_Adminhtml_Pixel extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * MM_PixelManager_Block_Adminhtml_Pixel constructor.
     */
    public function __construct()
    {
        $this->_controller = 'adminhtml_pixel';
        $this->_blockGroup = 'mm_pixelmanager';
        $this->_headerText = Mage::helper('mm_pixelmanager')->__('Pixel Manager');
        $this->_addButtonLabel = Mage::helper('mm_pixelmanager')->__('Add Pixel');

        parent::__construct();
    }
}