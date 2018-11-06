@extends('layouts.master')


@section('content')
<article class="container">
        <div class="row bs-podlozhka">
          <div class="col-sm-2 bs-links">
                @include('partials.menu')
          </div>
          <div class="col-sm-9 bs-advice">
            <div class="bs-basket">
              <ul class="breadcrumb">
                
                        <li><a href="{{ route('homepage') }}">Главная</a></li>
                
                <li> <a href="{{ route('advices') }}">Советы</a></li>
              </ul>
            </div>
            <h4 class="bs-deliver__head">Советы</h4>
            <img src="{{ (isset($advice->image)) ? asset('uploads/' . $advice->image) : '/images/not-found.png' }}" alt="{{ $advice->title }}" class="bs-advice__img">
            <h1 class="bs-advice__title bs-advice__title--inner">{{ $advice->title }}</h1>
            <div class="back-advice back-advice--inner">
                {!! $advice->content !!}
            </div>
          </div>
        </div>
      </article>
      
@endsection
