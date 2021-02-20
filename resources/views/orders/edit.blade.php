@extends('layout')

@section('content')
    <h1 class="heading has-text-weight-bold is-size-4">Update Order</h1>
    <form class="box" method="POST" action="/orders/{{ $order->id }}">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        <div class="field">
            <label class="label" for="email">email_клиента</label>
            <div class="control">
                <input class="input {{ $errors->has('email') ? 'is-danger' : '' }}" type="text" name="email" id="email" value="{{ $order->client_email }}">
                @if($errors->has('email'))
                    <p class="has-text-danger">{{ $errors->first('email') }}</p>
                @endif
            </div>
        </div>
        <div class="field">
            <label class="label" for="partner">партнер</label>
            <div class="control">
                <div class="select">
                    <select name="partner" id="partner">
                        @foreach($partners as $partner)
                            @if($partner->name === $order->partner->name)
                                <option selected>{{ $partner->name }}</option>
                            @else
                                <option>{{ $partner->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="field">
            <label class="label" for="">продукты</label>
            @foreach($order->orderProducts as $orderProduct)
                <p>{{ $orderProduct->product->name }} - {{ $orderProduct->quantity }}</p>
            @endforeach
        </div>
        <div class="field">
            <label class="label" for="status">статус заказа</label>
            <div class="control">
                <div class="select">
                    <select name="status" id="status">
                        @foreach($order->getStatuses() as $status)
                            @if($status === $order->status)
                                <option selected>{{ $status }}</option>
                            @else
                                <option>{{ $status }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="field">
            <label class="label" for="">стоимость заказ</label>
            <p>{{ $order->getOverallOrderPrice() }}</p>
        </div>
        <div class="field">
            <div class="control">
                <button class="button is-link" type="submit">Submit</button>
            </div>
            @if(session('message'))
                <p class="has-text-success">{{ session('message') }}</p>
            @endif
        </div>
    </form>
@endsection
