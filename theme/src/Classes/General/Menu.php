<?php
namespace Classes\General;
use Classes\General\MenuItem;

class Menu
{

    private $menuItems;

    public function __construct($name) {
        $this->setMenuItems($name);
        return $this->menuItems;
    }
    public function setMenuItems($name){
        $items = wp_get_nav_menu_items($name);
        foreach ($items as $item) {
            $this->menuItems[] = new MenuItem($item);
        }
    }
}