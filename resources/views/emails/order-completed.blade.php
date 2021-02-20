<h1>Заказ №{{ $number }} завершен!</h1>

<h2>Состав заказа:</h2>
<ul>
    @foreach($products as $product)
        <li>{{ $product }}</li>
    @endforeach
</ul>

<h2>Общая стоимость заказа: {{ $price }}</h2>
