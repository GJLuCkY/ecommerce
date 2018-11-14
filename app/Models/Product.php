<?php

namespace App\Models;

use App\Filters\ProductFilter;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Nicolaslopezj\Searchable\SearchableTrait;
use CyrildeWit\EloquentViewable\Viewable;



class Product extends Model
{
    use CrudTrait, Sluggable, SearchableTrait, Viewable;
   
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'products';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['title', 'meta_description', 'slug', 'image', 'content', 'price', 'article', 'code', 'quantity', 'api_id_product', 'api_id_category', 'status', 'custom_name', 'packaging', 'minimum'];
    // protected $hidden = [];
    // protected $dates = [];
    protected $appends = ['brand'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'slug_or_title',
            ],
        ];
    }


    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'products.title' => 8,
            'products.content' => 4,

        ],
//        'joins' => [
//            'posts' => ['users.id','posts.user_id'],
//        ],
    ];


    public static function boot()
    {
        parent::boot();
        static::deleting(function($obj) {
            \Storage::disk('uploads')->delete($obj->image);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
    public function values()
    {
        return $this->belongsToMany('App\Models\Value');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'produce_product', 'product_id', 'produce_id');
    }
    public function produces()
    {
        return $this->belongsToMany('App\Models\Product', 'produce_product', 'produce_id', 'product_id');
    }
 
    

    public function reviews() {
        return $this->hasMany('App\Models\Review', 'product_id');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order');
    }

    public function getCountActiveReviews() {

        $reviewCount = $this->reviews()->where('status', 1)->count();

        if($reviewCount > 0) {
            $starsSum = $this->reviews()->where('status', 1)->sum('stars');
            return $starsSum / $reviewCount;
        }
        
        return 0;
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopeFilter($query, ProductFilter $filters)
    {
        $filters->apply($query);
    }

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

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

    public function getName()
    {

        return $this->title;
    }

    public function getBrandAttribute()
    {
        $brand = $this->values()->where('filter_id', 1)->select('name')->first();

        return $brand;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function setImageAttribute($value)
    {
        $attribute_name = "image";
        $disk = "uploads";
        $destination_path = "product";

        // if the image was erased
        if ($value==null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (starts_with($value, 'data:image'))
        {
            // 0. Make the image
            $image = \Image::make($value);
            $image->resize(450, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            // 1. Generate a filename.
            $filename = md5($value.time()).'.png';
            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
            // 3. Save the path to the database
            $this->attributes[$attribute_name] = $destination_path.'/'.$filename;
        }
    }
}
