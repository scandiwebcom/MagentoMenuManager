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
 * MenuManager menu item parent title renderer
 *
 * @category    Scandi
 * @package     Scandi_MenuManager
 */
class Scandi_MenuManager_Block_Adminhtml_Menu_Edit_Tab_Renderer_Parent
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    /**
     * Returns item title by id or 'Root' if no parent specified
     *
     * @param Varien_Object $row
     * @return string
     */
    public function render(Varien_Object $row)
    {
        if ($value = $row->getData($this->getColumn()->getIndex())) {
            return Mage::getModel('scandi_menumanager/item')->load($value)->getTitle();
        }

        return Mage::helper('scandi_menumanager')->__('Root');
    }
}