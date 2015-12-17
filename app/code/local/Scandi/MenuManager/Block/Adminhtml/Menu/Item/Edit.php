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
 * MenuManager menu item edit form container
 *
 * @category    Scandi
 * @package     Scandi_MenuManager
 */
class Scandi_MenuManager_Block_Adminhtml_Menu_Item_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId   = 'item_id';
        $this->_blockGroup = 'scandi_menumanager';
        $this->_controller = 'adminhtml_menu_item';

        parent::__construct();

        $this->_updateButton('back', 'onclick', 'setLocation(\'' . $this->_getBackUrl() . '\')');
        $this->_updateButton('delete', 'onclick', 'setLocation(\'' . $this->_getDeleteUrl() . '\')');
    }

    /**
     * Retrieve text for header element depending on loaded page
     *
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry('menumanager_menu_item')->getId()) {
            return Mage::helper('scandi_menumanager')->__("Edit Menu Item '%s'",
                $this->escapeHtml(Mage::registry('menumanager_menu_item')->getTitle()));
        } else {
            return Mage::helper('scandi_menumanager')->__('New Menu Item');
        }
    }

    /**
     * get header css class
     *
     * @return string
     */
    public function getHeaderCssClass()
    {
        return 'icon-head head-cms-block ' . strtr($this->_controller, '_', '-');
    }

    /**
     * Getter of url for "Back" button
     *
     * @return string
     */
    protected function _getBackUrl()
    {
        return $this->getUrl('*/*/edit', array(
            'menu_id' => $this->getRequest()->getParam('menu_id'),
            '_current' => true
        ));
    }

    /**
     * Getter of url for "Delete" button
     *
     * @return string
     */
    protected function _getDeleteUrl()
    {
        return $this->getUrl('*/*/delete_item', array(
            'menu_id' => $this->getRequest()->getParam('menu_id'),
            'item_id' => $this->getRequest()->getParam('item_id')
        ));
    }
}