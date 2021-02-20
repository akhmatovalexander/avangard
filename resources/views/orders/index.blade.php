@extends('layout')
@section('content')
    <h1 class="heading has-text-weight-bold is-size-4">Orders</h1>
    <table class="table box is-hoverable">
        <thead>
        <tr>
            <th class="">ид_заказа</th>
            <th class="">название_партнера</th>
            <th class="">стоимость_заказа</th>
            <th class="">наименование_состав_заказа</th>
            <th class="">статус_заказа</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td class=""><a href="/orders/{{ $order->id }}/edit">{{ $order->id }}</a></td>
                <td class="">{{ $order->partner->name }}</td>
                <td class="">
                    {{ $order->getOverallOrderPrice() }}
                </td>
                <td class="">
                    @foreach($order->getProductsNames() as $productName)
                        <p>{{ $productName }}</p>
                    @endforeach
                </td>
                <td class="">{{ $order->status }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
