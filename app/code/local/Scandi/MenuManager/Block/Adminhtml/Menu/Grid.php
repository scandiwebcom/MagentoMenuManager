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
 * MenuManager menu grid
 *
 * @category    Scandi
 * @package     Scandi_MenuManager
 */
class Scandi_MenuManager_Block_Adminhtml_Menu_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();

        $this->setId('cmsMenuGrid');
        $this->setSaveParametersInSession(true);
    }

    /**
     * Prepare collection for grid
     *
     * @return Scandi_MenuManager_Block_Adminhtml_Menu_Grid
     */
    protected function _prepareCollection()
    {
        /* @var $collection Scandi_MenuManager_Model_Resource_Menu_Collection */
        $collection = Mage::getModel('scandi_menumanager/menu')
            ->getResourceCollection();

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * Prepare grid columns
     *
     * @return Scandi_MenuManager_Block_Adminhtml_Menu_Grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn('title', array(
            'header'    => Mage::helper('scandi_menumanager')->__('Title'),
            'index'     => 'title',
        ));

        $this->addColumn('identifier', array(
            'header'    => Mage::helper('scandi_menumanager')->__('Identifier'),
            'index'     => 'identifier',
        ));

        $this->addColumn('type', array(
            'header'    => Mage::helper('scandi_menumanager')->__('Type'),
            'index'     => 'type',
            'type'      => 'options',
            'options'   => Mage::getSingleton('scandi_menumanager/menu')->getAvailableTypes(),
        ));

        $this->addColumn('css_class', array(
            'header'    => Mage::helper('scandi_menumanager')->__('CSS Class'),
            'index'     => 'css_class',
        ));

        if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn('store_id', array(
                'header'        => Mage::helper('scandi_menumanager')->__('Store View'),
                'index'         => 'store_id',
                'type'          => 'store',
                'store_all'     => true,
                'store_view'    => true,
                'sortable'      => false,
                'filter_condition_callback' => array($this, '_filterStoreCondition'),
            ));
        }

        $this->addColumn('is_active', array(
            'header'    => Mage::helper('scandi_menumanager')->__('Status'),
            'index'     => 'is_active',
            'type'      => 'options',
            'options'   => array(
                0 => Mage::helper('scandi_menumanager')->__('Disabled'),
                1 => Mage::helper('scandi_menumanager')->__('Enabled')
            ),
        ));

        return parent::_prepareColumns();
    }

    /**
     * After collection load operations - load to add store data
     *
     * @return Mage_Adminhtml_Block_Widget_Grid | void
     */
    protected function _afterLoadCollection()
    {
        $this->getCollection()->walk('afterLoad');
        parent::_afterLoadCollection();
    }

    /**
     * Store filter condition callback - add store filter when needed
     *
     * @param $collection Scandi_MenuManager_Model_Resource_Menu_Collection
     * @param $column Mage_Adminhtml_Block_Widget_Grid_Column
     */
    protected function _filterStoreCondition($collection, $column)
    {
        if (!$value = $column->getFilter()->getValue()) {
            return;
        }

        $this->getCollection()->addStoreFilter($value);
    }

    /**
     * Return row url
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('menu_id' => $row->getId()));
    }
}