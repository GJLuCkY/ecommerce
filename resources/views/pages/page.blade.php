@extends('layouts.master')

@section('content')
    <article class="container">
        <div class="row bs-podlozhka">
            <div class="col-sm-2 bs-links">
                @include('partials.menu')
            </div>
            <div class="col-sm-9 bs-about">
                <div class="bs-basket">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('homepage') }}">Главная</a></li>
                        <li> {{ $page->title }}</li>
                    </ul>
                </div>
                <h4 class="bs-deliver__head">{{ $page->title }}</h4>
                {!! $page->content !!}
            </div>
        </div>
    </article>
@endsection