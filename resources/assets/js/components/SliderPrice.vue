<template>
  <div>
    <div class="bs-order__boxRange">
      <section class="range-slider">
        <span class="rangeValues">
          <span class="bs-laminat__min">{{ value[0] }}</span>
          <hr>
          <span class="bs-laminat__max">{{ value[1] }}</span>

        </span>
        <form>
          <vue-slider ref="slider" v-model="value" :dot-size="dotSize" :bg-style="bgStyle" :min="minPrice" :max="maxPrice" :tooltip="tooltip"
            :tooltip-dir="tooltipDir"  :tooltip-style="tooltipStyle" :process-style="processStyle"></vue-slider>
        </form>
      </section>
      <span class="bs-laminat__apply" v-on:click="getProductOnPrice">Применить</span>
    </div>
  </div>
</template>
<script>
  import vueSlider from 'vue-slider-component';
  import axios from 'axios';

  export default {
    components: {
      vueSlider
    },
    props: ['maxPrice', 'minPrice', 'catSlug', 'price'],
    data() {
      return {
        slugCategory: this.catSlug,
        oldPrice: this.price,
        dotSize: 20,
        tooltip: 'always',
        tooltipDir: ['bottom', 'top'],
        show: false,
        width: "100%",
        priceRange: [this.minPrice, this.maxPrice],
        bgStyle: {
          "backgroundColor": "#fff",
          "boxShadow": "inset 0.5px 0.5px 3px 1px rgba(0,0,0,.36)"
        },
        
        tooltipStyle: [{
            "backgroundColor": "#f05b72",
            "borderColor": "#f05b72",
            "display": "none"
          },
          {
            "backgroundColor": "#3498db",
            "borderColor": "#3498db",
            "display": "none"
          }
        ],
        processStyle: {
          "backgroundImage": "white"
        },
        value: []
      }
    },
    computed: {
      max() {
        return this.maxPrice
      },
      min() {
        return this.minPrice
      },
    },
    methods: {
      getProductOnPrice: function (event) {
        var str = window.location.search;
        var result = [];
        str.replace(/([^?=&]+)(?:[&#]|=([^&#]*))/g, function (match, key, value) {
            if (key.indexOf("[]") !== -1) {
                key = key.replace(/\[\]$/, "");
                if(!(result[key])) {
                    result[key] = new Array();
                }
                result[key].push(value);
            } else {
                result[key] = value || 1;
            }
        });
        var url = "/catalog/" + this.slugCategory;
        var first_iteration_without_price = true;
        var issetPrice = false;
        for (var k in result){
          if (result.hasOwnProperty(k)) {
            var name = k //price
            var value = result[k];
            if(k != 'price') {
              if(first_iteration_without_price) {
                url += '?' + name + '=' + value;
              } else {
                url += '&' + name + '=' + value;
              }
              first_iteration_without_price = false;
              issetPrice = true;
            } else {
              issetPrice = false;
            }
          }
        }
        var price = '';
        if(!issetPrice) {
            price = "?price="
        } else {
            price = "&price="
        }
     
        window.location.href = url + price + this.value[0] + "-" + this.value[1]
      },
      getParams: function (event) {
        if (this.oldPrice.length > 0) {
          var re = /\s*-\s*/
          this.value = this.oldPrice.split(re);
        } else {
          this.value = [
            this.minPrice,
            this.maxPrice
          ]
        }
      }
    },
    mounted() {
      this.getParams();
    }

  }
</script>

<style>
  .vue-slider-component {
    padding: 0px !important;
  }

  .vue-slider-tooltip-wrap {
    display: none !important;
  }

  .bs-laminat__apply {
    width: 100%;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
  }
</style>
