@extends('layouts.master')

@section('content')
<article class="container">
        <div class="row">
          <div class="col-sm-2 bs-links">
            @include('partials.menu')
          </div>
          <div class="col-sm-8 bs-brands">
            <div class="bs-basket">
              <ul class="breadcrumb">
                <li>
                  <a href="{{ route('homepage') }}">Главная</a>
                </li>
                <li>
                  <a href="{{route('brands')}}">Бренды</a>
                </li>
            <li>{{ $brand->name }}</li>
              </ul>
            </div>
            <h4 class="bs-brands__head">Бренды</h4>
            <img class="bs-brands__logo" src="{{ (isset($brand->image)) ? asset('uploads/' . $brand->image) : '/images/not-found.png' }}" alt="{{ $brand->name }}">
      
            <div class="bs-brands__slider">
              <div class="slider slide-for">
                <div>
                  <img src="/images/innerBrN.png" alt="brand">
                </div>
                <div>
                  <img src="/images/innerBrN.png" alt="brand">
                </div>
                <div>
                  <img src="/images/innerBrN.png" alt="brand">
                </div>
                <div>
                  <img src="/images/innerBrN.png" alt="brand">
                </div>
                <div>
                  <img src="/images/innerBrN.png" alt="brand">
                </div>
              </div>
              <div class="bs-brands__nav">
                <div class="slider slide-nav">
                  <div class="bs-brands__inner">
                    <img src="/images/innerBrN.png" alt="brand">
                  </div>
                  <div class="bs-brands__inner">
                    <img src="/images/innerBrN.png" alt="brand">
                  </div>
                  <div class="bs-brands__inner">
                    <img src="/images/innerBrN.png" alt="brand">
                  </div>
                  <div class="bs-brands__inner">
                    <img src="/images/innerBrN.png" alt="brand">
                  </div>
                  <div class="bs-brands__inner">
                    <img src="/images/innerBrN.png" alt="brand">
                  </div>
                </div>
              </div>
            </div>
            <p class="bs-brands__info">Однополосная паркетная доска от Bauholz изготовлена в большом разнообразии цветовых решений, от ярких и насыщенных
              оттенков до естественных натуральных. Это позволяет подобрать паркет для самых различных интерьеров. Однополосный
              рисунок придает помещению роскошный вид, а выразительная текстура годовых колец подчеркивает природную красоту древесины.
              При производстве паркета Bauholz используется натуральная древесина хвойных и ценных пород. Трехслойная паркетная
              доска имеет склеенную структуру, с разнонаправленными слоями, что делает конструкцию более стабильной и предохраняет
              паркетные планки от деформаций, происходящих из-за атмосферных колебаний. Замковое соединение значительно упрощает
              и ускоряет укладку паркета, а так же предоставляет возможность производить демонтаж напольного покрытия. Поверхность
              паркетных планок надежно защищена 6-ю слоями полиуретанового УФ-лака.</p>
            @if(count($products) > 0)
              <div class="bs-catalog">
              <div class="row bs-catalog__hits">
                <h5 class="bs-catalog__head">Продукция {{ $brand->name }}</h5>
                <div class="hits">
                  @foreach($products as $product)
                  <div class="bs-catalog__hit">
                        <div class="bs-catalog__hitImg">
                            <a href="{{ route('product', ['catSlug' => $product->category->slug, 'prodSlug' => $product->slug]) }}">
                                <img src="{{ (isset($product->image)) ? asset('uploads/' . $product->image) : '/images/not-found.png' }}" alt="{{ $product->title }}">
                            </a>
                            <a href="{{ route('wishlist', ['id' => $product->id]) }}" class="back-wishlist">
                                <img src="/images/fav.svg" alt="favorite">
                            </a>
                            <div class="bs-catalog__hitText">
                                    <p>3-х слойная паркетная доска
                                    <br> <a href="{{ route('product', ['catSlug' => $product->category->slug, 'prodSlug' => $product->slug]) }}">{{ $product->title }}</a>
                                    @if(isset($product->brand))
                                    <br> {{ $product->brand->name }} </p>
                                    @endif
                            </div>
                        </div>
                        @php
                        $cartItems = session()->has('cart') ? session('cart')->items : [];
                        $inCart = array_key_exists($product->id, $cartItems);
                        @endphp
                        <p class="bs-catalog__size">10 000 кв.м</p>
                        <a href="{{ $inCart ? route('cart') : route('addToCart', ['id' => $product->id]) }}" class="bs-catalog__add">
                            <img src="/images/basket.svg" alt="basket" class="bs-catalog__basket">
                            @if($inCart)
                            В корзине
                            @else
                            Добавить в корзину
                            @endif
                        </a>
                        <div class="bs-catalog__compare">
                            <ul>
                            <star-rating :rating={{ $product->getCountActiveReviews() }} :read-only="true" :show-rating="false" :star-size="16" :round-start-rating="false"></star-rating>
                                <li class="bs-catalog__cm"><a href="">Сравнить товар</a></li>
                            </ul>
                        </div>
                    </div>
                  @endforeach
                 
                </div>
              </div>
            </div>
            @endif
          </div>
          <div class="col-sm-2 bs-brands__links">
            <ul class="bs-brands__list">
                @foreach($values as $item)
              <li>
              <a href="{{ route('brand', ['brandSlug' => $item->slug]) }}" class="bs-brands__link {{ $brand->id == $item->id ? 'bs-brands__link--active' : '' }}">{{ $item->name }}</a>
              </li>
              @endforeach
            </ul>
          </div>
      </article>
@endsection