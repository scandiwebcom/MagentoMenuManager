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
 * MenuManager menu items grid
 *
 * @category    Scandi
 * @package     Scandi_MenuManager
 */
class Scandi_MenuManager_Block_Adminhtml_Menu_Edit_Tab_Items
    extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();

        $this->setId('cmsMenuItemsGrid');
        $this->setSaveParametersInSession(true);
    }

    /**
     * Prepare collection for grid
     *
     * @return Scandi_MenuManager_Block_Adminhtml_Menu_Edit_Tab_Items
     */
    protected function _prepareCollection()
    {
        /* @var $collection Scandi_MenuManager_Model_Resource_Item_Collection */
        $collection = Mage::getModel('scandi_menumanager/item')->getResourceCollection()
            ->addMenuFilter(Mage::registry('menumanager_menu'));
        if (!$this->getRequest()->getParam('sort')) { $collection->setPositionOrder(); }

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * Prepare grid columns
     *
     * @return Scandi_MenuManager_Block_Adminhtml_Menu_Edit_Tab_Items
     */
    protected function _prepareColumns()
    {
        /* @var $model Scandi_MenuManager_Model_Menu*/
        $menuModel = Mage::registry('menumanager_menu');

        /* @var $model Scandi_MenuManager_Model_Item*/
        $ItemModel = Mage::getModel('scandi_menumanager/item');

        $this->addColumn('item_title', array(
            'header'    => Mage::helper('scandi_menumanager')->__('Title'),
            'index'     => 'title',
        ));

        $this->addColumn('item_parent_id', array(
            'header'    => Mage::helper('scandi_menumanager')->__('Parent'),
            'index'     => 'parent_id',
            'type'      => 'options',
            'renderer'  => 'Scandi_MenuManager_Block_Adminhtml_Menu_Edit_Tab_Renderer_Parent',
            'options'   => $ItemModel->getCollection()
                ->addMenuFilter($menuModel)
                ->toItemOptionArray(),
        ));

        $this->addColumn('item_url', array(
            'header'    => Mage::helper('scandi_menumanager')->__('Url'),
            'index'     => 'url',
        ));

        $this->addColumn('cms_page_identifier', array(
            'header'    => Mage::helper('scandi_menumanager')->__('CMS page ID'),
            'index'     => 'cms_page_identifier',
        ));

        $this->addColumn('item_type', array(
            'header'    => Mage::helper('scandi_menumanager')->__('Type'),
            'index'     => 'type',
            'type'      => 'options',
            'options'   => $ItemModel->getAvailableTypes(),
        ));

        $this->addColumn('url_type', array(
            'header'    => Mage::helper('scandi_menumanager')->__('Url Type'),
            'index'     => 'url_type',
            'type'      => 'options',
            'options'   => array(
                1 => Mage::helper('scandi_menumanager')->__('URL'),
                2 => Mage::helper('scandi_menumanager')->__('CMS page')
            ),
        ));

        $this->addColumn('item_css_class', array(
            'header'    => Mage::helper('scandi_menumanager')->__('CSS Class'),
            'index'     => 'css_class',
        ));

        $this->addColumn('item_position', array(
            'header'    => Mage::helper('scandi_menumanager')->__('Position'),
            'index'     => 'position',
        ));

        $this->addColumn('item_is_active', array(
            'header'    => Mage::helper('scandi_menumanager')->__('Status'),
            'index'     => 'is_active',
            'type'      => 'options',
            'options'   => array(
                0 => Mage::helper('scandi_menumanager')->__('Disabled'),
                1 => Mage::helper('scandi_menumanager')->__('Enabled')
            ),
        ));

        $this->addColumn('position_path', array(
            'header'            => Mage::helper('scandi_menumanager')->__('Position Path'),
            'index'             => 'position_path',
            'column_css_class'  => 'no-display',
            'header_css_class'  => 'no-display'
        ));

        return parent::_prepareColumns();
    }

    /**
     * Return row url
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit_item', array(
            'item_id' => $row->getId(),
            'active_tab' => 'menu_page_tabs_items_section',
            'menu_id' => $this->getRequest()->getParam('menu_id'),
        ));
    }
}