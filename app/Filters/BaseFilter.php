<?php

namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;


abstract class BaseFilter
{
    protected $request;
    protected $builder;


    /**
     * Filter constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param Builder $builder
     */
    public function apply(Builder $builder)
    {
        // dd($this->filters());
        $this->builder = $builder;

        
        foreach($this->filters() as $filter => $value) {
            if($filter != "page") {
                if(method_exists($this, $filter)) {
                    $this->$filter($value);
                } else {
                    $this->defaultFilter($value);
                }
            }
        }
    }

    public function filters()
    {
        
        return $this->request->all();
    }
}