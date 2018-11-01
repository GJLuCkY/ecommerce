@extends('layouts.master')

@section('content')
    <article class="container">
        <div class="row bs-podlozhka">
            <div class="col-sm-2 bs-links">
                @include('partials.menu')
            </div>
            <div class="col-sm-10 bs-news">
                <div class="bs-basket">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('homepage') }}">Главная</a></li>
                        <li> Новости</li>
                    </ul>
                </div>
                <h4 class="bs-deliver__head">Новости</h4>
                @foreach ($news->chunk(4) as $chunk)
                <div class="row">
                    @foreach($chunk as $item)
                    <div class="col-sm-3 bs-news__col">
                      <a href="{{ route('post', ['postSlug' => $item->slug]) }}">
                        <img src="{{ asset($item->image) }}" alt="news">
                        <p class="bs-news__date">{{ $item->date }}</p>
                        <a href="{{ route('post', ['postSlug' => $item->slug]) }}" class="bs-news__link">{{ $item->title }}</a>
                        <div class="bs-news__mob">
                          <h6 class="bs-news__mob-head">head</h6>
                          <p class="bs-news__mob-date">{{ $item->date }}</p>  
                          <div class="bs-news__mob-desc">
                            content
                        </div>
                        </div>
                      </a>
                    </div>
                    @endforeach
                </div>
                @endforeach
                {{--<div class="pagination">--}}
                    {{--<a href="#">1</a>--}}
                    {{--<a class="active" href="#">2</a>--}}
                    {{--<a href="#">3</a>--}}
                    {{--<a href="#">4</a>--}}
                    {{--<a href="#">5</a>--}}
                    {{--<a href="#">6</a>--}}
                {{--</div>--}}
                {{ $news->links() }}
            </div>
        </div>
    </article>
@endsection
