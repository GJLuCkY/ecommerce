@extends('layouts.master')


@section('content')
<article class="container">
  <div class="row bs-podlozhka">
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
    <div class="col-sm-9 bs-brands">
      <div class="bs-basket">
        <ul class="breadcrumb">
          <li>
            <a href="#">Главная</a>
          </li>
          <li> Бренды</li>
        </ul>
      </div>
      <h4 class="bs-brands__head">Бренды</h4>
      <div class="row">
        <div class="col-sm-3">
          <a href="kronostar.html">
            <img src="images/krono.png" alt="brand">
            <p class="bs-brands__text">Ламинированные напольные покрытия</p>
          </a>
        </div>
        <div class="col-sm-3">
          <a href="">
            <img src="images/krono.png" alt="brand">
            <p class="bs-brands__text">Ламинированные напольные покрытия</p>
          </a>
        </div>
        <div class="col-sm-3">
          <a href="">
            <img src="images/krono.png" alt="brand">
            <p class="bs-brands__text">Ламинированные напольные покрытия</p>
          </a>
        </div>
        <div class="col-sm-3">
          <a href="">
            <img src="images/krono.png" alt="brand">
            <p class="bs-brands__text">Ламинированные напольные покрытия</p>
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <a href="">
            <img src="images/krono.png" alt="brand">
            <p class="bs-brands__text">Ламинированные напольные покрытия</p>
          </a>
        </div>
        <div class="col-sm-3">
          <a href="">
            <img src="images/krono.png" alt="brand">
            <p class="bs-brands__text">Ламинированные напольные покрытия</p>
          </a>
        </div>
        <div class="col-sm-3">
          <a href="">
            <img src="images/krono.png" alt="brand">
            <p class="bs-brands__text ">Ламинированные напольные покрытия</p>
        </div>
        </a>.png" alt="brand">
        <div class="col-sm-3">
          <a href="">
            <img src="images/krono.png" alt="brand">
            <p class="bs-brands__text">Ламинированные напольные покрытия</p>
          </a>
        </div>
      </div>
    </div>
  </div>
</article>
@endsection
