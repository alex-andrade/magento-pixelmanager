<?php
/**
 * MM_PixelManager
 *
 * @category    MM
 * @package     MM_PixelManager
 * @copyright   Copyright (c) 2016 MM. (http://blog.meumagento.com.br)
 */
class MM_PixelManager_Block_Adminhtml_Pixel_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{

    /**
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('base_fieldset', array('legend'=>$this->_getHelper()->__('General')));

        $fieldset->addField('name', 'text', array(
            'label'     => $this->_getHelper()->__('Name'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'name',
        ));

        $fieldset->addField('action', 'select', array(
            'label'     => $this->_getHelper()->__('Page Action'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'action',
            'options'   => $this->_getHelper()->getActionListOptions()
        ));

        $fieldset->addField('place', 'select', array(
            'label'     => $this->_getHelper()->__('Place'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'place',
            'options'   => $this->_getHelper()->getPlaceListOptions()
        ));

        $fieldset->addField('description', 'textarea', array(
            'label'     => $this->_getHelper()->__('Description'),
            'name'      => 'description',
        ));

        $fieldset->addField('pixel', 'textarea', array(
            'label'     => $this->_getHelper()->__('Pixel'),
            'name'      => 'pixel',
            'after_element_html' => '<small>Available objects: <br>- <i>{{var order.*}}</i><br>- <i>{{var customer.*}}</i><br>- <i>{{var product.*}}</i><br>- <i>{{var category.*}}</i><br> For looping, use: <br> {{loop order.all_visible_items delimiter=,}} <br> Sku: {{item sku}}, Name {{item name}}, ... <br> {{pool}} <br>Please replace <i>*</i> by the attribute code of the object:<br>(i.e.:<i>{{var order.grand_total}}</i>)<br>Please note that customer object only works with logged in users, and order only works if last_order_id is available in checkout session (i.e. in order thank you page). Otherwise, if object is not available, var will be replaced by an empty string.</small>'

        ));

        $fieldset->addField('store_id', 'select', array(
            'label'     => $this->_getHelper()->__('Store'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'store_id',
            'options'   => Mage::getSingleton('adminhtml/system_store')->getStoreOptionHash()
        ));

        $fieldset->addField('is_active', 'select', array(
            'label'     => $this->_getHelper()->__('Is active'),
            'title'     => $this->_getHelper()->__('Is active'),
            'name'      => 'is_active',
            'options'   => Mage::getSingleton('adminhtml/system_config_source_yesno')->toArray()
        ));

        if ( Mage::registry('pixel_data') ) {
            $form->setValues(Mage::registry('pixel_data')->getData());
        }

        return parent::_prepareForm();
    }

    /**
     * @return MM_PixelManager_Helper_Data
     */
    private function _getHelper()
    {
        return Mage::helper('mm_pixelmanager');
    }

}