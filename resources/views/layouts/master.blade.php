<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    {!! SEO::generate() !!}
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="author" content="BrandStudio.kz">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/back.css') }}">
    <meta name="_token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <style>
        .bs-footer__send img {
            margin-top: 0px;
        }
        .search-autocomplete {
            position: relative;
            z-index: 100;
            background: #fff;
            top: 0;
            left: 5px;
            border-radius: 0 0 .3125rem .3125rem;
            box-shadow: 0 0 5px 0 rgba(0,0,0,.15);
        }
        .mainpage-review-item-author.js-text-ellipsis, .search-autocomplete>.block-in {
             height: auto;
         }

        .nano {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        .nano>.nano-content {
            overflow: scroll;
            overflow-x: hidden;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            position: relative;
            max-height: 27rem;
        }
        .response-item {
            display: block;
        }
        .response-item {
            position: relative;
            border-bottom: 1px solid #e5e5e5;
            min-height: 7.1875rem;
            cursor: pointer;
        }
        .response-item-body {
            position: relative;
            padding: .9375rem 1.875rem .9375rem 7.5rem;
        }
        .response-item-img {
            position: absolute;
            left: 1rem;
            top: 1rem;
            width: 96px;
            height: 96px;
            line-height: 4.625rem;
            overflow: hidden;
            text-align: center;
        }
        .response-item-title {
            font-size: 12px;
            line-height: 1rem;
            margin-bottom: 5px;
        }
        .response-item-img img {
            display: inline-block;
            vertical-align: middle;
            max-height: 100%;
            max-width: 100%;
            line-height: 1;
        }
        .response-item-in {
            font-size: .8125rem;
            line-height: 1rem;
            color: #4c4c4c;
            margin-bottom: 5px;
        }
        .response-item-in dl {
            margin: 0;
            padding: 0;
        }
        .response-item-in dd {
             margin: 0;
             padding: 0;
         }
        .breadcrumbs ul, .js-text-ellipsis, .ratio, .text-ellipsis {
            overflow: hidden;
        }
        .response-item-price {
            font-size: 1.0625rem;
            line-height: 1.25rem;
            color: #000;
        }


    </style>
</head>

<body>
<header id="bs-header" class="bs-header">
<!-- Adds the Main Nav partial -->
  <div class="bs-header__div"></div>
    <div class="container first">
        <div class="row">
        <div class="col-md-8">
            <nav class="bs-main-nav">
            <form class="bs-header__select">
                <label class="bs-header__city">Ваш город:</label>
                <div class="bs-header__selectIn">
                <select>
                    @foreach($cities as $city)
                        <option value="{{ $city->slug }}">{{$city->name}}</option>
                    @endforeach
                </select>
                </div>
            </form>
            <ul class="bs-main-nav__list">
                <li class="bs-main-nav__item ">
                <a href="{{ route('news') }}" class="bs-main-nav__link">Новости</a>
                </li>

                <li class="bs-main-nav__item ">
                <a href="{{ route('advices') }}" class="bs-main-nav__link">Советы</a>
                </li>
                <!-- <li class="bs-main-nav__item ">
                                <a href="contacts.html" class="bs-main-nav__link">Услуги</a>
                            </li> -->
                <li class="bs-main-nav__item ">
                <a href="/oplata-i-dostavka" class="bs-main-nav__link">Оплата и доставка</a>
                </li>
            </ul>
            </nav>
        </div>
        <div class="col-md-4 bs-header__col">

            <li class="bs-main-nav__item">
            <a href="tel:+7722331122" class="bs-main-nav__link">
                <img src="/images/phone.svg" alt="human" class="bs-header__phone"> +7 (722) 33-11-22</a>
            </li>

            <li class="bs-main-nav__item ">
              @if(Auth::check())
                      <a href="{{ route('getLogout') }}">Выйти</a>
                      <a href="{{ route('profile.index') }}">Профиль</a>
                  @else
              <button class="bs-header__signup">
                  <a class="bs-main-nav__link">
                    <img src="{{ asset('images/cab.svg') }}" alt="human" class="bs-header__human"> Личный кабинет
                  </a>
              </button>
              <button class="bs-header__login">
                <a class="bs-main-nav__link">Войти</a>
              </button>
              @endif
            </li>
        </div>
        </div>
    </div>
    <div id="sign" class="bs-header__modal">
        <!-- Modal content -->
        <div class="bs-header__modal-content row">
            <span class="x">&times;</span>
            <img src="{{ asset('images/logo.svg') }}" class="bs-header__modalLogo">
            <h4 class="bs-header__h4">Регистрация</h4>
            <hr class="bs-header__modalLine">
            <p class="bs-header__modal-info">Личный кабинет, дает возможность просматривать историю покупок, сохранять в избранные, выбранный товар</p>
            @if(count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif
            <form id="signup">
                {{ csrf_field() }}
                <input type="text" name="name" placeholder="Имя">
                <small class="signup-error signup-name-error"></small>
                <input type="text" name="surname" placeholder="Фамилия">
                <small class="signup-error signup-surname-error"></small>
                <input type="text" name="phone" placeholder="Номер телефона">
                <small class="signup-error signup-phone-error"></small>
                <input type="email" name="email" placeholder="E-mail">
                <small class="signup-error signup-email-error"></small>
                <input type="password" name="password" placeholder="Пароль">
                <small class="signup-error signup-password-error"></small>
                <input type="password" name="password_confirmation" placeholder="Подтвердите пароль">
                <small class="signup-error signup-password-confirm-error"></small>
                <button type="submit" class="form-btn">Зарегистрироваться</button>
                <p class="bs-header__modal-text">*Регистрация на сайте, не обязательна, но при оформлении заказа необходимо создать учетную запись</p>
            </form>
        </div>
    </div>
    <div id="login" class="bs-header__modal">
        <!-- Modal content -->
        <div class="bs-header__modal-content row">
        <span class="x">&times;</span>
        <img src="/images/logo.svg" class="bs-header__modalLogo">
        <h4 class="bs-header__h4">Вход</h4>
        <hr class="bs-header__modalLine">
        <form method="post" action="form.php">
            <label>
            <input type="email" required name="email" placeholder="E-mail">
            </label>
            <label>
            <input type="password" required name="password   " placeholder="Пароль">
            </label>
            <button type="submit">Войти</button>
        </form>
        </div>
    </div>
    <!-- <div id="modal" class="bs-basket__modal">
            <div class="bs-basket__modal-content bs-basket__modal-content--small">
                <span class="x">&times;</span>
                <p class="bs-top__p">Спасибо, Ваше сообщение отправлено!</p>
            </div>
        </div> -->
    <hr class="bs-line">
    <div class="container">
        <div class="row">
        <div class="col-md-2 mob_search">  
          <a href="{{ route('search') }}">
            <img src="{{ asset('images/search.svg') }}" alt="search">
            </a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('homepage') }}">
            <img src="{{ asset('images/logo.svg') }}" class="bs-header__logo">
            </a>
        </div>
        <div class="col-md-7">
        <form class="bs-header__form" action="{{ route('search') }}" method="GET">
            <div class="bs-header__cat">
                <select name="category">
                <option disabled>Выбор категории</option>
                @foreach($menus as $category)
                <option value={{ $category->id }}>{{ $category->name }}</option>
                @endforeach
                </select>
            </div>
            
            <div class="bs-header__search">
                <input type="search" name="search" placeholder="Я ищу...">
                
                <button>
                <img src="{{ asset('images/search.svg') }}" alt="search">
                </button>
            </div>
            </form>
        </div>
        <div class="col-md-3">
            <div class="row">
            <div class="col-sm-6">
            @if(Auth::check())
            <a href="{{ route('profile.wishlist') }}">
            @else
            <button class="bs-wishlist-register bs-header__signup">
            @endif
                <img src="/images/heart.svg" alt="heart" class="bs-header__img">
                <p class="bs-header__text">Избранное</p>
                <span class="badge">{{ Auth::check() ? Wishlist::count(Auth::user()->id) : '' }}</span>
            @if(Auth::check())
            </a>
            @else
            </button>
            @endif
            </div>
            <div class="col-sm-6">
                <a href="{{ route('cart') }}">
                <img src="/images/basket.svg" alt="basket" class="bs-header__img">
                <p class="bs-header__text">Корзина</p>
                <span class="badge">{{ Cart::count() > 0 ? Cart::count() : '' }}</span>
                </a>
            </div>
            </div>
        </div>
        </div>
    </div>
    <!-- <div class="bs-header__mob">
      <ul>
        <li>
          <a href="tel:+7722331122" class="bs-main-nav__link"> +7 (722) 33-11-22</a>
        </li>
        <li>
          <a class="bs-main-nav__link">
                <img src="{{ asset('images/cab.svg') }}" alt="human" class="bs-header__human"> Личный кабинет
                </a>
        </li>
      </ul>
    </div> -->
