<div class="addToCartModal" id="addToCartModal">
    <form class="addToCartModal__content" action="{{ route('addToCart') }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="id">
        <span class="close">&times;</span>
        <h3>Вы добавили в корзину</h3>
        <div class="addToCartModal__row">
            <input type="hidden" name="pack" value="1">
            <img src=" " alt=" ">
            <p></p>
            <div class="addToCartModal__type">
                <div class="addToCartModal__quan">
                    <button type="button" class="minus minus-first">-</button>
                    <input id="uintTextBox" type="text" value="1" max="" required name="quantity">
                    <button type="button" class="plus plus-first">+</button>
                </div>
                <div>
                    <span class="cost"><span class="cost-first">5 418</span> ₸ / 1<span class="product-type">шт.</span></span>
                </div>
            </div>

            <div class="addToCartModal__type">
                <div class="addToCartModal__quan">
                    <button type="button" class="minus minus-second">-</button>
                    <input id="uintTextBox2" type="text" value="1" required name="secondqty">
                    <button type="button" class="plus plus-second">+</button>
                </div>
                <div>
                    <span class="cost"><span class="cost-second">5 418</span> ₸ / 1<span class="product-type-second">м²</span></span>
                </div>
            </div>
            
            <div class="addToCartModal__total">
                <span>ИТОГОВАЯ СТОИМОСТЬ</span>
                <h5 class="modalTotalPrice"><span>5 418</span> ₸ </h5>
            </div>
        </div>
        <div class="addToCartModal__linkWrp">
        <button type="submit" name="button" value="first">ПРОДОЛЖИТЬ ПОКУПКИ</button>
        <button type="submit" name="button" value="second" style="width: -webkit-fit-content; width: -moz-fit-content; width: fit-content; padding: 10px 36px; display: block; background-color: #00ab0c; color: #fff; font-weight: 600; font-size: 12px;"> Оформить заказ</a>
        </div>
    </form>
</div>