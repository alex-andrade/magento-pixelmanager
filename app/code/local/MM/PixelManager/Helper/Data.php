<?php
/**
 * MM_PixelManager
 *
 * @category    MM
 * @package     MM_PixelManager
 * @copyright   Copyright (c) 2016 MM. (http://blog.meumagento.com.br)
 */
class MM_PixelManager_Helper_Data extends Mage_Core_Helper_Abstract
{
    const ALL_ACTION_NAME = 'all';
    const CATALOG_PRODUCT_VIEW = 'catalog_product_view';
    const CATALOG_CATEGORY_VIEW = 'catalog_category_view';
    const CHECKOUT_CART_INDEX = 'checkout_cart_index';
    const CHECKOUT_ONEPAGE_INDEX = 'checkout_onepage_index';
    const CHECKOUT_ONEPAGE_SUCCESS = 'checkout_onepage_success';

    const PLACE_HEAD = '_head_';
    const PLACE_AFTER_BODY_START = 'after_body_start';
    const PLACE_BEFORE_BODY_END = 'before_body_end';
    const PLACE_FOOTER = '_footer_';

    /**
     * @return array
     */
    public static function getActionListOptions()
    {
        $_options = array(
            self::ALL_ACTION_NAME =>  __('All Pages'),
            self::CATALOG_PRODUCT_VIEW => __('Product Page'),
            self::CATALOG_CATEGORY_VIEW => __('Category Page'),
            self::CHECKOUT_CART_INDEX => __('Cart Page'),
            self::CHECKOUT_ONEPAGE_INDEX => __('Checkout Page'),
            self::CHECKOUT_ONEPAGE_SUCCESS => __('Checkout Success Page'),
        );

        return $_options;
    }
    /**
     * @return array
     */
    public static function getPlaceListOptions()
    {
        $_options = array(
            self::PLACE_HEAD =>  __('Head'),
            self::PLACE_AFTER_BODY_START => __("After body start"),
            self::PLACE_BEFORE_BODY_END => __("Before body end"),
            self::PLACE_FOOTER => __('Footer'),
        );

        return $_options;
    }

    /**
     * @param $action
     * @return MM_PixelManager_Model_Resource_Pixel_Collection
     */
    public function getFooterPixels($action)
    {
        $collection = $this->getPixelsCollection();
        $collection
            ->addFieldToFilter('place', self::PLACE_FOOTER)
            ->addFieldToFilter('action', array('in' => array(self::ALL_ACTION_NAME, $action)));
        return $collection;
    }

    /**
     * @param $action
     * @return MM_PixelManager_Model_Resource_Pixel_Collection
     */
    public function getHeadPixels($action)
    {
        $collection = $this->getPixelsCollection();
        $collection
            ->addFieldToFilter('place', self::PLACE_HEAD)
            ->addFieldToFilter('action', array('in' => array(self::ALL_ACTION_NAME, $action)));
        return $collection;
    }

    /**
     * @return MM_PixelManager_Model_Resource_Pixel_Collection
     */
    public function getPixelsCollection()
    {
        return Mage::getModel('mm_pixelmanager/pixel')
            ->getCollection()
            ->addFieldToFilter('is_active', 1);
    }

    /**
     * @param $action
     * @return MM_PixelManager_Model_Resource_Pixel_Collection
     */
    public function getAfterBodyStartPixels($action)
    {
        $collection = $this->getPixelsCollection();
        $collection
            ->addFieldToFilter('place', self::PLACE_AFTER_BODY_START)
            ->addFieldToFilter('action', array('in' => array(self::ALL_ACTION_NAME, $action)));
        return $collection;
    }

    /**
     * @param $action
     * @return MM_PixelManager_Model_Resource_Pixel_Collection
     */
    public function getBeforeBodyEndPixels($action)
    {
        $collection = $this->getPixelsCollection();
        $collection
            ->addFieldToFilter('place', self::PLACE_BEFORE_BODY_END)
            ->addFieldToFilter('action', array('in' => array(self::ALL_ACTION_NAME, $action)));
        return $collection;
    }
}