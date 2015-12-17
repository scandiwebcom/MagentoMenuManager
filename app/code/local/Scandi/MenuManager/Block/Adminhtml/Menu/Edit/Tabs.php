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
 * MenuManager menu edit page left menu
 *
 * @category    Scandi
 * @package     Scandi_MenuManager
 */
class Scandi_MenuManager_Block_Adminhtml_Menu_Edit_Tabs
    extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();

        $this->setId('menu_page_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('scandi_menumanager')->__('Menu Information'));
    }

    /**
     * Add "Menu Items" tab and its content
     *
     * @return Mage_Core_Block_Abstract
     */
    protected function _beforeToHtml()
    {
        if ($this->getRequest()->getParam('menu_id')) {
            $itemsTabContent = $this->getLayout()
                ->createBlock('scandi_menumanager/adminhtml_menu_edit_tab_items')
                ->toHtml();
        } else {
            $itemsTabContent = Mage::helper('scandi_menumanager')->__(
                '<ul class="messages"><li class="notice-msg"><ul><li><span>%s</span></li></ul></li></ul>',
                Mage::helper('scandi_menumanager')->__('You will be able to manage items after saving this menu.')
            );
        }

        $itemSectionStatus = $this->getRequest()
            ->getParam('active_tab') == 'menu_page_tabs_items_section' ? true : false;

        $this->addTab('items_section', array(
            'label' => $this->__('Menu Items'),
            'title' => $this->__('Menu Items'),
            'active' => $itemSectionStatus,
            'content' => $itemsTabContent,
        ));

        return parent::_beforeToHtml();
    }
}
