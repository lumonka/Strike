@extends('layouts.app')
@section('content')
    <div class="catalog__filter mb-3">
        <a href="?filter=new" class="catalog__filter-item">Новые</a>
        <a href="?filter=confirmed" class="catalog__filter-item">Подтвержденные</a>
        <a href="?filter=canceled" class="catalog__filter-item">Отмененные</a>
        <a href="/orders" class="catalog__filter-item">Показать все</a>
    </div>
    <div class="user">
            <div class="user-orders orders">
                @foreach($orders as $order)
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ФИО Клиента
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Товары в заказе
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Дата создания
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Итог сумма
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Статус
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Действие
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <code>{{ $order->number }}</code>
                                    @if($order->status == 'Новый')
                                        <div class="order__delete">
                                            <form action="/order-delete/{{ $order->number }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <input type="submit" class="btn btn-danger bg-red-700" value="Удалить заказ">
                                            </form>
                                        </div>
                                    @endif
                                </th>
                                <td>
                                    <div class="order__products">
                                        @foreach($order->products as $product)
                                            <div class="order__product">
                                                {{ $product->title }} x{{ $product->qty }}: {{ $product->price * $product->qty }} руб.
                                            </div>
                                        @endforeach
                                        Всего товаров: {{ $order->totalQty }}
                                    </div>
                                </td>
                                @foreach($order->products as $product)
                                    <td class="px-6 py-4">
                                    {{ $order->date }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $order->totalPrice }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $order->status }}
                                    </td>
                                @endforeach
                                <td class="">
                                <form action="/order-status/confirm/{{ $order->number }}" method="post">
                                    @method('patch')
                                    @csrf
                                    <input type="submit" class="btn btn-primary bg-blue-700" value="Подтвердить">
                                </form>
                                <form action="/order-status/cancel/{{ $order->number }}" method="post">
                                    @method('patch')
                                    @csrf
                                    <input type="submit" class="btn btn-danger bg-red-700" value="Отменить">
                                </form>
                            </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
    </div>
{{--    <table class="order__table table container">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th>ФИО клиента</th>--}}
{{--            <th>Товары в заказе</th>--}}
{{--            <th>Дата создания</th>--}}
{{--            <th>Итог сумма</th>--}}
{{--            <th>Статус</th>--}}
{{--            <th>Действия</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        @foreach($orders as $order)--}}
{{--            <tr class="order__raw">--}}
{{--                <td>{{ $order->number }}--}}
{{--                    @if($order->status == 'Новый')--}}
{{--                        <div class="order__delete">--}}
{{--                            <form action="/order-delete/{{ $order->number }}" method="post">--}}
{{--                                @method('delete')--}}
{{--                                @csrf--}}
{{--                                <input type="submit" class="btn btn-danger" value="Удалить заказ">--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </td>--}}
{{--                <td>--}}
{{--                    <div class="order__products">--}}
{{--                        @foreach($order->products as $product)--}}
{{--                            <div class="order__product">--}}
{{--                                {{ $product->title }} x{{ $product->qty }}: {{ $product->price * $product->qty }} руб.--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                        Всего товаров: {{ $order->totalQty }}--}}
{{--                    </div>--}}
{{--                </td>--}}
{{--                <td>{{ $order->date }}</td>--}}
{{--                <td>{{ $order->totalPrice }}</td>--}}
{{--                <td>{{ $order->status }}</td>--}}
{{--                <td class="">--}}
{{--                    <form action="/order-status/confirm/{{ $order->number }}" method="post">--}}
{{--                        @method('patch')--}}
{{--                        @csrf--}}
{{--                        <input type="submit" class="btn btn-success" value="Подтвердить">--}}
{{--                    </form>--}}
{{--                    <form action="/order-status/cancel/{{ $order->number }}" method="post">--}}
{{--                        @method('patch')--}}
{{--                        @csrf--}}
{{--                        <input type="submit" class="btn btn-danger" value="Отменить">--}}
{{--                    </form>--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
{{--    </table>--}}
@endsection
