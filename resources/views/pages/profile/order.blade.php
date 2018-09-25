@extends('layouts.master')

@section('content')
<article class="container bs-profile">
    <div class="row">
        <div class="col-sm-2 bs-profile__links">
            @include('partials.profile-menu')
        </div>
        <div class="col-sm-10 col">
            <h4 class="bs-profile__head">Мои покупки</h4>
            <div class="bs-profile__innerShop">
                <h6 class="bs-profile__innerShop-head">Заказ №{{$order->id}}</h6>
                <div class="bs-profile__innerShop-info">
                <p>
                    <label>Получатель:</label>{{ $order->name }}
                </p>
                <p>
                    <label>Способ доставки:</label> TODO
                </p>
                <p>
                    <label>Адрес доставки:</label> {{ $order->city }}: {{ $order->address }}
                </p>
                <p>
                    <label>Способ оплаты:</label> TODO
                </p>
                <p>
                    <label>К оплате:</label> TODO tg
                </p>
                </div>
                <table style="width:100%">
                <tr>
                    <th>Модель</th>
                    <th>Кол-во</th>
                    <th>Цена </th>
                </tr>
                @foreach(json_decode($order->products) as $product)
                <tr>
                    
                    <td>
                    <img src="{{ asset('uploads/' . $product->item->image) }}" class=""> {{ $product->item->title }}
                    </td>
                    <td>{{ $product->qty }}</td>
                    <td>{{ $product->price }} тг.</td>
                </tr>
                @endforeach
                </table>
            </div>
        </div>
    </div>
</article>
@endsection