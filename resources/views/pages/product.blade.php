@extends('layouts.master')

@section('content')
    <article class="container">
        <div class="row bs-podlozhka">
            <div class="col-sm-2 bs-links">
                @include('partials.menu')
            </div>
            <div class="col-sm-9 bs-order__col">
                <div class="bs-basket">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('homepage') }}">Главная</a></li>
                        <li><a href="{{ route('category', ['catSlug' => $product->category->slug]) }}">{{ $product->category->title }}</a></li>
                        <li> {{ $product->title }}</li>
                    </ul>
                </div>
                <h5 class="bs-basket__heading">{{ $product->title }}</h5>
                <div class="row row_border">
                    <div class="col-sm-8">
                        <div class="row bs-podlozhka__info">
                            <div class="col-sm-5">
                                <img src="{{ (isset($product->image)) ? asset('uploads/' . $product->image) : '/images/not-found.png' }}" alt="{{ $product->title }}">
                            </div>
                            <div class="col-sm-7">
                                <p class="bs-podlozhka__desc">Артикул: <span> 18343378</span></p>
                           
                                @foreach($product->values as $filter)
                            <p class="bs-podlozhka__desc">{{$filter->filter->name}}: <span> {{ $filter->name }}</span></p>
                                @endforeach
                                <div class="bs-podlozhka__links">
                                    <button type="submit">Задать вопрос</button>
                                    <a href="{{ route('wishlist', ['id' => $product->id]) }}">Добавить в избранное</a>
                                    <p>Добавлено <span><img src="/images/added.svg"></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="bs-podlozhka__description">
                            <h5 class="bs-basket__heading">Описание</h5>
                            <div class="bs-podlozhka__text">
                                {!! $product->content !!}
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-sm-4 bs-podlozhka__col">
                        <h6 class="bs-podlozhka__name">Дуб Мокко</h6>
                        <p class="bs-podlozhka__p">3-х слойная паркетная доска</p>
                        <h3 class="bs-podlozhka__cost">5000 тг / полотно</h3>
                        <h3 class="bs-podlozhka__cost">7000 тг / с коробкой</h3>
                        <h6 class="bs-podlozhka__quan">Комплектация</h6>
                        <div class="bs-order__box">
                            <label class="bs-order__checkLabel">
                                <input type="checkbox" name="check" checked=""> с коробкой
                                <span class="checkmark"></span>
                            </label>
                            <label class="bs-order__checkLabel">
                                <input type="checkbox" name="check"> Наличник 1 сторона
                                <span class="checkmark"></span>
                            </label>
                            <label class="bs-order__checkLabel">
                                <input type="checkbox" name="check"> Наличник 2 стороны
                                <span class="checkmark"></span>
                            </label>
                            <label class="bs-order__checkLabel">
                                <input type="checkbox" name="check"> Добор 10 см
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="bs-podlozhka__buttons">
                            <button class="bs-podlozhka__calc">Калькулятора расчета</button>
                            <a href="{{ route('addToCart', ['id' => $product->id]) }}" class="bs-podlozhka__add">Добавить в корзину</a>
                        </div>
                        <p class="bs-podlozhka__p">Минимальный закуп 1 упаковка</p>
                    </div>
                    <div id="myModal" class="bs-basket__modal">
                        <!-- Modal content -->
                        <div class="bs-basket__modal-content">
                            <span class="close">&times;</span>
                            <h4 class="bs-basket__h4">Калькулятор расчет ламината</h4>
                            <form method="post" action="form.php" >
                                <label class="bs-basket__area">Площадь помещения (м2) <input type="text" name="area" placeholder="100" class="bs-basket__inputModal"> М2</label>
                                <div class="bs-basket__modalLine">
                                    <p class="bs-basket__p">Способ укладки</p>
                                    <div class="bs-basket__check">
                                        <label><input type="radio" name="radio"> Диагональный
                                            <span class="checkmark"></span>
                                        </label>
                                        <label><input type="radio" name="radio"> Прямой
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row bs-basket__quality">
                                    <label>Точное количество с запасом <span class="bs-basket__count">57 пачек</span></label>
                                    <label>Точное количество м2 <span class="bs-basket__count">106.248 м2</span></label>
                                </div>
                                <button id="send" class="bs-basket__btn" type="button">Заказать</button>
                                <p class="bs-basket__text">*При диагональном способе укладки, на подрезку, прибавляется 6%</p>
                            </form>
                        </div>
                    </div>
                    <div id="modal" class="bs-basket__modal">
                        <!-- Modal content -->
                        <div class="bs-basket__modal-content bs-basket__modal-content--small">
                            <span class="x">&times;</span>
                            <p class="bs-top__p">Спасибо, Ваше сообщение отправлено!</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                  <div class="bs-podlozhka__review">
                            <h5 class="bs-basket__heading">ОТЗЫВЫ  <span class="count">({{ count($product->reviews) }})</span></h5>
                            @foreach($product->reviews as $review)
                            <div class="row">
                                <div class="col-sm-2">
                                    <img src="{{ asset('images/review.png') }}">
                                </div>
                                <div class="col-sm-10">
                                    <div>
                                        <h6>{{ $review->user->name }}</h6>
                                        <p class="bs-podlozhka__review-date">Вчера в 22:00</p>
                                    </div>
                                    <p class="bs-podlozhka__review-text">{{ $review->content }}</p>
                                </div>
                            </div>
                            @endforeach
                            <button type="submit">Добавить отзыв</button>
                            <form action="{{ route('review') }}" method="POST">
                                {{ csrf_field() }}
                                <textarea name="content"></textarea>
                                <input type="hidden" value="{{ $product->id }}" name="product_id">
                                <input type="hidden" value="{{ (Auth::check()) ? Auth::user()->id : '' }}" name="user_id">
                                <select name="stars" id="">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <button type="submit">Отправить отзыв</button>
                            </form>
                        </div>
                </div>
            </div>
        </div>
        <div class="bs-podlozhka">
            <div class="bs-catalog">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-7">
                        <div class="row bs-catalog__hits">
                            <h5 class="bs-catalog__head">С этим товаром покупают</h5>
                            <div class="hits">
                                <div class="bs-catalog__hit">
                                    <div class="bs-catalog__hitImg">
                                        <img src="/images/mochaDub.png" alt="Дуб">
                                        <a href="" class="back-wishlist"><img src="/images/fav.svg" alt="favorite"></a>
                                        <div class="bs-catalog__hitText">
                                            <p>3-х слойная паркетная доска</p>
                                            <h6>Дуб Мокко</h6>
                                        </div>
                                    </div>
                                    <p class="bs-catalog__size">10 000 кв.м</p>
                                    <a href="" class="bs-catalog__add"><img src="/images/basket.svg" alt="basket" class="bs-catalog__basket"> Добавить в корзину</a>
                                    <div class="bs-catalog__compare">
                                        <ul>
                                            <li class="bs-catalog__like active"><a href=""></a></li>
                                            <li class="bs-catalog__like"><a href=""></a></li>
                                            <li class="bs-catalog__like"><a href=""></a></li>
                                            <li class="bs-catalog__like"><a href=""></a></li>
                                            <li class="bs-catalog__like"><a href=""></a></li>
                                            <li class="bs-catalog__like"><a href=""></a></li>
                                            <li class="bs-catalog__cm"><a href="">Сравнить товар</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="bs-catalog__hit">
                                    <div class="bs-catalog__hitImg">
                                        <img src="/images/mochaDub.png" alt="Дуб">
                                        <a href="" class="back-wishlist"><img src="/images/fav.svg" alt="favorite"></a>
                                        <div class="bs-catalog__hitText">
                                            <p>3-х слойная паркетная доска</p>
                                            <h6>Дуб Мокко</h6>
                                        </div>
                                    </div>
                                    <p class="bs-catalog__size">10 000 кв.м</p>
                                    <a href="" class="bs-catalog__add"><img src="/images/basket.svg" alt="basket" class="bs-catalog__basket"> Добавить в корзину</a>
                                    <div class="bs-catalog__compare">
                                        <ul>
                                            <li class="bs-catalog__like active"><a href=""></a></li>
                                            <li class="bs-catalog__like"><a href=""></a></li>
                                            <li class="bs-catalog__like"><a href=""></a></li>
                                            <li class="bs-catalog__like"><a href=""></a></li>
                                            <li class="bs-catalog__like"><a href=""></a></li>
                                            <li class="bs-catalog__like"><a href=""></a></li>
                                            <li class="bs-catalog__cm"><a href="">Сравнить товар</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="bs-catalog__hit">
                                    <div class="bs-catalog__hitImg">
                                        <img src="/images/mochaDub.png" alt="Дуб">
                                        <a href="" class="back-wishlist"><img src="/images/fav.svg" alt="favorite"></a>
                                        <div class="bs-catalog__hitText">
                                            <p>3-х слойная паркетная доска</p>
                                            <h6>Дуб Мокко</h6>
                                        </div>
                                    </div>
                                    <p class="bs-catalog__size">10 000 кв.м</p>
                                    <a href="" class="bs-catalog__add"><img src="/images/basket.svg" alt="basket" class="bs-catalog__basket"> Добавить в корзину</a>
                                    <div class="bs-catalog__compare">
                                        <ul>
                                            <li class="bs-catalog__like active"><a href=""></a></li>
                                            <li class="bs-catalog__like"><a href=""></a></li>
                                            <li class="bs-catalog__like"><a href=""></a></li>
                                            <li class="bs-catalog__like"><a href=""></a></li>
                                            <li class="bs-catalog__like"><a href=""></a></li>
                                            <li class="bs-catalog__like"><a href=""></a></li>
                                            <li class="bs-catalog__cm"><a href="">Сравнить товар</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="bs-catalog__hit">
                                    <div class="bs-catalog__hitImg">
                                        <img src="/images/mochaDub.png" alt="Дуб">
                                        <a href="" class="back-wishlist"><img src="/images/fav.svg" alt="favorite"></a>
                                        <div class="bs-catalog__hitText">
                                            <p>3-х слойная паркетная доска</p>
                                            <h6>Дуб Мокко</h6>
                                        </div>
                                    </div>
                                    <p class="bs-catalog__size">10 000 кв.м</p>
                                    <a href="" class="bs-catalog__add"><img src="/images/basket.svg" alt="basket" class="bs-catalog__basket"> Добавить в корзину</a>
                                    <div class="bs-catalog__compare">
                                        <ul>
                                            <li class="bs-catalog__like active"><a href=""></a></li>
                                            <li class="bs-catalog__like"><a href=""></a></li>
                                            <li class="bs-catalog__like"><a href=""></a></li>
                                            <li class="bs-catalog__like"><a href=""></a></li>
                                            <li class="bs-catalog__like"><a href=""></a></li>
                                            <li class="bs-catalog__like"><a href=""></a></li>
                                            <li class="bs-catalog__cm"><a href="">Сравнить товар</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="bs-catalog__hit">
                                    <div class="bs-catalog__hitImg">
                                        <img src="/images/mochaDub.png" alt="Дуб">
                                        <a href="" class="back-wishlist"><img src="/images/fav.svg" alt="favorite"></a>
                                        <div class="bs-catalog__hitText">
                                            <p>3-х слойная паркетная доска</p>
                                            <h6>Дуб Мокко</h6>
                                        </div>
                                    </div>
                                    <p class="bs-catalog__size">10 000 кв.м</p>
                                    <a href="" class="bs-catalog__add"><img src="/images/basket.svg" alt="basket" class="bs-catalog__basket"> Добавить в корзину</a>
                                    <div class="bs-catalog__compare">
                                        <ul>
                                            <li class="bs-catalog__like active"><a href=""></a></li>
                                            <li class="bs-catalog__like"><a href=""></a></li>
                                            <li class="bs-catalog__like"><a href=""></a></li>
                                            <li class="bs-catalog__like"><a href=""></a></li>
                                            <li class="bs-catalog__like"><a href=""></a></li>
                                            <li class="bs-catalog__like"><a href=""></a></li>
                                            <li class="bs-catalog__cm"><a href="">Сравнить товар</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="bs-catalog__hit">
                                    <div class="bs-catalog__hitImg">
                                        <img src="/images/mochaDub.png" alt="Дуб">
                                        <a href="" class="back-wishlist"><img src="/images/fav.svg" alt="favorite"></a>
                                        <div class="bs-catalog__hitText">
                                            <p>3-х слойная паркетная доска</p>
                                            <h6>Дуб Мокко</h6>
                                        </div>
                                    </div>
                                    <p class="bs-catalog__size">10 000 кв.м</p>
                                    <a href="" class="bs-catalog__add"><img src="/images/basket.svg" alt="basket" class="bs-catalog__basket"> Добавить в корзину</a>
                                    <div class="bs-catalog__compare">
                                        <ul>
                                            <li class="bs-catalog__like active"><a href=""></a></li>
                                            <li class="bs-catalog__like"><a href=""></a></li>
                                            <li class="bs-catalog__like"><a href=""></a></li>
                                            <li class="bs-catalog__like"><a href=""></a></li>
                                            <li class="bs-catalog__like"><a href=""></a></li>
                                            <li class="bs-catalog__like"><a href=""></a></li>
                                            <li class="bs-catalog__cm"><a href="">Сравнить товар</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(count($similarProducts) > 0)
                        <div class="row bs-catalog__news">
                            <h5 class="bs-catalog__head">Похожие товары</h5>
                            <div class="hits">
                                @foreach($similarProducts as $product)
                                <div class="bs-catalog__hit">
                                    <div class="bs-catalog__hitImg">
                                        <a href="{{ route('product', ['catSlug' => $product->category->slug, 'prodSlug' => $product->slug]) }}">
                                            <img src="{{ asset('uploads/' . $product->image) }}" alt="{{ $product->title }}">
                                        </a>
                                        <a href="{{ route('wishlist', ['id' => $product->id]) }}" class="back-wishlist">
                                            <img src="/images/fav.svg" alt="favorite">
                                        </a>
                                        <div class="bs-catalog__hitText">
                                            <p>3-х слойная паркетная доска</p>
                                            <a href="{{ route('product', ['catSlug' => $product->category->slug, 'prodSlug' => $product->slug]) }}">
                                                <h6>Ясень Standart</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <p class="bs-catalog__size">10 000 кв.м</p>
                                    <a href="{{ route('addToCart', ['id' => $product->id]) }}" class="bs-catalog__add"><img src="/images/basket.svg" alt="basket" class="bs-catalog__basket"> Добавить в корзину</a>
                                    <div class="bs-catalog__compare">
                                        <ul>
                                            <star-rating :rating={{ $product->getCountActiveReviews() }} :read-only="true" :show-rating="false" :star-size="16" :round-start-rating="false"></star-rating>
                                            <li class="bs-catalog__cm"><a href="">Сравнить товар</a></li>
                                        </ul>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        <div class="bs-podlozhka__cat">
                            <a href="{{ route('category', ['catSlug' => $product->category->slug]) }}"> Перейти к каталогу</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection
