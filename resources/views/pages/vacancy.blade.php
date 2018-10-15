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
                  <li> Вакансии</li>
                </ul>
              </div>
              <h4 class="bs-deliver__head">{{ $vacancy->title }}</h4>
            
              <div class="bs-vacancy__prof" id="finance">
                <div class="bs-vacancy__title">
                  <h5 class="bs-vacancy__heading bs-vacancy__heading--white">{{ $vacancy->title }}</h5>
                <p class="bs-vacancy__city">{{ $city->title }}</p>
                </div>
                <div class="bs-vacancy__about">
                    @php
                        $requirements = json_decode($vacancy->requirements);
                    @endphp
                     @if(isset($requirements))
                  <h5 class="bs-vacancy__heading">Требование:</h5>
                  <ul class="bs-vacancy__list">
                      
                   
                    @foreach($requirements as $item)
                        @if(isset($item->name))
                        <li>{{$item->name}}</li>
                        @endif
                    @endforeach
                   
                  </ul>
                  @endif
                  @php
                        $duties = json_decode($vacancy->duties);
                    @endphp
                     @if(isset($duties))
                  <h5 class="bs-vacancy__heading">Обязанности:</h5>
                  <ul class="bs-vacancy__list">
                      
                   
                    @foreach($duties as $item)
                        @if(isset($item->name))
                        <li>{{$item->name}}</li>
                        @endif
                    @endforeach
                   
                  </ul>
                  @endif
                  @php
                        $conditions = json_decode($vacancy->conditions);
                    @endphp
                     @if(isset($conditions))
                  <h5 class="bs-vacancy__heading">Условия:</h5>
                  <ul class="bs-vacancy__list">
                      
                   
                    @foreach($conditions as $item)
                        @if(isset($item->name))
                        <li>{{$item->name}}</li>
                        @endif
                    @endforeach
                   
                  </ul>
                  @endif
                  @php
                        $personal = json_decode($vacancy->personal);
                    @endphp
                     @if(isset($personal))
                  <h5 class="bs-vacancy__heading">Личные качества:</h5>
                  <ul class="bs-vacancy__list">
                      
                   
                    @foreach($personal as $item)
                        @if(isset($item->name))
                        <li>{{$item->name}}</li>
                        @endif
                    @endforeach
                   
                  </ul>
                  @endif
                </div>
                <div class="bs-vacancy__send">
                @if(isset($vacancy->content))
                  <div class="bs-vacancy__text">
                      {!! $vacancy->content !!}
                  </div>
                @endif  
                  <form>
                    <div class="bs-vacancy__file">
                      <input type="file" name="myFile">
                      <button type="button">Выбрать файлы</button>
                      <span>Файл не выбран</span>
                    </div>
                    <label class="bs-vacancy__label">Сопроводительное письмо</label>
                    <textarea class="bs-vacancy__area"></textarea>
                    <input type="submit" class="bs-vacancy__submit">
                  </form>
                </div>
              </div>
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
              <div class="bs-vacancy__links">
                <ul>
                  @foreach($city->vacancies as $item)
                  <li>
                  <a href="{{ route('vacancy.id', ['citySlug' => $city->slug, 'vacancyId' => $item->id]) }}" class="{{ $item->id == $vacancy->id ? 'active' : '' }}">{{ $item->title }}</a>
                  </li>
                  @endforeach
                 
                </ul>
              </div>
            </div>
          </div>
        </div>
      </article>
@endsection