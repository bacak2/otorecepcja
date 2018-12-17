<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    /*
     *  set current active bookmark
     */
    function setActiveSubmenu($name){
        $this->activeSubmenu = $name;
    }

    /*
     *  set controller bookmark
     */
    function setMenuName($name){
        $this->menu = $name;
    }

    /*
     *  set available submenus
     *  where keys is route name and value- name with is displayed
     */
    function setSubmenuArray(Array $submenus){
        $this->submenu = $submenus;
    }
}
