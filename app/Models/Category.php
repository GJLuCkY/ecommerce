<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Category extends Model
{
    use CrudTrait, Sluggable;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'categories';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['title', 'meta_description', 'slug', 'article', 'code', 'code_parent', 'parent', 'status',
                            'lft',
                            'depth',
                            'parent_id',
                            'rgt', 'custom_name'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */


    public static function getTree()
    {
        $menu = self::orderBy('lft')->get();
        if ($menu->count()) {
            foreach ($menu as $k => $menu_item) {
                $menu_item->children = collect([]);
                foreach ($menu as $i => $menu_subitem) {
                    if ($menu_subitem->parent_id == $menu_item->id) {
                        $menu_item->children->push($menu_subitem);
                        // remove the subitem for the first level
                        $menu = $menu->reject(function ($item) use ($menu_subitem) {
                            return $item->id == $menu_subitem->id;
                        });
                    }
                }
            }
        }
        return $menu;
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'slug_or_title',
            ],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function categories() {
        return $this->hasMany('App\Models\Category', 'parent_id');
    }

    public function products() {
        return $this->hasMany('App\Models\Product', 'category_id');
    }
    // public function filters() {
    //     return $this->hasMany('App\Models\Filter', 'category_id');
    // }

    public function filters()
    {
        return $this->belongsToMany('App\Models\Filter');
    }


    public function pivotCategories()
    {
        return $this->belongsToMany('App\Models\Category', 'category_cat', 'cat_id', 'category_id');
    }
    public function pivotCats()
    {
        return $this->belongsToMany('App\Models\Category', 'category_cat', 'category_id', 'cat_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */
    public function getSlugOrTitleAttribute()
    {
        if ($this->slug != '') {
            return $this->slug;
        }

        return $this->title;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
