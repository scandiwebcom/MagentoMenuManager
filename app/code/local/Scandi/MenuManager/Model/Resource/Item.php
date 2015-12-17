<?php
/**
 * Scandiweb - creating a better future
 *
 * Scandi_MenuManager
 *
 * @category    Scandi
 * @package     Scandi_MenuManager
 * @author      Scandiweb.com <info@scandiweb.com>
 * @copyright   Copyright (c) 2013 Scandiweb.com (http://www.scandiweb.com)
 * @license     http://opensource.org/licenses/afl-3.0.php Academic Free License (AFL 3.0)
 */

/**
 * MenuManager menu item model
 *
 * @category    Scandi
 * @package     Scandi_MenuManager
 */
class Scandi_MenuManager_Model_Resource_Item extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('scandi_menumanager/menu_item', 'item_id');
    }

    /**
     * Load an object using 'identifier' field
     *
     * @param   Mage_Core_Model_Abstract    $object
     * @param   mixed                       $value
     * @param   string                      $field
     * @return  Scandi_MenuManager_Model_Resource_Item
     */
    public function load(Mage_Core_Model_Abstract $object, $value, $field = null)
    {
        if (!is_numeric($value) && is_null($field)) {
            $field = 'identifier';
        }

        return parent::load($object, $value, $field);
    }

    /**
     * Perform operations before object save - add unique 'identifier' and check item parent
     *
     * @param Scandi_MenuManager_Model_Item $object
     * @return Scandi_MenuManager_Model_Resource_Item
     */
    protected function _beforeSave(Mage_Core_Model_Abstract $object)
    {
        if ($object->getId() && $object->getId() == $object->getParentId()) {
            Mage::throwException(Mage::helper('scandi_menumanager')
                ->__('Menu item can not be parent to itself.'));

            return $this;
        }

        if (!$object->getMenuId()) {
            Mage::throwException(Mage::helper('scandi_menumanager')
                ->__('Menu item parent menu must be specified.'));

            return $this;
        }

        if (!$object->getIdentifier()) {
            $object->setIdentifier('menu_' . $object->getMenuId() . '_item_' . date('Y_m_d_H_i_s'));
        }

        Mage::app()->cleanCache(Scandi_MenuManager_Model_Menu::CACHE_TAG);

        return $this;
    }
}
