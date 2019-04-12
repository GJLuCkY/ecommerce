$(document).ready(function () {
  // Get the modal
  var modal = document.getElementById('myModal');

  var pop = document.getElementById('modal');

  var sign = document.getElementById('sign');
  var login = document.getElementById('login');
  var addToCartModal = document.getElementsByClassName('addToCartModal')[0];

  var catalog = document.getElementById('mob-catalog');

  // Get the button that opens the modal
  var btn = document.getElementsByClassName("myBtn");

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  var send = document.getElementById("send");

  var x = document.getElementsByClassName("x")[0];

  var back = document.getElementsByClassName("cat-head-close")[0];

  var mod = document.getElementsByClassName('bs-services__modal')[0];
  var close = document.getElementsByClassName('bs-header__signup')[0];
  var log = document.getElementsByClassName('bs-header__login')[0];

  // When the user clicks the button, open the modal
  $('.bs-podlozhka__calc').click(function () {
    modal.style.display = "block";
    // $('body').css("overflow", "hidden");
  });

  $('.mob-header__item--cat button').click(function () {
    catalog.style.display = "block";
    // $('body').css("overflow", "hidden");
  });

  $('.bs-catalog__add').click(function () {
    $('.addToCartModal__content #uintTextBox').attr('value', 1);
    img = $(this).parent().find('.prodImg').attr('src');
    alt = $(this).parent().find('.prodImg').attr('alt');
    name = $(this).parent().find('.bs-catalog__hitText a').text();
    price = $(this).parent().find('.bs-catalog__size span').text().replace(/ /g, '');
    value = $('.addToCartModal__quan input[name*=quantity]').val();
    total = parseInt(price) * parseInt(value);
    id = $(this).parent().find('.bs-catalog__hitText input[name*=id]').val();
    type = $(this).parent().find('.bs-catalog__hitText input[name*=type]').val();
    quantity = $(this).parent().find('.bs-catalog__hitText input[name*=quantity]').val();
    packaging = $(this).parent().find('.bs-catalog__hitText input[name*=packaging]').val();
    console.log(packaging);
    $('.addToCartModal__row input[name*=pack]').val(packaging);
    $('.addToCartModal__quan input[name*=quantity]').val(1);
    $('.addToCartModal__quan input[name*=secondqty]').val(1 * packaging);
    $('.addToCartModal__content img').attr('src', img);
    $('.addToCartModal__content img').attr('alt', alt);
    $('.addToCartModal__content p').html(name);
    $('.addToCartModal__content .cost-first').html(number_format(price, 0, ',', ' '));
    $('.addToCartModal__content .cost-second').html(number_format((price / packaging * 1000) / 1000, 0, ',', ' '));
    // $('.addToCartModal__total .modalTotalPrice span').html(number_format(total, 0, ',', ' '));
    $('.addToCartModal__total .modalTotalPrice span').html(total);
    $('.addToCartModal__content input[name*=id]').attr('value', id);
    $('.addToCartModal__content #uintTextBox').attr('max', quantity);
    $('.addToCartModal__content #uintTextBox2').attr('max', quantity * packaging);
    $('.addToCartModal__content .product-type').html(productType(type));

    // console.log($(this).parent().parent().find('.prodImg'));
    addToCartModal.style.display = "block";
    $('body').css("overflow", "hidden");
  });

  $('.addToCartModal .close').click(function () {
    addToCartModal.style.display = "none";
    $('body').css("overflow", "scroll");
  });

  $(btn).click(function () {
    modal.style.display = "block";
  });

  $(close).click(function () {
    sign.style.display = "block";
  });
  $(log).click(function () {
    login.style.display = "block";
  });

  // $('.bs-services__col').click(function(){
  // 	mod.style.display = "block";
  // 	$('.bs-services__desc').text($(this).find('.bs-services__small').text());
  // 	$('.bs-services__detail').html($(this).find('.bs-services__info').html());
  // 	// $('.bs-services__ul').html($(this).find('.bs-services__info ul').html());
  // });


  // When the user clicks on <span> (x), close the modal
  if (span) {
    span.onclick = function () {
      modal.style.display = "none";
    };
  }
  // x.onclick = function () {
  //   sign.style.display = "none";
  //   login.style.display = "none";
  // };
  $("#login .x").click(function () {
    login.style.display = "none";
  });
  $("#sign .x").click(function () {
    sign.style.display = "none";
  });

  if (back) {
    back.onclick = function () {
      catalog.style.display = "none";
    };
  }

  // When the user clicks anywhere outside of the modal, close it
  $(window).click(function (event) {
    if (event.target === modal) {
      modal.style.display = "none";
    }
    if (event.target === sign) {
      sign.style.display = "none";
    }
    if (event.target === login) {
      login.style.display = "none";
    }
    if (event.target === addToCartModal) {
      addToCartModal.style.display = "none";
      $('body').css("overflow", "scroll");
    }
  });

  if (send) {
    send.onclick = function () {
      modal.style.display = "none";
      pop.style.display = "block";
      x.style.display = "none";
      setTimeout(TimeOut, 3000);
    };
  }

  function TimeOut() {
    pop.style.display = "none";
  }
});

