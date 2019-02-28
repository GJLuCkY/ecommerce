@extends('layouts.master')

@section('home-menu-and-slider')
    <article class="container">
        <div class="bs-top">
            <div class="row">
                <div class="col-sm-2 bs-links">
                    @include('partials.menu')
                </div>
                <div class="col-sm-10 bs-top__main">
                    <div class="one-time">
                        @foreach($sliders as $slider)
                        <a href="{{ $slider->url }}" class="bs-top__item">
                            <img src="{{ asset('uploads/' . $slider->image) }}" alt="newPic">
                            <div class="bs-top__item-text">
                                <h5>{{ $slider->title }}</h5>
                                {!! $slider->content !!}
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('content')
    <div class="bs-catalog">
        <a href="{{ route('brands') }}">
            <h5 class="bs-catalog__brandText">Бренды</h5>
        </a>
        <div class="brands">
            @if(isset($brand->values))
            @foreach($brand->values as $item)
            <div class="bs-catalog__brand">
                <a href="{{ route('brand', ['brandSlug' => $item->slug]) }}">
                    <img src="{{ isset($item->image) ? asset('uploads/' . $item->image) : '/images/not-found.png' }}" alt="{{$item->name}}">
                    <p>{{ $item->name }}</p>
                </a>
            </div>
            @endforeach
            @endif
            <a href="{{ route('brands') }}" class="brands__button">ВСЕ БРЕНДЫ</a>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <div class="row bs-catalog__hits">
                    <h5 class="bs-catalog__head">Хиты продаж</h5>
                    <div class="hits">
                        @foreach($bestsellers as $product)
                        <div class="bs-catalog__hit">
                            <div class="bs-catalog__hitImg">
                                <a href="{{ route('product', ['catSlug' => $product->category->slug, 'prodSlug' => $product->slug]) }}">
                                    <img class="prodImg" src="{{ (isset($product->image)) ? asset('uploads/' . $product->image) : '/images/not-found.png' }}" alt="{{ $product->title }}">
                                </a>
                                <a href="{{ route('wishlist', ['id' => $product->id]) }}" class="back-wishlist">
                                    <img src="/images/fav.svg" alt="favorite">
                                    <div class="bs-catalog__fav">
                                        Добавить в избранное
                                    </div>
                                </a>
                                <div class="bs-catalog__mob-buttons row">
                                  <a href="{{ route('wishlist', ['id' => $product->id]) }}" class="mob-wishlist">
                                    <img src="/images/heart.svg" alt="favorite">
                                  </a>
                                    <form action="{{ route('addToCart') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <button type="submit" class="mob-wishlist">
                                            <img src="/images/basket.svg" alt="favorite">
                                        </button>
                                    </form>
                                </div>
                                <div class="bs-catalog__hitText">
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="{{ $product->quantity }}">
                                    <p>{{ isset($product->category->custom_name) ? $product->category->custom_name : $product->category->title }} {{ isset($product->brand->name) ? $product->brand->name : '' }}
                                    <br> <a href="{{ route('product', ['catSlug' => $product->category->slug, 'prodSlug' => $product->slug]) }}">{{ $product->title }}</a>
                                    @if(isset($product->brand))
                                    {{ $product->brand->name }} </p>
                                    @endif
                                </div>
                            </div>
                            <p class="bs-catalog__size"><span>{{ number_format($product->price, null, ',', ' ') }}</span> ₸</p>
                            
                            <button type="button" class="bs-catalog__add">
                                <img src="/images/basket.svg" alt="basket" class="bs-catalog__basket">   
                                Добавить в корзину
                            </button>
                            <div class="bs-catalog__compare">
                                <ul>
                                    <star-rating :rating={{ $product->getCountActiveReviews() }} :read-only="true" :show-rating="false" :star-size="16" :round-start-rating="false"></star-rating>
                                    <li class="bs-catalog__cm">
                                        <a href="">Сравнить товар</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="row bs-catalog__news">
                    <h5 class="bs-catalog__head">Новинки</h5>
                    <div class="hits">
                        @foreach($latests as $product)
                        <div class="bs-catalog__hit">
                                <div class="bs-catalog__hitImg">
                                    <a href="{{ route('product', ['catSlug' => $product->category->slug, 'prodSlug' => $product->slug]) }}">
                                        <img class="prodImg" src="{{ (isset($product->image)) ? asset('uploads/' . $product->image) : '/images/not-found.png' }}" alt="{{ $product->title }}">
                                    </a>
                                    <a href="{{ route('wishlist', ['id' => $product->id]) }}" class="back-wishlist">
                                        <img src="/images/fav.svg" alt="favorite">
                                        <div class="bs-catalog__fav">
                                            Добавить в избранное
                                        </div>
                                    </a>
                                    <div class="bs-catalog__mob-buttons row">
                                      <a href="{{ route('wishlist', ['id' => $product->id]) }}" class="mob-wishlist">
                                        <img src="/images/heart.svg" alt="favorite">
                                      </a>
                                        <form action="{{ route('addToCart') }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                            <button type="submit" class="mob-wishlist">
                                                <img src="/images/basket.svg" alt="favorite">
                                            </button>
                                        </form>
                                    </div>
                                    <div class="bs-catalog__hitText">
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="{{ $product->quantity }}">
                                        <p>{{ isset($product->category->custom_name) ? $product->category->custom_name : $product->category->title }} {{ isset($product->brand->name) ? $product->brand->name : '' }}
                                        <br> <a href="{{ route('product', ['catSlug' => $product->category->slug, 'prodSlug' => $product->slug]) }}">{{ $product->title }}</a>
                                        @if(isset($product->brand))
                                        {{ $product->brand->name }} </p>
                                        @endif
                                    </div>
                                </div>
                                <p class="bs-catalog__size"><span>{{ number_format($product->price, null, ',', ' ') }}</span> ₸</p>
                                
                                <button type="button" class="bs-catalog__add">
                                    <img src="/images/basket.svg" alt="basket" class="bs-catalog__basket">   
                                    Добавить в корзину
                                </button>
                                <div class="bs-catalog__compare">
                                    <ul>
                                        <star-rating :rating={{ $product->getCountActiveReviews() }} :read-only="true" :show-rating="false" :star-size="16" :round-start-rating="false"></star-rating>
                                        <li class="bs-catalog__cm">
                                            <a href="">Сравнить товар</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
