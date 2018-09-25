@extends('layouts.master')

@section('content')
<article class="container bs-profile">
    <div class="row">
        <div class="col-sm-2 bs-profile__links">
            @include('partials.profile-menu')
        </div>
        <div class="col-sm-10 col">
            <h4 class="bs-profile__head">Мои покупки</h4>
            <div class="bs-profile__shop">
                <table style="width:100%">
                <tr>
                    <th>Номер заказа</th>
                    <th>Дата покупки</th>
                    <th>Цена (тг)</th>
                    <th>Кол-во</th>
                    <th>Адрес доставки</th>
                    <th>Статус заказа</th>
                </tr>
                @foreach($orders as $order)
                <tr onclick="document.location = '{{ route('profile.order', ['id' => $order->id]) }}';">
                    <td>{{$order->id}}</td>
                    <td>{{ $order->created_at}}</td>
                    <td>todo</td>
                    <td>todo</td>
                    <td>{{ $order->address }}</td>
                    <td>{{ $order->status }}</td>
                </tr>
                @endforeach
                </table>
            </div>
        </div>
    </div>
</article>
@endsection