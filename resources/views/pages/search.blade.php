@extends('layouts.master')

@section('content')

    <article class="container bs-laminat">
        <div class="row" style="margin-bottom: 50px;">
            <div class="col-sm-2 bs-links">
                
                @include('partials.menu')
                
            </div>
            <div class="col-sm-9 bs-laminat__col">
                <div class="bs-basket">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('homepage') }}">Главная</a></li>
                        <li> Поиск </li>
                    </ul>
                </div>
                <div class="row bs-catalog__hits">
                    <div class="row">
                      <div class="bs-catalog--search">
                        <h5 class="bs-basket__heading"><span><a href="{{ route('homepage') }}"><img src="/images/back.png" alt="back"></a></span>ПОИСК</h5>
                        <form action="{{ route('search') }}" method="GET">
                          <input type="search" name="search">
                          <button>
                            <img src="{{ asset('images/smallSearch.png') }}" alt="search">
                          </button>
                        </form>
                      </div>
                        <!-- <h5 class="bs-laminat__head bs-laminat__head-search">Поиск по фразе "{{ $searchText }}"</h5> -->
                        {{-- <div class="bs-catalog__select">
                            <div class="bs-catalog__selectIn">
                                <select>
                                <option>Цены по возрастанию</option>
                                <option>Цены по убыванию</option>
                                <option>Рекомендованное</option>
                                <option>Популярное</option>
                                </select>
                            </div>
                        </div> --}}
                    </div>
                    @if(count($products) > 0)
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
                    @else
                    <h5>Ничего не найдено</h5>
                    @endif
                </div>
                {{ $products->appends(request()->all())->links('partials.pagination') }}
            </div>
        </div>
    </article>
@endsection
