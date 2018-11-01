@extends('layouts.master')

@section('content')
    <article class="container">
        <div class="row bs-podlozhka">
            <div class="col-sm-2 bs-links">
                @include('partials.menu')
            </div>
            <div class="bs-inner-news">
                <div class="col-sm-8">
                    <div class="bs-basket">
                        <ul class="breadcrumb">
                            <li><a href="{{ route('homepage') }}">Главная</a></li>
                            <li><a href="{{ route('news') }}">Новости</a></li>
                            <li> {{ $post->title }}</li>
                        </ul>
                    </div>
                    <div class="bs-inner-news__desc">
                      <h4 class="bs-deliver__head bs-deliver__head--head">Новости</h4>
                      <div >
                          <img src="{{ asset($post->image) }}" alt="news">
                          <p class="bs-news__date">{{ $post->date }}</p>
                          <h4 class="bs-deliver__head">{{ $post->title }}</h4>
                          <div class="bs-inner-news__text">
                              {!! $post->content !!}
                          </div>

                      </div>
                    </div>
                    <div class="bs-inner-news__mob">
                       <h4 class="bs-deliver__head"><a href="">{{ $post->title }}</a></h4>
                       <p class="bs-news__date">{{ $post->date }}</p>
                       <img src="{{ asset($post->image) }}" alt="news">
                       <div class="bs-inner-news__text">
                            {!! $post->content !!}
                        </div>
                    </div>
                </div>
               
                <div class="col-sm-3">
                    <h4 class="bs-deliver__head">Читайте также</h4>
                    <div class="row">
                        <img src="images/news1.png" alt="news">
                        <p class="bs-news__date">20.06.2018</p>
                        <a href="" class="bs-news__link">Акция! Пол + плинтус</a>
                    </div>
                    <div class="row">
                        <img src="images/news1.png" alt="news">
                        <p class="bs-news__date">20.06.2018</p>
                        <a href="" class="bs-news__link">Акция! Пол + плинтус</a>
                    </div>
                    <div class="row">
                        <img src="images/news1.png" alt="news">
                        <p class="bs-news__date">20.06.2018</p>
                        <a href="" class="bs-news__link">Акция! Пол + плинтус</a>
                    </div>
                    <a href="news.html" class="bs-inner-news__link">Все новости </a>
                    <span class="bs-inner-news__arrow"></span>
                </div>
            </div>
        </div>
    </article>
@endsection
