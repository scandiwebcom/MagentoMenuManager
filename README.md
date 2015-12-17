Scandi_MenuManager
===================
> As a site visitor you will get convenient navigation. There can be different navigation blocks on the site, if
necessary. As a store owner, you are able to create unlimited number of navigation blocks per web site or store, add
menu items, set URLs for them, enable/disable, set CSS class, set order of display. As a developer you will get easy to
customize module, it does not have pre-defined strict front end design, so it is up to you how to render it, but you can
choose several layouts: horizontal, vertical, or plain output.

Video Overview
----------------------------
[http://www.screencast.com/t/XQaDKY1vAAuP](http://www.screencast.com/t/XQaDKY1vAAuP)

Installation
------------
* For manual installation copy all folders to project root.
* Clear cache and extension should be installed.

Testing installation success
----------------------------
* After installation extension is available in Admin -> CMS -> Menus, where you can add Menus, and once added, create
menu items and set their hierarchy e.g. root level, or 2nd-3rd-4th-... level sub-menu item, where root level means menu
item is show on top level.
* As developer you can add menu via XML, directly in template or in CMS using Magento short-code - see examples below.

Depends
----------------------------
*   Mage_Cms
*   Mage_Adminhtml


Developer Notes
----------------------------
How-to add menu to the Magento store:

> * Add within layout files (f.e. theme local.xml):

    <block type="scandi_menumanager/menu" name="menu_name">
        <action method="setMenuId">
            <menu_id>menu_identifier</menu_id>
        </action>
    </block>

> * Add menu using Magento shortcode (f.e. within CMS block):

    {{block type="scandi_menumanager/menu" name="menu_name" menu_id="menu_identifier"}}

> * Add menu directly into template:

    <?php echo $this->getLayout()->createBlock('scandi_menumanager/menu')->setMenuId('menu_identifier')->toHtml(); ?>

> * Add same menu multiple times having different output type:

    <!-- Menu 1 displayed in header as horizontal menu -->
    <reference name="header">
        <block type="scandi_menumanager/menu" name="menu_header">
            <action method="setMenuId">
                <menu_id>menu_identifier</menu_id>
            </action>
        </block>
    </reference>

    <!-- We use same menu but will show as vertical type -->
    <reference name="right">
        <block type="scandi_menumanager/menu" name="menu_right">
            <action method="setMenuId">
                <menu_id>menu_identifier</menu_id>
            </action>

            <!-- Set new type like this -->
            <action method="setCustomType">
                <custom_type>vertical</custom_type>
            </action>
        </block>
    </reference>

> * Create menu and menu items using Magento models (useful for data migration):

    <?php
        //Create Menu
        $menu = Mage::getModel('scandi_menumanager/menu')->load('menu_identifier')
            ->setIdentifier('menu_identifier')
            ->setTitle('Menu Title')            //menu title
            ->setStores(array(0))               //array of store ids - 0 for all stores
            ->setType('none')                   //none, vertical or horizontal - 'none' used by default
            ->setCssClass('menu-class')         //ignore this line if you do not need to add css classes
            ->setIsActive('1')                  //menu will be active by default, add this line if you want it disabled
            ->save();

        //Add Menu Item
        Mage::getModel('scandi_menumanager/item')->load('item_identifier')
            ->setIdentifier('item_identifier')  //items are identified by identifiers, attribute is not visible in admin
            ->setMenuId($menu->getId())         //set previously created menu as item's parent, we need to know the id
            ->setParentId('0')                  //set item's parent item, 0 stands for root level, 0 used by default
            ->setTitle('Item Title')
            ->setUrl('/')                       //item's url, ignore for item w/o url, add '/' for base url item.
            ->setType('same_window')            //link type - same_window or new_window, default same_window
            ->setCssClass('item-class')         //ignore this line if you do not need to add css classes
            ->setPosition('0')                  //item's position depending of its parent, 0 default
            ->setIsActive(1)                    //menu item will be active by default
            ->save();
    ?>