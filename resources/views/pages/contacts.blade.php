@extends('layouts.master')
@section('content')
<article class="container">
  <div class="bs-contacts">
    <div class="row">
      <div class="col-sm-2 bs-links">
        <ul class="bs-links__list">
          <li class="bs-links__item active">

            <a href="">Каталог товаров</a>
          </li>
          <li class="bs-links__item">
            <!-- <div class="dropdown"> -->
            <!-- <button class="">Напольные покрытия</button> -->
            <a href="laminat.html"> Напольные покрытия</a>
            <div class="dropdown-content">
              <a href="mocha.html">Дуб Мокко</a>
              <a href="#">Напольные покрытия</a>
              <a href="#">Напольные покрытия</a>
              <a href="#">Напольные покрытия</a>
            </div>
            <!-- </div> -->
            <!-- <a href="">Напольные покрытия</a> -->
          </li>
          <li class="bs-links__item">
            Напольные плинтусы и аксессуары
            <div class="dropdown-content">
              <a href="plintus.html">Плинтус напольный</a>
              <a href="#">Напольные покрытия</a>
              <a href="#">Напольные покрытия</a>
              <a href="#">Напольные покрытия</a>
            </div>
          </li>
          <li class="bs-links__item">
            Подложка и аксессуары для укладки
            <div class="dropdown-content">
              <a href="podlozhka.html">Подложка 2 мм 12 м2</a>
              <a href="#">Напольные покрытия</a>
              <a href="#">Напольные покрытия</a>
              <a href="#">Напольные покрытия</a>
            </div>
          </li>
          <li class="bs-links__item">
            Межкомнатные двери
            <div class="dropdown-content">
              <a href="doors.html">Полотно дверное</a>
              <a href="#">Напольные покрытия</a>
              <a href="#">Напольные покрытия</a>
              <a href="#">Напольные покрытия</a>
            </div>
          </li>
        </ul>
      </div>
      <div class="col-sm-7 bs-advice">
        <div class="bs-basket">
          <ul class="breadcrumb">
            <li>
              <a href="#">Главная</a>
            </li>
            <li> Сеть наших магазинов</li>
          </ul>
        </div>
        <h4 class="bs-deliver__head">Контакты</h4>
        <div class="bs-contacts__shop"></div>
        <div id="map"></div>
      </div>
      <div class="col-sm-2 bs-contacts__links">
        <div id="MainMenu">
          <ul class="bs-contacts__list">
            <li class="">
              <a href="#SubMenu1" class="bs-contacts__item" onclick="zoomPyrenees(); return false;">Алматы</a>
              <div class="bs-contacts__inner collapse list-group-submenu" id="SubMenu1">
                <h4 class="bs-contacts__head"> Магазины «Etalon market» в г. Алматы </h4>
                <div class="row">
                  <div class="col-sm-6">
                    <ul>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees14(); return false;">Ennoca medical </a>
                      </li>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees15(); return false;">Ennoca medical, г. Алматы</a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-sm-6">
                    <ul>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees14(); return false;">Ennoca medical </a>
                      </li>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees15(); return false;">Ennoca medical, г. Алматы</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <a href="#SubMenu2" class="bs-contacts__item" onclick="zoomPyrenees1(); return false;">Астана</a>
              <div class="bs-contacts__inner collapse list-group-submenu" id="SubMenu1">
                <h4 class="bs-contacts__head"> Магазины «Etalon market» в г. Алматы </h4>
                <div class="row">
                  <div class="col-sm-6">
                    <ul>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees14(); return false;">Ennoca medical </a>
                      </li>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees15(); return false;">Ennoca medical, г. Алматы</a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-sm-6">
                    <ul>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees14(); return false;">Ennoca medical </a>
                      </li>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees15(); return false;">Ennoca medical, г. Алматы</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <a href="#SubMenu3" class="bs-contacts__item" onclick="zoomPyrenees2(); return false;">Актау</a>
              <div class="bs-contacts__inner collapse list-group-submenu" id="SubMenu1">
                <h4 class="bs-contacts__head"> Магазины «Etalon market» в г. Алматы </h4>
                <div class="row">
                  <div class="col-sm-6">
                    <ul>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees14(); return false;">Ennoca medical </a>
                      </li>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees15(); return false;">Ennoca medical, г. Алматы</a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-sm-6">
                    <ul>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees14(); return false;">Ennoca medical </a>
                      </li>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees15(); return false;">Ennoca medical, г. Алматы</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <a href="#SubMenu4" class="bs-contacts__item" onclick="zoomPyrenees3(); return false;">Актобе</a>
              <div class="bs-contacts__inner collapse list-group-submenu" id="SubMenu1">
                <h4 class="bs-contacts__head"> Магазины «Etalon market» в г. Алматы </h4>
                <div class="row">
                  <div class="col-sm-6">
                    <ul>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees14(); return false;">Ennoca medical </a>
                      </li>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees15(); return false;">Ennoca medical, г. Алматы</a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-sm-6">
                    <ul>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees14(); return false;">Ennoca medical </a>
                      </li>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees15(); return false;">Ennoca medical, г. Алматы</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <a href="#SubMenu5" class="bs-contacts__item" onclick="zoomPyrenees4(); return false;">Усть-Каменогорск</a>
              <div class="bs-contacts__inner collapse list-group-submenu" id="SubMenu1">
                <h4 class="bs-contacts__head"> Магазины «Etalon market» в г. Алматы </h4>
                <div class="row">
                  <div class="col-sm-6">
                    <ul>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees14(); return false;">Ennoca medical </a>
                      </li>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees15(); return false;">Ennoca medical, г. Алматы</a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-sm-6">
                    <ul>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees14(); return false;">Ennoca medical </a>
                      </li>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees15(); return false;">Ennoca medical, г. Алматы</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <a href="#SubMenu6" class="bs-contacts__item" onclick="zoomPyrenees5(); return false;">Талдыкорган</a>
              <div class="bs-contacts__inner collapse list-group-submenu" id="SubMenu1">
                <h4 class="bs-contacts__head"> Магазины «Etalon market» в г. Алматы </h4>
                <div class="row">
                  <div class="col-sm-6">
                    <ul>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees14(); return false;">Ennoca medical </a>
                      </li>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees15(); return false;">Ennoca medical, г. Алматы</a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-sm-6">
                    <ul>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees14(); return false;">Ennoca medical </a>
                      </li>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees15(); return false;">Ennoca medical, г. Алматы</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <a href="#SubMenu7" class="bs-contacts__item" onclick="zoomPyrenees6(); return false;">Караганда</a>
              <div class="bs-contacts__inner collapse list-group-submenu" id="SubMenu1">
                <h4 class="bs-contacts__head"> Магазины «Etalon market» в г. Алматы </h4>
                <div class="row">
                  <div class="col-sm-6">
                    <ul>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees14(); return false;">Ennoca medical </a>
                      </li>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees15(); return false;">Ennoca medical, г. Алматы</a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-sm-6">
                    <ul>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees14(); return false;">Ennoca medical </a>
                      </li>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees15(); return false;">Ennoca medical, г. Алматы</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <a href="#SubMenu8" class="bs-contacts__item" onclick="zoomPyrenees7(); return false;">Кокшетау</a>
              <div class="bs-contacts__inner collapse list-group-submenu" id="SubMenu1">
                <h4 class="bs-contacts__head"> Магазины «Etalon market» в г. Алматы </h4>
                <div class="row">
                  <div class="col-sm-6">
                    <ul>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees14(); return false;">Ennoca medical </a>
                      </li>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees15(); return false;">Ennoca medical, г. Алматы</a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-sm-6">
                    <ul>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees14(); return false;">Ennoca medical </a>
                      </li>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees15(); return false;">Ennoca medical, г. Алматы</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <a href="#SubMenu9" class="bs-contacts__item" onclick="zoomPyrenees8(); return false;">Костанай</a>
              <div class="bs-contacts__inner collapse list-group-submenu" id="SubMenu1">
                <h4 class="bs-contacts__head"> Магазины «Etalon market» в г. Алматы </h4>
                <div class="row">
                  <div class="col-sm-6">
                    <ul>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees14(); return false;">Ennoca medical </a>
                      </li>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees15(); return false;">Ennoca medical, г. Алматы</a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-sm-6">
                    <ul>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees14(); return false;">Ennoca medical </a>
                      </li>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees15(); return false;">Ennoca medical, г. Алматы</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <a href="#SubMenu10" class="bs-contacts__item" onclick="zoomPyrenees9(); return false;">Кызылорда</a>
              <div class="bs-contacts__inner collapse list-group-submenu" id="SubMenu1">
                <h4 class="bs-contacts__head"> Магазины «Etalon market» в г. Алматы </h4>
                <div class="row">
                  <div class="col-sm-6">
                    <ul>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees14(); return false;">Ennoca medical </a>
                      </li>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees15(); return false;">Ennoca medical, г. Алматы</a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-sm-6">
                    <ul>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees14(); return false;">Ennoca medical </a>
                      </li>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees15(); return false;">Ennoca medical, г. Алматы</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <a href="#SubMenu11" class="bs-contacts__item" onclick="zoomPyrenees10(); return false;">Петропавловск</a>
              <div class="bs-contacts__inner collapse list-group-submenu" id="SubMenu1">
                <h4 class="bs-contacts__head"> Магазины «Etalon market» в г. Алматы </h4>
                <div class="row">
                  <div class="col-sm-6">
                    <ul>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees14(); return false;">Ennoca medical </a>
                      </li>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees15(); return false;">Ennoca medical, г. Алматы</a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-sm-6">
                    <ul>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees14(); return false;">Ennoca medical </a>
                      </li>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees15(); return false;">Ennoca medical, г. Алматы</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <a href="#SubMenu12" class="bs-contacts__item" onclick="zoomPyrenees11(); return false;">Павлодар</a>
              <div class="bs-contacts__inner collapse list-group-submenu" id="SubMenu1">
                <h4 class="bs-contacts__head"> Магазины «Etalon market» в г. Алматы </h4>
                <div class="row">
                  <div class="col-sm-6">
                    <ul>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees14(); return false;">Ennoca medical </a>
                      </li>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees15(); return false;">Ennoca medical, г. Алматы</a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-sm-6">
                    <ul>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees14(); return false;">Ennoca medical </a>
                      </li>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees15(); return false;">Ennoca medical, г. Алматы</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <a href="#SubMenu13" class="bs-contacts__item" onclick="zoomPyrenees12(); return false;">Тараз </a>
              <div class="bs-contacts__inner collapse list-group-submenu" id="SubMenu1">
                <h4 class="bs-contacts__head"> Магазины «Etalon market» в г. Алматы </h4>
                <div class="row">
                  <div class="col-sm-6">
                    <ul>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees14(); return false;">Ennoca medical </a>
                      </li>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees15(); return false;">Ennoca medical, г. Алматы</a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-sm-6">
                    <ul>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees14(); return false;">Ennoca medical </a>
                      </li>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees15(); return false;">Ennoca medical, г. Алматы</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <a href="#SubMenu14" class="bs-contacts__item" onclick="zoomPyrenees13(); return false;">Шымкент </a>
              <div class="bs-contacts__inner collapse list-group-submenu" id="SubMenu1">
                <h4 class="bs-contacts__head"> Магазины «Etalon market» в г. Алматы </h4>
                <div class="row">
                  <div class="col-sm-6">
                    <ul>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees14(); return false;">Ennoca medical </a>
                      </li>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees15(); return false;">Ennoca medical, г. Алматы</a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-sm-6">
                    <ul>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees14(); return false;">Ennoca medical </a>
                      </li>
                      <li>
                        <a href="#" class="bs-contacts__item" data-parent="#SubMenu1" onclick="zoomPyrenees15(); return false;">Ennoca medical, г. Алматы</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</article>
