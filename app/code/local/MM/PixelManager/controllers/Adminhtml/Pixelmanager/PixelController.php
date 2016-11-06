<?php
/**
 * MM_PixelManager
 *
 * @category    MM
 * @package     MM_PixelManager
 * @copyright   Copyright (c) 2016 MM. (http://blog.meumagento.com.br)
 */
class MM_PixelManager_Adminhtml_Pixelmanager_PixelController extends Mage_Adminhtml_Controller_Action
{

    private $_modelTitle = 'pixel';
    private $_modelName = 'pixel';
    private $_helperGroupName = 'mm_pixelmanager';
    private $_modelGroupName = 'mm_pixelmanager';

    public function indexAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('mm_pixelmanager/adminhtml_pixel'));
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_redirect('*/*/edit');
    }

    public function editAction()
    {
        $this->loadLayout();
        $model = $this->_initObject();
        Mage::register('pixel_data', $model);
        $this->_addContent($this->getLayout()->createBlock('mm_pixelmanager/adminhtml_pixel_edit'))
            ->_addLeft($this->getLayout()->createBlock('mm_pixelmanager/adminhtml_pixel_edit_tabs'));
        $this->renderLayout();
    }

    public function saveAction()
    {
        $redirectBack = $this->getRequest()->getParam('back', false);
        if ($data = $this->getRequest()->getPost()) {

            $id    = $this->getRequest()->getParam('id');

            $model = $this->_initObject();

            $data = new Varien_Object($data);

            // save model
            try {
                $model->addData($data->getData());
                $model->setId($id);
                $model->setUserId(Mage::getSingleton('admin/session')->getUserId());
                $this->_getSession()->setFormData($model->getData());
                $model->save();
                $this->_getSession()->setFormData(false);
                $this->_getSession()->addSuccess(Mage::helper($this->_helperGroupName)->__('The ' . $this->_modelTitle . ' has been saved.'));
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
                $redirectBack = true;
            } catch (Exception $e) {
                $this->_getSession()->addError(Mage::helper($this->_helperGroupName)->__('Unable to save the ' . $this->_modelTitle . '.'));
                $this->_getSession()->addError($e->getMessage());
                $redirectBack = true;
                Mage::logException($e);
            }

            if ($redirectBack) {
                $this->_redirect('*/*/edit', array('id' => $model->getId()));

                return;
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * @return MM_PixelManager_Model_Pixel|void
     */
    private function _initObject()
    {
        $id    = $this->getRequest()->getParam('id');
        $model = Mage::getModel('mm_pixelmanager/pixel');
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->_getSession()->addError(Mage::helper($this->_helperGroupName)->__('This ' . $this->_modelTitle . ' no longer exists.'));
                $this->_redirect('*/*/index');

                return;
            }
        }
        return $model;
    }

    public function deleteAction() {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                // init model and delete
                $model = Mage::getModel($this->_modelGroupName . '/' . $this->_modelName);
                $model->load($id);
                if (!$model->getId()) {
                    Mage::throwException(Mage::helper($this->_helperGroupName)->__('Unable to find a ' . $this->_modelTitle . ' to delete.'));
                }
                $model->delete();
                // display success message
                $this->_getSession()->addSuccess(Mage::helper($this->_helperGroupName)->__('The ' . $this->_modelTitle . ' has been deleted.'));
                // go to grid
                $this->_redirect('*/*/index');

                return;
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError(Mage::helper($this->_helperGroupName)->__('An error occurred while deleting ' . $this->_modelTitle . ' data. Please review log and try again.'));
                Mage::logException($e);
            }
            // redirect to edit form
            $this->_redirect('*/*/edit', array('id' => $id));

            return;
        }
        // display error message
        $this->_getSession()->addError(Mage::helper($this->_helperGroupName)->__('Unable to find a ' . $this->_modelTitle . ' to delete.'));
        // go to grid
        $this->_redirect('*/*/index');
    }

    /**
     *
     */
    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('mm_pixelmanager/adminhtml_pixel_grid')->toHtml()
        );
    }

}