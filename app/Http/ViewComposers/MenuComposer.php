<?php

namespace App\Http\ViewComposers;

use App\Models\ProductCategory;
use Illuminate\View\View;



class MenuComposer
{
    private $menu;

    public function __construct(ProductCategory $items)
    {
        $this->menu = $items;



    }
    public function compose(View $view)
    {
        $view->with('menus', $this->menu->getTree($this->menu->where('parent_id', null)->orderBy('lft')->get()));
    }
}