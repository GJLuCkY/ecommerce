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
                    @foreach($products->chunk(4) as $chunk)
                    <div class="bs-laminat__hits row">
                        @foreach($chunk as $item)
                        <div class="col-sm-3 bs-catalog__hit">
                            <div class="bs-catalog__hitImg">
                                <a href="{{ route('product', ['catSlug' => $item->category->slug, 'prodSlug' => $item->slug]) }}">
                                    <img src="{{ (isset($item->image)) ? asset('uploads/' . $item->image) : '/images/not-found.png' }}" alt="{{ $item->title }}">
                                </a>
                                <a class="back-wishlist" href="{{ route('wishlist', ['id' => $item->id]) }}">
                                    <img src="{{ asset('images/fav.svg') }}" alt="favorite">
                                </a>
                                <div class="bs-catalog__mob-buttons row">
                                  <a href="{{ route('wishlist', ['id' => $item->id]) }}" class="mob-wishlist">
                                    <img src="/images/heart.svg" alt="favorite">
                                  </a>
                                  <a href="{{ route('wishlist', ['id' => $item->id]) }}" class="mob-wishlist">
                                    <img src="/images/basket.svg" alt="favorite">
                                  </a>
                                </div>
                                <div class="bs-catalog__hitText">
                                    <p>{{ isset($item->category->custom_name) ? $item->category->custom_name : $item->category->title }} {{ $item->brand->name }}</p>
                                    <a href="{{ route('product', ['catSlug' => $item->category->slug, 'prodSlug' => $item->slug]) }}">
                                        <h6>{{ $item->title }}</h6>
                                    </a>
                                </div>
                            </div>
                            
                            <p class="bs-catalog__size">{{ number_format($item->price, null, ',', ' ') }} ₸</p>
                            <form action="{{ route('addToCart') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <button type="button" class="bs-catalog__add">
                                    <img src="/images/basket.svg" alt="basket" class="bs-catalog__basket">   
                                    Добавить в корзину
                                </button>
                            </form>
                            
                            <div class="bs-catalog__compare">
                                <ul>
                                    <star-rating :rating={{ $item->getCountActiveReviews() }} :read-only="true" :show-rating="false" :star-size="16" :round-start-rating="false"></star-rating>
                                    <li class="bs-catalog__cm"><a href="">Сравнить товар</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="addToCartModal" id="addToCartModal">
                          <div class="addToCartModal__content">
                            <span class="close">&times;</span>
                            <h3>Вы добавили в корзину</h3>
                            <div class="addToCartModal__row">
                              <img src="{{ (isset($item->image)) ? asset('uploads/' . $item->image) : '/images/not-found.png' }}" alt="{{ $item['title'] }}">
                              <p>{{ $item->title }}</p>
                              <div class="addToCartModal__quan">
                                <button type="button" class="plus">+</button>
                                <input id="uintTextBox" type="text" value="1">
                                <button type="button" class="minus">-</button>
                              </div>
                              <div>
                                <span class="cost">5 418 тг / 1шт.</span>
                              </div>
                              <div class="addToCartModal__total">
                                <span>ИТОГОВАЯ СТОИМОСТЬ</span>
                                <h5>5 418 тг </h5>
                              </div>
                            </div>
                            <div class="addToCartModal__linkWrp">
                              <button type="submit">ПРОДОЛЖИТЬ ПОКУПКИ</button>
                              <a href="{{ route('checkout') }}"> Оформить заказ</a>
                            </div>
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
