<?php
/**
 * MM_PixelManager
 *
 * @category    MM
 * @package     MM_PixelManager
 * @copyright   Copyright (c) 2016 MM. (http://blog.meumagento.com.br)
 */
class MM_PixelManager_Block_Adminhtml_Pixel_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    /**
     * MM_PixelManager_Block_Adminhtml_Pixel_Edit_Tabs constructor.
     * @param array $args
     */
    public function __construct(array $args)
    {
        parent::__construct($args);
        $this->setId('pixel_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('mm_pixelmanager')->__('Pixel'));
    }

    /**
     * @return Mage_Core_Block_Abstract
     * @throws Exception
     */
    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('mm_pixelmanager')->__('Pixel Info'),
            'title'     => Mage::helper('mm_pixelmanager')->__('Pixel Info'),
            'content'   => $this->getLayout()->createBlock('mm_pixelmanager/adminhtml_pixel_edit_tab_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }

}