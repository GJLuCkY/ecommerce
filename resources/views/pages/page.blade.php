@extends('layouts.master')

@section('content')
    <article class="container">
        <div class="row {{ ($page->template == 'vacancy') ? 'bs-vacancy' : 'bs-podlozhka' }}">
            <div class="col-sm-2 bs-links">
                @include('partials.menu')
            </div>
            @if($page->template == 'vacancy')
            
            <div class="col-sm-7 bs-advice">
            @else 
            <div class="col-sm-9 bs-about">
            @endif    
                <div class="bs-basket">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('homepage') }}">Главная</a></li>
                        <li> {{ $page->title }}</li>
                    </ul>
                </div>
                <h4 class="bs-deliver__head">{{ $page->title }}</h4>
                @if($page->template == 'vacancy')
                <div class="bs-brands__slider">
                        <div class="slider slide-for">
                          <div>
                            <img src="images/innerBrN.png" alt="brand">
                          </div>
                          <div>
                            <img src="images/innerBrN.png" alt="brand">
                          </div>
                          <div>
                            <img src="images/innerBrN.png" alt="brand">
                          </div>
                          <div>
                            <img src="images/innerBrN.png" alt="brand">
                          </div>
                          <div>
                            <img src="images/innerBrN.png" alt="brand">
                          </div>
                        </div>
                        <div class="bs-brands__nav">
                          <div class="slider slide-nav">
                            <div class="bs-brands__inner">
                              <img src="images/innerBrN.png" alt="brand">
                            </div>
                            <div class="bs-brands__inner">
                              <img src="images/innerBrN.png" alt="brand">
                            </div>
                            <div class="bs-brands__inner">
                              <img src="images/innerBrN.png" alt="brand">
                            </div>
                            <div class="bs-brands__inner">
                              <img src="images/innerBrN.png" alt="brand">
                            </div>
                            <div class="bs-brands__inner">
                              <img src="images/innerBrN.png" alt="brand">
                            </div>
                          </div>
                        </div>
                      </div>
                {{-- <h6 class="bs-vacancy__head">Присоединись к лучшей команде!</h6> --}}
                @endif
                {!! $page->content !!}
            </div>
            @if($page->template == 'vacancy')
            <div class="col-sm-3 bs-vacancy__col">
                    <div class="bs-catalog__select">
                      <div class="bs-catalog__selectIn">
                        <select onchange="this.options[this.selectedIndex].value &amp;&amp; (window.location = this.options[this.selectedIndex].value);">
                          <option disabled="" selected="">Выберите город</option>
                          @foreach($vacancyCities as $city)
                          
                          <option value="{{ route('vacancy.city', ['citySlug' => $city->slug]) }}">{{ $city->title }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
            @endif
        </div>
    </article>
@endsection