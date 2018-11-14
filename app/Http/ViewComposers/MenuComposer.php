<?php

namespace App\Http\ViewComposers;

use App\Models\Category;
use Illuminate\View\View;



class MenuComposer
{
    private $menu;

    public function __construct(Category $items)
    {
        $this->menu = $items;



    }
    public function compose(View $view)
    {
        $view->with('menus', $this->menu->getTree($this->menu->where('parent_id', null)->orderBy('lft')->get()));
    }
}