@endsection

@section('before_jquery')
<style>
  /*style the box*/

  .gm-style .gm-style-iw {
    background-color: rgba(0, 68, 3, .9) !important;
    top: 0 !important;
    left: 0 !important;
    width: 100% !important;
    height: 100% !important;
    min-height: 120px !important;
    padding-top: 10px;
    display: block !important;
  }

  /*style the p tag*/

  .gm-style .gm-style-iw #google-popup p {
    padding: 10px;
  }


  /*style the arrow*/

  .gm-style div div div div div div div div {
    background-color: transparent !important;
    box-shadow: none !important;
    border: none !important;
    width: 100% !important;
    height: 100% !important;
    padding: 0;
    margin: 0;
    padding: 10px 20px;
    top: 0;
    color: #fff;
    font-size: 16px;
  }

  .gm-style div div div div div div img {
    display: none !important;
  }

  /*style the link*/

  .gm-style div div div div div div div div a {
    color: transparent;
    font-weight: bold;
  }
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3Z0yl4L708msLmktufijK06xBC0Gtyfw" type="text/javascript"></script>
<script type="text/javascript">
  var locations = [
    ['Ennoca medical, г. Алматы, ул. Дуйсенова, 25/202', 43.2541325, 76.8837935, 4],
    // ['Ennoca medical, г. Алматы, ул. Дуйсенова, 25/202', 43.2541315, 76.8837955, 4],
    ['ТОО "ОрдаМед Астана", г. Астана, ул. Бейбитшилик, д. 25, оф. 321, БЦ «Оркен»', 51.1721174, 71.4166263, 4],
    ['ТОО "ОрдаМед Актау", г. Актау, 11-й микрорайон, 35А', 43.657655, 51.150242, 4],
    ['ТОО "ОрдаМед Актобе", г. Актобе, ул.М.Оспанова, 67, оф.54 «А», склад оф.16', 50.2749811, 57.1676047, 4],
    ['ТОО "ОрдаМед Восток" , г. Усть-Каменогорск, ул. Серикбаева, зд.1, оф. 305', 49.9596586, 82.5908147, 4],
    ['ТОО "ОрдаМед Жетысу", г.Талдыкорган, микрорайон 7, здание 10, Гостиничный комплекс «KOKTEM GRAND»', 44.9991025,
      78.3364675, 4
    ],
    ['ТОО "ОрдаМед Караганда", г. Караганда, пр. Бухар Жырау, 49/6, офис 812-813', 49.8170321, 73.0761681, 4],
    ['ТОО "ОрдаМед Кокшетау" г. Кокшетау, ул.Ауельбекова 179А/207', 53.2863823, 69.4104784, 4],
    ['ТОО "ОрдаМед Костанай" г.Костанай, ул. Карбышева 2, офис 118', 53.2066945, 63.5874375, 4],
    ['ТОО "ОрдаМед Кызылорда" г. Кызылорда, ул. А. Байтурсынова 46Б, Бизнес-центр "Мега Оптика"', 44.8264164,
      65.5125925, 4
    ],
    ['ТОО "ОрдаМед Петропавловск" г. Петропавловск, ул. Чкалова, д.48, оф. 222.', 54.8872393, 69.1437945, 4],
    ['ТОО "ОрдаМед Павлодар" г. Павлодар, переулок им. Гоголя, д.123.', 52.2722476, 76.9614752, 4],
    ['ТОО "ОрдаМед Тараз" г. Тараз, Толе би, дом 61, кв.(офис) 30', 42.9009463, 71.3640182, 4],
    ['ТОО "ОрдаМед Шымкент" г. Шымкент, 4-й микрорайон, ул. Байтулы-баба, 18 зд. Байтерек-8', 42.337186, 69.560661, 4],
    ['Ennoca jhrkdf, г. Алматы, ул. Дуйсенова, 25/202', 43.5552215, 76.8827945, 4],
  ];

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 5,
    center: new google.maps.LatLng(48.6351736, 66.0231749, 5),
    mapTypeId: google.maps.MapTypeId.TERRAIN
  });

  var infowindow = new google.maps.InfoWindow({
    maxWidth: 200
  });

  // var iconBase = new google.maps.Marker(
  //   // '../images/marker.png',
  //   null, /* size is determined at runtime */
  //   null, /* origin is 0,0 */
  //   null, /* anchor is bottom center of the scaled image */
  //   new google.maps.Size(32, 48)
  // );
  var marker, i;

  for (i = 0; i < locations.length; i++) {
    marker = new google.maps.Marker({
      position: new google.maps.LatLng(locations[i][1], locations[i][2]),
      // icon: iconBase,
      map: map
    });

    google.maps.event.addListener(marker, 'mouseout', (function (marker, i) {
      return function () {
        infowindow.close();
      }
    })(marker, i));
    google.maps.event.addListener(marker, 'mouseover', (function (marker, i) {
      return function () {
        infowindow.setContent(locations[i][0]);
        infowindow.open(map, marker);
      }
    })(marker, i));

  }
</script>
@endsection