$(document).ready(function () {
  $('.addToCartModal__quan .plus-first').click(function () {
    quantity = $('.addToCartModal__quan input[name*=quantity]').attr('max');
    value = $('.addToCartModal__quan input[name*=quantity]').val();
    packaging = $('.addToCartModal__row input[name*=pack]').val();
    price = $('.addToCartModal__content .cost-first').text().replace(/ /g, '');

    console.log(price);
    if (parseInt(value) < parseInt(quantity)) {
      value++;
    }
    $('.addToCartModal__total .modalTotalPrice span').html(number_format(parseInt(value) * parseInt(price), 0, ',', ' '));
    $('.addToCartModal__quan input[name*=quantity]').val(value);
    $('.addToCartModal__quan input[name*=secondqty]').val(value * packaging);
    $('.addToCartModal__content .cost-second').html(number_format((parseInt(price) / packaging * 1000) / 1000, 0, ',', ' '));
  });
  $('.addToCartModal__quan input[name*=quantity]').on('input', function () {
    quantity = $('.addToCartModal__quan input[name*=quantity]').attr('max');
    value = $('.addToCartModal__quan input[name*=quantity]').val();
    packaging = $('.addToCartModal__row input[name*=pack]').val();
    price = $('.addToCartModal__content .cost-first').text().replace(/ /g, '');
    if (parseInt(value) > parseInt(quantity)) {
      value = value.substr(0, value.length - 1);
    }

    if (parseInt(value) == 0) {
      value = 1;
    }
    $('.addToCartModal__total .modalTotalPrice span').html(number_format(parseInt(value) * parseInt(price), 0, ',', ' '));
    $('.addToCartModal__quan input[name*=quantity]').val(value);
    $('.addToCartModal__quan input[name*=secondqty]').val(value * packaging);
  });
  $('.addToCartModal__quan input[name*=quantity]').on('input', function () {
    quantity = $('.addToCartModal__quan input[name*=quantity]').attr('max');
    value = $('.addToCartModal__quan input[name*=quantity]').val();
    price = $('.addToCartModal__content .cost-first').text().replace(/ /g, '');
    if (parseInt(value) > parseInt(quantity)) {
      value = value.substr(0, value.length - 1);
    }

    if (parseInt(value) == 0) {
      value = 1;
    }
    $('.addToCartModal__total .modalTotalPrice span').html(number_format(parseInt(value) * parseInt(price), 0, ',', ' '));
    $('.addToCartModal__quan input[name*=quantity]').val(value);
  });
  $('.addToCartModal__quan .minus-first').click(function () {
    if ($('.addToCartModal__quan input[name*=quantity]').val() > 1) {
      value = $('.addToCartModal__quan input[name*=quantity]').val();
      price = $('.addToCartModal__content .cost-first').text().replace(/ /g, '');
      packaging = $('.addToCartModal__row input[name*=pack]').val();
      value--;
      $('.addToCartModal__total .modalTotalPrice span').html(number_format(parseInt(value) * parseInt(price), 0, ',', ' '));
      $('.addToCartModal__quan input[name*=quantity]').val(value);
      $('.addToCartModal__quan input[name*=secondqty]').val(value * packaging);
      $('.addToCartModal__content .cost-second').html(number_format((parseInt(price) / packaging * 1000) / 1000, 0, ',', ' '));
    }
  });


  function setInputFilter(textbox, inputFilter) {
    ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function (event) {
      textbox.addEventListener(event, function () {
        if (inputFilter(this.value)) {
          this.oldValue = this.value;
          this.oldSelectionStart = this.selectionStart;
          this.oldSelectionEnd = this.selectionEnd;
        } else if (this.hasOwnProperty("oldValue")) {
          this.value = this.oldValue;
          this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
        }
      });
    });
  }

  setInputFilter(document.getElementById("uintTextBox"), function (value) {
    return /^\d*$/.test(value);
  });
});


