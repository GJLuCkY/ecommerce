$(document).ready(function () {
	// Get the modal
	var modal = document.getElementById('myModal');

	var pop = document.getElementById('modal');

  var sign = document.getElementById('sign');
  var login = document.getElementById('login');

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
    });

     $('.mob-header__item--cat button').click(function(){
       catalog.style.display = "block";
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
	window.onclick = function(event) {
	    if (event.target === modal) {
	        modal.style.display = "none";
	    }
	    if (event.target === sign) {
	        sign.style.display = "none";
      }
      if (event.target === login) {
        login.style.display = "none";
      }
	};

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
