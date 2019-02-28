<div class="addToCartModal" id="addToCartModal">
    <form class="addToCartModal__content" action="{{ route('addToCart') }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="id">
        <span class="close">&times;</span>
        <h3>Вы добавили в корзину</h3>
        <div class="addToCartModal__row">
            <img src=" " alt=" ">
            <p></p>
            <div class="addToCartModal__quan">
                <button type="button" class="plus">+</button>
                <input id="uintTextBox" type="text" value="1" max="" required name="quantity">
                <button type="button" class="minus">-</button>
            </div>
            <div>
                <span class="cost"><span>5 418</span> ₸ / 1шт.</span>
            </div>
            <div class="addToCartModal__total">
                <span>ИТОГОВАЯ СТОИМОСТЬ</span>
                <h5 class="modalTotalPrice"><span>5 418</span> ₸ </h5>
            </div>
        </div>
        <div class="addToCartModal__linkWrp">
        <button type="submit">ПРОДОЛЖИТЬ ПОКУПКИ</button>
        <a href="{{ route('checkout') }}"> Оформить заказ</a>
        </div>
    </form>
</div>