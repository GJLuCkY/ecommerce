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
    $('.bs-podlozhka__calc').click(function(){
      modal.style.display = "block";
      // $('body').css("overflow", "hidden");
    });

    $('.mob-header__item--cat button').click(function(){
      catalog.style.display = "block";
      // $('body').css("overflow", "hidden");
    });

    $('.bs-catalog__add').click(function(){
      img = $(this).parent().parent().find('.prodImg').attr('src');
      alt = $(this).parent().parent().find('.prodImg').attr('alt');
      name = $(this).parent().parent().find('.bs-catalog__hitText a').text();
      $('.addToCartModal__content img').attr('src', img);
      $('.addToCartModal__content img').attr('alt', alt);
      $('.addToCartModal__content p').html(name);

      // console.log($(this).parent().parent().find('.prodImg'));
      addToCartModal.style.display = "block";
      $('body').css("overflow", "hidden");
    });

    $('.addToCartModal .close').click(function(){
      addToCartModal.style.display = "none";
      $('body').css("overflow", "scroll");
    });

    $(btn).click(function(){
    	modal.style.display = "block";
    });

     $(close).click(function(){
    	sign.style.display = "block";
    });
    $(log).click(function(){
    	login.style.display = "block";
    });

    // $('.bs-services__col').click(function(){
    // 	mod.style.display = "block";
    // 	$('.bs-services__desc').text($(this).find('.bs-services__small').text());
    // 	$('.bs-services__detail').html($(this).find('.bs-services__info').html());
    // 	// $('.bs-services__ul').html($(this).find('.bs-services__info ul').html());
    // });


	// When the user clicks on <span> (x), close the modal
	if(span) {
        span.onclick = function() {
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

  if(back) {
        back.onclick = function() {
            catalog.style.display = "none";
        };
	}

	// When the user clicks anywhere outside of the modal, close it
	$(window).click(function(event) {
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

	if(send) {
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
  $('.addToCartModal__quan .plus').click(function(){
    value = $('.addToCartModal__quan input').val();
    value++;
    $('.addToCartModal__quan input').val(value);
    // cost = $('.addToCartModal .cost').text();
    // cost = parseInt(cost);
  });

  $('.addToCartModal__quan .minus').click(function(){
    if($('.addToCartModal__quan input').val() > 1){
      value = $('.addToCartModal__quan input').val();
      value--;
      $('.addToCartModal__quan input').val(value);
    }
  });


  function setInputFilter(textbox, inputFilter) {
    ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
      textbox.addEventListener(event, function() {
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

  setInputFilter(document.getElementById("uintTextBox"), function(value) {
    return /^\d*$/.test(value);
  });
});