</header>
<article class="mob-header">
    <input id="mob-header__checkbox" type="checkbox" class="mob-header__checkbox">
    <label for="mob-header__checkbox" class="mob-header__label">
        <span class="mob-header__icon">&nbsp;</span>
    </label>
    <div class="mob-header__background">&nbsp;</div>
    <nav class="mob-header__nav">
      <h4 class="mob-header__heading">МЕНЮ</h4>
       <form class="bs-header__select">
          <label class="bs-header__city">Ваш город:</label>
          <div class="bs-header__selectIn">
          <select>
              @foreach($cities as $city)
                  <option value="{{ $city->slug }}">{{$city->name}}</option>
              @endforeach
          </select>
          </div>
      </form>
      <ul class="mob-header__list">
        <li class="mob-header__item mob-header__item--cat">
              <button>Каталог</button>
          </li>
          <li class="mob-header__item">
              <a class="mob-header__link" href="{{ route('news') }}">Новости</a>
          </li>
          <li class="mob-header__item">
              <a class="mob-header__link" href="{{ route('news') }}">Советы</a>
          </li>
          <li class="mob-header__item">
              <a class="mob-header__link" href="/oplata-i-dostavka">Оплата и доставка</a>
          </li>
        </ul>
      <div class="mob-bottom">
        <ul class="mob-header__list">
          <li class="mob-header__phone">
              <a class="mob-header__link" href="tel:+7722331122"><img src="/images/phone.svg" alt="phone" class="bs-header__phone">+7 (722) 33-11-22</a>
          </li>
          <li class="mob-header__sign">
              <a class="mob-header__link" href="{{ route('signin') }}"><img src="http://127.0.0.1:8000/images/cab.svg" alt="human" class="bs-header__human">Личный кабинет</a>
          </li>
        </ul>
      </div>
    </nav>
    <div id="mob-catalog" class="bs-header__modal">
        <!-- Modal content -->
      <div class="bs-header__modal-content row">
        <h4 class="cat-head"><img class="cat-head-close" src="/images/back.png">КАТАЛОГ</h4>
        <div>
          <p class="cat-link">Напольные покрытия TODO</p>
          <ul class="cat-list">
            <li> <a href="todo">Напольные покрытия</a></li>
            <li> <a href="todo">Напольные покрытия</a></li>
            <li> <a href="todo">Напольные покрытия</a></li>
          </ul>
        </div>
        <div>
          <p class="cat-link">Напольные покрытия</p>
          <ul class="cat-list">
            <li> <a href="todo">Напольные покрытия</a></li>
            <li> <a href="todo">Напольные покрытия</a></li>
            <li> <a href="todo">Напольные покрытия</a></li>
          </ul>
        </div>
      </div>
    </div>
