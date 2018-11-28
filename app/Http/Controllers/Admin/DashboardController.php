<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $this->data['title'] = trans('backpack::base.dashboard'); // set the page title
        $this->data['categories'] = Category::select('id', 'title')->whereNotNull('parent_id')->get();

        return view('backpack::dashboard', $this->data);
    }
}