function productType(type) {
  if (type == 'polotno') {
    return 'полотно';
  } else if (type == 'thing') {
    return 'шт.';
  } else {
    return 'уп.';
  }
  // return "м²";



}


function number_format(number, decimals, dec_point, thousands_sep) {
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







$(document).ready(function () {
  $('.addToCartModal__quan .plus-second').click(function () {
    quantity = $('.addToCartModal__quan input[name*=quantity]').attr('max');
    value = $('.addToCartModal__quan input[name*=secondqty]').val();
    packaging = $('.addToCartModal__row input[name*=pack]').val();
    price = $('.addToCartModal__content .cost-first').text().replace(/ /g, '');

    console.log(price);
    if (parseInt(value) < parseInt(quantity)) {
      value++;
    }
    $('.addToCartModal__total .modalTotalPrice span').html(number_format(parseInt(value) * parseInt(price), 0, ',', ' '));
    $('.addToCartModal__quan input[name*=quantity]').val(Math.ceil(value / packaging));
    $('.addToCartModal__quan input[name*=secondqty]').val(value);
    $('.addToCartModal__content .cost-second').html(number_format((parseInt(price) / packaging * 1000) / 1000, 0, ',', ' '));
  });

  $('.addToCartModal__quan .minus-second').click(function () {
    if ($('.addToCartModal__quan input[name*=quantity]').val() > 1) {
      value = $('.addToCartModal__quan input[name*=secondqty]').val();
      price = $('.addToCartModal__content .cost-first').text().replace(/ /g, '');
      packaging = $('.addToCartModal__row input[name*=pack]').val();
      value--;
      $('.addToCartModal__total .modalTotalPrice span').html(number_format(parseInt(value) * parseInt(price), 0, ',', ' '));
      $('.addToCartModal__quan input[name*=quantity]').val(Math.ceil(value / packaging));
      $('.addToCartModal__quan input[name*=secondqty]').val(value);
      $('.addToCartModal__content .cost-second').html(number_format((parseInt(price) / packaging * 1000) / 1000, 0, ',', ' '));
    }
  });

  $('.addToCartModal__quan input[name*=secondqty]').on('input', function () {
    quantity = $('.addToCartModal__quan input[name*=quantity]').attr('max');
    value = $('.addToCartModal__quan input[name*=secondqty]').val();
    packaging = $('.addToCartModal__row input[name*=pack]').val();
    price = $('.addToCartModal__content .cost-first').text().replace(/ /g, '');
    if (parseInt(value) > parseInt(quantity)) {
      value = value.substr(0, value.length - 1);
    }

    if (parseInt(value) == 0) {
      value = 1;
    }
    $('.addToCartModal__total .modalTotalPrice span').html(number_format(parseInt(value) * parseInt(price), 0, ',', ' '));
    $('.addToCartModal__quan input[name*=quantity]').val(Math.ceil(value / packaging));
    $('.addToCartModal__quan input[name*=secondqty]').val(value);
  });

});
