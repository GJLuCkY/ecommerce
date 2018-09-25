<?php

namespace App\Http\ViewComposers;

use App\Models\MenuItem;
use Illuminate\View\View;



class MenuComposer
{
    private $menu;

    public function __construct(MenuItem $items)
    {
        $this->menu = $items;



    }
    public function compose(View $view)
    {
        $view->with('menus', $this->menu->orderBy('lft')->get());
    }
}