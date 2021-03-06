@extends('layouts.master')

@section('content')
<article class="container bs-profile">
    <div class="row">
        <div class="col-sm-2 bs-profile__links">
            @include('partials.profile-menu')
        </div>
        <div class="col-sm-10 col">
            <h4 class="bs-profile__head">Помощь</h4>
            <div class="bs-profile__help">
                <div class="row">
                <div class="col-sm-4">
                    <h6 class="bs-profile__help-head">Интернет-магазин</h6>
                    <hr class="bs-profile__help-line">
                    <ul class="bs-profile__help-list">
                    <li>
                        <a href="/kak-zakazat" class="bs-profile__help-link">Как сделать заказ</a>
                    </li>
                    <li>
                        <a href="/oplata-i-dostavka" class="bs-profile__help-link">Оплата и доставка</a>
                    </li>
                    <li>
                        <a href="/faq" class="bs-profile__help-link">Вопросы и ответы</a>
                    </li>
                    <li>
                        <a href="/vozvrat-tovara" class="bs-profile__help-link">Возврат товара</a>
                    </li>
                    </ul>
                </div>
                <div class="col-sm-4">
                    <h6 class="bs-profile__help-head">Компания</h6>
                    <hr class="bs-profile__help-line">
                    <ul class="bs-profile__help-list">
                    <li>
                        <a href="/o-kompanii" class="bs-profile__help-link">О компании</a>
                    </li>
                    <li>
                        <a href="{{ route('news') }}" class="bs-profile__help-link">Новости</a>
                    </li>
                    <li>
                        <a href="{{ route('advices') }}" class="bs-profile__help-link">Советы</a>
                    </li>
                    <li>
                        <a href="/vacancy" class="bs-profile__help-link">Вакансии</a>
                    </li>
                    <li>
                        <a href="/contacts-2" class="bs-profile__help-link">Контакты</a>
                    </li>
                    </ul>
                </div>
                </div>
                <div class="bs-profile__help-ask">
                  <h6 class="bs-profile__help-head">Задать вопрос</h6>
                  <hr class="bs-profile__help-line">
                  <p>У Вас есть вопросы? Задайте их нам и мы с радость ответим на них.</p>
                  <form>
                      <textarea class="bs-profile__help-area" placeholder="Напишите свой вопрос"></textarea>
                      <button type="submit" class="bs-profile__help-send">Отправить</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</article>
@endsection
