@extends('layouts.master')

@section('content')
    <article class="container bs-laminat">
        <div class="row">
            <div class="col-sm-2 bs-links">
                
                @include('partials.menu')
                <form>
                    {{-- @if(count($products) > 0) --}}
                    <div class="bs-laminat__brands">
                        <h6 class="bs-laminat__title">Цена
                            <span>
                            <img src="/images/laminat.svg">
                            </span>
                        </h6>
                    <price-slider price="{{ request('price') }}" :max-price="{{ $max }}" :min-price="{{ $min }}" cat-slug="{{ $category->slug }}"></price-slider>        
                    </div>
                    {{-- @endif --}}
                    @foreach($category->filters as $filters)
                    @if(count($filters->values) > 0)
                    <div class="bs-laminat__brands">
                        <h6 class="bs-laminat__title">{{ $filters->name }}
                            <span>
                                <img src="/images/laminat.svg">
                            </span>
                        </h6>
                        <div class="bs-order__box">
                            @foreach($filters->values as $value)
                            <label class="bs-order__checkLabel">
                                
                             @php
                                $currentFilterValue = request($filters->slug);
                                $customFilterValue = $currentFilterValue;
                                $req = request()->all();
                                $active = false;
                                if(isset($customFilterValue)) {
                                    $customFilterValue = explode(',', $customFilterValue);
                                    if(in_array($value->slug, $customFilterValue)) {
                                        $active = true;
                                        $filterValue = array_diff($customFilterValue, [$value->slug]);
                                    }  else {
                                        $active = false;
                                        $filterValue = array_merge($customFilterValue, [$value->slug]);
                                    }
                                } else {
                                    $filterValue = [$value->slug];
                                }

                                if(isset($customFilterValue) && count($customFilterValue) <= 1 && in_array($value->slug, $customFilterValue)) {
                                    $req[$filters->slug] = implode(',', $filterValue);
                                    unset($req[$filters->slug]);
                                    $routeParameters = array_merge(['catSlug' => $category->slug], $req);
                                    
                                } else {
                                    $req[$filters->slug] = implode(',', $filterValue);
                                    $routeParameters = array_merge(['catSlug' => $category->slug], $req);
                                }
                             @endphp

                                <a href="{{ route('category',  $routeParameters) }}">
                                    <input type="checkbox" name="check"> {{ $value->name }}
                                    <span class="checkmark">
                                    @if($active === true)
                                    <span class="check"></span>
                                    @endif
                                    </span>
                                </a>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @endforeach

                </form>
            </div>
            <div class="col-sm-9 bs-laminat__col">
                <div class="bs-basket">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('homepage') }}">Главная</a></li>
                        <li> {{ $category->title }} </li>
                    </ul>
                </div>
                <div class="row bs-catalog__hits">
                    <div class="row">
                        <h5 class="bs-laminat__head">{{ $category->title }}</h5>
                        <div class="bs-catalog__select">
                            <div class="bs-catalog__selectIn">
                                @php
                                    $requestSelect = request()->all();
                                    $routeParametersSelect = array_merge(['catSlug' => $category->slug], $requestSelect);
                                    // dd($routeParametersSelect);
                                @endphp    
                                <form action="{{ route('category', $routeParametersSelect) }}" method="GET" id="form-id">
                                    @foreach(request()->all() as $key=>$value)
                                        @if($key == 'sort')
                                        @else
                                        <input type="hidden" name="{{ $key }}" value="{{$value}}">
                                        @endif
                                    @endforeach
                                   
                                    <select name="sort" value="{{ request('sort') }}" onchange="document.getElementById('form-id').submit();" >
                                        @php
                                            $sort = [
                                                'asc' => 'Цены по возрастанию',
                                                'desc' => 'Цены по убыванию',
                                                // 'rec' => 'Рекомендованное',
                                                'rating' => 'Популярное'
                                            ];
                                        @endphp
                                        @foreach($sort as $key=>$item)
                                            <option {{ request('sort') == $key ? 'selected' : ''}} value="{{$key}}" >{{$item}}</option>
                                        @endforeach
                                        
                                    </select>   
                                </form>
                            </div>
                        </div>
                    </div>
                    @foreach($products->chunk(5) as $chunk)
                    <div class="bs-laminat__hits row">
                        @foreach($chunk as $item)
                        <div class="col-sm-3 bs-catalog__hit">
                            <div class="bs-catalog__hitImg">
                                <a href="{{ route('product', ['catSlug' => $item->category->slug, 'prodSlug' => $item->slug]) }}">
                                    <img src="{{ asset('uploads/' . $item->image) }}" alt="Дуб">
                                </a>
                                <a class="back-wishlist" href="{{ route('wishlist', ['id' => $item->id]) }}">
                                    <img src="{{ asset('images/fav.svg') }}" alt="favorite">
                                </a>
                                <div class="bs-catalog__hitText">
                                    <p>3-х слойная паркетная доска</p>
                                    <a href="{{ route('product', ['catSlug' => $item->category->slug, 'prodSlug' => $item->slug]) }}">
                                        <h6>{{ $item->title }}</h6>
                                    </a>
                                </div>
                            </div>
                            @php
                            $cartItems = session()->has('cart') ? session('cart')->items : [];
                            $inCart = array_key_exists($item->id, $cartItems);
                            @endphp
                            <p class="bs-catalog__size">10 000 кв.м</p>
                            <a href="{{ $inCart ? route('cart') : route('addToCart', ['id' => $item->id]) }}" class="bs-catalog__add">
                                <img src="/images/basket.svg" alt="basket" class="bs-catalog__basket">
                                @if($inCart)
                                В корзине
                                @else
                                Добавить в корзину
                                @endif</a>
                            <div class="bs-catalog__compare">
                                <ul>
                                    <star-rating :rating={{ $item->getCountActiveReviews() }} :read-only="true" :show-rating="false" :star-size="16" :round-start-rating="false"></star-rating>
                                    <li class="bs-catalog__cm"><a href="">Сравнить товар</a></li>
                                </ul>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
                {{ $products->appends(request()->all())->links('partials.pagination') }}
            </div>
        </div>
    </article>
@endsection