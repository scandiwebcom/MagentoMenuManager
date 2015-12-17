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
 * MenuManager menu edit form container
 *
 * @category    Scandi
 * @package     Scandi_MenuManager
 */
class Scandi_MenuManager_Block_Adminhtml_Menu_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId   = 'menu_id';
        $this->_controller = 'adminhtml_menu';
        $this->_blockGroup = 'scandi_menumanager';

        parent::__construct();

        $this->_addButton('saveandcontinue', array(
            'label'   => Mage::helper('adminhtml')->__('Save and Continue Edit'),
            'onclick' => 'saveAndContinueEdit(\'' . $this->_getSaveAndContinueUrl() . '\')',
            'class'   => 'save',
        ), -100);

        if (Mage::registry('menumanager_menu')->getId()) {
            $this->_addButton('addmenuitem', array(
                'label'   => Mage::helper('scandi_menumanager')->__('Add Menu Item'),
                'onclick' => 'setLocation(\'' . $this->_getAddMenuItemUrl() . '\')',
                'class'   => 'add'
            ), 0);
        }

        $this->_formScripts[] = "
            function saveAndContinueEdit(urlTemplate) {
                var template = new Template(urlTemplate, /(^|.|\\r|\\n)({{(\w+)}})/),
                    tabsIdValue = menu_page_tabsJsTabs.activeTab.id,
                    url = template.evaluate({tab_id:tabsIdValue});

                editForm.submit(url);
            }
        ";
    }

    /**
     * Retrieve text for header element depending on loaded page
     *
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry('menumanager_menu')->getId()) {
            return Mage::helper('scandi_menumanager')->__("Edit Menu '%s'",
                $this->escapeHtml(Mage::registry('menumanager_menu')->getTitle()));
        } else {
            return Mage::helper('scandi_menumanager')->__('New Menu');
        }
    }

    /**
     * Get header css class
     *
     * @return string
     */
    public function getHeaderCssClass()
    {
        return 'icon-head head-cms-block ' . strtr($this->_controller, '_', '-');
    }

    /**
     * Getter of url for "Save and Continue" button
     *
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl('*/*/save', array(
            '_current'   => true,
            'back'       => 'edit',
            'active_tab' => '{{tab_id}}'
        ));
    }

    /**
     * Getter of url for "Add Menu Item" button
     *
     * @return string
     */
    protected function _getAddMenuItemUrl()
    {
        $request = $this->getRequest();

        return $this->getUrl('*/*/new_item', array(
            'menu_id' => $request->getParam('menu_id'),
            'active_tab' => $request->getParam('active_tab'),
        ));
    }
}