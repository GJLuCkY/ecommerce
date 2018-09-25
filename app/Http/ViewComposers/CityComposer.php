<?php

namespace App\Http\ViewComposers;

use App\Models\City;
use Illuminate\View\View;

class CityComposer
{
    private $city;

    public function __construct(City $items)
    {
        $this->city = $items;



    }
    public function compose(View $view)
    {
        $view->with('cities', $this->city->where('status', 1)->select('id', 'name', 'slug')->get());

        //$view->with('pagemenus', $this->menu->getTree($this->menu->where('type', 'page_link')->where('parent_id', null)->orderBy('lft')->get()));

        //$menus = MenuItem::getTree();
    }
}