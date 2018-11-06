@extends('layouts.master')

@section('content')
    <article class="container">
        <div class="row bs-order">
            <div class="col-sm-2 bs-links">
                @include('partials.menu')
            </div>
            <div class="col-sm-9 bs-order__col">
                <div class="bs-basket">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('homepage') }}">Главная</a></li>
                        <li>Оформление заказа</li>
                    </ul>
                </div>
                <h5 class="bs-basket__heading"><span><a href="{{ route('homepage') }}"><img src="/images/back.png" alt="back"></a></span>Оформление заказа</h5>
                @foreach($products as $product)
                <div class="row bs-basket__row">
                    <div class="col-sm-1 bs-basket__img">
                        <img src="{{ (isset($product['item']->image)) ? asset('uploads/' . $product['item']->image) : '/images/not-found.png' }}" class="bs-advice__img">
                    </div>
                    <div class="col-sm-6 bs-basket__bigCol">
                        <p class="bs-basket__about">{{ $product['item']->title }}
                            <br>3-х слойная паркетная доска
                            <br>KRONOTEX
                        </p>
                    </div>
                    <div class="col-sm-3 bs-basket__qual">
                        <h6 class="bs-basket__title">Количество</h6>
                        <div class="bs-basket__quality">
                            <p>{{ $product['qty'] }}</p>
                        </div>
                    </div>
                    <div class="col-sm-2 bs-basket__qual">
                        <h6 class="bs-basket__title">Стоимость</h6>
                        <p>{{ $product['item']->price }}</p>
                    </div>
                </div>
                @endforeach
                <form class="bs-order__form" action="{{ route('checkout-go') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ Auth::check() ? Auth::user()->id : 0 }}" name="user_id">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="bs-order__input">Имя
                                <input type="text" name="name" required>
                            </label>
                            
                            <div class="bs-order__check" style="margin-bottom: 40px">
                                <p style="margin-bottom: 15px">Способ доставки</p>
                                <label><input type="radio" name="delivery_method" value="dostavka" checked> Доставка
                                    <span class="checkmark"></span>
                                </label>
                                <label><input type="radio" name="delivery_method" value="samovyvoz"> Самовывоз
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                            <label class="bs-order__input">Адрес доставки
                                <input type="text" name="address">
                            </label>
                            
                            <div class="bs-order__select" style="margin: 15px 0 50px 0">
                                <div class="bs-order__selectIn">
                                    <select name="usertype">
                                        <option value="f">Физическое лицо</option>
                                        <option value="u">Юридическое лицо</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="bs-order__check">
                                <p>Способ оплаты </p>
                                <label><input type="radio" name="method" value="nal"> Наличными
                                    <span class="checkmark"></span>
                                </label>
                                <label><input type="radio" name="method" value="cart"> Оплата картой
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            
                        </div>
                        <div class="col-sm-6">
                            
                            <label class="bs-order__input">Телефон
                                <input type="text" name="phone" required>
                            </label>
                            <label class="bs-order__input">E-Mail
                                <input type="email" name="email" required>
                            </label>
                            <label class="bs-order__input">Комментарий
                                <textarea name="comment"></textarea>
                            </label>

                            

                            <div class="bs-order__box" style="    margin-bottom: 200px;">
                                <label class="bs-order__checkLabel">
                                    <input type="checkbox" name="check" checked=""> Подписаться на рассылку
                                    <span class="checkmark"></span>
                                </label>
                            </div>


                            <div class="bs-order__total">
                                <h6>ИТОГО <span class="bs-order__quan"> 2 </span> товара на сумму <span class="bs-order__sum"> {{ number_format($totalPrice, null, ' ', ' ') }} </span></h6>
                                {{-- <h4>К оплате: <span class="bs-order__pay"> 13 390</span></h4> --}}
                                <button type="submit">Оформить заказ</button>
                            </div>

                            
                        </div>
                    </div>
                </form>
                <form class="bs-order__form-mob" action="{{ route('checkout-go') }}" method="POST">
                    {{ csrf_field() }}
                   
                    <input type="hidden" value="{{ Auth::check() ? Auth::user()->id : 0 }}" name="user_id">
                    <div class="row">
                      <p class="bs-order__form-mob-text">Общая информация</p>
                      <label class="bs-order__input">Имя
                          <input type="text" name="name" required>
                      </label>
                      <label class="bs-order__input">Телефон
                          <input type="text" name="phone" required>
                      </label>
                      <label class="bs-order__input">E-Mail
                          <input type="email" name="email" required>
                      </label>
                      {{-- <div class="bs-order__select">
                            <input list="browsers" id="myBrowser" name="city" placeholder="Впишите свой город, или выберите из списка" required/>
                            <datalist id="browsers">
                                <option value="Алматы">
                                <option value="Шымкент">
                                <option value="Астана">
                                <option value="Караганда">
                                <option value="Кызылорда">
                                <option value="Актау">
                            </datalist>
                        </div> --}}
                        <div class="bs-order__select">
                          <div class="bs-order__selectIn">
                              <select name="usertype">
                                  <option value="f">Физическое лицо</option>
                                  <option value="u">Юридическое лицо</option>
                              </select>
                          </div>
                        </div>
                        <p class="bs-order__form-mob-text">Доставка</p>
                        <label class="bs-order__input">Адрес доставки
                            <input type="text" name="address">
                        </label>
                        <div class="bs-order__check">
                            <p class="bs-order__form-mob-text">Способ оплаты </p>
                            <label><input type="radio" name="radio"> Наличными
                                <span class="checkmark"></span>
                            </label>
                            <label><input type="radio" name="radio"> Оплата картой
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <p class="bs-order__form-mob-text">Комментарий</p>
                        <label class="bs-order__input">Комментарий
                            <textarea name="comment"></textarea>
                        </label>
                    </div>
                    <div class="bs-order__total">
                      <div class="row bs-basket__buttons-cost">
                        <p class="bs-basket__text bs-basket__text--total">ВЫБРАНО: <span class="count">{{count($products)}} товаров</span></p>
                        <p class="bs-basket__text bs-basket__text--total">ИТОГО: <span class="count">{{ number_format($totalPrice, null, ' ', ' ') }} тг</span></p>
                    </div>
                      <button type="submit">Оформить заказ</button>
                    </div>
                </form>
            </div>
        </div>
    </article>
@endsection
