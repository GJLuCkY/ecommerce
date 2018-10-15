@extends('layouts.master')

@section('content')
<article class="container">
        <div class="bs-vacancy">
          <div class="row">
            <div class="col-sm-2 bs-links">
                    @include('partials.menu')
            </div>
            <div class="col-sm-7 bs-advice">
              <div class="bs-basket">
                <ul class="breadcrumb">
                  <li>
                    <a href="{{ route('homepage') }}">Главная</a>
                  </li>
                  <li>  <a href="/vacancy">Вакансии</a></li>
                </ul>
              </div>
              <h4 class="bs-deliver__head">Вакансии</h4>
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
              <h5>Вакансии нет</h5>
            </div>
            <div class="col-sm-3 bs-vacancy__col">
              <div class="bs-catalog__select">
                <div class="bs-catalog__selectIn">
                  <select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                    <option disabled selected>Выберите город</option>
                    @foreach($vacancyCities as $item)  
                        <option value="{{ route('vacancy.city', ['citySlug' => $item->slug]) }}">{{ $item->title }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              {{-- <div class="bs-vacancy__links">
                <ul>
                  <li>
                    <a data-href="" class="active">Финансист-технолог</a>
                  </li>
                  <li>
                    <a data-href="">Менеджер по продажам
                    </a>
                  </li>
                  <li>
                    <a data-href="">Программист</a>
                  </li>
                  <li>
                    <a data-href="">Повар</a>
                  </li>
                </ul>
              </div> --}}
            </div>
          </div>
        </div>
      </article>
@endsection