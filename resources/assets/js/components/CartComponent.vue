<template>
<div>
    <div>
        <div class="bs-basket">
            <ul class="breadcrumb">
                <li><a href="/">Главная</a></li>
                <li>Корзина</li>
            </ul>
            <div class="row bs-basket--rel"  style="margin-bottom: 60px">
                <div class="col-sm-9 bs-basket-9">
                    <h5 class="bs-basket__heading"> <span><a href="/"><img src="/images/back.png" alt="back"></a></span> ВАША КОРЗИНА <span class="count">({{ count }})</span></h5>
                    <div v-for="(product, keyProduct) in products" :key="keyProduct">
                        <div class="row bs-basket__row">
                            <div class="col-sm-1 bs-basket__img">
                                <img :src="product.options.image != '' ? product.options.image : '/images/not-found.png'" :alt="product.name">
                            </div>
                            <div class="col-sm-4 bs-basket__bigCol">
                                <p class="bs-basket__about">{{ product.name }} 
                                    <br>{{ product.options.category + ' ' + product.options.brand.name }}
                                    
                                </p>
                                <ul>
                                    <!-- v-if="product.options.equipments.length > 0" -->
                                    <li  v-for="(item, keyItem) in product.options.equipments" :key="keyItem">{{ $item.name }} </li>
                                </ul>
                            </div>
                            
                            <div class="col-sm-3 bs-basket__qual">
                                <div class="bs-basket__counter">
                                    <button type="submit" @click="changeQuality('plus', product.rowId)">+</button>
                                    <p>{{ product.qty }}</p>
                                    <div v-if="product.qty == 1">
                                        <button type="button">-</button>
                                    </div>
                                    <div v-else>
                                        <button type="submit" @click="changeQuality('minus', product.rowId)">-</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 bs-basket__cost">
                                <p class="bs-basket__cost">{{ product.price }}  тг / 1 {{ getType(product.options.type) }}</p>
                                <h4 class="bs-basket__costTotal">{{ product.subtotal }} тг / {{ product.qty }} {{ getType(product.options.type) }}</h4>
                            </div>
                            <div class="col-sm-1 bs-basket__delete">
                                <a @click="deleteProductInBasket(product.rowId)"><img src="/images/delete.svg" alt="X" class=""></a>
                            </div>
                        </div>
                        <div class="row bs-basket__row-mob">
                            <div class="col-xs-2 bs-basket__img">
                                <img :src="product.options.image != '' ? product.options.image : '/images/not-found.png'" :alt="product.name">
                            </div>
                            <div class="col-xs-9 bs-basket__bigCol">
                                <p class="bs-basket__about">
                                    <br>{{ product.options.category + ' ' + product.options.brand.name }}
                                    <br>{{ product.name }}
                                </p>
                                <p class="bs-basket__cost">{{ product.price }}  тг</p>
                                <div class="bs-basket__counter">
                                        <button @click="changeQuality('plus', product.rowId)">+</button>
                                    <p>{{ product.qty }}</p>
                                    <div v-if="product.qty == 1">
                                        <button  type="button">-</button>
                                    </div>
                                    <div v-else>
                                        <button @click="changeQuality('minus', product.rowId)">-</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-1 bs-basket__delete">
                                <a style="cursor: pointer" @click="deleteProductInBasket(product.rowId)"><img src="/images/delete.svg" alt="X" class=""></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row bs-basket__buttons">
                    <div class="row bs-basket__buttons-cost">
                        <p class="bs-basket__text bs-basket__text--total">ВЫБРАНО: <span class="count">{{ count }} товаров</span></p>
                        <p class="bs-basket__text bs-basket__text--total">ИТОГО: <span class="count">{{ total }} тг</span></p>
                    </div>
                    <button class="bs-basket__order">
                        <a href="#"> Оформить заказ</a>
                    </button>
                    <form>
                        <input class="bs-basket__promo" type="text" name="promo" placeholder="ПРОМОКОД">
                    </form>
                </div>
                <div class="col-sm-3 bs-basket-oform">
                    <div>
                        <hr class="bs-basket__line">
                        <p class="bs-basket__text bs-basket__text--total">ИТОГОВАЯ СТОИМОСТЬ</p>
                        <p class="bs-basket__costText"> {{ total }} тг
                        </p>
                        <button class="bs-basket__order">
                            <a href="#"> Оформить заказ</a>
                        </button>
                        <form>
                            <input class="bs-basket__promo" type="text" name="promo" placeholder="ПРОМОКОД">
                        </form>
                    </div>
                </div>
            </div>
            <div class="sibling"></div>
        </div>
    </div>
    
</div>
</template>

<script>
export default {
    data() {
        return {
            products: [],
            count: '',
            total: '',
        };
    },
    mounted() {
         axios
      .get('/v1/get-basket')
      .then(response => (
          this.products = response.data.data,
          this.count = response.data.count,
          this.total = response.data.total
        ))
    },
    methods: {
        changeQuality(type, id) {
            axios.post('/cart-change-quantity', {
                    product: id,
                    change: type
                })
                .then(response => (
                    this.products = response.data.data,
                    this.count = response.data.count,
                    this.total = response.data.total
                ))
        },
        deleteProductInBasket(id) {
            axios.post('/remove-to-basket', {
                    id: id,
                })
                .then(response => (
                    this.products = response.data.data,
                    this.count = response.data.count,
                    this.total = response.data.total
                ))
        },
        getType(type) {
            if (type == 'polotno') {
                return 'полотно';
            } else if (type == 'thing') {
                return 'шт.';
            } else {
                return 'за уп.';
            }
           
        }
    }
}
</script>
