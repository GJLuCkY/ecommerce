@extends('layouts.master')


@section('content')
    <article class="container">
        <p><b>ID заказа: </b>{{ $order->id }}</p>
        <p><b>ID пользователя: </b>{{ $order->user_id }}</p>
        <p><b>Имя пользователя: </b>{{ $order->name }}</p>
        <p><b>Адрес: </b>{{ $order->address }}</p>
        <p><b>E-mail: </b>{{ $order->email }}</p>
        <p><b>Ваш комментарий: </b>{{ $order->comment }}</p>
        <p><b>Метод оплаты: </b>{{ $order->method }}</p>
        <p><b>Метод доставки: </b>{{ $order->delivery_method }}</p>




        <h3>Товары:</h3>
        <ul>
            @foreach($order->products as $product)
            <li>{{ $product->name }} - {{ $product->price }} тг * {{ $product->qty }}</li>
            @endforeach
        </ul>

        <p><b>Итого: </b>{{ $order->total_price }}</p>


        <p><b>Статус заказа: </b>{{ $order->status }}</p>
        <p><b>Ответ processing: </b>{{ $otvet }}</p>
    </article>
@endsection
