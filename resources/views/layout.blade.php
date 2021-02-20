<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Avangard</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
</head>
<body>
<div class="container">
    <div class="tabs">
        <ul>
            <li class="{{ request()->is('bryansk-weather') ? 'is-active' : ''  }}"><a href="/bryansk-weather">Температура в Брянске</a></li>
            <li class="{{ request()->is('orders') ? 'is-active' : ''  }}"><a href="/orders">Все заказы</a></li>
            <li class="{{ request()->is('orders/overdue') ? 'is-active' : ''  }}"><a href="/orders/overdue">Просроченные заказы</a></li>
            <li class="{{ request()->is('orders/current') ? 'is-active' : ''  }}"><a href="/orders/current">Текущие заказы</a></li>
            <li class="{{ request()->is('orders/new') ? 'is-active' : ''  }}"><a href="/orders/new">Новые заказы</a></li>
            <li class="{{ request()->is('orders/completed') ? 'is-active' : ''  }}"><a href="/orders/completed">Завершенные заказы</a></li>
        </ul>
    </div>
    @yield('content')
</div>
</body>
</html>
