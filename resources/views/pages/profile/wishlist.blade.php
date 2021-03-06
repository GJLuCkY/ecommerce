@extends('layouts.master')

@section('content')
<article class="container bs-profile">
    <div class="row">
        <div class="col-sm-2 bs-profile__links">
            @include('partials.profile-menu')
        </div>
        <div class="col-sm-10 col">
            <h4 class="bs-profile__head">Избранное</h4>
           
            @foreach($wishlist as $product)
            @if(isset($product->product))
            <div class="bs-profile__fav">
              <div class="row">
                <div class="col-sm-2">
                  <img src="{{ (isset($product->product->image) && strlen($product->product->image) > 1 && !empty($product->product->image))  ? asset('uploads/' . $product->product->image) : '/images/not-found.png' }}" class="">
                </div>
                <div class="bs-catalog__mob-buttons row">
                  <a href="{{ route('wishlist.remove', ['id' => $product->product->id]) }}" class="mob-wishlist like wish">
                    <img src="/images/ic_love.png" alt="favorite">
                  </a>
                  <a href="{{ route('wishlist', ['id' => $product->id]) }}" class="mob-wishlist cart rem">
                    <img src="/images/basket.svg" alt="favorite">
                  </a>
                </div>
                <div class="col-sm-9">
                <p class="bs-profile__fav-text">{{ $product->product->title }}</p>
                    @if($product->product->quantity > 0)
                    <p class="have">Товар в наличии</p>
                    @else
                    <p class="haveNot">Товара нет в наличии</p>
                    @endif
                    <p class="bs-profile__fav-cost">
                    <label>Цена:</label> {{ number_format($product->product->price, null, ',', ' ') }} ₸
                    </p>
                    <p class="bs-profile__fav-date">
                    <label>Добавлен:</label> {{ $product->created_at }}
                    </p>
                    <form action="{{ route('addToCart') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $product->product->id }}">
                            <button type="submit" class="bs-catalog__add">
                                <img src="/images/basket.svg" alt="basket" class="bs-catalog__basket">   
                                Добавить в корзину
                            </button>
                        </form>
                </div>
                <div class="col-sm-1">
                    <a href="{{ route('wishlist.remove', ['id' => $product->product->id]) }}" class="bs-profile__fav-delete">
                    <img src="/images/delete.svg" alt="x">
                    </a>
                </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</article>
@endsection
