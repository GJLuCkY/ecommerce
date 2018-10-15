@extends('layouts.master')


@section('content')
<article class="container">
        <div class="row bs-podlozhka">
          <div class="col-sm-2 bs-links">
                @include('partials.menu')
            <div class="bs-advice__filter">
              <h6 class="bs-advice__head">По типу
              </h6>
              <div class="bs-advice__box">
                <label class="bs-advice__checkLabel">
                  <input type="checkbox" name="check"> Стройматериалы
                  <span class="checkmark"></span>
                </label>
                <label class="bs-advice__checkLabel">
                  <input type="checkbox" name="check"> Плитки
                  <span class="checkmark"></span>
                </label>
                <label class="bs-advice__checkLabel">
                  <input type="checkbox" name="check"> Двери
                  <span class="checkmark"></span>
                </label>
                <label class="bs-advice__checkLabel">
                  <input type="checkbox" name="check"> Плитки
                  <span class="checkmark"></span>
                </label>
              </div>
              <h6 class="bs-advice__head">По отделам
              </h6>
              <div class="bs-advice__box">
                <label class="bs-advice__checkLabel">
                  <input type="checkbox" name="check"> Стройматериалы
                  <span class="checkmark"></span>
                </label>
                <label class="bs-advice__checkLabel">
                  <input type="checkbox" name="check"> Плитки
                  <span class="checkmark"></span>
                </label>
                <label class="bs-advice__checkLabel">
                  <input type="checkbox" name="check"> Двери
                  <span class="checkmark"></span>
                </label>
                <label class="bs-advice__checkLabel">
                  <input type="checkbox" name="check"> Плитки
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
          </div>
          <div class="col-sm-7 bs-advice">
            <div class="bs-basket">
              <ul class="breadcrumb">
                    <li><a href="{{ route('homepage') }}">Главная</a></li>
                <li> Советы</li>
              </ul>
            </div>
            <h4 class="bs-deliver__head">Советы</h4>
            @foreach($advices as $advice)
            <div class="row">
              <div class="col-sm-4">
                    <img src="{{ (isset($advice->image)) ? asset('uploads/' . $advice->image) : '/images/not-found.png' }}" alt="{{ $advice->title }}">
              </div>
              <div class="col-sm-8">
                <h6 class="bs-advice__title">{{ $advice->title }}</h6>
                <p class="bs-advice__text">{{ $advice->desc }}</p>
                <a href="{{ route('advice', ['adviceSlug' => $advice->slug]) }}" class="bs-advice__link">Подробнее</a>
              </div>
            </div>
            @endforeach
            
          </div>
        </div>
      </article>
@endsection