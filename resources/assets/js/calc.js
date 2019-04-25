$(document).ready(function(){
  var area, areaNumber;
  $(".areaCheck input").click(function (){
    $(".areaCheck input").removeClass("checked");
    $(this).toggleClass("checked");

    area = document.getElementById("area").value;
    areaNumber = parseInt(area); 
    if ($('#diagonal').hasClass("checked")){
      areaNumber = areaNumber + (areaNumber * .06);
      $("#areaResult").html(areaNumber);
    } else {
      areaNumber = areaNumber + (areaNumber * .05);
      $("#areaResult").html(areaNumber);
    }
  });
  $("#area").keyup(function(){
    area = this.value;
    // qweqweqeqewqe
    areaNumber = parseInt(area);    
    if ($('#diagonal').hasClass("checked")){
      areaNumber = areaNumber + (areaNumber * .06);
    } else if ($('#pryamoi').hasClass("checked")){
      areaNumber = areaNumber + (areaNumber * .05);
    }
    $("#areaResult").html(areaNumber);
  });
});
