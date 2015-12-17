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
 * MenuManager menu item collection
 *
 * @category    Scandi
 * @package     Scandi_MenuManager
 */
class Scandi_MenuManager_Model_Resource_Item_Collection
    extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('scandi_menumanager/item');
    }

    /**
     * Add menu filter to item collection
     *
     * @param   int | Scandi_MenuManager_Model_Menu $menu
     * @return  Scandi_MenuManager_Model_Resource_Item_Collection
     */
    public function addMenuFilter($menu)
    {
        if ($menu instanceof Scandi_MenuManager_Model_Menu) {
            $menu = $menu->getId();
        }

        $this->addFilter('menu_id', $menu);

        return $this;
    }

    /**
     * Add status filter to item collection
     *
     * @return  Scandi_MenuManager_Model_Resource_Item_Collection
     */
    public function addStatusFilter()
    {
        $this->addFilter('is_active', 1);

        return $this;
    }

    /**
     * Set order to item collection
     *
     * @return Scandi_MenuManager_Model_Resource_Item_Collection
     */
    public function setPositionOrder()
    {
        $this->setOrder('position_path', 'asc');

        return $this;
    }

    /**
     * Collection to option array method
     *
     * @return array
     */
    public function toItemOptionArray()
    {
        $result = array();
        $result['0'] = Mage::helper('scandi_menumanager')->__('Root');

        foreach ($this as $item) {
            $result[$item->getData('item_id')] = $item->getData('title');
        }

        return $result;
    }
}