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
 * MenuManager menu model
 *
 * @category    Scandi
 * @package     Scandi_MenuManager
 */
class Scandi_MenuManager_Model_Menu extends Mage_Core_Model_Abstract
{
    /**
     * Menu types
     */
    const TYPE_HORIZONTAL = 'horizontal';
    const TYPE_VERTICAL = 'vertical';
    const TYPE_NONE = 'none';

    /**
     * Cache tag
     */
    const CACHE_TAG = 'menumanager_menu';

    protected function _construct()
    {
        $this->_init('scandi_menumanager/menu');
    }

    /**
     * Prepare menu types
     *
     * @return array
     */
    public function getAvailableTypes()
    {
        $types = array(
            self::TYPE_NONE => Mage::helper('scandi_menumanager')->__('None'),
            self::TYPE_VERTICAL => Mage::helper('scandi_menumanager')->__('Vertical'),
            self::TYPE_HORIZONTAL => Mage::helper('scandi_menumanager')->__('Horizontal'),
        );

        return $types;
    }

    /**
     * Provide available options as a value/label array
     *
     * @return array
     */
    public function toOptionArray()
    {
        $collection = Mage::getModel('scandi_menumanager/menu')->getCollection();
        $return = array();
        foreach ($collection as $menu) {
            $return[] = array('value' => $menu->getIdentifier(), 'label' => $menu->getTitle());
        }
        return $return;
    }
}
