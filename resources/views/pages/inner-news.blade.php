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
                    @foreach($news as $item)
                    <div class="row">
                        <img src="{{ asset($item->image) }}" alt="news">
                        <p class="bs-news__date">{{ $item->created_at }}</p>
                    <a href="{{ route('post', ['newSlug' => $item->slug]) }}" class="bs-news__link">{{ $item->title }}</a>
                    </div>
                    @endforeach
                    
                    <a href="{{route('news')}}" class="bs-inner-news__link">Все новости </a>
                    <span class="bs-inner-news__arrow"></span>
                </div>
            </div>
        </div>
    </article>
@endsection
