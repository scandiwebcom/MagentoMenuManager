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

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->getConnection()
    ->addColumn(
        $installer->getTable('scandi_menumanager/menu_item'),
        'position_path',
        array(
            'type'      => Varien_Db_Ddl_Table::TYPE_TEXT,
            'length'    => 100,
            'nullable'  => false,
            'default'   => '0',
            'comment'   => 'Position Path'
        )
    );