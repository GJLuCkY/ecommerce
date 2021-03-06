@extends('layouts.master')

@section('content')
    <article class="container">
        <div class="row bs-order">
            <div class="col-sm-2 bs-links">
                @include('partials.menu')
            </div>
            <div class="col-sm-9 bs-order__col">
              <div class="bs-thanku">
                <div class="wrp">
                  <h3>{{ $order->name }}, спасибо за заказ!</h3>
                  <h6>Номер вашего заказа - {{ $order->id }}</h6>
                  <p>Ваш заказ находится в обработке. Мы свяжемся с вами в ближайшее время.</p>
                  <p>Если вы пропустили звонок, просто перезвоните нам по телефону <a href="tel: {{ Config::get('settings.phone') }}">{{ Config::get('settings.phone') }}</a></p>
                  <p>Детали заказа отправлены на указанную вами <span>электронную почту</span>.</p>
                    <p>{{ Config::get('settings.order_page') }}</p>
                  <a href="{{ route('homepage') }}" class="bs-emptyBasket__link">Продолжить покупки</a>
                </div>
              </div>
            </div>
        </div>
    </article>
@endsection
