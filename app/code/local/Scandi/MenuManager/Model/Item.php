<?php
/**
 * Scandi_MenuManager
 *
 * @category Scandi
 * @package Scandi_MenuManager
 * @author Scandiweb <info@scandiweb.com>
 * @copyright Copyright (c) 2013 Scandiweb, Ltd (http://scandiweb.com)
 * @license http://opensource.org/licenses/afl-3.0.php Academic Free License (AFL 3.0)
 */

/**
 * MenuManager menu item model
 *
 * @category    Scandi
 * @package     Scandi_MenuManager
 */
class Scandi_MenuManager_Model_Item extends Mage_Core_Model_Abstract
{
    /**
     * Menu item url open window types
     */
    const TYPE_NEW_WINDOW = 'new_window';
    const TYPE_SAME_WINDOW = 'same_window';

    protected function _construct()
    {
        $this->_init('scandi_menumanager/item');
    }

    /**
     * Prepare menu item url open window types
     *
     * @return array
     */
    public function getAvailableTypes()
    {
        $types = array(
            self::TYPE_SAME_WINDOW => Mage::helper('scandi_menumanager')->__('Same Window'),
            self::TYPE_NEW_WINDOW => Mage::helper('scandi_menumanager')->__('New Window'),
        );

        return $types;
    }

    /**
     * Gets position path of items parent
     *
     * @param $parentId
     * @return mixed
     */
    public function getParentPositionPath($parentId)
    {
        return $this->getCollection()
            ->addFieldToSelect('position_path')
            ->addFieldToFilter('item_id', $parentId)
            ->getFirstItem()
            ->getData('position_path');
    }
}
