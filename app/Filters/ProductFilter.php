<?php

namespace App\Filters;


class ProductFilter extends BaseFilter
{
    public function price($value)
    {
        $priceFilterValues = explode('-', $value);
        return $this->builder->whereBetween('price', [$priceFilterValues[0], $priceFilterValues[1]]);
    }

    public function defaultFilter($value)
    {
        $filterValues = explode(',', $value);

        return $this->builder->whereHas('values', function ($q) use ($filterValues) {
            $q->whereIn('slug', $filterValues);
        });
    }

    public function page($value)
    {
        
    }

    public function sort($value)
    {
        if($value == 'rating') {
            return $this->builder->orderByViewsCount();
        } else if($value == 'asc') {
            return $this->builder->orderBy('price');
        } else if($value == 'desc') {
            return $this->builder->orderByDesc('price');
        }
    }
}