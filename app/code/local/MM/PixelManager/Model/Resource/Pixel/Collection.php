<?php
/**
 * MM_PixelManager
 *
 * @category    MM
 * @package     MM_PixelManager
 * @copyright   Copyright (c) 2016 MM. (http://blog.meumagento.com.br)
 */
class MM_PixelManager_Model_Resource_Pixel_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('mm_pixelmanager/pixel');
    }
}