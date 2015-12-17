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
 * MenuManager widget
 *
 * @category    Scandi
 * @package     Scandi_MenuManager
 */
class Scandi_MenuManager_Block_Widget extends Mage_Core_Block_Template implements Mage_Widget_Block_Interface
{

    /**
     * Produces Scandi_menumanager menu
     *
     * @return string
     */
    protected function _toHtml()
    {
        $menu = $this->getData('widget_menu');
        return $this->getLayout()->createBlock('scandi_menumanager/menu')->setMenuId($menu)->toHtml();
    }
} 