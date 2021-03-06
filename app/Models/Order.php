<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Order extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'orders';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['user_id', 'phone', 'name', 'city', 'address', 'email', 'comment', 'method', 'status', 'products', 'delivery_method', 'user_type', 'iin_bin', 'total_price', 'reference'];
    // protected $hidden = [];
    // protected $dates = [];
    protected $casts = [
        'products' => 'object'
    ];
    protected $date = [
        'created_at',
        'updated_at'
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
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
    public function getUpdatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->toDateTimeString();
    }

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->toDateTimeString();
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
