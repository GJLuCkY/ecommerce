@extends('layouts.master')

@section('content')
{{-- {{ dd() }} --}}
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
                            <p class="bs-podlozhka__desc">Артикул: <span> {{ $product->article }}</span></p>
                               
                                @foreach($product->values as $filter)
                              <p class="bs-podlozhka__desc">{{$filter->filter->name}}: <span> {{ $filter->name }}</span></p>
                                @endforeach
                                <div class="bs-podlozhka__links">
                                    <button type="submit">Задать вопрос</button>
                                    @if(Auth::check())
                                        @if(empty(Wishlist::getWishlistItem($product->id, Auth::user()->id)))
                                        <a href="{{ route('wishlist', ['id' => $product->id]) }}">Добавить в избранное</a>
                                        @else
                                        <p>Добавлено <span><img src="/images/added.svg"></span></p>
                                        @endif
                                    @else
                                        <a href="#" class="bs-wishlist-register">Добавить в избранное</a>
                                    @endif
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
                        <form action="{{ route('addToCart') }}" method="post">
                            {!! csrf_field() !!}
                            @if(isset($product->packaging))
                            <h3 class="bs-podlozhka__cost"><span>{{ number_format($product->price / $product->packaging, 0, ',', ' ') }}</span> ₸ / 1 м²</h3>
                            @endif
                            
                            
                            <h3 class="bs-podlozhka__cost"><span>{{ number_format($product->price, 0, ',', ' ') }}</span> ₸ / 
                            
                                @if($product->type == 'polotno')
                                полотно
                                @elseif($product->type == 'thing')
                                шт.
                                @else
                                за уп.
                                @endif
                                </h3>
                                @if(count($equipment) > 0)
                                <h3 class="bs-podlozhka__cost"><span id="price2">{{ number_format($product->price, 0, ',', ' ') }}</span> ₸ / итого</h3>
                                @endif
                                @if($product->type == 'polotno')
                            <h6 class="bs-podlozhka__quan">Комплектация</h6>
                            @elseif($product->type == 'thing')
                            <h6 class="bs-podlozhka__quan">Количество в штуках</h6>
                            @else
                            <h6 class="bs-podlozhka__quan">Количество упаковок</h6>
                            @endif
                            @if($product->type !== 'polotno')
                            <div class="quantity">
                            <input type="number" min="1" max="{{ $product->quantity }}" step="1" value="1" name="quantity" id="quantity-change"><div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>
                                <span class="bs-podlozhka__equal">=</span>
                                <div class="bs-podlozhka__plintus">
                                    <h6 class="bs-podlozhka__plintus-area" ><span id="packaging-summa-izm">{{ isset($product->packaging) ? $product->packaging: 1 }}</span> 
                                        @if($product->type == 'polotno')
                                        полотно
                                        @elseif($product->type == 'thing')
                                        шт.
                                        @else
                                        м²
                                        @endif</h6>
                                <p class="bs-podlozhka__plintus-pay">(<span id="packaging-summa">{{ number_format($product->price, 0, ',', ' ') }}</span> ₸)</p>
                                </div>
                            </div>
                            @endif
                                    
                            @include('partials.equipment')
                            <div class="bs-podlozhka__buttons">
                            <input type="hidden" name="id" value="{{ $product->id }}">
                                @if($product->type !== 'polotno')
                                <span class="bs-podlozhka__calc" style="cursor: pointer;display: block; text-align: center">Калькулятора расчета</span>
                                @endif
                                <button type="submit" class="bs-podlozhka__add">Добавить в корзину</button>
                            </div>
                            @if($product->type == 'package')
                            <p class="bs-podlozhka__p">Минимальный закуп 1 упаковка</p>
                            @endif
                        </form>
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
                                        <h6 class="bs-podlozhka__review-name">{{ $review->user->name }}</h6>
                                        <star-rating :rating={{ $review->stars }} :read-only="true" :show-rating="false" :star-size="16" :round-start-rating="false"></star-rating>
                                        <p class="bs-podlozhka__review-date">Вчера в 22:00</p>
                                    </div>
                                    <p class="bs-podlozhka__review-text">{{ $review->content }}</p>
                                </div>
                            </div>
                            @endforeach
                            <p class="bs-podlozhka__rebiew-add">Добавить отзыв</p>
                            <form action="{{ route('review') }}" method="POST">
                                {{ csrf_field() }}
                                <input class="bs-podlozhka__review-input" type="text" name="name" placeholder="Имя">
                                <textarea class="bs-podlozhka__review-area" name="content" placeholder="Напишите Ваш отзыв."></textarea>
                                <input type="hidden" value="{{ $product->id }}" name="product_id">
                                <input type="hidden" value="{{ (Auth::check()) ? Auth::user()->id : '' }}" name="user_id">
                                <!-- <select name="stars" id="">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select> -->
                                <label class="bs-podlozhka__review-label">Поставьте оценку:</label>
                                <star-rating inactive-color="#fff" :border-width="3"></star-rating>
                                <input type="hidden" value="1" name="stars" id="review-stars">
                                <button type="submit">Отправить</button>
                            </form>
                        </div>
                </div>
            </div>
            <div id="myModal" class="bs-basket__modal calculator">
                        <!-- Modal content -->
                        <div class="bs-basket__modal-content">
                            <span class="close">&times;</span>
                            <h4 class="bs-basket__h4">Калькулятор расчет ламината</h4>
                            <form method="post" action="form.php" >
                                <label class="bs-basket__area">Площадь помещения (м2) <input type="text" name="area" placeholder="100" class="bs-basket__inputModal"> <span> М2 </span></label>
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
            <div class="bs-podlozhka-mob">
              <h5 class="bs-basket__heading"><a href="{{ route('category', ['catSlug' => $product->category->slug]) }}"><span><img src="/images/back.png" alt="back"></span></a>{{ $product->title }}</h5>
              <ul class="bs-podlozhka-mob__list">
                <li data-value="1" class="active">Описание </li>
                <li data-value="2" >Характеристики </li>
                <li data-value="3" >Отзывы </li>
              </ul>
              <div data-value="1" class="bs-podlozhka-mob__info">
                <div class="bs-podlozhka-mob__desc">
                    <img src="{{ (isset($product->image)) ? asset('uploads/' . $product->image) : '/images/not-found.png' }}" alt="{{ $product->title }}">
                    <div class="bs-podlozhka__text">
                        {!! $product->content !!}
                    </div>
                    <div class="bs-podlozhka__buttons">
                      <div>
                        <button class="bs-podlozhka__calc">Калькулятора расчета</button>
                        <p class="bs-podlozhka-mob__cost">ЦЕНА: <span>{{ number_format($product->price, 0, ',', ' ') }} ₸</span></p>
                      </div>
                      <div>
                        <a href="{{ route('wishlist', ['id' => $product->id]) }}" class="bs-podlozhka-mob-wishlist">
                          <img src="/images/heart.svg" alt="favorite">
                        </a>


                        <form action="{{ route('addToCart') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <button type="submit" class="bs-podlozhka__add">
                                        КУПИТЬ
                                </button>
                            </form>
                        {{-- <a href="{{ route('addToCart', ['id' => $product->id]) }}" >КУПИТЬ</a> --}}
                      </div>
                    </div>
                  </div>
              </div>
              <div data-value="2" class="bs-podlozhka-mob__info">
                <div class="bs-podlozhka-mob__desc">
                    <p class="bs-podlozhka__desc">Артикул: <span> 18343378</span></p>
                      @foreach($product->values as $filter)
                    <p class="bs-podlozhka__desc">{{$filter->filter->name}}: <span> {{ $filter->name }}</span></p>
                      @endforeach
                      <div class="bs-podlozhka__buttons">
                      <div>
                        <button class="bs-podlozhka__calc">Калькулятора расчета</button>
                        <p class="bs-podlozhka-mob__cost">ЦЕНА: <span>2 600 ТГ</span></p>
                      </div>
                      <div>
                        <a href="{{ route('wishlist', ['id' => $product->id]) }}" class="bs-podlozhka-mob-wishlist">
                          <img src="/images/heart.svg" alt="favorite">
                        </a>
                        <a href="{{ route('addToCart', ['id' => $product->id]) }}" class="bs-podlozhka__add">КУПИТЬ</a>
                      </div>
                    </div>
                  </div>
              </div>
              <div data-value="3" class="bs-podlozhka-mob__info">
                <div class="bs-podlozhka-mob__desc">
                    @foreach($product->reviews as $review)
                      <div>
                          <h6 class="bs-podlozhka__review-name">{{ $review->user->name }}</h6>
                          <div class="bs-catalog__compare">
                              <ul>
                                  <li class="bs-catalog__like active"><a href=""></a></li>
                                  <li class="bs-catalog__like"><a href=""></a></li>
                                  <li class="bs-catalog__like"><a href=""></a></li>
                                  <li class="bs-catalog__like"><a href=""></a></li>
                                  <li class="bs-catalog__like"><a href=""></a></li>
                                  <li class="bs-catalog__like"><a href=""></a></li>
                              </ul>
                          </div>
                          <p class="bs-podlozhka__review-date">Вчера в 22:00</p>
                      </div>
                      <p class="bs-podlozhka__review-text">{{ $review->content }}</p>
                    @endforeach
                    <div class="bs-podlozhka__buttons">
                      <button id="awdawd" class="bs-podlozhka__review-add dobavitOtziv">Добавить отзыв</button>
                      <form class="bs-podlozhka__review-form" action="{{ route('review') }}" method="POST">
                          {{ csrf_field() }}
                          <label>Имя</label>
                          <input type="text" name="name" placeholder="Введите ваше имя">
                          <label>Отзыв</label>
                          <textarea name="content" placeholder="Напишите Ваш отзыв."></textarea>
                          <input type="hidden" value="{{ $product->id }}" name="product_id">
                          <input type="hidden" value="{{ (Auth::check()) ? Auth::user()->id : '' }}" name="user_id">
                          <label class="small-label">Оцените продукт</label>
                          <select name="stars">
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                          </select>
                          <div class="bs-podlozhka__buttons">
                            <button class="back-button" type="submit">НАЗАД</button>
                            <button class="send-button" type="submit">ОТПРАВИТЬ</button>
                          </div>
                      </form>
                    </div>
                  </div>
              </div>
            </div>
        </div>
        <div class="bs-podlozhka">
            <div class="bs-catalog">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-7">
                        @if(count($otherProducts) > 0)
                        <div class="row bs-catalog__hits">
                            <h5 class="bs-catalog__head">С этим товаром покупают</h5>
                            <div class="hits">
                                @foreach($otherProducts as $otherProduct)
                                <div class="bs-catalog__hit">
                                        <div class="bs-catalog__hitImg">
                                            <a href="{{ route('product', ['catSlug' => $otherProduct->category->slug, 'prodSlug' => $otherProduct->slug]) }}">
                                                <img src="{{ (isset($otherProduct->image)) ? asset('uploads/' . $otherProduct->image) : '/images/not-found.png' }}" alt="{{ $otherProduct->title }}">
                                            </a>
                                            <a href="{{ route('wishlist', ['id' => $product->id]) }}" class="back-wishlist">
                                                <img src="/images/fav.svg" alt="favorite">
                                            </a>
                                            <div class="bs-catalog__hitText">
                                                <p>{{ isset($otherProduct->category->custom_name) ? $otherProduct->category->custom_name : $otherProduct->category->title }} {{ $otherProduct->brand->name }}</p>
                                                <a href="{{ route('product', ['catSlug' => $otherProduct->category->slug, 'prodSlug' => $otherProduct->slug]) }}">
                                                    <h6>{{ $otherProduct->title }}</h6>
                                                </a>
                                            </div>
                                        </div>
                                        <p class="bs-catalog__size">{{ number_format($otherProduct->price, null, ',', ' ') }} ₸</p>
                                        <form action="{{ route('addToCart') }}" method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{ $otherProduct->id }}">
                                                <button type="submit" class="bs-catalog__add">
                                                    <img src="/images/basket.svg" alt="basket" class="bs-catalog__basket">   
                                                    Добавить в корзину
                                                </button>
                                            </form>
                                        {{-- <a href="{{ route('addToCart', ['id' => $otherProduct->id]) }}" class="bs-catalog__add"><img src="/images/basket.svg" alt="basket" class="bs-catalog__basket"> Добавить в корзину</a> --}}
                                        <div class="bs-catalog__compare">
                                            <ul>
                                                <star-rating :rating={{ $otherProduct->getCountActiveReviews() }} :read-only="true" :show-rating="false" :star-size="16" :round-start-rating="false"></star-rating>
                                                <li class="bs-catalog__cm"><a href="">Сравнить товар</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        @if(count($similarProducts) > 0)
                        <div class="row bs-catalog__news">
                            <h5 class="bs-catalog__head">Похожие товары</h5>
                            <div class="hits">
                                @foreach($similarProducts as $similarProduct)
                                <div class="bs-catalog__hit">
                                    <div class="bs-catalog__hitImg">
                                        <a href="{{ route('product', ['catSlug' => $similarProduct->category->slug, 'prodSlug' => $similarProduct->slug]) }}">
                                            <img src="{{ (isset($similarProduct->image)) ? asset('uploads/' . $similarProduct->image) : '/images/not-found.png' }}" alt="{{ $similarProduct->title }}">
                                        </a>
                                        <a href="{{ route('wishlist', ['id' => $product->id]) }}" class="back-wishlist">
                                            <img src="/images/fav.svg" alt="favorite">
                                        </a>
                                        <div class="bs-catalog__hitText">
                                            <p>{{ isset($similarProduct->category->custom_name) ? $similarProduct->category->custom_name : $similarProduct->category->title }} {{ isset($similarProduct->brand->name) ? $similarProduct->brand->name : '' }}</p>
                                            <a href="{{ route('product', ['catSlug' => $similarProduct->category->slug, 'prodSlug' => $similarProduct->slug]) }}">
                                                <h6>{{ $similarProduct->title }}</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <p class="bs-catalog__size">{{ number_format($similarProduct->price, null, ',', ' ') }} ₸</p>
                                    <form action="{{ route('addToCart') }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id" value="{{ $similarProduct->id }}">
                                            <button type="submit" class="bs-catalog__add">
                                                <img src="/images/basket.svg" alt="basket" class="bs-catalog__basket">   
                                                Добавить в корзину
                                            </button>
                                        </form>
                                    {{-- <a href="{{ route('addToCart', ['id' => $similarProduct->id]) }}" class="bs-catalog__add"><img src="/images/basket.svg" alt="basket" class="bs-catalog__basket"> Добавить в корзину</a> --}}
                                    <div class="bs-catalog__compare">
                                        <ul>
                                            <star-rating :rating={{ $similarProduct->getCountActiveReviews() }} :read-only="true" :show-rating="false" :star-size="16" :round-start-rating="false"></star-rating>
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


@section('after_jquery')
<script>
        var summ = {{ $product->price }};
       
            $(document).on("change", ".subproducts", function() {
                summ+=((this.checked?1:-1)*$(this).data('price'));
                
                $("#price2").html(number_format(summ, 0, ',', ' '));
            });
            

            var summa = 0;
            var izm = {{ isset($product->packaging) ? $product->packaging : 1 }}
            $(document).on("change", "#quantity-change", function() {
                $("#packaging-summa-izm").html(Math.round(this.value * izm * 1000) / 1000);
                summa = this.value * {{ $product->price }}
                $("#packaging-summa").html(number_format(summa, 0, ',', ' '));
            });

            $(document).on("click", ".vue-star-rating-pointer", function() {
                var rating = $('.vue-star-rating-rating-text').html();
                $('#review-stars').val(rating);
                console.log($('#review-stars').val());
            });
   

    </script>


<script>
function number_format (number, decimals, dec_point, thousands_sep) {
    // Strip all characters but numerical ones.
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

</script>
    @endsection