</article>


<div id="app">
    <div id="bs-wrapper">
        @yield('home-menu-and-slider')
        @yield('content')
        @yield('home-footer')
    </div>
</div>


<!-- Adds the Footer partial -->
<footer id="bs-footer" class="bs-footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <a href="{{ route('homepage') }}">
                    <img src="{{ asset('images/logo.svg') }}" class="bs-footer__logo">
                </a>
                <p class="bs-footer__mob-p">Магазин строительных материалов</p>
            </div>
            <div class="col-sm-3 bs-footer__col">
                <h6 class="bs-footer__head">Компания <span><img src="{{ asset('images/foot.png') }}" alt="arrow"></span></h6>
                <ul class="bs-footer__list">
                    <li class="bs-footer__item"><a href="/o-kompanii" class="bs-footer__link">О Компании</a></li>
                    <li class="bs-footer__item"><a href="{{ route('news') }}" class="bs-footer__link">Новости</a></li>
                    <li class="bs-footer__item"><a href="{{ route('advices') }}" class="bs-footer__link">Советы</a></li>
                    <li class="bs-footer__item"><a href="" class="bs-footer__link">Вакансии</a></li>
                    <li class="bs-footer__item"><a href="" class="bs-footer__link">Контакты</a></li>
                    <!-- <li class="bs-footer__item"><a href="" class="bs-footer__link">Услуги</a></li> -->
                </ul>
            </div>
            <div class="col-sm-3 bs-footer__col">
                <h6 class="bs-footer__head">Интернет-магазин <span><img src="{{ asset('images/foot.png') }}" alt="arrow"></span></h6>
                <ul class="bs-footer__list">
                    <li class="bs-footer__item"><a href="/kak-zakazat" class="bs-footer__link">Как сделать заказ</a></li>
                    <li class="bs-footer__item"><a href="/oplata-i-dostavka" class="bs-footer__link">Оплата и доставка</a></li>
                    <li class="bs-footer__item"><a href="/faq" class="bs-footer__link">Вопросы и Ответы</a></li>
                    <li class="bs-footer__item"><a href="/vozvrat-tovara" class="bs-footer__link">Возврат товара</a></li>
                </ul>
            </div>
            <div class="col-sm-3 bs-footer__col">
                <h6 class="bs-footer__head bs-footer__head--last">Подписка на новости</h6>
                <div class="bs-footer__mob-div row">
                  <div class="col-xs-6">
                    <p class="bs-footer__gray">Адрес</p>
                    <p class="bs-footer__whiteMob">ТРЦ «Галерея» 1 этаж, 2 бутик</p>
                  </div>
                  <div class="col-xs-6">
                    <p class="bs-footer__gray">Телефон</p>
                    <a href="tel:+7722331122" class="bs-footer__whiteMob">+7 (722) 33-11-22</a>
                  </div>
                </div>
                <form class="bs-footer__form" method="POST" action="{{ route('subscribe') }}">
                    {{ csrf_field() }}
                    <p class="bs-footer__boldMob">Подпишитесь на наши новости</p>
                    <input type="email" name="email" placeholder="Ваш E-mail" required>
                    <button type="submit" class="bs-footer__send" href=""><img src="{{ asset('images/send.svg') }}" alt="send"></button>
                    <button type="submit" class="bs-footer__sendMob" href="">Отправить</button>
                </form>
                <button class="bs-footer__call">Заказать звонок</button>
                <div class="bs-footer__net">
                    <a href=""><img src="{{ asset('images/fb.svg') }}" alt="facebook"></a>
                    <a href=""><img src="{{ asset('images/insta.svg') }}" alt="insta"></a>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="form-spinner" style="display:none"> <!-- begin form-spinner -->
    <div class="form-spinner__inner">
        <div class="lds-css ng-scope">
            <div class="lds-spinner" style="100%;height:100%"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
            <style type="text/css">
                @keyframes lds-spinner
                {
                   0% {
                       opacity: 1;
                   }
                   100% {
                       opacity: 0;
                   }
                }
                @-webkit-keyframes lds-spinner {
                    0% {
                        opacity: 1;
                    }
                    100% {
                        opacity: 0;
                    }
                }
                .lds-spinner {
                    position: relative;
                }
                .lds-spinner div {
                    left: 94px;
                    top: 48px;
                    position: absolute;
                    -webkit-animation: lds-spinner linear 1s infinite;
                    animation: lds-spinner linear 1s infinite;
                    background: #121212;
                    width: 12px;
                    height: 24px;
                    border-radius: 40%;
                    -webkit-transform-origin: 6px 52px;
                    transform-origin: 6px 52px;
                }
                .lds-spinner div:nth-child(1) {
                    -webkit-transform: rotate(0deg);
                    transform: rotate(0deg);
                    -webkit-animation-delay: -0.916666666666667s;
                    animation-delay: -0.916666666666667s;
                }
                .lds-spinner div:nth-child(2) {
                    -webkit-transform: rotate(30deg);
                    transform: rotate(30deg);
                    -webkit-animation-delay: -0.833333333333333s;
                    animation-delay: -0.833333333333333s;
                }
                .lds-spinner div:nth-child(3) {
                    -webkit-transform: rotate(60deg);
                    transform: rotate(60deg);
                    -webkit-animation-delay: -0.75s;
                    animation-delay: -0.75s;
                }
                .lds-spinner div:nth-child(4) {
                    -webkit-transform: rotate(90deg);
                    transform: rotate(90deg);
                    -webkit-animation-delay: -0.666666666666667s;
                    animation-delay: -0.666666666666667s;
                }
                .lds-spinner div:nth-child(5) {
                    -webkit-transform: rotate(120deg);
                    transform: rotate(120deg);
                    -webkit-animation-delay: -0.583333333333333s;
                    animation-delay: -0.583333333333333s;
                }
                .lds-spinner div:nth-child(6) {
                    -webkit-transform: rotate(150deg);
                    transform: rotate(150deg);
                    -webkit-animation-delay: -0.5s;
                    animation-delay: -0.5s;
                }
                .lds-spinner div:nth-child(7) {
                    -webkit-transform: rotate(180deg);
                    transform: rotate(180deg);
                    -webkit-animation-delay: -0.416666666666667s;
                    animation-delay: -0.416666666666667s;
                }
                .lds-spinner div:nth-child(8) {
                    -webkit-transform: rotate(210deg);
                    transform: rotate(210deg);
                    -webkit-animation-delay: -0.333333333333333s;
                    animation-delay: -0.333333333333333s;
                }
                .lds-spinner div:nth-child(9) {
                    -webkit-transform: rotate(240deg);
                    transform: rotate(240deg);
                    -webkit-animation-delay: -0.25s;
                    animation-delay: -0.25s;
                }
                .lds-spinner div:nth-child(10) {
                    -webkit-transform: rotate(270deg);
                    transform: rotate(270deg);
                    -webkit-animation-delay: -0.166666666666667s;
                    animation-delay: -0.166666666666667s;
                }
                .lds-spinner div:nth-child(11) {
                    -webkit-transform: rotate(300deg);
                    transform: rotate(300deg);
                    -webkit-animation-delay: -0.083333333333333s;
                    animation-delay: -0.083333333333333s;
                }
                .lds-spinner div:nth-child(12) {
                    -webkit-transform: rotate(330deg);
                    transform: rotate(330deg);
                    -webkit-animation-delay: 0s;
                    animation-delay: 0s;
                }
                .lds-spinner {
                    width: 200px !important;
                    height: 200px !important;
                    -webkit-transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
                    transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
                }
            </style>
        </div>
    </div>
</div>
@yield('before_jquery')
<!--SCRIPTS    -->
<!-- <script src="{{ asset('js/app.js') }}"></script> -->
<script src="{{ asset('js/main.js') }}"></script>
@yield('after_jquery')
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}

@yield('after_js')
<script>
    $(function() {
        'use strict';
        $('#signup').on('submit', function(e) {
            e.preventDefault();
            var fd = new FormData( this );
            $.ajax({
                url: '{{ route('signup') }}',
                type: 'POST',
                contentType: false,
                processData: false,
                data: fd,
                beforeSend: function() {
                    $('.form-spinner').show();


                },
                error: function(xhr) {
                    var smalls = $("#signup small");
                    $.each(smalls, function(index, value) {
                        $( this ).text('');
                    });
                    var errors = JSON.parse(xhr.responseText).errors;
                    $.each(errors, function(index, value) {
                        var inputName = $('#signup input[name$="' + index + '"]');

                        if(index == inputName[0].name) {
                            $( "#signup .signup-"+ index +"-error" ).text( value );
                        }
                    });
                },
                success: function(msg) {
                    $('.form-btn').prop('disabled', true);
                    if(msg === 'ok') {
                        window.location.href = "{{ route('profile.index') }}";
                    }
                }
            });
        });
    });

</script>

<script>
    $('.bs-wishlist-register').click(function() {
        $('#sign').show();
    });
</script>


{{-- <script type="text/javascript">

    $('#search').on('keyup',function(){

        $value=$(this).val();

        $.ajax({

            type : 'get',

            url : '',

            data:{'search':$value},

            success:function(data){

                $('.nano-content').html(data);

            }

        });



    })

</script>

<script type="text/javascript">

    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

</script> --}}

</body>

</html>
