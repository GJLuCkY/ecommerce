@extends('layouts.master')

@section('content')
<article class="container">
        <div class="row bs-podlozhka">
          <div class="col-sm-2 bs-links">
            @include('partials.menu')
          </div>
          <div class="col-sm-9 bs-brands">
            <div class="bs-basket">
              <ul class="breadcrumb">
                <li>
                  <a href="{{ route('homepage') }}">Главная</a>
                </li>
                <li> Бренды</li>
              </ul>
            </div>
            <h4 class="bs-brands__head">Бренды</h4>
            @foreach($values->chunk(4) as $items)
            <div class="row">
              @foreach($items as $item)
              <div class="col-sm-3">
                <a href="{{ route('brand', ['brandSlug' => $item->slug]) }}">
                    <img src="{{ (isset($item->image)) ? asset('uploads/' . $item->image) : '/images/not-found.png' }}" alt="{{ $item->title }}">
                    <p class="bs-brands__text">{{ $item->title }}</p>
                </a>
              </div>
              @endforeach
            </div>
            @endforeach
          </div>
        </div>
      </article>
@endsection