<<<<<<< HEAD
               @include('partials.product-modal')
=======
                <div class="addToCartModal" id="addToCartModal">
                  <div class="addToCartModal__content">
                    <span class="close">&times;</span>
                    <h3>Вы добавили в корзину</h3>
                    <form action="">
                      <div class="addToCartModal__row">
                        <img src="{{ (isset($product->image)) ? asset('uploads/' . $product->image) : '/images/not-found.png' }}" alt="{{ $product['title'] }}">
                        <p>{{ $product->title }}</p>
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
                    </form>  
                  </div>
                </div>
>>>>>>> 7d374dc01c87a146968f2407debdddd4bc13658c
            </div>
        </div>
    </div>
@endsection

@section('home-footer')
        <hr class="bs-line">
        <div class="container">
            <div class="bs-flat">
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <h5 class="bs-catalog__head">Собери свою квартиру</h5>
                        <ul class="bs-flat__list">
                            <li class="bs-flat__item active"><a href="" class="bs-flat__link">Kronotex</a></li>
                            <li class="bs-flat__item"><a href="" class="bs-flat__link">Kronostar</a></li>
                            <li class="bs-flat__item"><a href="" class="bs-flat__link">Falquon</a></li>
                            <li class="bs-flat__item"><a href="" class="bs-flat__link">Villeroy & Boch</a></li>
                            <li class="bs-flat__item"><a href="" class="bs-flat__link">Art Deko</a></li>
                            <li class="bs-flat__item"><a href="" class="bs-flat__link">Zadoor</a></li>
                        </ul>
                        <img src="/images/flat.png" alt="flat">
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection
