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
 * MenuManager menu edit page main tab
 *
 * @category    Scandi
 * @package     Scandi_MenuManager
 */
class Scandi_MenuManager_Block_Adminhtml_Menu_Edit_Tab_Main
    extends Mage_Adminhtml_Block_Widget_Form
        implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    protected function _prepareForm()
    {
        /* @var $model Scandi_MenuManager_Model_Menu */
        $model = Mage::registry('menumanager_menu');

        $form = new Varien_Data_Form();
        $form->setHtmlIdPrefix('menu_');

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend' => Mage::helper('scandi_menumanager')->__('General Information'))
        );

        if ($model->getMenuId()) {
            $fieldset->addField('menu_id', 'hidden', array(
                'name' => 'menu_id',
            ));
        }

        $fieldset->addField('title', 'text', array(
            'name'      => 'title',
            'label'     => Mage::helper('scandi_menumanager')->__('Title'),
            'title'     => Mage::helper('scandi_menumanager')->__('Title'),
            'required'  => true
        ));

        $fieldset->addField('identifier', 'text', array(
            'name'      => 'identifier',
            'label'     => Mage::helper('scandi_menumanager')->__('Identifier'),
            'title'     => Mage::helper('scandi_menumanager')->__('Identifier'),
            'required'  => true,
            'class'     => 'validate-xml-identifier',
            'note'      => Mage::helper('cms')->__('Must Be Unique Identifier Per Store View')
        ));

        $fieldset->addField('type', 'select', array(
            'name'      => 'type',
            'label'     => Mage::helper('scandi_menumanager')->__('Type'),
            'title'     => Mage::helper('scandi_menumanager')->__('Type'),
            'options'   => $model->getAvailableTypes(),
            'required'  => true
        ));

        $fieldset->addField('css_class', 'text', array(
            'name'      => 'css_class',
            'label'     => Mage::helper('scandi_menumanager')->__('CSS Class'),
            'title'     => Mage::helper('scandi_menumanager')->__('CSS Class'),
            'note'      => Mage::helper('cms')->__('Space Separated Class Names')
        ));

        if (!Mage::app()->isSingleStoreMode()) {
            $fieldset->addField('store_id', 'multiselect', array(
                'name'      => 'stores[]',
                'label'     => Mage::helper('scandi_menumanager')->__('Store View'),
                'title'     => Mage::helper('scandi_menumanager')->__('Store View'),
                'required'  => true,
                'values'    => Mage::getSingleton('adminhtml/system_store')
                    ->getStoreValuesForForm(false, true)
            ));
        } else {
            $fieldset->addField('store_id', 'hidden', array(
                'name'      => 'stores[]',
                'value'     => Mage::app()->getStore(true)->getId()
            ));

            $model->setStoreId(Mage::app()->getStore(true)->getId());
        }

        $fieldset->addField('is_active', 'select', array(
            'label'     => Mage::helper('scandi_menumanager')->__('Status'),
            'title'     => Mage::helper('scandi_menumanager')->__('Menu Status'),
            'name'      => 'is_active',
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('scandi_menumanager')->__('Enabled'),
                '0' => Mage::helper('scandi_menumanager')->__('Disabled'),
            ),
        ));

        if (!$model->getId()) {
            $model->setData('is_active', '1');
        }

        Mage::dispatchEvent(
            'adminhtml_cms_menu_edit_tab_main_prepare_form',
            array('form' => $form)
        );

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return Mage::helper('scandi_menumanager')->__('General Information');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return Mage::helper('scandi_menumanager')->__('General Information');
    }

    /**
     * Returns tab's status flag - can be shown or not
     *
     * @return boolean
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Returns tab's status flag - hidden or not
     *
     * @return boolean
     */
    public function isHidden()
    {
        return false;
    }
}
